<?php
if(!isset($_SESSION))
{
    session_start();
}
if (isset($_SESSION['username'])){
            //Lade Werte des form-elemtes in die Variablen und entferne Tags
            $username = strip_tags($_POST['user']);
            $password = strip_tags($_POST['pass']);
            $image = $_FILES['userImg'];
            $oldName = $_SESSION['username'];

  if (!empty($_POST['user']) && !empty($_POST['pass'])){
      if(ctype_alnum($username) && strlen( $username) >= 4 && strlen( $username) <= 10 && strlen( $password) >= 4 && strlen( $password) <= 20){

            //Mit Server verbinden und Datenbank auswaehlen
            $database = mysqli_connect("gamblegame.mofagames.eu", "GambleGame", "L7cnyeN9DA@Ywx3");
            mysqli_select_db($database, "GambleDB");

            //Anti Mysql injection
            $username = stripcslashes($username);
            $password = stripcslashes($password);
            $username = mysqli_real_escape_string($database, $username);
            $password = mysqli_real_escape_string($database, $password);

            //Suche nach Nutzer in der Datenbank
            $result = $database -> query("select * from users where username = '$username'")
                                   or die("Fehler beim durchsuchen der Datenbank: ".mysqli_error($database));

              if (mysqli_num_rows($result) <= 0 || $username == $oldName){  //Falls name noch nicht existiert:

                if(is_uploaded_file($image["tmp_name"])){
                    //Check upload
                    if($image["size"] < 300000 && getimagesize($image["tmp_name"])[0] == 300 && getimagesize($image["tmp_name"])[1] == 300 && exif_imagetype($image["tmp_name"]) == IMAGETYPE_JPEG){
                    $newfilename = $username . ".jpg";
                    move_uploaded_file($image["tmp_name"], "../img/userIMGS/" . $newfilename);
                    } else{
                          die("Es tut uns leid aber leider können wir aus Sicherheitsgründen nur Bilddateien mit der Endung '.jpg' akzeptieren. Diese dürfen auch nur 300x300 pixel groß sein. Wir bitten um ihr verständnis.");
                    }
                }

                  //Setze user in die datenbank

                  $database -> query("UPDATE users SET password='$password' WHERE username='$oldName'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));
                  $database -> query("UPDATE users SET username='$username' WHERE username='$oldName'") or die ("Fehler beim Senden deines Klicks:".mysqli_error($database));

                  $actualDate = date('Y-m-d H:i:s', time());
                  $message = "Der Nutzer ".$username."hat eine Daten am ".$actualDate." geändert.";
                  $database -> query("insert into debug (inhalt) values ('$message');") or die ("Fehler: ".mysqli_error($database));

                  //Check for rename of image
                  if(file_exists('../img/userIMGS/'.$oldName.'.jpg')){
                    rename ('../img/userIMGS/'.$oldName.'.jpg', '../img/userIMGS/'.$username.'.jpg');
                  }

                  session_destroy();
                  session_start();
                  $_SESSION['notification'] = ["success", "Alle Änderungen wurden übernommen! Bitte neu einloggen!"];
                  header("location:  LIChangeProfile.php");
              } else {
                $_SESSION['notification'] = ["error", "Der Benutzername ist bereits vergeben."];
                header("location:  LIChangeProfile.php");
              }


      } else {
                $_SESSION['notification'] = ["error", "Ungültige Eingaben."];
                header("location: LIChangeProfile.php");
      }
  } else {
            $_SESSION['notification'] = ["error", "Es müssen alle Textfelder ausgefüllt werden!"];
            header("location: LIChangeProfile.php");
  }
}




 ?>
