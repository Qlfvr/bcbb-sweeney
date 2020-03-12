 <?php
 session_start(); 
 try
 {
 // On se connecte à MySQL
 $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
 }
 catch(Exception $e)
 {
 // En cas d'erreur, on affiche un message et on arrête tout
 die('Erreur : '.$e->getMessage());
 }
 
 //Delete 


if ($_GET["action"] == "deleteusers") {

    $request = 'DELETE FROM `users` WHERE `id` = :id';
    $delete = $bdd->prepare($request);
    $delete->execute(['id' => $_GET['id']]);
    //header("location:/login.php");
    echo '<meta http-equiv="refresh" content="1;URL=login.php">'; 
}

?>