<?php
// Include configuration file
require_once '../config.php';

// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
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

    // Check if DB constants are defined
    if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
        $_SESSION['error'] = "Database configuration is missing. Please contact the site administrator.";
        header("Location: ../../createanaccount.php");
        exit();
    }

    // Establish Database Connection
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check Connection
    if ($conn->connect_error) {
        error_log("Registration - DB Connection failed: " . $conn->connect_error);
        $_SESSION['error'] = "Registration failed due to a server issue. Please try again later.";
        header("Location: ../../createanaccount.php");
        exit();
    }

    // Check if Email Already Exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        error_log("Registration - DB prepare select (email check) failed: " . $conn->error);
        $_SESSION['error'] = "Registration failed due to a server issue. Please try again later.";
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        error_log("Registration - DB execute select (email check) failed: " . $stmt->error);
        $_SESSION['error'] = "Registration failed due to a server issue. Please try again later.";
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
        error_log("Registration - password_hash failed.");
        $_SESSION['error'] = "Registration failed due to a security issue. Please try again later.";
        $conn->close();
        header("Location: ../../createanaccount.php");
        exit();
    }

    // Insert New User
    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Registration - DB prepare insert failed: " . $conn->error);
        $_SESSION['error'] = "Registration failed due to a server issue. Please try again later.";
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
        error_log("Registration - DB execute insert failed: " . $stmt->error);
        $_SESSION['error'] = "Registration failed due to a server issue. Please try again.";
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
