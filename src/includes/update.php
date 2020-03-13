<?php 
session_start(); 

try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
             
// Update autre

if ($_GET["action"] == "updateusers") {
   
    $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $signature = filter_input(INPUT_POST, "signature", FILTER_SANITIZE_STRING);
    if (!empty($nickname && $password && $signature )) {
        $pdo = $bdd;
        $pdo = $request = "UPDATE `users` SET `nickname` = :nickname , `password` =  :password , `signature` = :signature WHERE `id` = :id";
        $insert = $bdd->prepare($request);
        try {
            $insert->execute(['nickname' => $_POST['nickname'], 'password' =>htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT)), 'signature' => $_POST['signature'], 'id' => $_GET['id']]);
            header("location:/profil.php");

        }
        catch (PDOException $e){

            die($e->getMessage());
        }
    } else {
        //echo "Insérer une valeur à chaque champ";
    }




};

?>