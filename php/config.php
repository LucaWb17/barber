<?php
// Database Configuration
// Please define your database connection details below.
// It is recommended to copy php/config.sample.php to php/config.local.php
// and define your settings there. Then, include php/config.local.php here.
// define('DB_HOST', 'your_db_host');
// define('DB_USERNAME', 'your_db_username');
// define('DB_PASSWORD', 'your_db_password');
// define('DB_NAME', 'your_db_name');

// Attempt to include a local configuration file if it exists.
if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
} else {
    // Optional: Display a warning or die if config.local.php is missing and no constants are defined.
    // For now, we'll allow scripts to proceed, but they will likely fail if DB constants are not defined.
    // Consider adding a check in scripts that require DB connection:
    // if (!defined('DB_HOST')) { /* die or set error message */ }
}

// Other global settings
// define('BASE_URL', 'http://localhost/your_project_directory/'); // Example

// Email Configuration
// define('SALON_EMAIL', 'your_salon_email@example.com');
// define('EMAIL_FROM_ADDRESS', 'noreply@yourdomain.com');
// define('EMAIL_FROM_NAME', 'Your Salon Name');
?>
