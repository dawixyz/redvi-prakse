<?php
include "database.php";
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

// Handle update form submission
if (isset($_POST['update'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $product_code = $_POST['product_code'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE `products` SET 
                `name`='$name',
                `slug`='$slug',
                `description`='$description',
                `product_code`='$product_code',
                `price`='$price',
                `stock`='$stock',
                `image_url`='$image_url',
                `category_id`='$category_id',
                `updated_at`=NOW()
            WHERE `id`='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Produkts veiksmīgi rediģēs.</p>";
    } else {
        echo "<p style='color: red;'>Kļūda labojot produk: " . $conn->error . "</p>";
    }
}

// Produkta dati pēc ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE `id`='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <title>Rediģēt produktu</title>
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

<h2>Update Product</h2>

<div class="card">
    <form method="post" action="">
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>">

        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" value="<?php echo $row['slug']; ?>">

        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo $row['description']; ?></textarea>

        <label for="product_code">Product Code:</label>
        <input type="text" name="product_code" id="product_code" value="<?php echo $row['product_code']; ?>">

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo $row['price']; ?>">

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?php echo $row['stock']; ?>">

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url" value="<?php echo $row['image_url']; ?>">
        <label for="category_id">Category:</label>
       <select name="category_id" id="category_id" required>
            <option value="">Select a Category</option>
            <?php
            // Fetch categories from the database
            $sql = "SELECT id, name FROM categories";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" name="update" value="Update Product">
    </form>
</div>

</body>
</html>

<?php
    } else {
        echo "<p>Produkts nav atrasts.</p>";
    }
} else {
    echo "<p>Nav iekļauts produkta ID.</p>";
}
?>
