<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as New Tutor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>E-Learning Platform</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Register as New Tutor</h2>
            <form action="register_tutor_action.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>

                <input type="submit" value="Register">
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
