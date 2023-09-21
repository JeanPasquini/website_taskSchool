<?php

// Define the SELECT query
$query = "SELECT name FROM users WHERE user_id = 1";

// Execute the query
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    if ($row) {
        $name = $row['name'];
        echo "Name: $name";
    } else {
        echo "No user found.";
    }
    

    //specific getData

    //specific getData
?>