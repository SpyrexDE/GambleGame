<?php  session_start();

if(isset($_SESSION["username"])){
          header("location: loggedIn/LIindex.php");
}
?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg" />
<title>__________OEG-2100_____________</title>
</head>
    <body>

        <div class="header">

          <img class= "noHoverLogo" src="img/logo.jpg" height="100" width="100" >
          <a class="menuButton active" href="index.php">Start</a>
          <a class="menuButton" href="Login.php">Login</a>
          <a class="menuButton" href="Register.php">Registrieren</a>

        </div>

      <div class="content">

        <div>
          <h1><u>Willkommen bei GambleGame</u></h1>
        <center><h2 class= "subHeading">-Zocken ohne Grenzen-</h2></center>
                  <p class="text">Herzlich willkommen auf der Website des OEG-Accounts <b>2100</b>. Hier kannst du dir dein Kapital erklicken, um es anschließend in einem unterhanltsamen SevenEleven-Spiel zu verzocken. Wirst du die Millarden erreichen können oder als größter Pechvogel in die Geschichte eingehen? Registriere dich jetzt, werde zu einem der größten Spieler des GambleGames und ringe um den 1. Platz auf der Toplist!</p>
        </div>
      </div>

      <div class="footer">
        <a class="footerLink" href="impressum.html">Impressum</a>
        <a class="footerLink" href="datenschutz.html">Datenschutz</a>
      </div>

    </body>
</html>
