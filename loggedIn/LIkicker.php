<?php session_start();

if(time()-$_SESSION["lastLogin"] >= 20){
  session_start();

  session_destroy();

  session_start();
  $_SESSION['notification'] = ["warning", "Um das Schummeln von bösen Bot-Meistern auf GambleGame zu verhinden haben wir dich nach 20 Minuten online-Zeit gekickt. Wenn du weiterspielen möchtest, kannst du dich einfach erneut einloggen!"];

  header("location: ../Login.php");
}

?>
