<?php
// login.php

// Get form input
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "mywebsite");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $row['password'])) {
        echo "Login successful!";
        // Redirect or start session here
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
