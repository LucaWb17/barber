<?php
// Include configuration file
require_once '../config.php';

// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password_input = $_POST['password']; // Password from form

    $errors = [];

    // Basic Validation
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password_input)) {
        $errors[] = "Password is required.";
    }

    // If there are basic validation errors, redirect back
    if (count($errors) > 0) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: ../../login.php"); // Redirect to login.php
        exit();
    }

    // ---- Database Operations ----
    // Check if DB constants are defined
    if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
        $_SESSION['error'] = "Database configuration is missing. Please contact the site administrator.";
        header("Location: ../../login.php");
        exit();
    }

    // Establish Database Connection
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check Connection
    if ($conn->connect_error) {
        error_log("Login - DB Connection failed: " . $conn->connect_error);
        $_SESSION['error'] = "Login failed due to a server issue. Please try again later.";
        header("Location: ../../login.php");
        exit();
    }

    // Prepare SELECT statement to fetch user by email
    // Assuming the table 'users' has columns 'id', 'name', and 'password_hash' (for the hashed password)
    $stmt = $conn->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
    if (!$stmt) {
        error_log("Login - DB prepare select failed: " . $conn->error);
        $_SESSION['error'] = "Login failed due to a server issue. Please try again later.";
        $conn->close();
        header("Location: ../../login.php");
        exit();
    }
    $stmt->bind_param("s", $email);

    if (!$stmt->execute()) {
        error_log("Login - DB execute select failed: " . $stmt->error);
        $_SESSION['error'] = "Login failed due to a server issue. Please try again later.";
        $stmt->close();
        $conn->close();
        header("Location: ../../login.php");
        exit();
    }

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password_input, $user['password_hash'])) {
            // Password is correct, start session
            session_regenerate_id(true); // Regenerate session ID for security

            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $email; // Or $user['email'] if selected

            // Optional: Set a success message or simply redirect
            // $_SESSION['message'] = "Login successful!";

            $stmt->close();
            $conn->close();
            header("Location: ../../dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            // Password is not correct
            $_SESSION['error'] = "Invalid email or password.";
            $stmt->close();
            $conn->close();
            header("Location: ../../login.php");
            exit();
        }
    } else {
        // No user found with that email
        $_SESSION['error'] = "Invalid email or password.";
        $stmt->close();
        $conn->close();
        header("Location: ../../login.php");
        exit();
    }

} else {
    // If the request method is not POST
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../../login.php");
    exit();
}
?>
