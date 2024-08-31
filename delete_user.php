<?php
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: login_admin.php");
//     exit();
// }

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elearning');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user
$user_id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id = $user_id");

header("Location: manage_users.php");
exit();
?>
