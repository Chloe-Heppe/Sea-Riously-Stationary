<?php

session_start();

$conn = new mysqli("localhost", "root", "", "campus_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php
// This file connects the website to the MySQL database.
$host = "localhost";
$username = "root";
$password = "";
$database = "campus_store";

// Create the database connection.
$conn = new mysqli($host, $username, $password, $database);

// Stop the website if the database connection does not work.
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set the character set so special characters display correctly.
$conn->set_charset("utf8mb4");
?>
