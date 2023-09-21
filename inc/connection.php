<?php
// Database connection parameters
$host = ''; //localhost
$username = ''; //username
$password = ''; //password
$database = ''; //database

// Create a MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Close the connection when done (optional)
$mysqli->close();
?>