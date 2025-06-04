<?php
require_once '../config.php';
header('Content-Type: application/json');

// Fallback DB credentials
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'clipper_db');

// 1. Retrieve and Validate Input
$barber_id = filter_input(INPUT_GET, 'barber_id', FILTER_VALIDATE_INT);
$date_str = $_GET['date'] ?? '';

$errors = [];
if (!$barber_id) {
    $errors['barber_id'] = 'Barber ID is required and must be an integer.';
}

if (empty($date_str)) {
    $errors['date'] = 'Date is required.';
} else {
    $date_obj = DateTime::createFromFormat('Y-m-d', $date_str);
    if (!$date_obj || $date_obj->format('Y-m-d') !== $date_str) {
        $errors['date'] = 'Invalid date format. Please use YYYY-MM-DD.';
    } else {
        $today = new DateTime();
        $today->setTime(0,0,0); // Compare date part only
        if ($date_obj < $today) {
            // Allow fetching for today, but slots in the past will be filtered later.
            // If date is strictly before today, then it's an error.
            // For simplicity, we can allow today and yesterday for timezone considerations,
            // but frontend should typically prevent selecting past dates.
            // For now, let's consider any date before today an error for slot generation.
            // $errors['date'] = 'Date cannot be in the past.';
        }
    }
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

// 2. Determine Day of the Week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
$day_of_week = (int)$date_obj->format('w');

// 3. Database Interaction
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit;
}

$available_slots = [];
$db_error_occurred = false;

// Fetch Barber's General Availability for the specific day_of_week
$stmt_avail = $conn->prepare("SELECT start_time, end_time FROM availability WHERE barber_id = ? AND day_of_week = ? AND is_available = TRUE ORDER BY start_time ASC");
if(!$stmt_avail) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare availability statement: ' . $conn->error]);
    $conn->close();
    exit;
}
$stmt_avail->bind_param("ii", $barber_id, $day_of_week);
$stmt_avail->execute();
$result_avail = $stmt_avail->get_result();
$barber_availability_periods = $result_avail->fetch_all(MYSQLI_ASSOC);
$stmt_avail->close();

if (empty($barber_availability_periods)) {
    echo json_encode(['available_slots' => [], 'message' => 'Barber is not available on this day.']);
    $conn->close();
    exit;
}

// Fetch Booked Appointments for the Date
// We fetch duration_minutes for potential future use in more precise conflict checking
$stmt_booked = $conn->prepare("SELECT a.appointment_datetime, s.duration_minutes FROM appointments a JOIN services s ON a.service_id = s.id WHERE a.barber_id = ? AND DATE(a.appointment_datetime) = ? AND a.status = 'scheduled'");
if(!$stmt_booked) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare booked appointments statement: ' . $conn->error]);
    $conn->close();
    exit;
}
$stmt_booked->bind_param("is", $barber_id, $date_str);
$stmt_booked->execute();
$result_booked = $stmt_booked->get_result();
$booked_appointments_raw = $result_booked->fetch_all(MYSQLI_ASSOC);
$stmt_booked->close();

$booked_slots_start_times = [];
foreach ($booked_appointments_raw as $booked) {
    // Store just the H:i time for easier comparison with generated slots
    $booked_dt_obj = new DateTime($booked['appointment_datetime']);
    $booked_slots_start_times[] = $booked_dt_obj->format('H:i');
}


// Calculate Available Slots
$slot_duration_minutes = 30; // Configurable: 30 minutes

$now_datetime = new DateTime(); // Current time for checking past slots on the current day

foreach ($barber_availability_periods as $period) {
    $current_slot_time = new DateTime($date_str . ' ' . $period['start_time']);
    $end_period_time = new DateTime($date_str . ' ' . $period['end_time']);

    while ($current_slot_time < $end_period_time) {
        $slot_time_str = $current_slot_time->format('H:i');

        // Check if slot is in the past (only if the date is today)
        if ($date_obj->format('Y-m-d') === $now_datetime->format('Y-m-d') && $current_slot_time < $now_datetime) {
            $current_slot_time->modify("+" . $slot_duration_minutes . " minutes");
            continue;
        }

        // Simplified conflict check: if a slot's start time matches a booked appointment's start time
        if (!in_array($slot_time_str, $booked_slots_start_times)) {
            $available_slots[] = $slot_time_str;
        }

        $current_slot_time->modify("+" . $slot_duration_minutes . " minutes");
    }
}

$conn->close();

if ($db_error_occurred) {
    // Error already sent
    exit;
}

echo json_encode(['available_slots' => array_values(array_unique($available_slots))]); // Ensure unique slots if periods overlap
?>
