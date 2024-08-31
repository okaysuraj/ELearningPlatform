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
$user = $_POST['username']; // Use null coalescing operator to handle undefined indexes
$pass = $_POST['password'];


// Use prepared statements to retrieve user data from the database
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $stored_password);
    $stmt->fetch();
    if ($pass === $stored_password) {
        // Start session and redirect
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user_id;
        header("Location: user_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "No user found with this username.";
}


$stmt->close();
$conn->close();
?>
