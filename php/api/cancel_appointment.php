<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

// Check if DB constants are defined
if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database configuration is missing.']);
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'You must be logged in to cancel appointments.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method. Only POST is accepted.']);
    exit();
}

// Retrieve and validate appointment_id
$appointment_id = filter_input(INPUT_POST, 'appointment_id', FILTER_VALIDATE_INT);

if (!$appointment_id) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid Appointment ID provided.']);
    exit();
}

// Establish Database Connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    error_log("Database connection failed in cancel_appointment.php: " . $conn->connect_error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "A server error occurred. Please try again later."]);
    exit();
}

// Prepare UPDATE statement
// We update the status to 'cancelled' only if the appointment belongs to the logged-in user
// and its current status is 'scheduled' or 'confirmed' (or any other cancellable status)
$stmt = $conn->prepare("UPDATE appointments SET status = 'cancelled' WHERE id = ? AND user_id = ? AND (status = 'scheduled' OR status = 'confirmed')");

if (!$stmt) {
    error_log("Prepare update failed in cancel_appointment.php: " . $conn->error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'A server error occurred. Please try again later.']);
    $conn->close();
    exit();
}

$stmt->bind_param("ii", $appointment_id, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Appointment cancelled successfully.']);
    } else {
        // Potentially, the appointment was not found, didn't belong to the user, or was not in a cancellable state
        // To give more specific feedback, one might fetch the appointment first, but this approach is more concise.
        http_response_code(404); // Not Found or Forbidden (if not owned or not cancellable)
        echo json_encode(['error' => 'Failed to cancel appointment. It may have already been cancelled, is not yours, or cannot be found.']);
    }
} else {
    error_log("Execute update failed in cancel_appointment.php: " . $stmt->error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'A server error occurred. Please try again later.']);
}

$stmt->close();
$conn->close();
exit();
?>
