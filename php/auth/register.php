<?php
// Include configuration file
require_once '../config.php';

// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    // Basic Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If there are basic validation errors, redirect back
    if (count($errors) > 0) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: ../../createanaccount.php");
        exit();
    }

    // ---- Database Operations ----

    // Define DB constants if not already defined (e.g. by config.php)
    // This is a fallback in case config.php is not properly set up,
    // allowing the script to proceed further for testing (though DB connection will likely fail).
    if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
    if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
    if (!defined('DB_NAME')) define('DB_NAME', 'clipper_db');

    // Establish Database Connection
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check Connection
    if ($conn->connect_error) {
        $_SESSION['error'] = "Connection failed: " . $conn->connect_error . ". Please check config.php and ensure database server is running.";
        // Optionally log the detailed error to a server log for diagnostics
        // error_log("MySQL Connection Error: " . $conn->connect_error);
        header("Location: ../../createanaccount.php");
        exit();
    }

    // Check if Email Already Exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Database error (prepare select): " . $conn->error;
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        $_SESSION['error'] = "Database error (execute select): " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already registered.";
        $stmt->close();
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }
    $stmt->close();

    // Hash Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($hashed_password === false) {
        $_SESSION['error'] = "Failed to hash password.";
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }

    // Insert New User
    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Database error (prepare insert): " . $conn->error;
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['message'] = "Registration successful! Please login.";
        $stmt->close();
        $conn->close();
        header("Location: ../../login.php");
        exit();
    } else {
        // Insertion failed
        $_SESSION['error'] = "Registration failed. Please try again. Error: " . $stmt->error;
        // Optionally log the detailed error: error_log("MySQL Insert Error: " . $stmt->error);
        $stmt->close();
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }

} else {
    // If the request method is not POST
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../../createanaccount.php");
    exit();
}
?>
