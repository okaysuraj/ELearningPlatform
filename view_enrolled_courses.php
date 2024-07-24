<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
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
    </style>
</head>
<body>
    <h1>My Enrolled Courses</h1>
    <?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'elearning_platform');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT courses.title, courses.description FROM courses
                            INNER JOIN enrollments ON courses.id = enrollments.course_id
                            WHERE enrollments.user_id = '$user_id'");

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Course Title</th>
                    <th>Description</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "You are not enrolled in any courses.";
    }

    $conn->close();
    ?>
