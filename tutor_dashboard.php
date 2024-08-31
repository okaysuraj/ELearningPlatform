<?php
session_start();
// if (!isset($_SESSION['tutor_logged_in'])) {
//     header("Location: login_tutor.php");
//     exit();
// }

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elearning_platform');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tutor's courses
$tutor_id = $_SESSION['tutor_id'];
$courses_result = $conn->query("SELECT * FROM courses WHERE tutor_id = $tutor_id");

// Fetch enrolled users
$enrolled_users = [];
if ($courses_result->num_rows > 0) {
    while ($course = $courses_result->fetch_assoc()) {
        $course_id = $course['id'];
        $users_result = $conn->query("SELECT users.username FROM enrollments JOIN users ON enrollments.user_id = users.id WHERE enrollments.course_id = $course_id");
        $enrolled_users[$course_id] = $users_result->fetch_all(MYSQLI_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_course'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tutor_id = $_SESSION['tutor_id'];
        
        $stmt = $conn->prepare("INSERT INTO courses (title, description, tutor_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $description, $tutor_id);
        $stmt->execute();
        $course_id = $stmt->insert_id;
        
        // Handle file upload
        foreach ($_FILES['videos']['tmp_name'] as $index => $tmp_name) {
            $file_name = $_FILES['videos']['name'][$index];
            $file_tmp = $_FILES['videos']['tmp_name'][$index];
            move_uploaded_file($file_tmp, "uploads/videos/$file_name");
            $conn->query("INSERT INTO videos (course_id, file_path) VALUES ($course_id, 'uploads/videos/$file_name')");
        }

        header("Location: tutor_dashboard.php");
        exit();
    } elseif (isset($_POST['update_course'])) {
        $course_id = $_POST['course_id'];
        $description = $_POST['description'];

        $stmt = $conn->prepare("UPDATE courses SET description = ? WHERE id = ?");
        $stmt->bind_param("si", $description, $course_id);
        $stmt->execute();

        // Handle file upload
        foreach ($_FILES['videos']['tmp_name'] as $index => $tmp_name) {
            $file_name = $_FILES['videos']['name'][$index];
            $file_tmp = $_FILES['videos']['tmp_name'][$index];
            move_uploaded_file($file_tmp, "uploads/videos/$file_name");
            $conn->query("INSERT INTO videos (course_id, file_path) VALUES ($course_id, 'uploads/videos/$file_name')");
        }

        header("Location: tutor_dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            padding: 20px;
        }
        .sidebar h2 {
            margin-top: 0;
            font-size: 1.5em;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin: 15px 0;
        }
        .sidebar a:hover {
            background-color: #575757;
            padding: 10px;
            border-radius: 5px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h3 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Tutor Dashboard</h2>
        <a href="tutor_dashboard.php">Create New Course</a>
        <a href="tutor_dashboard.php">Update Existing Course</a>
        <a href="tutor_dashboard.php">Show Enrolled Users</a>
        <a href="logout_tutor.php">Logout</a>
    </div>
    
    <div class="main-content">
        <h1>Welcome, Tutor!</h1>
        <!-- Create New Course -->
        <div class="card">
            <h3>Create New Course</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Course Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Course Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="videos">Upload Video Lessons</label>
                    <input type="file" id="videos" name="videos[]" multiple required>
                </div>
                <div class="form-group">
                    <button type="submit" name="create_course">Create Course</button>
                </div>
            </form>
        </div>

        <!-- Update Existing Course -->
        <div class="card">
            <h3>Update Existing Course</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_id">Course ID</label>
                    <input type="number" id="course_id" name="course_id" required>
                </div>
                <div class="form-group">
                    <label for="description">Update Course Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="videos">Upload More Videos</label>
                    <input type="file" id="videos" name="videos[]" multiple>
                </div>
                <div class="form-group">
                    <button type="submit" name="update_course">Update Course</button>
                </div>
            </form>
        </div>

        <!-- Show Enrolled Users -->
        <div class="card">
            <h3>Enrolled Users</h3>
            <?php foreach ($courses_result as $course): ?>
                <h4><?php echo htmlspecialchars($course['title']); ?></h4>
                <ul>
                    <?php foreach ($enrolled_users[$course['id']] as $user): ?>
                        <li><?php echo htmlspecialchars($user['username']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
        
        <button class="logout-btn" onclick="location.href='logout_tutor.php'">Logout</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
