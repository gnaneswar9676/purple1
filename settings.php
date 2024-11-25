<?php
// Database connection (optional if you need to save settings)
$conn = new mysqli('localhost', 'root', 'Chandu.11', 'login_register');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can add logic to save settings in the database if needed.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #2196f3cc;
            padding-top: 60px;
            position: fixed;
            left: 0;
            transition: left 0.3s ease;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #45a049;
        }

        .sidebar a.active {
            background-color: #45a049;
        }

        /* Main Content Styling */
        .main {
            margin-left: 220px;
            padding: 40px 20px 20px 20px;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #2196f3cc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Sidebar Toggle Button */
        .toggle-btn {
            display: none; /* Hide by default */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
                padding-top: 50px;
            }

            .main {
                margin-left: 180px;
            }

            /* Show toggle button on mobile */
            .toggle-btn {
                display: block;
                background-color: #333;
                color: white;
                padding: 10px;
                border: none;
                cursor: pointer;
                position: absolute;
                top: 20px;
                left: 20px;
                z-index: 1000;
            }

            .sidebar a {
                font-size: 14px;
            }

            form {
                padding: 15px;
            }

            button {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="orders.php">Orders</a>
        <a href="settings.php" class="active">Settings</a>
        <a href="index.php">Logout</a>
    </div>

    <div class="main">
        <h2>Settings</h2>
        <form action="settings.php" method="post">
            <label for="site_name">Site Name:</label>
            <input type="text" name="site_name" id="site_name" placeholder="Enter site name">

            <label for="site_email">Contact Email:</label>
            <input type="email" name="site_email" id="site_email" placeholder="Enter contact email">

            <button type="submit">Save Settings</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
