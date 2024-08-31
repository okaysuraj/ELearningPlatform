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
$user = $_POST['username'];
$pass = $_POST['password'];

// Retrieve admin data from database
$sql = "SELECT * FROM admin WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($pass === $row['password']) {
        header("Location: admin_dashboard.php");
        // Start admin session here
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "No admin found with this email.";
}

$conn->close();
?>
