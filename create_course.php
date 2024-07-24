<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
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
        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
    <h1>Create New Course</h1>
    <form action="create_course_action.php" method="post">
        <label for="title">Course Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Course Description</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="duration">Course Duration (e.g., 4 weeks)</label>
        <input type="text" id="duration" name="duration" required>

        <input type="submit" value="Create Course">
    </form>
</body>
</html>
