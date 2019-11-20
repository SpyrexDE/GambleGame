<?php  session_start();

header("location: https://oeg2100.000webhostapp.com/");

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

            <img class= "logo" src="img/logo.jpg" height="100" width="100">

            <a class="active" href="index.php">Start</a>
            <a href="Login.php">Login</a>
            <a href="Register.php">Registrieren</a>

        </div>

      <div class="content">

        <div>
          <h1><u>Under construction</u></h1>
        <h2 class= "subHeading">Lorem ipsum dolor sit amet,</h2>
          <p class="text">consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <hr/>
          <h2 class= "subHeading">Willkommen auf meiner Website!</h2>
            <p class="text">Hier wird ein lustiges Klickerspiel mit Gewinnspiel-elementen entstehen. Mit etwas Glück habe ich das Account-Manageing bereits programmiert, und du kannst dich schon einmal registrieren!</p>
            <a href="/loggedIn/LIindex.php">Zum Spiel</a>
        </div>
      </div>
    </body>
</html>
