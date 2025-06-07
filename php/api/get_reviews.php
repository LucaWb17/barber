<?php
session_start();
require_once '../config.php';
header('Content-Type: application/json');

// Check if DB constants are defined
if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    error_log("get_reviews.php: Database configuration is missing.");
    http_response_code(500);
    echo json_encode(['error' => 'Server configuration error. Please try again later.']);
    exit();
}

// Establish Database Connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_error) {
    error_log("get_reviews.php: Database connection failed: " . $conn->connect_error);
    http_response_code(500);
    echo json_encode(['error' => 'Could not connect to the database. Please try again later.']);
    exit();
}

// SQL query to fetch reviews
$sql = "SELECT r.rating, r.comment, r.review_date,
               u.name AS user_name,
               b.name AS barber_name
        FROM reviews r
        LEFT JOIN users u ON r.user_id = u.id
        LEFT JOIN barbers b ON r.barber_id = b.id
        ORDER BY r.review_date DESC";

$result = $conn->query($sql);

if ($result === false) {
    error_log("get_reviews.php: SQL query failed: " . $conn->error);
    http_response_code(500);
    echo json_encode(['error' => 'Failed to retrieve reviews. Please try again later.']);
    $conn->close();
    exit();
}

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$result->free();
$conn->close();

echo json_encode($reviews);
exit();
?>
