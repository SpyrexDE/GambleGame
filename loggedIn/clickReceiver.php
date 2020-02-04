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

if(oneDayPast($row['lastClick'], $actualDate)){
    $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
}

if($row['dailyCoins'] <= 50){
    if($click == true){

    $coins = $row['coins'] + 1;
    $dailyCoins = $row['dailyCoins'] + 1;
    $database -> query("UPDATE users SET coins='$coins' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    $database -> query("UPDATE users SET dailyCoins='$dailyCoins' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
    }
}else{
    $_SESSION['notification'] = ["error", "Du hast heute bereits 50 mal geklickt!"];
    header("location: LIVerdienen.php");
}


function oneDayPast($oldDay, $newDay){
    $oldDay = '12-05-12';
    $newDay = date("y-m-d", strtotime($oldDay));
    $today = date("y-m-d", strtotime("today"));

    if ($newDay === $today)
    {
        return false;
    }
    elseif ($denDay < $today)
    {
        return true;
    }
}

?>
