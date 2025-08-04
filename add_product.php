<?php
include "database.php";
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $product_code = $_POST['product_code'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id']; 

    // Insert new product into the database
    $sql = "INSERT INTO `products` 
            (`name`, `slug`, `description`, `product_code`, `price`, `stock`, `image_url`, `category_id`, `created_at`, `updated_at`) 
            VALUES 
            ('$name', '$slug', '$description', '$product_code', '$price', '$stock', '$image_url', '$category_id', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Product added successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error adding product: " . $conn->error . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />
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
            width: 500px;
            align-self: center;
        }

        a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        label {
            font-weight: bold;
        }




        
    </style>
</head>
<body>

<h2>Add New Product</h2>

<div class="card">
    <form method="post" action="">
        <!-- Product Name -->
        <label for="name">Vārds:</label>
        <input type="text" name="name" id="name" required>

        <!-- Product Slug -->
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" required>

        <!-- Product Description -->
        <label for="description">Apraksts:</label>
        <textarea name="description" id="description" required></textarea>

        <!-- Product Code -->
        <label for="product_code">Producta kods:</label>
        <input type="text" name="product_code" id="product_code" required>

        <!-- Product Price -->
        <label for="price">Cena:</label>
        <input type="text" name="price" id="price" required>

        <!-- Product Stock -->
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required>

        <!-- Product Image URL -->
        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url" required>

        <!-- Product Category Dropdown -->
        <label for="category_id">Kategorija:</label>
        <select name="category_id" id="category_id" required>
            <option value="">Izvēlēties kategoriju</option>
            <?php
            // Fetch categories from the database
            $sql = "SELECT id, name FROM categories";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <!-- Submit Button -->
        <input type="submit" name="insert" value="Pievienot produktu">
    </form>


</div>



</body>
</html>
