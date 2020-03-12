<?php
session_start();
 include "includes/functions.php";

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
// // REQUEST for writing message
// if (isset($_POST["message_content"],$_POST["date"],$_POST["topic_id"],$_POST["user_id"])) {
// $create_message = $bdd->prepare('INSERT INTO messages(content, creation_date, topics_id, users_id)
// VALUES(:content, :creation_date, :topics_id, :users_id)');
// $create_message->execute(array(
// 'content' => $_POST["message_content"],
// 'creation_date' => $_POST["date"],
// 'topics_id' => $_POST["topic_id"],
// 'users_id' => $_POST["user_id"]
// ));
// }
//PREPARE REQUEST TO SHOW MESSAGES
// $req_messages = $bdd->prepare('SELECT * FROM messages WHERE topics_id =? ORDER BY creation_date ASC');
$req_messages = $bdd->prepare(
'SELECT messages.*, users.nickname AS nickname, users.email AS email from messages INNER JOIN users ON
messages.users_id = users.id WHERE topics_id =? ORDER BY creation_date ASC'

);
$req_messages->execute(array($_GET["topic_id"]));



//Recuperer le titre du topic et son contenu
$req_topics = $bdd->prepare('SELECT topics.*, users.nickname AS nickname, users.email AS email FROM
topics INNER JOIN users ON topics.users_id = users.id WHERE topics.id =?');

$req_topics->execute(array($_GET["topic_id"]));


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

    <!-- <script>
        function delete_message_ajax($bdd, $message_id) {

            $.ajax({
                url: 'ajax.php', // La ressource ciblée
                type: 'POST', // Le type de la requête HTTP.
                data: {
                    action: 'delete_message',
                    message_id: $message_id,
                    bdd: $bdd

                },
                success: function (code_html, statut) { // code_html contient le HTML renvoyé
                }

            });

        };
    </script> -->

    <?php include "includes/topmenu.php";?>
    <div class="wrapper">
        <?php include "includes/sidebar.php";?>
        <div class="content">

            <?php while ($topics = $req_topics->fetch()) : ?>

            <div class="card card-message">
                <div class="card-header">
                    <h2>Topic : <?php echo $_GET["topic_title"]; ?></h2>

                </div>
                <div class="card-body p-2 card-message-body d-flex">
                    <div class="pr-2 text-center border-right">
                        <img class="profile-pic m-auto" src="<?php echo get_gravatar($topics["email"])?>" alt=""> <br>
                        <span class="text-muted"><?php echo $topics["nickname"]?></span>
                    </div>
                    <div class="pl-3 pr-3">
                        <?php
                    echo $topics["content"];?>


                    </div>
                </div>
                <div class="card-footer card-message-footer">
                    <i class="fas fa-edit text-primary"></i>&nbsp;
                    <i class="fas fa-trash-alt text-danger"></i>
                    <div class="float-right text-muted">
                        <?php echo$topics["creation_date"] ?>
                    </div>
                </div>
            </div>
            <?php  endwhile;?>



            <!-- LES messages -->


            <div class="card mb-2 mt-2">
                <div class="card-header">
                    <h3>Answers :</h3>

                </div>
                <div class="card-body">

                    <!-- Show messages -->
                    <?php while ($messages = $req_messages->fetch()) : ?>
                    <div class="card card-message">
                        <div class="card-body p-2 card-message-body bg-light-gray d-flex">
                            <div class="pr-2 text-center border-right">
                                <img class="profile-pic m-auto" src="<?php echo get_gravatar($messages["email"])?>"
                                    alt=""> <br>
                                <span class="text-muted"><?php echo $messages["nickname"]?></span>
                            </div>
                            <div class="pl-3 pr-3">



                                <?php 

                                if ($messages["deleted"] == 0) {
                                    echo$messages["content"]."<br>"; 
                                }

                                else {
                                    echo '<i class="text-muted">This message has been deleted</i>';
                                }
                                ?>

                            </div>
                        </div>
                        <div class="card-footer card-message-footer">
                            <i id="deleter" class="fas fa-edit text-primary"></i>&nbsp;
                            <!-- <a href="" onclick="delete_message_ajax()"><i class="fas fa-trash-alt text-danger"></i></a> -->
                            <a href="?action=delete&message_id=<?php echo $messages["id"]?>"><i
                                    class="fas fa-trash-alt text-danger"></i></a>

                            <div class="float-right text-muted">
                                <?php echo$messages["creation_date"] ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile ; ?>
                    <!-- Show messages -->

                    <?php write_message($_GET["topic_id"], $_GET["topic_title"], $_SESSION["id"] );?>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>


</body>

</html>