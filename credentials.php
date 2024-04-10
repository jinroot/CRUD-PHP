<?php

// Establish database connection
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Change this to your MySQL username
$password = "yourpassword"; // Change this to your MySQL password
$dbname = "mycvproject"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
