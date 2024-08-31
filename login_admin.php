<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login as Admin</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li, a, form, label, input {
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
        
        main form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        form label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1rem;
            color: #333;
        }
        
        form input[type="text"],
        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        form input[type="submit"] {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        form input[type="submit"]:hover {
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

    <main>
        <div class="container">
            <h2>Login as Admin</h2>
            <form action="login_admin_action.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="text" id="password" name="password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 E-Learning Platform by Suraj Kumar</p>
        </div>
    </footer>
</body>
</html>
