<?php session_start();

    if(!empty( $_POST['user']) &&  !empty($_POST['pass'])){

        //Lade Werte des form-elemtes in die Variablen
        $username = $_POST['user'];
        $password = $_POST['pass'];

        //Mit Server verbinden und Datenbank auswaehlen
          $database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
          mysqli_select_db($database, "gamblegame");

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
              setcookie("coins", $row["coins"]);
              
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
