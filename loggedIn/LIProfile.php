<?php
session_start();

if (isset($_SESSION['username'])){
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
                    <img class= "logo selected" src="<?php echo $_SESSION['image'];?>" height="100" width="100" >
                  </a>
                  <?php echo "<label class='quickData'>"."Name: ".$_SESSION['username']."<br>"."<label id='labelCoins'>"."Geld: ".$_COOKIE['coins']."</label>"."</label>"; ?>
              <a class="menuButton" href="LIindex.php">Start</a>
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

        <div class="panel" style="height: 600px;">
            
                <img class= "profileLogo" src="<?php echo $_SESSION['image'];?>" height="140" width="140" >
                <?php echo "<label class='profileData' style='font-size: 20px !important;'>"."Name: ".$_SESSION['username']."<br>"."<label>"."Geld: ".$_COOKIE['coins']."<br>"."<label>"."Registriert am: ".$_SESSION['registered']."</label>"."</label>"."<div align='center'><a style='color: deepskyblue;' href='LIChangeProfile.php'>Profil bearbeiten</a></div>"."</label>"; ?>
                

          
        </div>



        </div>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
