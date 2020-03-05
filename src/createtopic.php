<?php
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

// create topic into database


$topic = $bdd->prepare('INSERT INTO topics(title, creation_date, boards_id, users_id)
VALUES(:title, :creation_date, :boards_id, :users_id)');
$topic->execute(array(
'title' => $_POST["topic_title"],
'creation_date' => $_POST["date"],
'boards_id' => $_POST["board_id"],
'users_id' => $_POST["user_id"]
));

?>