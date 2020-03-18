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

              <?php $_SESSION['notification'] = ["warning", "Du musst alle Felder ausfüllen, um die Daten zu ändern!"]; ?>

        <div>

          <div class="panel">


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

            <form action="changeProcess.php" method = "POST">

                  <div class="textbox">
                      <p class="text">Neues Profilbild:</p>
                      <input id="imgUpload" type="file" name="userImg" placeholder="Photo" capture>
                  </div>

                  <div class="textbox">
                      <p class="text">Neuer Name:</p>
                      <input type="text" name="user">
                  </div>

                  <div class="textbox">
                      <p class="text">Neues Passwort:</p>
                      <input type="password" name="pass">
                  </div>

                  <div class="centered"><Button id="saveBtn">Speichern</Button></div>

            </form>


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
