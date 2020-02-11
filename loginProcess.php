<?php session_start();

    if(!empty( $_POST['user']) &&  !empty($_POST['pass'])){

        //Lade Werte des form-elemtes in die Variablen
        $username = $_POST['user'];
        $password = $_POST['pass'];

        //Mit Server verbinden und Datenbank auswaehlen
          $database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
          mysqli_select_db($database, "GambleDB");

        //Anti Mysql injection
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        $username = mysqli_real_escape_string($database, $username);
        $password = mysqli_real_escape_string($database, $password);


        //Suche nach Nutzer in der Datenbank
        $result = $database -> query("select * from users where username = '$username' and password= '$password'")
                      or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error());
        $row = $result->fetch_array();
          if ($row['username'] == $username && $row['password'] == $password ){

              //Variablen setzen
              $_SESSION["username"] = $username;
              $_SESSION["registered"] = $row["registered"];
              if(file_exists($_SERVER['DOCUMENT_ROOT']."/img/userIMGS/".$username.".jpg")){
                $_SESSION["image"] = "../img/userIMGS/".$username.".jpg";
              } else {
                $_SESSION["image"] = "../img/logo.jpg";
              }

              setcookie("coins", $row["coins"]);
              setcookie("dailyCoins", $row['dailyCoins']);
              setcookie("lastClick", $row['lastClick']);

              
              

              //Reset DailyMaxCoins

              $actualDate = new DateTime();
              $actualDate = $actualDate->format('Y-m-d');

              if(oneDayPast($row['lastClick'], $actualDate)){
                  $database -> query("UPDATE users SET lastClick='$actualDate' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
                  $database -> query("UPDATE users SET dailyCoins='0' WHERE username='$username'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
              }
              
              
              function oneDayPast($oldDay, $newDay){
                  if ($oldDay != $today)
                  {
                      return true;
                  }
                  else
                  {
                      return false;
                  }
              }







            $_SESSION['notification'] = ["success", "Erfolgreich eingeloggt."];
              header("location: loggedIn/LIindex.php");
          } else {
            $_SESSION['notification'] = ["error", "Falscher Benutzername oder Passwort."];
            header("location: Login.php");
          }

    } else{
      $_SESSION['notification'] = ["warning", "Du musst beide Felder ausgefüllt haben!"];
      header("location: Login.php");
    }
 ?>
