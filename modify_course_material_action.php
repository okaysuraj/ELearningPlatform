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
$course_id = $_POST['course_id'];
$material = $_POST['material'];

// Update course material in database
$sql = "UPDATE courses SET material='$material' WHERE id='$course_id'";

if ($conn->query($sql) === TRUE) {
    echo "Course material updated successfully. <a href='tutor_dashboard.php'>Go back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
