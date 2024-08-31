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

// Delete tutor
$tutor_id = $_GET['id'];
$conn->query("DELETE FROM tutors WHERE id = $tutor_id");

header("Location: manage_tutors.php");
exit();
?>
