<?php
require 'vendor/autoload.php'; // Include the JWT library

use \Firebase\JWT\JWT;

// Define your secret key (keep this secret!)
$secretKey = 'your_secret_key_here';

// Function to generate a JWT token with an expiration time
function generateToken($user_id) {
    $issuedAt = time();
    $expirationTime = $issuedAt + 3600; // 1 hour expiration (adjust as needed)

    $payload = array(
        'user_id' => $user_id,
        'iat' => $issuedAt,
        'exp' => $expirationTime
    );

    return JWT::encode($payload, $GLOBALS['secretKey'], 'HS256');
}

// Function to validate and decode a JWT token


/*
                        // Example usage:
                        $user_id = 123; // Replace with the actual user ID
                        $token = generateToken($user_id);

                        // To validate a token:
                        $isValid = validateToken($token);

                        if ($isValid) {
                            echo "Token is valid.\n";
                            print_r($isValid);
                        } else {
                            echo "Token is invalid or expired.\n";
                        }

?>
*/