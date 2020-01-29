<?php
session_start();
$coins = $_COOKIE["coins"];
$clicks = $_COOKIE["clicks"];
$username = $_SESSION["username"];

$coins = intval($coins);

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();


if ($coins - $clicks == $row['coins']){


$database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler Speichern des Kontostandes: ".mysqli_error($database));
$_SESSION['notification'] = ["success", "Erfolgreich gespeichert!"];

} else{
  $_SESSION['notification'] = ["error", "Cheaten ist böse!"];
}
//Clicks resetten
$_COOKIE["clicks"] = 0;
//Coins zuruecksetzten
$_COOKIE["coins"] = $row['coins'];

header("location: LIindex.php");

?>
