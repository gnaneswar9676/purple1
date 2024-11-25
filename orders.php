<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'Chandu.11', 'login_register');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders (you need an 'orders' table in the database)
$sql = "SELECT * FROM orders";  // This assumes you have an 'orders' table
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="styles.css">
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

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fafafa;
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
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="orders.php" class="active">Orders</a>
        <a href="settings.php">Settings</a>
        <a href="index.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h2>Orders List</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        // Toggle sidebar for mobile view
        document.querySelector('.toggle-btn').addEventListener('click', function() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle('open');
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
