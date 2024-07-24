<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elearning_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$course_id = $_GET['course_id'];
$user_id = $_SESSION['user_id'];

// Check if already enrolled
$result = $conn->query("SELECT * FROM enrollments WHERE user_id='$user_id' AND course_id='$course_id'");
if ($result->num_rows > 0) {
    echo "You are already enrolled in this course. <a href='user_dashboard.php'>Go back</a>";
    exit;
}

// Enroll in the course
$sql = "INSERT INTO enrollments (user_id, course_id) VALUES ('$user_id', '$course_id')";

if ($conn->query($sql) === TRUE) {
    echo "You have been successfully enrolled. <a href='user_dashboard.php'>Go back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
