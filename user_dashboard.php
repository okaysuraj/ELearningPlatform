<?php
session_start();
// if (!isset($_SESSION['user_logged_in'])) {
//     header("Location: login_user.php");
//     exit();
// }

// Database connection
$conn = new mysqli('localhost', 'root', '', 'elearning_platform');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all courses
$courses_result = $conn->query("SELECT * FROM courses");

// Fetch user's enrolled courses
$user_id = $_SESSION['user_id'];
$enrolled_courses_result = $conn->query("SELECT courses.* FROM enrollments JOIN courses ON enrollments.course_id = courses.id WHERE enrollments.user_id = $user_id");

// Enroll in course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enroll'])) {
    $course_id = $_POST['course_id'];
    $conn->query("INSERT INTO enrollments (user_id, course_id) VALUES ($user_id, $course_id)");
    header("Location: user_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
        .form-group input, .form-group select, .form-group textarea, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>User Dashboard</h2>
        <a href="user_dashboard.php">Enroll in Courses</a>
        <a href="user_dashboard.php">Access Course Videos</a>
        <a href="logout_user.php">Logout</a>
    </div>
    
    <div class="main-content">
        <h1>Welcome, User!</h1>

        <!-- Enroll in Courses -->
        <div class="card">
            <h3>Enroll in Courses</h3>
            <form method="post">
                <div class="form-group">
                    <label for="search">Search Courses</label>
                    <input type="text" id="search" name="search" placeholder="Search courses...">
                </div>
                <div class="form-group">
                    <button type="submit" name="search_courses">Search</button>
                </div>
            </form>
            <div class="course-list">
                <h4>Available Courses</h4>
                <ul>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_courses'])) {
                        $search = $_POST['search'];
                        $search_query = "SELECT * FROM courses WHERE title LIKE '%$search%'";
                        $search_result = $conn->query($search_query);
                    } else {
                        $search_result = $courses_result;
                    }

                    if ($search_result->num_rows > 0) {
                        while ($course = $search_result->fetch_assoc()) {
                            echo "<li>
                                <strong>{$course['title']}</strong> - {$course['description']}
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='course_id' value='{$course['id']}'>
                                    <button type='submit' name='enroll'>Enroll</button>
                                </form>
                            </li>";
                        }
                    } else {
                        echo "<li>No courses found.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <!-- Access Course Videos -->
        <div class="card">
            <h3>Access Course Videos</h3>
            <form method="post">
                <div class="form-group">
                    <label for="my_courses">Select Course</label>
                    <select id="my_courses" name="course_id">
                        <?php
                        if ($enrolled_courses_result->num_rows > 0) {
                            while ($course = $enrolled_courses_result->fetch_assoc()) {
                                echo "<option value='{$course['id']}'>{$course['title']}</option>";
                            }
                        } else {
                            echo "<option value=''>No enrolled courses</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="view_videos">View Videos</button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['view_videos'])) {
                $course_id = $_POST['course_id'];
                $videos_result = $conn->query("SELECT * FROM videos WHERE course_id = $course_id");

                if ($videos_result->num_rows > 0) {
                    echo "<h4>Course Videos</h4><ul>";
                    while ($video = $videos_result->fetch_assoc()) {
                        echo "<li><a href='{$video['file_path']}' target='_blank'>View Video</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No videos available for this course.</p>";
                }
            }
            ?>
        </div>

        <button class="logout-btn" onclick="location.href='logout_user.php'">Logout</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
