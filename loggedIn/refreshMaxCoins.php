<?php

//Mit DB verbinden
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$username = $_SESSION["username"];


//Reset MaxCoins
$actualDate = time(); // date('Y-m-d H-i-s', time());
$actualMinus3 = time() - 3*60;
$result = $database -> query("select * from users where username = '$username'")
              or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();
$lastUpdateDate = $row['lastClick'];

if($lastUpdateDate < $actualMinus3){
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    setcookie("dailyCoins", 0, time()+3600, "/");
    //Update lastClickCookie
    $result = $database -> query("select * from users where username = '$username'")
                  or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
    $row = $result->fetch_array();
  

    setcookie("lastClick", $actualDate, time()+3600, "/");
  

    $_SESSION['notification'] = ["success", "Deine 3-minute-Coins wurden resettet!"];
} else {
    setcookie("lastClick", $lastUpdateDate, time()+3600, "/");
}
?>
