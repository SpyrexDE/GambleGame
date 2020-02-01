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

            <a onclick="setClicks(clicks)" href="LIindex.php">Start</a>
            <a onclick="setClicks(clicks)" class="active" href="LIVerdienen.php">Verdienen</a>
            <a onclick="setClicks(clicks)" href="LIStats.php">Statistiken</a>
            <?php echo "<label id='labelCoins' class='text'>Geld: ".$_COOKIE['coins']."</label>"; ?>
            <a id="Btn_Logout" href="LILogout.php">Logout</a>

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

              function addCoins(value){
                setCookie('coins', parseInt(getCookie('coins'))+ value, 365);
                refresh();
              }

              function setClicks(value){
                setCookie('clicks', value, 365);
                refresh();
              }

              function refresh(){
                  var coins = getCookie('coins');
                  var currency = "Geld: ";
                  var coinStr = coins;
                  document.getElementById('labelCoins').innerHTML = currency.concat(coinStr);
              }


              window.onload = function () {
                  refresh();
              }
          </script>



          <center><input onclick="addCoins(1); sendClick();" type="button" class ="btnClicker" id="btnClicker" value="[Klicken]"\></center>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</script>

          <script>
          function sendClick(){
            $.ajax({
                url: 'clickReceiver.php',
                type:'POST',
                data:
                {
                    click: true
                }
            });
          }
          </script>


          <hr>

          <h2 class = "text">Coinflip</h2>
          <p class = "text">Wenn du gewinnst, wird sich dein Einsatz vedoppeln. Wenn nicht, dann ist dein Einsatz weg.</p>

          <center><input type="text" class="textbox" value="Einsatz" id="coinFlipBox"></input></center>

          <center><input onclick="sendCoinflip();" type="button" class ="btnClicker" id="btnCoinFlip" value="[Flip]"\></center>

          <script>
          function sendCoinflip(){
            $.ajax({
                url: 'coinFlip.php',
                type:'POST',
                data:
                {
                    einsatz: document.getElementById("coinFlipBox").value
                }
            });
          }
          </script>


      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
