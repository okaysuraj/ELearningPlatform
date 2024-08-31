<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li, a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* General styles */
        html, body {
            height: 100%;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
        }
        
        header {
            background: #007BFF;
            color: #fff;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        
        header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        header h1 {
            font-size: 2rem;
        }
        
        nav ul {
            list-style: none;
            display: flex;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }
        
        nav ul li a:hover {
            text-decoration: underline;
        }
        
        main {
            padding: 180px 20px 20px;
            text-align: center;
            flex: 1;
        }
        
        main h2 {
            font-size: 2.5rem;
            color: #333;
        }
        
        main p {
            font-size: 1.2rem;
            color: #555;
            margin: 20px 0;
        }
        
        .buttons {
            margin: 20px 0;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 1rem;
            color: #fff;
            background: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #218838;
        }
        
        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        
        footer p {
            margin-bottom: 10px;
        }
        
        footer ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        
        footer ul li {
            margin-left: 20px;
        }
        
        footer ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        footer ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
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

    <!-- Main Content -->
    <main>
        <div class="container">
            <h2>Welcome to the E-Learning Platform</h2>
            <p>Your gateway to a world of knowledge and learning.</p>
            <div class="buttons">
                <a href="register_user.php" class="btn">Register as New User</a>
                <a href="login_user.php" class="btn">Login as User</a>
                <a href="login_tutor.php" class="btn">Login as Tutor</a>
                <a href="register_tutor.php" class="btn">Register as New Tutor</a>
                <a href="login_admin.php" class="btn">Login as Admin</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Learning Platform by Suraj Kumar</p>
        </div>
    </footer>
</body>
</html>
