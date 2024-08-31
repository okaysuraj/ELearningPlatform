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
$email = $_POST['email'];
$pass = $_POST['password'];
$subject = $_POST['subject'];

// Insert data into database
$sql = "INSERT INTO tutors (username, email, password, subject) VALUES ('$user', '$email', '$pass', '$subject')";

if ($conn->query($sql) === TRUE) {
    echo "New tutor registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
