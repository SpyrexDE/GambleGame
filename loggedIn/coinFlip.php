<?php
session_start();

$username = $_SESSION["username"];
$einsatz = $_POST["einsatz"];

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();

if(!empty($einsatz) && $einsatz > 0){
  if($row['coins'] >= $einsatz){
    $randomInt = rand(0, 1);
      if($randomInt == 0){
        $gewonnen = $row['coins'] + $einsatz;
        $database -> query("UPDATE users SET coins='$gewonnen' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
        $_SESSION['notification'] = ["success", "Du hast beim Coinflip gewonnen!"];
        $ergebnis = "gewonnen";
      }else {
        $verloren = $row['coins'] - $einsatz;
        $database -> query("UPDATE users SET coins='$verloren' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
        $_SESSION['notification'] = ["error", "Du hast beim Coinflip verloren!"];
        $ergebnis = "verloren";
      }

      $actualDate = date('Y-m-d H:i:s', time());
      $message = "Der Nutzer ".$username."hat am beim Coinflip am".$actualDate." ".$ergebnis.".";
      $database -> query("insert into debug (inhalt) values ('$message');") or die ("Fehler: ".mysqli_error($database));

  } else {
    $_SESSION['notification'] = ["error", "Du besitzt nicht genug Geld dafür."];
  }
} else {
    $_SESSION['notification'] = ["error", "Bitte trage deinen Einsatz ein."];
}

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();
setcookie("coins", $row["coins"], time()+3600, "/");

header("location: LIVerdienen.php");
