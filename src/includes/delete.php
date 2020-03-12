 <?php
//  session_start(); 
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


if ($_GET["action"] == "delete_message") {

    echo "test";
    echo $_GET["action"];
    echo $_GET["message_id"];

$query = 'UPDATE messages SET deleted = 1  WHERE id =? ';
$delete_message = $bdd->prepare($query);
$delete_message->execute(array($_GET["message_id"]));
    echo '<meta http-equiv="refresh" content="1;URL=../messages.php?topic_id='.$_GET["topic_id"].'">';



}


?>