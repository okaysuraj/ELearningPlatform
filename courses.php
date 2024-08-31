<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li, a, form, input, .card {
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
            padding: 120px 20px 20px;
            flex: 1;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
        }

        .search-bar input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .courses-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            padding: 20px;
            margin: 10px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #eee;
            border-radius: 5px;
        }

        .card h3 {
            margin: 15px 0;
            font-size: 1.5rem;
            color: #333;
        }

        .card p {
            font-size: 1rem;
            color: #555;
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
            <h2>Our Courses</h2>
            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search for courses...">
            </div>
            <!-- Courses List -->
            <div class="courses-container">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'elearning_platform');
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch courses from the database
                $sql = "SELECT title, description FROM courses";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each course
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='card'>
                                <img src='course-placeholder.jpg' alt='Course Image'>
                                <h3>" . $row["title"] . "</h3>
                                <p>" . $row["description"] . "</p>
                              </div>";
                    }
                } else {
                    echo "No courses available.";
                }

                // Close connection
                $conn->close();
                ?>
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
