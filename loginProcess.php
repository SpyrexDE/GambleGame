<?php session_start();
    if(!empty( $_POST['user']) &&  !empty($_POST['pass'])){
      $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfxZ-IUAAAAADCw6cFyh7C_zqhvgjQnmIrKj-cw&response=".$_POST['g-recaptcha-response']);
        $request = json_decode($request);
        if($request->success == true){


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
        $result = $database -> query("select * from users where username = '$username' and password = '$password'")
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

              include "loggedIn/refreshMaxCoins.php";


              setcookie("coins", $row["coins"]);
              setcookie("dailyCoins", $row['dailyCoins']);

              $actualDate = date('Y-m-d H:i:s', time());
              $message = "Der Nutzer ".$username." hat sich am ".$actualDate." eingeloggt.";
              $database -> query("insert into debug (inhalt) values ('$message');") or die ("Fehler: ".mysqli_error($database));

              $_SESSION["lastLogin"] = time()

            $_SESSION['notification'] = ["success", "Erfolgreich eingeloggt."];
              header("location: loggedIn/LIindex.php");
          } else {
            $_SESSION['notification'] = ["error", "Falscher Benutzername oder Passwort."];
            header("location: Login.php");
          }



       } else{
         $_SESSION['notification'] = ["warning", "Das recaptcha muss bestätigt werden!"];
         header("location: Login.php");
       }


    } else{
      $_SESSION['notification'] = ["warning", "Du musst beide Felder ausgefüllt haben!"];
      header("location: Login.php");
    }
 ?>
