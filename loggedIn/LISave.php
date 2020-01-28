<?php
session_start();
$coins = $_COOKIE["coins"];
$username = $_SESSION["username"];
//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");


$database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler Speichern des Kontostandes: ".mysqli_error($database));
$_SESSION['notification'] = ["success", "Erfolgreich gespeichert!"];
header("location: LIindex.php");
?>
