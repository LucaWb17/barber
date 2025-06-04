<?php
// Include configuration file
require_once '../config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Fallback DB credentials if not defined in config.php
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'clipper_db'); // Assuming 'clipper_db' or your actual DB name

// Establish Database Connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "Connection failed: " . $conn->connect_error]);
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
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "Database query failed: " . $conn->error]);
    $conn->close();
    exit();
}

// Close the database connection
$conn->close();

// Encode the array as JSON and echo it
echo json_encode($services_array);
exit();
?>
