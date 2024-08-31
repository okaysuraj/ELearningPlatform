<?php
session_start();

// Check if tutor is logged in
if (!isset($_SESSION['tutor_logged_in']) || !$_SESSION['tutor_logged_in']) {
    header("Location: login_tutor.php");
    exit();
}

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

// Fetch tutor's ID from the session
$tutor_id = $_SESSION['tutor_id'];

// Fetch tutor's courses
$courses_result = $conn->query("SELECT * FROM courses"); // Update query based on your actual schema

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
        
        $stmt = $conn->prepare("INSERT INTO courses (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
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
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f9;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            margin-top: 0;
            font-size: 1.5em;
        }
        .sidebar a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            margin: 15px 0;
            font-size: 1.1em;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .main-content {
            margin-left: 350px;
            margin-right: 50px;
            padding: 20px;
            flex: 1;
            overflow: hidden;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none; /* Hide all cards initially */
        }
        .card.active {
            display: block; /* Show the active card */
        }
        .card h3 {
            margin-top: 0;
            font-size: 1.4em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="file"] {
            border: none;
            padding: 0;
        }
        .form-group button {
            background-color: #27ae60;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
        }
        .form-group button:hover {
            background-color: #2ecc71;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #3498db;
            color: #fff;
        }
        .table tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Tutor Dashboard</h2>
        <a href="#" onclick="showSection('create')">Create New Course</a>
        <a href="#" onclick="showSection('update')">Update Existing Course</a>
        <a href="#" onclick="showSection('enrolled')">Show Enrolled Users</a>
        <a href="logout_tutor.php">Logout</a>
    </div>
    
    <div class="main-content">
        <h1>Welcome, Tutor!</h1>

        <!-- Create New Course -->
        <div id="create" class="card">
            <h3>Create New Course</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Course Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Course Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="videos">Upload Video Lessons:</label>
                    <input type="file" id="videos" name="videos[]" multiple required>
                </div>
                <div class="form-group">
                    <button type="submit" name="create_course">Create Course</button>
                </div>
            </form>
        </div>

        <!-- Update Existing Course -->
        <div id="update" class="card">
            <h3>Update Existing Course</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_id">Course ID:</label>
                    <input type="number" id="course_id" name="course_id" required>
                </div>
                <div class="form-group">
                    <label for="description">Update Course Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="videos">Upload More Videos:</label>
                    <input type="file" id="videos" name="videos[]" multiple>
                </div>
                <div class="form-group">
                    <button type="submit" name="update_course">Update Course</button>
                </div>
            </form>
        </div>

        <!-- Show Enrolled Users -->
        <div id="enrolled" class="card">
            <h3>Enrolled Users</h3>
            <?php if ($courses_result->num_rows > 0): ?>
                <?php while ($course = $courses_result->fetch_assoc()): ?>
                    <h4><?php echo htmlspecialchars($course['title']); ?></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($enrolled_users[$course['id']])): ?>
                                <?php foreach ($enrolled_users[$course['id']] as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td>No users enrolled.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
        
        <button class="logout-btn" onclick="location.href='logout_tutor.php'">Logout</button>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            var sections = document.querySelectorAll('.card');
            sections.forEach(function(section) {
                section.classList.remove('active');
            });

            // Show the selected section
            var selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.add('active');
            }
        }

        // Default to showing the first section
        document.addEventListener('DOMContentLoaded', function() {
            showSection('create');
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
