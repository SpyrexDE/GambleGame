<?php
session_start();

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("SELECT * FROM users ORDER BY coins DESC LIMIT 10") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$topTen = $result;


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

            <a href="LIindex.php">Start</a>
            <a href="LIVerdienen.php">Verdienen</a>
            <a class="active" href="LIStats.php">Statistiken</a>
            <?php echo "<label class='text'>Geld: ".$_COOKIE['coins']."</label>"; ?>
            <a id="Btn_Save" href="LISave.php">Speichern</a>
            <a id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">

        <div>
            
            <?php
              while ($row = mysql_fetch_assoc($topTen)) {
                echo "<p> $row[0] </p>";
              }                    
            ?>

        </div>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
