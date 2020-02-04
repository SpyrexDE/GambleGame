<?php
session_start();

$username = $_SESSION["username"];
$click = $_POST["click"];

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();

$actualDate = new DateTime();
$actualDate = $actualDate->format('Y-m-d H:i:s');

$lastUpdateDate = $database -> query("select lastRegister from iplist where IP = '$seineIP'") or die ("Fehler: ".mysqli_error($database));
$lastUpdateDate = mysqli_fetch_array($lastUpdateDate)[0];


if($lastUpdateDate < $actualDate->modify('-1 day')->format('Y-m-d H:i:s')){
    if($click == true &&  $row['dailyCoins'] <= 50){

    $coins = $row['coins'] + 1;
    $coins = $row['dailyCoins'] + 1;
    $database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));

    }
}else{
    die("Du hast bereits 50 mal heite geklickt!");
}
?>
