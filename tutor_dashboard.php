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
            padding: 0;
            display: flex;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background: #444;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            transform: translateX(-250px);
            transition: transform 0.3s ease;
            padding: 15px;
        }
        .sidebar.active {
            transform: translateX(0);
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background: #666;
        }
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
            color: #444;
            background: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .toggle-btn:hover {
            background: #f4f4f4;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .section {
            margin: 20px 0;
        }
        .section h3 {
            margin-bottom: 10px;
        }
        .section button {
            padding: 10px 15px;
            border: none;
            color: #fff;
            background: #555;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px 0;
        }
        .section button:hover {
            background: #777;
        }
    </style>
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>

    <div class="sidebar" id="sidebar">
        <h2>Tutor Dashboard</h2>
        <a href="profile.php">Profile</a>
        <a href="my_courses.php">My Courses</a>
        <a href="create_course.php">Create New Course</a>
        <a href="delete_course.php">Delete Course</a>
        <a href="show_enrolled_users.php">Show Enrolled Users</a>
        <a href="modify_course_material.php">Modify Course Material</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Welcome, Tutor!</h1>
        <p>This is your dashboard. Here you can manage your courses, track student progress, and update your profile.</p>

        <div class="section">
            <h3>Create New Course</h3>
            <button onclick="window.location.href='create_course.php'">Create Course</button>
        </div>

        <div class="section">
            <h3>Delete Course</h3>
            <button onclick="window.location.href='delete_course.php'">Delete Course</button>
        </div>

        <div class="section">
            <h3>Show Enrolled Users</h3>
            <button onclick="window.location.href='show_enrolled_users.php'">View Enrolled Users</button>
        </div>

        <div class="section">
            <h3>Modify Course Material</h3>
            <button onclick="window.location.href='modify_course_material.php'">Modify Material</button>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
