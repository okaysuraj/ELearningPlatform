<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Course Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form textarea {
            height: 150px;
        }
        form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <h1>Modify Course Material</h1>
    <form action="modify_course_material_action.php" method="post">
        <label for="course">Select Course</label>
        <select id="course" name="course_id" required>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'elearning_platform');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT id, title FROM courses");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="material">Course Material</label>
        <textarea id="material" name="material" required></textarea>

        <input type="submit" value="Update Material">
    </form>
</body>
</html>
