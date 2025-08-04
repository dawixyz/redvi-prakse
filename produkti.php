<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>REDVI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="style.css">

</head>
<body>

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
        <form action="login.php" method="POST" class="login-form">
            <label for="email">E-pasts:</label>
            <input type="email" id="email" name="email" placeholder="Ievadi savu e-pastu" required>

            <label for="password">Parole:</label>
            <input type="password" id="password" name="password" placeholder="Ievadi savu paroli" required>

            <button type="submit">Ielogoties</button>

            <div id="notification" class="notification">
                <?php
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            </div>
        </form>
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

  <h1 style="text-align:center;">Mūsu Produkti</h1>

<form style="text-align:center;" method="get" action="produkti.php">
  <label>
   Filtrēt pēc kategorijas
    <input type="text"name="keywords" autocomplete="off">
  </label>
  <input type="submit" value="Search"><br>
</form>


  <div class="product-catalog">
    <div class="product-grid">
      <?php
include 'database.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0):
  while ($row = mysqli_fetch_assoc($result)):
?>
    <a href="product-details.php?id=<?php echo $row['id']; ?>" class="product-link" style="text-decoration: none; color: inherit;">
      <div class="product-item">
        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>

        <div class="price-container">
          <p class="price">€<?php echo number_format($row['price'], 2, ',', ''); ?></p>
        </div>
      </div>
    </a>
<?php
  endwhile;
else:
  echo "<p style='text-align:center;'>Nav pieejamu produktu.</p>";
endif;

mysqli_close($conn);
?>
    </div>
  </div>
  <script src="skripts.js"></script>
  <footer>
    <div id="footer">
      <p>"SIA REDVI | © 2025"</p>
    </div>
  </footer>

</body>
</html>
