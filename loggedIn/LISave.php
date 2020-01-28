<?php
session_start();

$coins = $_COOKIE["coins"];
$username = $_SESSION["username"];


$database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler Speichern des Kontostandes: ".mysqli_error($database));

$_SESSION['notification'] = ["success", "Erfolgreich gespeichert!"];

header("location: loggedIn/LIindex.php");

?>
