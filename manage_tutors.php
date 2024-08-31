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

// Fetch tutors
$result = $conn->query("SELECT * FROM tutors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tutors</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
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
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        .main-content h1 {
            color: #333;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0 auto 20px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4caf50;
            color: white;
            font-size: 1.1rem;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
            transition: background 0.3s ease;
        }
        .actions a.edit {
            background-color: #ffa500;
        }
        .actions a.edit:hover {
            background-color: #ff8c00;
        }
        .actions a.delete {
            background-color: #f44336;
        }
        .actions a.delete:hover {
            background-color: #d32f2f;
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
        <h1>Manage Tutors</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td class="actions">
                            <a href="edit_tutor.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                            <a href="delete_tutor.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
    </div>
</body>
</html>

<?php $conn->close(); ?>
