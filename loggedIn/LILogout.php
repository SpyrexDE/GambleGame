<?php
session_start();

session_destroy();

session_start();
$_SESSION['notification'] = ["success", "Erfolgreich ausgeloggt."];

header("location: ../Login.php");
?>
