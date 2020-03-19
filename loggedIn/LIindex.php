<?php
session_start();
if (isset($_SESSION['username'])){
include "LIkicker.php";
?>
<html>
<head>
<link rel="stylesheet" href="../styles.css">
<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg" />
<title>__________OEG-2100_____________</title>
</head>
    <body>

        <div class="header">
                <a href="LIProfile.php">
                  <img class= "logo" src="<?php echo $_SESSION['image'].'?='.filemtime($_SESSION['image']);?>" height="100" width="100" >
                </a>
                <?php echo "<label class='quickData'>"."Name: ".$_SESSION['username']."<br>"."<label id='labelCoins'>"."Geld: ".$_COOKIE['coins']."</label>"."</label>"; ?>
            <a class="menuButton active" href="LIindex.php">Start</a>
            <a class="menuButton" href="LIVerdienen.php">Verdienen</a>
            <a class="menuButton" href="LIStats.php">Statistiken</a>
            <a class="menuButton" id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">


                     <!--NOTIFICATION-LISTENER-->

                   <?php
                   if (isset($_SESSION['notification'])){
                     $type = $_SESSION['notification'][0];
                     $message = $_SESSION['notification'][1];
                     ?>
                     <div class="alert <?php echo $type; ?>" >
                       <span class="closebtn" onclick="this.parentElement.id='closedAlert';">&times;</span>
                       <?php echo $message; ?>
                     </div>
                     <?php
                     unset($_SESSION['notification']);
                     }

                    ?>



        <div>
          <h1>GambleGame</h1>
        <h2 class= "subHeading">Willkommen im Spiel <b><?php echo $_SESSION['username'];?></b>!</h2>
          <p class="text">Ich freue mich sehr, dass du dich registrieren konntest und eingeloggt hast. Bei dem Menüpunkt "Verdienen" kannst du dir dein Kapital zusammen klicken, und in Glückspiel investieren. Der Menüpunkt "Statistiken" zeigt dir die zehn besten Spieler des Spiels und deren Kontostand an. Wirst du es auch in diese Liste schaffen?</p>
        <hr/>
           <h2 class= "subHeading">Letzte Updates</h2>
            <ul class = "text">
                <li style="color: red;">Profilbearbeitungen hinzugefügt</li>
                <li>Profile hinzugefügt</li>
                <li>XSS gefixt</li>
                <li>Cookie-Editing gefixt</li>
                <li>Mobile Optimierungen</li>
                <li>Performance verbesserungen</li>
                <li>Neue Datenbankverbindung</li>
                <li>Kleinere bugfixes</li>
                <li>Coinflip hinzugefügt</li>
                <li><?php echo time()-$_SESSION["lastLogin"];?></li>
            </ul>
        </div>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
