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

// 2. Retrieve and Validate Input
$barber_id = filter_input(INPUT_POST, 'barber_id', FILTER_VALIDATE_INT);
$service_id = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
$appointment_datetime_str = $_POST['appointment_datetime'] ?? '';
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
    $errors['appointment_datetime'] = 'Please select a date and time.';
} else {
    // Validate datetime format and ensure it's not in the past
    $appointment_datetime_obj = DateTime::createFromFormat('Y-m-d\TH:i', $appointment_datetime_str);
    if ($appointment_datetime_obj === false) {
        $errors['appointment_datetime'] = 'Invalid date and time format. Please use YYYY-MM-DDTHH:MM.';
    } else {
        $now = new DateTime();
        if ($appointment_datetime_obj < $now) {
            $errors['appointment_datetime'] = 'Appointment date and time cannot be in the past.';
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
}
// Basic phone validation (e.g. numbers and common characters) - can be enhanced
elseif (!preg_match('/^[0-9\s\-\+\(\)]+$/', $customer_phone)) {
    $errors['customer_phone'] = 'Invalid phone number format.';
}


if (!empty($errors)) {
    http_response_code(400); // Bad Request
    echo json_encode(['errors' => $errors]);
    exit();
}

// 3. User ID
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in. Please login to book.']);
    exit();
}
$user_id = $_SESSION['user_id'];

// 4. Database Interaction
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// b. Check for Appointment Conflicts (Basic)
// For simplicity, this checks for exact datetime match for the barber.
// A more robust solution would check for overlapping time ranges based on service duration.
$stmt_check = $conn->prepare("SELECT id FROM appointments WHERE barber_id = ? AND appointment_datetime = ? AND status = 'scheduled'");
if (!$stmt_check) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error (conflict check prepare): ' . $conn->error]);
    $conn->close();
    exit();
}
$stmt_check->bind_param("is", $barber_id, $appointment_datetime_str);
if (!$stmt_check->execute()) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error (conflict check execute): ' . $stmt_check->error]);
    $stmt_check->close();
    $conn->close();
    exit();
}
$stmt_check->store_result();
if ($stmt_check->num_rows > 0) {
    http_response_code(409); // Conflict
    echo json_encode(['error' => 'The selected time slot is no longer available for this barber. Please choose a different time.']);
    $stmt_check->close();
    $conn->close();
    exit();
}
$stmt_check->close();

// c. Insert Appointment
// Assumed table `appointments` has columns: user_id, barber_id, service_id, appointment_datetime, 
// customer_name, customer_email, customer_phone, status
$sql_insert = "INSERT INTO appointments (user_id, barber_id, service_id, appointment_datetime, customer_name, customer_email, customer_phone, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'scheduled')";
$stmt_insert = $conn->prepare($sql_insert);

if (!$stmt_insert) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error (insert prepare): ' . $conn->error]);
    $conn->close();
    exit();
}

$stmt_insert->bind_param("iiissss", $user_id, $barber_id, $service_id, $appointment_datetime_str, $customer_name, $customer_email, $customer_phone);

if ($stmt_insert->execute()) {
    echo json_encode(['success' => true, 'message' => 'Appointment booked successfully!']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to book appointment. Please try again. Error: ' . $stmt_insert->error]);
}

$stmt_insert->close();
$conn->close();
exit();
?>
