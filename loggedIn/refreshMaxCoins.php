<?php
die("ähä");
//Mit DB verbinden
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

//Suche nach Nutzer in der Datenbank
$result = $database -> query("select * from users where username = '$username' and password = '$password'")
              or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();

$username = $row['username'];

//Reset MaxCoins
$actualDate = date('Y-m-d H:i:s', time());
$lastUpdateDate = $database -> query("select lastClick from users where username='$username'") or die ("Fehler: ".mysqli_error($database));
$lastUpdateDate = mysqli_fetch_array($lastUpdateDate)[0];
        $database -> query("insert into debug (inhalt) values ('$actualDate');") or die ("Fehler: ".mysqli_error($database));
        $database -> query("insert into debug (inhalt) values ('$lastUpdateDate');") or die ("Fehler: ".mysqli_error($database));
        $database -> query("insert into debug (inhalt) values ('$actualDate->modify('-3 minute')');") or die ("Fehler: ".mysqli_error($database));

if($lastUpdateDate < $actualDate->modify('-3 minute')){
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    setcookie("dailyCoins", 0);
    die("Deine dailyCoins wurden resettet!");
}
?>
