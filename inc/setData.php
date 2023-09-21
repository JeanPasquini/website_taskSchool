<?php

// Define the SELECT query
$query = "INSERT INTO users (name) VALUES (?)";

if ($stmt = $mysqli->prepare($query)) {
    // Bind the parameter
    $stmt->bind_param("s", //var);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Name "/*var*/ " inserted successfully!";
    } else {
        echo "Error executing the INSERT query: " . $stmt->error;
    }
    

    //specific SetData

    //specific SetData

?>