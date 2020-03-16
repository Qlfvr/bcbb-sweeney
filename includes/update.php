<?php 
session_start(); 

try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=qzd0dusw8ob73fdo;charset=utf8','hpya3i8f0c3nymfm','xvxw1nfar44r7iin');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Update autre

    // $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING);
    // $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    // $signature = filter_input(INPUT_POST, "signature", FILTER_SANITIZE_STRING);
    
    if (isset($_POST["nickname"],$_POST["signature"],$_POST["id"])) {
  $insert = $bdd->prepare("UPDATE `users` SET `nickname` = :nickname , `signature` =
  :signature WHERE `id` = :id");

  $insert->execute(['nickname' => $_POST['nickname'], 'signature' => $_POST['signature'], 'id' => $_POST['id']]);
    }
      



// Modification du mots de passe



    if (isset($_POST["password"], $_POST["confirm-password"])){


       if ($_POST["password"]!="") {

        if ($_POST["password"] == $_POST["confirm-password"]) {



if (isset($_POST["password"],$_POST["id"])) {
$insert = $bdd->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");

$insert->execute(['password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT)), 'id' =>
$_POST['id']]);
}

            
            echo "parfait";
        } else {

            echo "pas confirmer";
        }

        
       }
       else {
           echo "empty password";
       }




    }




?>