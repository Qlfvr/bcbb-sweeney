<?php 
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


$create_message = $bdd->prepare('INSERT INTO messages(content, creation_date, edition_date, topics_id, users_id)
VALUES(:content, :creation_date, :edition_date, :topics_id, :users_id)');


$update_message = $bdd->prepare('UPDATE messages 

SET content=:content, edition_date=:edition_date
WHERE id=:id');



$last_message = unserialize(base64_decode($_POST["last_message"])); //retransforme la chaine de caractere en tableau


if ($last_message["user_id"] == $_POST["user_id"] && $last_message["deleted"] == 0) {
    
    $update_message->execute(array(
    'content' => ($last_message["content"])."<br>".($_POST["message_content"]),
    'edition_date' => htmlspecialchars($_POST["date"]),
    'id' => htmlspecialchars($last_message["id"])
    ));
}

else{

    if (isset($_POST["message_content"],$_POST["date"],$_POST["topic_id"],$_POST["user_id"])) {
        $create_message->execute(array(
        'content' => htmlspecialchars($_POST["message_content"]),
        'creation_date' => htmlspecialchars($_POST["date"]),
        'edition_date' => null,
        'topics_id' => htmlspecialchars($_POST["topic_id"]),
        'users_id' => htmlspecialchars($_POST["user_id"])
        ));
    }
}






header("location:messages.php?topic_id=".$_POST['topic_id']."&topic_title=".$_POST['topic_title']);




?>