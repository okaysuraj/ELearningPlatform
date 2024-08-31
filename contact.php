<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            flex: 1;
            text-align: center;
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

        .contact-details {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .contact-details h3 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            color: #007BFF;
        }

        .contact-details p {
            font-size: 1rem;
            color: #555;
            margin: 10px 0;
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
            <h2>Contact Us</h2>
            <div class="contact-details">
                <h3>Contact Information</h3>
                <p><strong>Name:</strong> Suraj Kumar</p>
                <p><strong>Email:</strong> suraj.kumar@example.com</p>
                <p><strong>Phone:</strong> +123 456 7890</p>
                <p><strong>Address:</strong> 123 Learning Lane, Knowledge City, EDUC 456</p>
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
