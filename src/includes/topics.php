<?php

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

// Emoticons
include("includes/emoticon.php");

// Markdown
include("includes/Parsedown.php");
$parsedown = new Parsedown();

// create topic into database

if (isset($_POST["topic_title"],$_POST["date"],$_POST["board_id"],$_POST["user_id"])) {
    $create_topic = $bdd->prepare('INSERT INTO topics(title, content, creation_date, boards_id, users_id)
    VALUES(:title,:content, :creation_date, :boards_id, :users_id)');
    $create_topic->execute(array(
        'title' => $_POST["topic_title"],
        'content' => $_POST["topic_content"],
        'creation_date' => $_POST["date"],
        'boards_id' => $_POST["board_id"],
        'users_id' => $_POST["user_id"]
    ));
}

// SHOW TOPICS REQUEST 

$req_topics = $bdd->prepare(
'SELECT topics.*, users.nickname AS creator_nickname, users.email AS creator_email from topics INNER JOIN users ON topics.users_id = users.id WHERE boards_id =? ORDER BY creation_date DESC'

);
$req_topics->execute(array($_GET["board_id"]));


// REQUEST LAST MESSAGE FOR EVERY TOPIC

$req_last_message = $bdd->prepare('SELECT * from messages WHERE topics_id =? ORDER BY creation_date DESC LIMIT 1');

// Boards info

$req_board_details = $bdd->prepare('SELECT * from boards WHERE id =?');
$req_board_details->execute(array($_GET["board_id"]));
// *****************************************************************************
?>
<?php while($board = $req_board_details->fetch()): ?>

<h1><?php echo $board["name"]?></h1>
<p><?php echo $board["description"]?></p>

<?php endwhile ?>

<?php if(!empty($_SESSION) && (!empty($_GET))): ?>
<div class="d-flex flex-row">
    <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#topicForm" aria-expanded="false"
        aria-controls="topicForm">New Topic</button>
</div>


<!-- FORMULAIRE DE CREATION DE TOPICS -->


<form id="topicForm" class="mb-2 mt-4 collapse" action="index.php?board_id=<?php echo$_GET["board_id"]?>" method="post">
    <div class="form-group">
        <label for="topicTitle">Topic Title</label>
        <input type="text" class="form-control" id="topicTitle" name="topic_title" required>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <br>
        <label for="topic-content">Your message</label><br>
        <textarea name="topic_content" id="topic-content" required></textarea>


    </div>




    <input type="hidden" name="board_id" value="<?php echo $_GET["board_id"] ?>" />
    <input type="hidden" name="date" value="<?php echo$now = date('Y-m-d H:i:s'); ?>" />
    <input type="hidden" name="user_id" value="<?php echo $_SESSION["id"] ?>" /> <!-- Change to make dynamic-->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php endif; ?>



<?php while ($topics = $req_topics->fetch()) : ?>

<div class="card mb-2 mt-2">
    <div class="container">
        <div class="row">

            <div class="col-2 border-right p-3 text-center">

                <img class="profile-pic m-auto" src="<?php echo get_gravatar($topics["creator_email"])?>" alt="">
                <p class="text-muted"><?php echo $topics["creator_nickname"]?></p>

            </div>

            <div class="col-8 p-3">
                <h3 class="card-title">
                    <a class="stretched-link text-decoration-none"
                        href="messages.php?<?php echo "topic_id=".$topics["id"]."&topic_title=".$topics["title"]?>">
                        <?php echo $topics["title"]; ?>
                    </a>
                </h3>
                <!-- request last message -->
                <?php $req_last_message->execute(array($topics["id"])); 

                if ($last_message = $req_last_message->fetch()): ?>

                <p class="text-muted">

                    <?php 
                            //Affichage smileys
                            $content = smileys($last_message["content"]);
                            // echo $content;

                            //Affichage markdown
                            echo $parsedown->text($content);
                    ?>

                </p>

                <?php  else :

                    echo '<p class="text-muted">'.$topics["content"].'</p>'; //affiche le message initial de topic

                endif;?>



            </div>

            <div class="col-2 border-left p-3 d-flex justify-content-center">
                <i class="fas fa-comment-alt fa-4x text-primary"></i>
            </div>
        </div>
    </div>

</div>





<?php endwhile; ?>