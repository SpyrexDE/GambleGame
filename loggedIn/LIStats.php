<?php
session_start();
if (isset($_SESSION['username'])){
  include "LIkicker";

  //Mit Server verbinden und Datenbank auswaehlen
  $database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
  mysqli_select_db($database, "GambleDB");

  $result = $database -> query("SELECT * FROM users ORDER BY coins DESC LIMIT 10") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
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

                  <a href="LIProfile.php">
                    <img class= "logo" src="<?php echo $_SESSION['image'].'?='.filemtime($_SESSION['image']);?>" height="100" width="100" >
                  </a>
                  <?php echo "<label class='quickData'>"."Name: ".$_SESSION['username']."<br>"."<label id='labelCoins'>"."Geld: ".$_COOKIE['coins']."</label>"."</label>"; ?>
              <a class="menuButton" href="LIindex.php">Start</a>
              <a class="menuButton" href="LIVerdienen.php">Verdienen</a>
              <a class="menuButton active" href="LIStats.php">Statistiken</a>
              <a class="menuButton" id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">

        <div>
            <center>

            <?php
              $counter = 0;
              while($topTen = $result->fetch_array()){
                $counter += 1;
                echo "<p class='text'>".$counter.". Platz: ".$topTen['username']." | ".$topTen['coins']." Coins</p>";
              }
            ?>

            </center>
        </div>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
