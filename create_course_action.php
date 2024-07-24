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
$title = $_POST['title'];
$description = $_POST['description'];
$duration = $_POST['duration'];

// Insert data into database
$sql = "INSERT INTO courses (title, description, duration) VALUES ('$title', '$description', '$duration')";

if ($conn->query($sql) === TRUE) {
    echo "New course created successfully. <a href='tutor_dashboard.php'>Go back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
