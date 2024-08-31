<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'elearning_platform');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Queries to get data
$total_users = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$total_tutors = $conn->query("SELECT COUNT(*) AS count FROM tutors")->fetch_assoc()['count'];
$total_enrollments = $conn->query("SELECT COUNT(*) AS count FROM enrollments")->fetch_assoc()['count'];
$total_courses = $conn->query("SELECT COUNT(*) AS count FROM courses")->fetch_assoc()['count'];

// Return data as JSON
header('Content-Type: application/json');
echo json_encode([
    'total_users' => $total_users,
    'total_tutors' => $total_tutors,
    'total_enrollments' => $total_enrollments,
    'total_courses' => $total_courses
]);

// Close connection
$conn->close();
?>
