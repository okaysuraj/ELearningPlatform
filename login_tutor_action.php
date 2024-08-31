<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elearning";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT id, password FROM tutors WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($tutor_id, $stored_password);
    $stmt->fetch();

    // Check if the entered password matches the stored password
    if ($pass === $stored_password) {
        // Start session and redirect
        $_SESSION['tutor_logged_in'] = true;
        $_SESSION['tutor_id'] = $tutor_id;
        header("Location: tutor_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "No tutor found with this username.";
}

$stmt->close();
$conn->close();
?>
