<?php
// Include configuration file
require_once '../config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if DB constants are defined
if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    http_response_code(500);
    echo json_encode(['error' => 'Database configuration is missing. Please set up config.php.']);
    exit();
}

// Establish Database Connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    error_log("Database connection failed in get_services.php: " . $conn->connect_error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "A server error occurred while fetching services. Please try again later."]);
    exit();
}

// Prepare and execute SELECT statement to fetch services
// Assuming columns: id, name, description, duration_minutes, price
$sql = "SELECT id, name, description, duration_minutes, price FROM services ORDER BY name ASC";
$result = $conn->query($sql);

$services_array = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $services_array[] = $row;
    }
    $result->free(); // Free result set
} else {
    error_log("Database query failed in get_services.php: " . $conn->error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "A server error occurred while fetching services. Please try again later."]);
    $conn->close();
    exit();
}

// Close the database connection
$conn->close();

// Encode the array as JSON and echo it
echo json_encode($services_array);
exit();
?>
