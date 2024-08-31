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

// Fetch tutor details
$tutor_id = $_GET['id'];
$result = $conn->query("SELECT * FROM tutors WHERE id = $tutor_id");
$tutor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];

    $conn->query("UPDATE tutors SET username='$name', email='$email' WHERE id = $tutor_id");
    header("Location: manage_tutors.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tutor</title>
</head>
<body>
    <h2>Edit Tutor</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $tutor['username']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $tutor['email']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
<?php $conn->close(); ?>
