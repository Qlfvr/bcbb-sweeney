<?php 
session_start(); 
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8mb4', 'root', 'root');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    echo '<meta http-equiv="refresh" content="1;URL=index.php">'; 
}

if ($_POST["action"] == "delete_message") {

    if ($_SESSION["id"]== $_POST["user_id"]) {

    echo "The message has been deleted";
    $query = 'UPDATE messages SET deleted = 1  WHERE id =? ';
    $delete_message = $bdd->prepare($query);
    $delete_message->execute(array($_POST["message_id"]));
        echo '<meta http-equiv="refresh" content="2;URL=../messages.php?topic_id='.$_POST["topic_id"].'">'; 

    }
    else {
        echo "you don't have permission to delete others messages...";
    }
}

if ($_POST["action"] == "edit_message") {

if ($_SESSION["id"]== $_POST["user_id"]) {

echo "The message has been edited";
$query = 'UPDATE messages SET content = ? WHERE id =? ';
$delete_message = $bdd->prepare($query);
$delete_message->execute(array($_POST["new_content"], $_POST["message_id"]));
echo '
<meta http-equiv="refresh" content="2;URL=../messages.php?topic_id='.$_POST["topic_id"].'">';

}
else {
echo "you don't have permission to edit others messages...";
}
}
?>