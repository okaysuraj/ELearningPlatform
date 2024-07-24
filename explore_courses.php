<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .enroll-btn {
            padding: 5px 10px;
            border: none;
            color: #fff;
            background: #333;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .enroll-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <h1>Explore All Courses</h1>
    <?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'elearning_platform');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT id, title, description FROM courses");

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Course Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td><a class='enroll-btn' href='enroll_course_action.php?course_id=" . $row['id'] . "'>Enroll</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No courses available.";
    }

    $conn->close();
    ?>
</body>
</html>
