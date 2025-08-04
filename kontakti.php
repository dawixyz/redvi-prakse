<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--Ikonas-->
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REDVI</title>
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
                            <!-- Ielogošanās panelis -->
                            <div class="login-form">
                              <label for="email">E-pasts:</label>
                              <input type="email" id="email" name="email" placeholder="Ievadi savu e-pastu">
                      
                              <label for="password">Parole:</label>
                              <input type="password" id="password" name="password" placeholder="Ievadi savu paroli">
                      
                              <button type="submit" onclick="validateLogin()">Ielogoties</button>
                      
                              <!-- Paziņojums par nederīgu epasta adresi/tā nav ievadīta-->
                              <div id="notification" class="notification"></div>
                            </div>
                      
                            <!-- Registrācijas poga -->
                            <a href="registreties.html" class="register-button">Reģistrēties</a>
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
    <script src="skripts.js"> </script>
    <div>
    <div class="wrapper">
        <header>
            <h1 class="under-nav-text">Sazinies ar mums</h1>
        </header>
        <section class="columns">
            <div class="column">
                <h2>Saziņai</h2>
                <p>E-pasts - redvi@inbox.lv</p>
            </div>
            <div class="column">
                <h2>Darba laiks</h2>
                <p>Pirmdiena - Piektdiena 09:00-17:00</p>
                <p>Sestdiena - 10:00-14:00</p>
                <p>Svētdiena - slēgts</p>
            </div>
            <div class="column">
                <h2>Juridiskā adrese</h2>
                <p>SIA "REDVI"</p>
                <p>Sakas iela 5, Aizpute, Dienvidkurzemes novads, LV-3456</p>
            </div>
        </section>
    </div>
    <h2 class="under-nav-text">Atrašanās vieta</h2>
    <p style="text-align: center;"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4378.53931112379!2d21.592618!3d56.721159!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46efe3d880374617%3A0x4a19db5dec99e265!2sREDVI%20SIA!5e0!3m2!1sen!2slv!4v1701384028043!5m2!1sen!2slv" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
    <div id="footer">
        <p>"SIA REDVI | © 2025"</p>
      </div>
</body>
</html>