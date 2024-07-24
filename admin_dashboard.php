<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background: #555;
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
            background: #777;
        }
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
            color: #555;
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
    </style>
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>

    <div class="sidebar" id="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_tutors.php">Manage Tutors</a>
        <a href="manage_courses.php">Manage Courses</a>
        <a href="view_reports.php">View Reports</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Welcome, Admin!</h1>
        <p>This is your dashboard. Here you can manage users, tutors, courses, and view system reports.</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
