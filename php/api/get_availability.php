<?php
require_once '../config.php';
header('Content-Type: application/json');

// Check if DB constants are defined
if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    http_response_code(500);
    echo json_encode(['error' => 'Database configuration is missing.']);
    exit();
}

// --- Input Retrieval and Validation ---
$barber_id = filter_input(INPUT_GET, 'barber_id', FILTER_VALIDATE_INT);
$date_str = $_GET['date'] ?? '';
$service_duration_minutes_req = filter_input(INPUT_GET, 'service_duration_minutes', FILTER_VALIDATE_INT);

$errors = [];
if (!$barber_id) {
    $errors['barber_id'] = 'Barber ID is required.';
}
if (empty($date_str)) {
    $errors['date'] = 'Date is required.';
} else {
    $date_obj = DateTime::createFromFormat('Y-m-d', $date_str);
    if (!$date_obj || $date_obj->format('Y-m-d') !== $date_str) {
        $errors['date'] = 'Invalid date format. Please use YYYY-MM-DD.';
    }
}
if ($service_duration_minutes_req === false || $service_duration_minutes_req === null || $service_duration_minutes_req <= 0) {
    $errors['service_duration_minutes'] = 'Valid service duration is required.';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

// --- Generate Potential Start Slots (00:00 to 23:30 on 30-min interval) ---
$potential_slots = [];
$slot_interval_minutes = 30;
$current_slot_dt = new DateTime($date_str . ' 00:00:00');
$end_of_day_dt = new DateTime($date_str . ' 23:59:59');

while ($current_slot_dt <= $end_of_day_dt) {
    $potential_slots[] = clone $current_slot_dt;
    $current_slot_dt->modify("+" . $slot_interval_minutes . " minutes");
}

// --- Fetch Existing Appointments for the Barber on the Given Date ---
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    error_log("Database connection failed in get_availability.php: " . $conn->connect_error);
    http_response_code(500);
    echo json_encode(['error' => "A server error occurred. Please try again later."]);
    exit;
}

$booked_intervals = [];
$sql_booked = "SELECT a.appointment_datetime, s.duration_minutes
               FROM appointments a
               JOIN services s ON a.service_id = s.id
               WHERE a.barber_id = ? AND DATE(a.appointment_datetime) = ? AND (a.status = 'scheduled' OR a.status = 'confirmed')";
$stmt_booked = $conn->prepare($sql_booked);

if(!$stmt_booked) {
    error_log("Statement preparation failed in get_availability.php: " . $conn->error);
    http_response_code(500);
    echo json_encode(['error' => 'A server error occurred. Please try again later.']);
    $conn->close();
    exit;
}

$stmt_booked->bind_param("is", $barber_id, $date_str);
if (!$stmt_booked->execute()) {
    error_log("Statement execution failed in get_availability.php: " . $stmt_booked->error);
    http_response_code(500);
    echo json_encode(['error' => 'A server error occurred. Please try again later.']);
    $stmt_booked->close();
    $conn->close();
    exit;
}

$result_booked = $stmt_booked->get_result();
while ($row = $result_booked->fetch_assoc()) {
    $booked_start = new DateTime($row['appointment_datetime']);
    $booked_end = (clone $booked_start)->modify("+" . (int)$row['duration_minutes'] . " minutes");
    $booked_intervals[] = ['start' => $booked_start, 'end' => $booked_end];
}
$stmt_booked->close();
$conn->close();

// --- Determine Actually Available Slots (Conflict Detection) ---
$actually_available_slots_str = [];
foreach ($potential_slots as $potential_start_dt) {
    // Calculate end time for this potential slot using the requested service's duration
    $potential_end_dt = (clone $potential_start_dt)->modify("+" . $service_duration_minutes_req . " minutes");

    $is_slot_available = true;
    foreach ($booked_intervals as $booked_interval) {
        // Overlap condition: (potential_start < existing_booked_end) AND (potential_end > existing_booked_start)
        if ($potential_start_dt < $booked_interval['end'] && $potential_end_dt > $booked_interval['start']) {
            $is_slot_available = false;
            break;
        }
    }

    if ($is_slot_available) {
        // Also ensure the service itself does not span across midnight into the next day from its start time
        if ($potential_end_dt->format('Y-m-d') === $date_str) {
             $actually_available_slots_str[] = $potential_start_dt->format('H:i');
        }
    }
}

if (empty($actually_available_slots_str)) {
     echo json_encode(['available_slots' => [], 'message' => 'No time slots available for this service duration due to existing bookings or service length. Please try a different service or date.']);
} else {
    echo json_encode(['available_slots' => $actually_available_slots_str]);
}
exit;
?>
