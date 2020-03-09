<?php

//Reset MaxCoins
$actualDate = date('Y-m-d H:i:s', time());
$lastUpdateDate = $database -> query("select lastClick from users where username='$username'") or die ("Fehler: ".mysqli_error($database));
$lastUpdateDate = mysqli_fetch_array($lastUpdateDate)[0];
        $database -> query("insert into debug (inhalt) values ('$actualDate');") or die ("Fehler: ".mysqli_error($database));
        $database -> query("insert into debug (inhalt) values ('$lastUpdateDate');") or die ("Fehler: ".mysqli_error($database));
die("");

if($lastUpdateDate < $actualDate->modify('-3 minute')){
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    setcookie("dailyCoins", 0);
    die("Deine dailyCoins wurden resettet!");
}
?>
