<?php
session_start();
//Data base connexion with PDO
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
// REQUEST for writing message
if (isset($_POST["message_content"],$_POST["date"],$_POST["topic_id"],$_POST["user_id"])) {
$create_message = $bdd->prepare('INSERT INTO messages(content, creation_date, topics_id, users_id)
VALUES(:content, :creation_date, :topics_id, :users_id)');
$create_message->execute(array(
'content' => $_POST["message_content"],
'creation_date' => $_POST["date"],
'topics_id' => $_POST["topic_id"],
'users_id' => $_POST["user_id"]
));
}
//PREPARE REQUEST TO SHOW MESSAGES
    $req_messages = $bdd->prepare('SELECT * FROM messages WHERE topics_id =? ORDER BY creation_date ASC');
    $req_messages->execute(array($_GET["topic_id"]));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <title>Document</title>
</head>

<body>
    <?php include "includes/topmenu.php";?>
    <div class="wrapper">
        <?php include "includes/sidebar.php";?>
        <div class="content">
            <div class="card mb-2 mt-2">
                <div class="card-header">
                    <h2><?php echo $_GET["topic_title"] ?></h2>
                </div>
                <div class="card-body">
                    <?php while ($messages = $req_messages->fetch()) : ?>
                    <div class="card m-3">
                        <div class="card-body bg-light-gray">
                            <?php echo$messages["content"]."<br>"; ?>
                            <?php // echo$messages["signature"]."<br>"; ?>
                        </div>
                    </div>
                    <?php endwhile ?>

                    <div class="card m-3">
                        <form
                            action="messages.php?topic_id=<?php echo$_GET["topic_id"]."&topic_title=".$_GET["topic_title"] ?>"
                            method="post">
                            <textarea name="message_content" class="write-message p-2"
                                placeholder="Type your message here..."></textarea>
                            <div class="card-footer d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <input type="hidden" name="date" value="<?php echo$now = date('Y-m-d H:i:s'); ?>" />
                            <input type="hidden" name="user_id" value="1" /> <!-- change to make dynamic -->
                            <input type="hidden" name="topic_id" value="<?php echo $_GET["topic_id"] ?>" />
                            <!-- get the $_GET[topic_id] and pass it to add message adlgorithm with POST -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>