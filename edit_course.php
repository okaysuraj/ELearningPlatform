<?php
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: login_admin.php");
//     exit();
// }

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elearning_platform');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch course details
$course_id = $_GET['id'];
$result = $conn->query("SELECT * FROM courses WHERE id = $course_id");
$course = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tutor_id = $_POST['tutor_id'];

    $conn->query("UPDATE courses SET title='$title', description='$description' WHERE id = $course_id");
    header("Location: manage_courses.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
</head>
<body>
    <h2>Edit Course</h2>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $course['title']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $course['description']; ?></textarea><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
<?php $conn->close(); ?>
