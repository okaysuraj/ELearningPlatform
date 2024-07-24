<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Enrolled Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
    <h1>Enrolled Users</h1>
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'elearning_platform');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $course_id = $_GET['course_id'];
    $sql = "SELECT users.username, users.email FROM users
            INNER JOIN enrollments ON users.id = enrollments.user_id
            WHERE enrollments.course_id = '$course_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No users enrolled in this course.";
    }

    $conn->close();
    ?>
</body>
</html>
