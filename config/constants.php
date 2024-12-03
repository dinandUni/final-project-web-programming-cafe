<?php 
    session_start();

    define('SITEURL', 'http://localhost/final-project-web-programming-cafe/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'tr_cafe');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        error_log("Connection failed: " . mysqli_connect_error(), 3, 'error_log.txt');
        die("Connection failed. Please try again later.");
    }
?>
