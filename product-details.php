<?php 
include("database.php"); 
// Validate and get product by ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    die("Invalid product ID.");
}

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REDVI - <?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation -->
    <nav>
    <div class="nav-bar">
      <span class="logo"><a href="index.php">REDVI</a></span>
      <div class="menu">
        <ul class="nav-links">
          <li><a href="index.php">Sākums</a></li>
          <li><a href="kontakti.php">Kontakti</a></li>
          <li><a href="produkti.php">Produkti</a></li>
          <div class="login-container">


      
    <a href="javascript:void(0)" class="login-button" id="loginTrigger">Ielogoties</a>


    <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">×</span>
            <p>Ielogoties</p>

            <!-- Login form -->
            <div class="login-form">
                <label for="email">E-pasts:</label>
                <input type="email" id="email" name="email" placeholder="Ievadi savu e-pastu" required>

                <label for="password">Parole:</label>
                <input type="password" id="password" name="password" placeholder="Ievadi savu paroli" required>

                <button type="submit" onclick="validateLogin()">Ielogoties</button>

                <div id="notification" class="notification"></div>
            </div>
          
            <a href="registreties.php" onclick="window.open('registreties.php', 'popup', 'width=400,height=600'); return false;">Reģistrēties</a>
        </div>
    </div>
</div>
        </ul>
      </div>
      <div class="darkLight-searchBox">
        <div class="dark-light">
          <i class='bx bx-moon moon'></i>
          <i class='bx bx-sun sun'></i>
        </div>
      </div>
    </div>
  </nav>

    <!-- Product Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <ul>
                    <li>Cena: €<?php echo number_format($product['price'], 2, ',', ''); ?></li>
                    <ul>
                        <li>Preces kods: <?php echo htmlspecialchars($product['product_code'] ?? 'Nav pieejams'); ?></li>
                        <li>Filtra izpildījums: <?php echo htmlspecialchars($product['filter_type'] ?? 'Nav norādīts'); ?></li>
                    </ul>
                </ul>
                <button class="btn" style="background-color: rgb(223, 80, 23); color: white;">Pievienot grozam</button>
            </div>
        </div>
    </div>

        <div id="footer">
        <p>"SIA REDVI | © 2025"</p>
      </div>

    <script src="skripts.js"></script>
</body>

</html>
