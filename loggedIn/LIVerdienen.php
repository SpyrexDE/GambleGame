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

            <img class= "logo" src="../img/logo.jpg" height="100" width="100">

            <a href="LIindex.php">Start</a>
            <a class="active" href="LIVerdienen.php">Verdienen</a>
            <a href="LIStats.php">Statistiken</a>
            <?php echo "<label id='labelCoins' class='text'>Geld: ".$_SESSION['coins']."</label>"; ?>
            <a id="Btn_Save" href="LISave.php">Speichern</a>
            <a id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">

          <center><input onclick="document.cookie +=1; document.getElementById('labelCoins').innerHTML = 'Geld: '.document.cookie;" type="button" class ="btnClicker" id="btnClicker" value="[Klicken]"\></center>
          
          
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
