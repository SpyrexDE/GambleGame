<?php
session_start();

$username = $_SESSION["username"];
$einsatz = $_POST["einsatz"];

//Mit Server verbinden und Datenbank auswaehlen
$database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
mysqli_select_db($database, "GambleDB");

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();

if(!empty($einsatz) && $einsatz > 0){
  if($row['coins'] >= $einsatz){
    $resultStr = "Str";
    $wurfSumme = wurf();
    $ersteSumme = $wurfSumme;
    die("1 - " + $resultStr);
      if($wurfSumme == 7 || $wurfSumme == 11){
          gewonnen();
            die("2 - " + $resultStr);
      }else if($wurfSumme == 2 || $wurfSumme == 3 || $wurfSumme == 12){
          verloren();
            die("3 - " + $resultStr);
      } else {
          endSchleife();
            die("4 - " + $resultStr);
      }
      
      
  } else {
    $_SESSION['notification'] = ["error", "Du besitzt nicht genug Geld dafür."];
  }
} else {
    $_SESSION['notification'] = ["error", "Bitte trage deinen Einsatz ein."];
}

$result = $database -> query("select * from users where username = '$username'") or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
$row = $result->fetch_array();
setcookie("coins", $row["coins"], time()+3600, "/");

header("location: LIVerdienen.php");




function wurf(){
    global $resultStr;
    $wurfZahl1 = rand(1, 6);
    $wurfZahl2 = rand(1, 6);
    $wurfSumme = $wurfZahl1 + $wurfZahl2;
    $resultStr .= "Würfel1: " . $wurfZahl1 . ", Würfel2: " . $wurfZahl2 . " | Würfelsumme: " . $wurfSumme;
          die($resultStr);
    return $wurfSumme;
}

function gewonnen(){
        global $row;
        global $einsatz;
        global $resultStr;
        global $username;
        $gewonnen = $row['coins'] + $einsatz;
        $database -> query("UPDATE users SET coins='$gewonnen' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
        $_SESSION['notification'] = ["success", $resultStr + " » Gewonnen"];
}

function verloren(){
        $_SESSION['notification'] = ["success", "Grummel"];
        //$verloren = $row['coins'] - $einsatz;
        //$database -> query("UPDATE users SET coins='$verloren' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
        //$_SESSION['notification'] = ["error", $resultStr + " » Verloren"];
}

function endSchleife(){
          global $ersteSumme;
          $wurfSumme = wurf();
          if($wurfSumme == 7){
            verloren();
          } else if($wurfSumme == $ersteSumme){
              gewonnen();
          } else{
              endSchleife();
          }
          
}
