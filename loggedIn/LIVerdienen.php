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
            <?php echo "<label id='labelCoins' class='text'>Geld: ".$_COOKIE['coins']."</label>"; ?>
            <a id="Btn_Save" href="LISave.php">Speichern</a>
            <a id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">

          
          
          <script>
              function setCookie(cname, cvalue, exdays) {
                  var d = new Date();
                  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                  var expires = "expires="+d.toUTCString();
                  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                  var name = cname + "=";
                  var ca = document.cookie.split(';');
                  for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                      c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                      return c.substring(name.length, c.length);
                    }
                  }
                  return "";
                }
          </script>
          
          
          
          
          
          
          <center><input onclick="setCookie(’coins’, parseInt(getCookie(’coins’))+ 1, 365); document.getElementById('labelCoins').innerHTML = 'Geld: '.getCookie(’coins’);" type="button" class ="btnClicker" id="btnClicker" value="[Klicken]"\></center>
          
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
