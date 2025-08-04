<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>REDVI</title>
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
      <h1 style="text-align: center;">Lapa ir izstrādes režīmā</h1>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"
        nonce="abc123"></script>
        <div class="fb-page-wrapper" id="fbContainer">
          <div class="toggle-btn" id="fbToggle">&#8594;</div>
          <div class="fb-page"
              data-href="https://www.facebook.com/REDVI.SIA"
              data-tabs="timeline"
              data-small-header="false"
              data-adapt-container-width="true"
              data-hide-cover="false"
              data-show-facepile="true">
          </div>
      </div>
        
  </body>
  
  
  <script src="skripts.js"></script>
  <div id="footer">
    <p>"SIA REDVI | © 2025"</p>
  </div>
</body>
</html>
