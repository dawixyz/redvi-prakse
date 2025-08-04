<?php include "database.php";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Pārskatīt produktus</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Slug</th>
                    <th>Apraksts</th>
                    <th>Cena</th>
                    <th>Noliktavā</th>
                    <th>Izveidots</th>
                    <th>Mainīts</th>
                </tr>
            </thead>
            <tbody> <?php if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {        ?> <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['slug']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                             <td><?php echo $row['updated_at']; ?></td>
                            <td><a class="btn btn-info" href="update-product.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                           <td> <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                        
                        </tr> 
                        <?php       
                        }
                        }       
                         ?> 
                         </tbody>
        </table>
    </div>
</body>

</html>