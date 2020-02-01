<?php
session_start();

$username = $_SESSION["username"];
$click = $_POST["click"];

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();

if($click == true){

$coins = $row['coins'] + 1;
$database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));

}
?>
