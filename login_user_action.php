<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elearning_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$pass = $_POST['password'];

// Retrieve user data from database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        echo "Login successful.";
        // Start user session here
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "No user found with this email.";
}

$conn->close();
?>
