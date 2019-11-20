<?php
session_start();

if (isset($_SESSION['username'])){
?>
<html>
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg" />
<title>__________OEG-2100_____________</title>
</head>
    <body>

        <div class="header">

            <img class= "logo" src="../img/logo.jpg" height="100" width="100">

            <a class="active" href="LIindex.php">Start</a>
            <a href="LIVerdienen.php">Verdienen</a>
            <a href="LIStats.php">Statistiken</a>
            <a id="Btn_Save" href="LISave.php">Speichern</a>
            <a id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">

        <div>
          <h1><u>Under construction</u></h1>
        <h2 class= "subHeading">Lorem ipsum dolor sit amet,</h2>
          <p class="text">consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <hr/>
          <h2 class= "subHeading">Willkommen im Spiel <b><?php echo $_SESSION['username'];?></b>!</h2>
          <p class="text">ACHTUNG: Zur Zeit ist in diesem Bereich nur der <b>Logout-Button</b> mit einer Funktion belegt!</p>
        </div>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
