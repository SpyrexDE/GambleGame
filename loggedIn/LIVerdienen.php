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
                    <img class= "logo" src="<?php echo $_SESSION['image'];?>" height="100" width="100" >
                  </a>
                  <?php echo "<label class='quickData'>"."Name: ".$_SESSION['username']."<br>"."<label id='labelCoins'>"."Geld: ".$_COOKIE['coins']."</label>"."</label>"; ?>
              <a class="menuButton" href="LIindex.php">Start</a>
              <a class="menuButton active" href="LIVerdienen.php">Verdienen</a>
              <a class="menuButton" href="LIStats.php">Statistiken</a>
              <a class="menuButton" id="Btn_Logout" href="LILogout.php">Logout</a>

        </div>

      <div class="content">
        <center>
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

          <div class="section">
              <h1 style="margin-bottom: 0;">Klicker</h1>

              <input onclick="addCoins(1); sendClick();" type="button" class ="btnClicker" id="btnClicker" value="[Klicken]"\>
          </div>

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

          <div class="section">
              <h1>Coinflip</h1>
              <p class = "text">Wenn du gewinnst, wird sich dein Einsatz vedoppeln. Wenn nicht, dann ist dein Einsatz weg.</p>
              <form action="coinFlip.php" method="POST">
                <p class = "text"><b>Einsatz:<b>
                    <input type="text" class="textbox" value="10" name="einsatz" id="textboxCoinFlip"></input>
                </p>
                  <input type="submit" class ="btnClicker" id="btnCoinFlip" value="[Flip]"/>
              </form>
         </div>
        <center>
      </div>
    </body>
</html>

<?php
} else{
header("location: ../Login.php");
}
 ?>
