<?php
session_start();

if(isset($_SESSION["username"])){
          header("location: loggedIn/LIindex.php");
}

?>
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
            <a href="Login.php">Login</a>
            <a class="active" href="Register.php">Registrieren</a>

        </div>

      <div class="content">

        <div class="login">
          <h1>Registrieren</h1>
            <form action="registerProcess.php" method = "POST">
                <div class="textbox">
                    <p class="text">Benutzername:</p>
                    <input type="text" name="user">
                </div>

                <div class="textbox">
                    <p class="text">Passwort:</p>
                    <input type="password" name="pass">
                </div>

                  <div class="antiSpam"></div>

                    <div class="centered">
                        <?php require('registerProcess.php');
                              if(!darfRegistrieren()){?>
          				                <Button class="registerBtn" disabled

                                  title="Um die Website vor Account-Spam zu schützen,&#10;wurde sich dazu entschieden, dass nur alle&#10;30 Minuten ein neuer Account erstellt werden kann."

                                  >Du hast dich bereits registriert</Button>
                        <?php } else { ?>
        				          <Button class="registerBtn">Registrieren</Button>
                        <?php }?>
                    </div>
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
