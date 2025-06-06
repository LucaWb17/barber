<?php
// Include configuration file
require_once '../config.php';

// Start the session
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Fallback DB credentials if not defined in config.php
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'clipper_db');

// 1. Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method. Only POST is accepted.']);
    exit();
}

// 2. Retrieve and Validate Input (Basic Validation)
$barber_id = filter_input(INPUT_POST, 'barber_id', FILTER_VALIDATE_INT);
$service_id = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
$appointment_datetime_str = $_POST['appointment_datetime'] ?? ''; // Expected format YYYY-MM-DD HH:MM:SS
$customer_name = trim($_POST['customer_name'] ?? '');
$customer_email = trim($_POST['customer_email'] ?? '');
$customer_phone = trim($_POST['customer_phone'] ?? '');

$errors = [];

if (empty($barber_id)) {
    $errors['barber_id'] = 'Please select a barber.';
}
if (empty($service_id)) {
    $errors['service_id'] = 'Please select a service.';
}
if (empty($appointment_datetime_str)) {
    $errors['appointment_datetime'] = 'Appointment date and time are required.';
} else {
    $new_app_start_dt = DateTime::createFromFormat('Y-m-d H:i:s', $appointment_datetime_str);
    if (!$new_app_start_dt || $new_app_start_dt->format('Y-m-d H:i:s') !== $appointment_datetime_str) {
        // Try Y-m-d H:i as a fallback, assuming seconds might be missing (though JS should send them)
        $new_app_start_dt = DateTime::createFromFormat('Y-m-d H:i', $appointment_datetime_str);
        if (!$new_app_start_dt || $new_app_start_dt->format('Y-m-d H:i') !== $appointment_datetime_str) {
            $errors['appointment_datetime'] = 'Invalid date and time format. Expected YYYY-MM-DD HH:MM(:SS). Received: ' . htmlspecialchars($appointment_datetime_str);
        } else {
             $appointment_datetime_str .= ':00'; // Normalize to H:i:s for DB
             $new_app_start_dt = DateTime::createFromFormat('Y-m-d H:i:s', $appointment_datetime_str); // Re-create for consistency
        }
    }
}

if (empty($customer_name)) {
    $errors['customer_name'] = 'Your name is required.';
}
if (empty($customer_email)) {
    $errors['customer_email'] = 'Your email is required.';
} elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    $errors['customer_email'] = 'Invalid email format.';
}
if (empty($customer_phone)) {
    $errors['customer_phone'] = 'Your phone number is required.';
} elseif (!preg_match('/^[0-9\s\-\+\(\)]+$/', $customer_phone)) {
    $errors['customer_phone'] = 'Invalid phone number format.';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit();
}

// 3. User ID
$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// 4. Database Interaction & Advanced Conflict Check
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch Service Duration for the new booking
$stmt_service_duration = $conn->prepare("SELECT duration_minutes FROM services WHERE id = ?");
if (!$stmt_service_duration) {
    http_response_code(500); echo json_encode(['error' => 'DB error (service duration prepare): ' . $conn->error]); $conn->close(); exit;
}
$stmt_service_duration->bind_param("i", $service_id);
if (!$stmt_service_duration->execute()) {
    http_response_code(500); echo json_encode(['error' => 'DB error (service duration execute): ' . $stmt_service_duration->error]); $stmt_service_duration->close(); $conn->close(); exit;
}
$result_service_duration = $stmt_service_duration->get_result();
if ($row_duration = $result_service_duration->fetch_assoc()) {
    $new_service_duration_minutes = (int)$row_duration['duration_minutes'];
} else {
    http_response_code(400); echo json_encode(['errors' => ['service_id' => 'Invalid service selected.']]); $stmt_service_duration->close(); $conn->close(); exit;
}
$stmt_service_duration->close();

// Define New Booking Interval
$new_app_end_dt = (clone $new_app_start_dt)->modify("+" . $new_service_duration_minutes . " minutes");

// Check Against Working Hours/Days
$day_of_week_int = (int)$new_app_start_dt->format('w'); // 0 for Sunday, 6 for Saturday
if ($day_of_week_int === 0 || $day_of_week_int === 1) { // Sunday or Monday
    http_response_code(400); echo json_encode(['errors' => ['appointment_datetime' => 'Bookings are only available from Tuesday to Saturday.']]); $conn->close(); exit;
}

$shop_open_time_str = '08:00:00';
$shop_close_time_str = '21:00:00';
$new_app_start_time_str = $new_app_start_dt->format('H:i:s');
$new_app_end_time_str = $new_app_end_dt->format('H:i:s');

if ($new_app_start_time_str < $shop_open_time_str || $new_app_end_time_str > $shop_close_time_str) {
    http_response_code(400); echo json_encode(['errors' => ['appointment_datetime' => 'Booking time is outside of working hours (08:00 AM - 09:00 PM).']]); $conn->close(); exit;
}
if ($new_app_end_dt->format('Y-m-d') !== $new_app_start_dt->format('Y-m-d')) {
     http_response_code(400); echo json_encode(['errors' => ['appointment_datetime' => 'Booking cannot span across midnight.']]); $conn->close(); exit;
}
// Check if appointment is in the past (even after format validation)
$now_dt = new DateTime();
if ($new_app_start_dt < $now_dt) {
    http_response_code(400); echo json_encode(['errors' => ['appointment_datetime' => 'Cannot book appointments in the past.']]); $conn->close(); exit;
}


// Fetch Existing Appointments for Overlap Check
$date_for_query = $new_app_start_dt->format('Y-m-d');
$sql_existing = "SELECT a.appointment_datetime, s.duration_minutes
                 FROM appointments a
                 JOIN services s ON a.service_id = s.id
                 WHERE a.barber_id = ? AND DATE(a.appointment_datetime) = ? AND a.status = 'scheduled'
                 ORDER BY a.appointment_datetime ASC";
$stmt_existing = $conn->prepare($sql_existing);
if (!$stmt_existing) {
    http_response_code(500); echo json_encode(['error' => 'DB error (existing appts prepare): ' . $conn->error]); $conn->close(); exit;
}
$stmt_existing->bind_param("is", $barber_id, $date_for_query);
if (!$stmt_existing->execute()) {
    http_response_code(500); echo json_encode(['error' => 'DB error (existing appts execute): ' . $stmt_existing->error]); $stmt_existing->close(); $conn->close(); exit;
}
$result_existing = $stmt_existing->get_result();
$existing_appointments = $result_existing->fetch_all(MYSQLI_ASSOC);
$stmt_existing->close();

// Perform Overlap Check
foreach ($existing_appointments as $existing_app) {
    $existing_app_start_dt = new DateTime($existing_app['appointment_datetime']);
    $existing_app_end_dt = (clone $existing_app_start_dt)->modify("+" . (int)$existing_app['duration_minutes'] . " minutes");

    if (($new_app_start_dt < $existing_app_end_dt) && ($new_app_end_dt > $existing_app_start_dt)) {
        http_response_code(409); // Conflict
        echo json_encode(['error' => 'The selected time slot conflicts with an existing appointment. Please choose a different time.']);
        $conn->close();
        exit;
    }
}

// Insert Appointment (If all checks passed)
$sql_insert = "INSERT INTO appointments (user_id, barber_id, service_id, appointment_datetime, customer_name, customer_email, customer_phone, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'scheduled')";
$stmt_insert = $conn->prepare($sql_insert);
if (!$stmt_insert) {
    http_response_code(500); echo json_encode(['error' => 'Database error (insert prepare): ' . $conn->error]); $conn->close(); exit;
}

// For user_id, if it's null, mysqli handles it if the column is nullable.
$stmt_insert->bind_param(is_null($user_id) ? "siissss" : "iiissss", $user_id, $barber_id, $service_id, $appointment_datetime_str, $customer_name, $customer_email, $customer_phone);
// Note: If user_id is consistently an int or null, 'i' should work for null too in mysqli if column is nullable.
// However, to be absolutely explicit, we can change type string. Let's stick to 'i' as it usually works.
// Reverted to "iiissss" as user_id is int or null, which 'i' handles for nullable INT columns.

$stmt_insert->bind_param("iiissss", $user_id, $barber_id, $service_id, $appointment_datetime_str, $customer_name, $customer_email, $customer_phone);


if ($stmt_insert->execute()) {
    // Email sending logic (remains unchanged from previous implementation)
    $barber_name = "N/A"; /* ... fetch ... */ $service_name = "N/A"; /* ... fetch ... */
    // Fetch barber name
    $stmt_b_name = $conn->prepare("SELECT name FROM barbers WHERE id = ?");
    if ($stmt_b_name) {
        $stmt_b_name->bind_param("i", $barber_id);
        if ($stmt_b_name->execute()) {
            $result_b_name = $stmt_b_name->get_result();
            if ($row_b_name = $result_b_name->fetch_assoc()) { $barber_name = $row_b_name['name']; }
        } $stmt_b_name->close();
    }
    // Fetch service name
    $stmt_s_name = $conn->prepare("SELECT name FROM services WHERE id = ?");
    if ($stmt_s_name) {
        $stmt_s_name->bind_param("i", $service_id);
        if ($stmt_s_name->execute()) {
            $result_s_name = $stmt_s_name->get_result();
            if ($row_s_name = $result_s_name->fetch_assoc()) { $service_name = $row_s_name['name']; }
        } $stmt_s_name->close();
    }

    $appointment_datetime_formatted = date("F j, Y, g:i a", strtotime($appointment_datetime_str));
    $salon_name = defined('EMAIL_FROM_NAME') ? EMAIL_FROM_NAME : 'Our Salon';
    $from_address = defined('EMAIL_FROM_ADDRESS') ? EMAIL_FROM_ADDRESS : 'noreply@example.com';
    $to_customer = $customer_email;
    $subject_customer = "Your Appointment Confirmation at " . $salon_name;
    $message_customer_html = "<html><body><p>Dear " . htmlspecialchars($customer_name) . ",</p><p>This email confirms your appointment at <strong>" . htmlspecialchars($salon_name) . "</strong>.</p><p><strong>Details:</strong></p><ul><li><strong>Service:</strong> " . htmlspecialchars($service_name) . "</li><li><strong>Barber:</strong> " . htmlspecialchars($barber_name) . "</li><li><strong>Date & Time:</strong> " . htmlspecialchars($appointment_datetime_formatted) . "</li></ul><p>We look forward to seeing you!</p><p>Sincerely,<br>The " . htmlspecialchars($salon_name) . " Team</p></body></html>";
    $headers_customer = "From: " . htmlspecialchars($salon_name) . " <" . $from_address . ">\r\n";
    $headers_customer .= "Reply-To: " . $from_address . "\r\n"; $headers_customer .= "MIME-Version: 1.0\r\n"; $headers_customer .= "Content-Type: text/html; charset=UTF-8\r\n";
    @mail($to_customer, $subject_customer, $message_customer_html, $headers_customer);

    if (defined('SALON_EMAIL') && !empty(SALON_EMAIL)) {
        $to_salon = SALON_EMAIL;
        $subject_salon = "New Appointment Booking: " . htmlspecialchars($customer_name) . " for " . htmlspecialchars($service_name);
        $message_salon_html = "<html><body><p>A new appointment has been booked:</p><ul><li><strong>Customer Name:</strong> " . htmlspecialchars($customer_name) . "</li><li><strong>Customer Email:</strong> " . htmlspecialchars($customer_email) . "</li><li><strong>Customer Phone:</strong> " . htmlspecialchars($customer_phone) . "</li><li><strong>Service:</strong> " . htmlspecialchars($service_name) . "</li><li><strong>Barber:</strong> " . htmlspecialchars($barber_name) . "</li><li><strong>Date & Time:</strong> " . htmlspecialchars($appointment_datetime_formatted) . "</li></ul></body></html>";
        $headers_salon = "From: System <" . $from_address . ">\r\n";
        $headers_salon .= "Reply-To: " . htmlspecialchars($customer_email) . "\r\n"; $headers_salon .= "MIME-Version: 1.0\r\n"; $headers_salon .= "Content-Type: text/html; charset=UTF-8\r\n";
        @mail($to_salon, $subject_salon, $message_salon_html, $headers_salon);
    }
    echo json_encode(['success' => true, 'message' => 'Appointment booked successfully! Confirmation emails sent.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to book appointment. Please try again. Error: ' . $stmt_insert->error]);
}

$stmt_insert->close();
$conn->close();
exit();
?>
