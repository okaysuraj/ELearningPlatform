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

// Example queries to get data for reports
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_tutors = $conn->query("SELECT COUNT(*) AS total FROM tutors")->fetch_assoc()['total'];
$total_courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_enrollments = $conn->query("SELECT COUNT(*) AS total FROM enrollments")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            background-color: #f4f4f9;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            margin-top: 0;
            text-align: center;
            font-size: 1.5rem;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            transition: background 0.3s ease;
            text-align: center;
            font-size: 1rem;
        }
        .sidebar a:hover {
            background: #555;
        }
        .main-content {
            margin-left: 350px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .main-content h1 {
            color: #333;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.25rem;
        }
        .card p {
            font-size: 1rem;
            color: #555;
        }
        .logout-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background: #ff4c4c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .logout-btn:hover {
            background: #ff1a1a;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_tutors.php">Manage Tutors</a>
        <a href="manage_courses.php">Manage Courses</a>
        <a href="view_reports.php">View Reports</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>System Reports</h1>
        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="card">
                <h3>Total Tutors</h3>
                <p><?php echo $total_tutors; ?></p>
            </div>
            <div class="card">
                <h3>Total Courses</h3>
                <p><?php echo $total_courses; ?></p>
            </div>
            <div class="card">
                <h3>Total Enrollments</h3>
                <p><?php echo $total_enrollments; ?></p>
            </div>
        </div>
        <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
