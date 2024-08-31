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

// Retrieve tutor data from database
$sql = "SELECT * FROM tutors WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($pass === $row['password']) {
        header("Location: tutor_dashboard.php");
        // Start tutor session here
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "No tutor found with this email.";
}

$conn->close();
?>
