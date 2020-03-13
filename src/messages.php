<?php
session_start();
 include "includes/functions.php";

//Data base connexion with PDO
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
$req_messages = $bdd->prepare(
'SELECT messages.*, users.id AS users_id, users.nickname AS nickname, users.email AS email from messages INNER JOIN users ON
messages.users_id = users.id WHERE topics_id =? ORDER BY creation_date ASC');
$req_messages->execute(array($_GET["topic_id"]));

//Recuperer le titre du topic et son contenu
$req_topics = $bdd->prepare('SELECT topics.*, users.nickname AS nickname, users.email AS email FROM
topics INNER JOIN users ON topics.users_id = users.id WHERE topics.id =?');
$req_topics->execute(array($_GET["topic_id"]));

// Emoticons
include("includes/emoticon.php");

// Markdown
include("includes/Parsedown.php");
$parsedown = new Parsedown();

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



            <!-- Affichage du topic -->
            <?php while ($topics = $req_topics->fetch()) : ?>
            <div class="card card-message">
                <div class="card-header">
                    <h2>Topic : <?php echo $topics["title"]; ?></h2>
                    <hr>
                    <span class=" date text-muted"><?php echo$topics["creation_date"] ?></span>

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
            </div>
            <?php  endwhile;?>
            <!-- / Affichage du topic -->

            <!-- Affichage des messages -->
            <div class="card mb-2 mt-2">
                <div class="card-header">
                    <h3>Answers :</h3>
                </div>
                <div class="card-body">
                    <!-- Show messages -->
                    <?php while ($messages = $req_messages->fetch()) : ?>
                    <div class="card card-message mt-2">
                        <div class="card-body p-2 card-message-body bg-light-gray d-flex">
                            <div class="pr-2 text-center border-right">
                                <img class="profile-pic m-auto" src="<?php echo get_gravatar($messages["email"])?>"
                                    alt=""> <br>
                                <span class="text-muted"><?php echo $messages["nickname"]?></span>
                            </div>
                            <div class="pl-3 pr-3">
                                <?php 
                                if ($messages["deleted"] == 0) {

                                    //Affichage smileys
                                    $content = smileys($messages["content"]);
                                    // echo $content;

                                    //Affichage markdown
                                    echo $parsedown->text($content);



                                }
                                else {
                                    echo '<i class="text-muted">This message has been deleted</i>';
                                }
                                ?>
                            </div>
                        </div>


                        <div class="card-footer card-message-footer d-flex justify-content-between">
                            <div class="text-muted">
                                <span class="date"> <?php echo$messages["creation_date"] ?></span>
                            </div>
                            <!-- <i id="deleter" class="fas fa-edit text-primary"></i>&nbsp; -->
                            <!-- <a href="" onclick="delete_message_ajax()"><i class="fas fa-trash-alt text-danger"></i></a> -->
                            <!-- <a
                                href="/includes/delete.php?action=delete_message&message_id=<?php // echo $messages["id"];?>&topic_id=<?php //echo $_GET["topic_id"];?>">
                                <i class="fas fa-trash-alt text-danger"></i></a> -->
                            <?php  if ($_SESSION["id"]== $messages["users_id"] && $messages["deleted"] ==0): ?>

                            <form action="/includes/delete.php" method="post">
                                <input type="hidden" name="action" value="delete_message">
                                <input type="hidden" name="user_id" value="<?php echo $messages["users_id"]?>">
                                <input type="hidden" name="message_id" value="<?php echo$messages["id"]?>">
                                <input type="hidden" name="topic_id" value="<?php echo $_GET["topic_id"]?>">
                                <button class="no-style-button" type="submit"><i
                                        class="fas fa-trash-alt text-danger"></i></button>
                            </form>

                            <?php endif ?>




                        </div>
                    </div>
                    <?php endwhile ; ?>
                    <!-- / Show messages -->

                    <?php write_message($_GET["topic_id"], $_GET["topic_title"], $_SESSION["id"] );?>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>


</body>

</html>