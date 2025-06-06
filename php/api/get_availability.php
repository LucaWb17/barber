<?php
require_once '../config.php';
header('Content-Type: application/json');

// Fallback DB credentials
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'clipper_db');

// --- Input Retrieval and Validation ---
$barber_id = filter_input(INPUT_GET, 'barber_id', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
$date_str = $_GET['date'] ?? '';
$service_duration_minutes = filter_input(INPUT_GET, 'service_duration_minutes', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);

$errors = [];
if (!$barber_id) {
    $errors['barber_id'] = 'Barber ID is required and must be a positive integer.';
}
if (empty($date_str)) {
    $errors['date'] = 'Date is required.';
} else {
    $date_obj = DateTime::createFromFormat('Y-m-d', $date_str);
    if (!$date_obj || $date_obj->format('Y-m-d') !== $date_str) {
        $errors['date'] = 'Invalid date format. Please use YYYY-MM-DD.';
    } else {
        $today = new DateTime();
        $today->setTime(0, 0, 0); // Compare date part only
        if ($date_obj < $today) {
            $errors['date'] = 'Date cannot be in the past.';
        }
    }
}
if ($service_duration_minutes === false || $service_duration_minutes === null) { // filter_input returns false on failure, null if not set
    $errors['service_duration_minutes'] = 'Service duration is required and must be a positive integer.';
}


if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

// --- Working Day Check ---
$day_of_week_int = (int)$date_obj->format('w'); // 0 for Sunday, 6 for Saturday
if ($day_of_week_int === 0 || $day_of_week_int === 1) { // Sunday or Monday
    echo json_encode(['available_slots' => [], 'message' => 'Appointments are only available from Tuesday to Saturday.']);
    exit;
}

// --- Define Fixed Schedule ---
$shop_open_time_str = '08:00:00';
$shop_close_time_str = '21:00:00';
$slot_interval_minutes = 30;

// --- Generate Potential Start Slots & Filter by End Time ---
$potential_slots = [];
$current_slot_start = new DateTime($date_str . ' ' . $shop_open_time_str);
$shop_close_dt = new DateTime($date_str . ' ' . $shop_close_time_str);
$now_datetime = new DateTime();

while (true) {
    $potential_slot_end = clone $current_slot_start;
    $potential_slot_end->modify("+" . $service_duration_minutes . " minutes");

    if ($potential_slot_end > $shop_close_dt) {
        break; // This slot would end after shop closes
    }

    // Filter out slots that are in the past if the selected date is today
    if ($date_obj->format('Y-m-d') === $now_datetime->format('Y-m-d') && $current_slot_start < $now_datetime) {
        // Modify $current_slot_start for the next iteration and continue
        $current_slot_start->modify("+" . $slot_interval_minutes . " minutes");
        continue;
    }

    $potential_slots[] = clone $current_slot_start;
    $current_slot_start->modify("+" . $slot_interval_minutes . " minutes");
    if ($current_slot_start >= $shop_close_dt) break;
}


// --- Fetch Existing Appointments ---
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit;
}

$booked_intervals = [];
$sql_booked = "SELECT a.appointment_datetime, s.duration_minutes
               FROM appointments a
               JOIN services s ON a.service_id = s.id
               WHERE a.barber_id = ? AND DATE(a.appointment_datetime) = ? AND a.status = 'scheduled'";
$stmt_booked = $conn->prepare($sql_booked);

if(!$stmt_booked) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare booked appointments statement: ' . $conn->error]);
    $conn->close();
    exit;
}

$stmt_booked->bind_param("is", $barber_id, $date_str);
$stmt_booked->execute();
$result_booked = $stmt_booked->get_result();
while ($row = $result_booked->fetch_assoc()) {
    $booked_start = new DateTime($row['appointment_datetime']);
    $booked_end = clone $booked_start;
    $booked_end->modify("+" . $row['duration_minutes'] . " minutes");
    $booked_intervals[] = ['start' => $booked_start, 'end' => $booked_end];
}
$stmt_booked->close();
$conn->close();


// --- Determine Actually Available Slots (Conflict Detection) ---
$actually_available_slots_str = [];
foreach ($potential_slots as $potential_start_dt) {
    $potential_end_dt = clone $potential_start_dt;
    $potential_end_dt->modify("+" . $service_duration_minutes . " minutes");

    $is_slot_available = true;
    foreach ($booked_intervals as $booked_interval) {
        // Overlap condition: (new_start < existing_end) AND (new_end > existing_start)
        if ($potential_start_dt < $booked_interval['end'] && $potential_end_dt > $booked_interval['start']) {
            $is_slot_available = false;
            break;
        }
    }

    if ($is_slot_available) {
        $actually_available_slots_str[] = $potential_start_dt->format('H:i');
    }
}

if (empty($actually_available_slots_str) && !empty($potential_slots) ) { // Had potential slots but all were booked or conflicted
     echo json_encode(['available_slots' => [], 'message' => 'No slots available for the selected criteria due to existing bookings.']);
} elseif (empty($actually_available_slots_str) && empty($potential_slots) && ($day_of_week_int !== 0 && $day_of_week_int !== 1) ){ // No potential slots generated (e.g., service duration too long for any part of the day)
     echo json_encode(['available_slots' => [], 'message' => 'No slots available, possibly due to service duration exceeding working hours.']);
}
else {
    echo json_encode(['available_slots' => $actually_available_slots_str]);
}

?>
