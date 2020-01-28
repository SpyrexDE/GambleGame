<?php
session_start();
print("Hallo");
$coins = $_COOKIE["coins"];
$username = $_SESSION["username"];

print("Hallo");
$database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler Speichern des Kontostandes: ".mysqli_error($database));
print("Hallo");
$_SESSION['notification'] = ["success", "Erfolgreich gespeichert!"];
print("Hallo");
header("location: loggedIn/LIindex.php");
print("Hallo");
?>
