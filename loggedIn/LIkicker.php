<?php session_start();

$lastLogin = $_SESSION["lastLogin"];
$nowMinus20 =  time() - 20*60;

if($lastLogin < $nowMinus20){
  session_start();

  session_destroy();

  session_start();
  $_SESSION['notification'] = ["warning", "Um das Schummeln von bösen Bot-Meistern auf GambleGame zu verhinden haben wir dich nach 20 Minuten online-Zeit gekickt. Wenn du weiterspielen möchtest, kannst du dich einfach erneut einloggen!"];

  header("location: ../Login.php");
}

?>
