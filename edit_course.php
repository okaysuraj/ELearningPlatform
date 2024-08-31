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

// Fetch course details
$course_id = $_GET['id'];
$result = $conn->query("SELECT * FROM courses WHERE id = $course_id");
$course = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }
        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
            font-size: 1.5rem;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Course</h2>
        <form method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $course['title']; ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $course['description']; ?></textarea>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>
