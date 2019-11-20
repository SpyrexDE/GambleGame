<!DOCTYPE html>
<?php session_start();
if(isset($_SESSION["username"])){
          header("location: loggedIn/LIindex.php");
}?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg" />
<title>__________OEG-2100_____________</title>
</head>
    <body>

        <div class="header">

            <img class= "logo" src="img/logo.jpg" height="100" width="100">

            <a href="index.php">Start</a>
            <a class="active"href="Login.php">Login</a>
            <a href="Register.php">Registrieren</a>

        </div>

      <div class="content">

        <div class="login">
                             <form action="loginProcess.php" method = "POST">
                             <h1>Login</h1>

                                   <div class="textbox">
                                       <p class="text">Benutzername:</p>
                                       <input type="text" name="user">
                                   </div>

                                   <div class="textbox">
                                       <p class="text">Passwort:</p>
                                       <input type="password" name="pass">
                                   </div>

                                   <div class="centered"><Button class="loginBtn">Login</Button></div>
                                   </form>

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

        </div>

      </div>
    </body>
</html>
