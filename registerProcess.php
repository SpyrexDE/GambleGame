<?php
if(!isset($_SESSION))
{
    session_start();
}


    if(!empty( $_POST['user']) &&  !empty($_POST['pass']) && darfRegistrieren()){


          //Mit Server verbinden und Datenbank auswaehlen
          $database = mysqli_connect("db4free.net", "oeg2100", "L7cnyeN9DA@Ywx3");
          mysqli_select_db($database, "gamblegame");

          //Lade Werte des form-elemtes in die Variablen
          $username = $_POST['user'];
          $password = $_POST['pass'];
          $seineIP = $_SERVER['REMOTE_ADDR'];

          $registeredIP= $database -> query("SELECT IP FROM iplist WHERE IP = '$seineIP'") or die ("Fehler beim erstellen des Accounts: ".mysqli_error($database));
          $registeredIP = $registeredIP->fetch_array(MYSQLI_NUM)[0];

          $actualDate = new DateTime();
          $actualDate = $actualDate->format('Y-m-d H:i:s');
          //Anti Mysql injection
          $username = stripcslashes($username);
          $password = stripcslashes($password);
          $username = mysqli_real_escape_string($database, $username);
          $password = mysqli_real_escape_string($database, $password);

          //Suche nach Nutzer in der Datenbank
          $result = $database -> query("select * from users where username = '$username'")
                                 or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error($database));

            if (mysqli_num_rows($result) <= 0){  //Falls name noch nicht existiert:
                //BEI ERFOLGREICHEM REGISTRIEREN:
                //Setze user in die datenbank
                $database -> query("INSERT INTO users (username, password, coins) VALUES ('$username', '$password', '0')") or die ("Fehler beim erstellen des Accounts: ".mysqli_error($database));
                //Prüfe ob IP überhaupt jemals eingetragen wurde
                if ($registeredIP != null){
                    $database -> query("UPDATE iplist SET lastRegister='$actualDate' WHERE IP='$seineIP'") or die ("Fehler beim erstellen des Accounts: ".mysqli_error($database));
                  } else{
                    $database -> query("INSERT INTO iplist (IP, lastRegister) VALUES ('$seineIP', '$actualDate')");  //Erstelle neue IP-Row
                  }
                //----
                $_SESSION['notification'] = ["success", "Erfolgreich registriert."];
                header("location: Register.php");
            } else {
              $_SESSION['notification'] = ["error", "Der Benutzername ist bereits vergeben."];
              header("location: Register.php");
            }




    }





    function darfRegistrieren(){//Checkt, ob schon 3 tage her ist wo die reg zahl wieder zurück auf 0 gesetzt wurde
      $actualDate = new DateTime();
      $database = mysqli_connect("db4free.net", "oeg2100", "L7cnyeN9DA@Ywx3");
      mysqli_select_db($database, "gamblegame");
      $seineIP = $_SERVER['REMOTE_ADDR'];
      $lastUpdateDate = $database -> query("select lastRegister from iplist where IP = '$seineIP'") or die ("Fehler: ".mysqli_error($database));
            $lastUpdateDate = mysqli_fetch_array($lastUpdateDate)[0];

      if($lastUpdateDate < $actualDate->modify('-30 minute')->format('Y-m-d H:i:s')){
        return true;
      } else{
        return false;
      }

    }
 ?>
