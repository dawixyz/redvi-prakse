<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 40px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 300px;
        }
        a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>

<h1>Admin Panelis</h1>

<div class="card">
    <h2>Products</h2>
    <a href="admin_products.php">Pārskatīt produktus</a>
    <a href="add_product.php">Pievienot produktus</a>
    <a href="add_category.php"> Pievienot kategoriju </a>
    <a href="edit_category.php"> Pārskatīt kategorijas </a>
</div>




<div class="card">
    <a href="logout.php">Izlogoties</a>
</div>

</body>
</html>
