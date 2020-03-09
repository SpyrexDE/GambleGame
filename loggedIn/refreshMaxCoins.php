<?php

//Mit DB verbinden
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$username = $_SESSION["username"];



//Reset MaxCoins
$actualDate = date('Y-m-d H:i:s', time());
//$actualMinus3 = $actualDate->modify('-3 minute');
$result = $database -> query("select * from users where username = '$username'")
              or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();
$lastUpdateDate = $row['lastClick'];

        $database -> query("insert into debug (inhalt) values ('$actualDate');") or die ("Fehler: ".mysqli_error($database));
        $database -> query("insert into debug (inhalt) values ('$lastUpdateDate');") or die ("Fehler: ".mysqli_error($database));
//        $database -> query("insert into debug (inhalt) values ('$actualMinus3');") or die ("Fehler: ".mysqli_error($database));

if($lastUpdateDate < $actualDate->modify('-3 minute')){
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    setcookie("dailyCoins", 0);
    die("Deine dailyCoins wurden resettet!");
}
?>
