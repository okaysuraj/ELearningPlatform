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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>

    <div class="sidebar" id="sidebar">
        <h2>User Dashboard</h2>
        <a href="profile.php">Profile</a>
        <a href="explore_courses.php">Explore Courses</a>
        <a href="view_enrolled_courses.php">View Enrolled Courses</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Welcome, User!</h1>
        <p>This is your dashboard. Here you can explore available courses and manage your enrollments.</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
