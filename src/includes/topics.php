<?php

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


// create topic into database

if (isset($_POST["topic_title"],$_POST["date"],$_POST["board_id"],$_POST["user_id"])) {
    $create_topic = $bdd->prepare('INSERT INTO topics(title, creation_date, boards_id, users_id)
    VALUES(:title, :creation_date, :boards_id, :users_id)');
    $create_topic->execute(array(
        'title' => $_POST["topic_title"],
        'creation_date' => $_POST["date"],
        'boards_id' => $_POST["board_id"],
        'users_id' => $_POST["user_id"]
    ));
}
?>

<div class="d-flex flex-row-reverse">
    <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#topicForm" aria-expanded="false"
        aria-controls="topicForm">New Topic</button>
</div>

<form id="topicForm" class="mb-2 collapse" action="index.php" method="post">
    <div class="form-group">
        <label for="topicTitle">Topic Title</label>
        <input type="text" class="form-control" id="topicTitle" name="topic_title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="boardId">Choose a board</label><br>
        <select name="board_id" id="boardId">
            <!-- Change to make dynamic-->
            <option value="1">General</option>
            <option value="2">Development</option>
            <option value="3">Smalltalk</option>
            <option value="4">Events</option>
        </select>
    </div>
    <input type="hidden" name="date" value="<?php echo$now = date('Y-m-d H:i:s'); ?>" />
    <input type="hidden" name="user_id" value="1" /> <!-- Change to make dynamic-->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<!-- SHOW TOPICS -->

<?php
$req_topics = $bdd->prepare('SELECT * from topics WHERE boards_id =? ORDER BY creation_date DESC');
    $req_topics->execute(array($_GET["board_id"]));

    // $donnees = $req_topics->fetch();
    // print_r($donnees = $req_topics->fetch());
?>

<?php while ($donnees = $req_topics->fetch()) : ?>

<div class="card mb-2 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-10 p-3">
                <h3 class="card-title">
                    <a class="stretched-link text-decoration-none"
                        href="messages.php?<?php echo "topic_id=".$donnees["id"]."&topic_title=".$donnees["title"]?>">
                        <?php echo $donnees["title"]; ?>
                    </a>
                </h3>
                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore iste soluta
                    perferendis
                    aspernatur
                    totam
                    cupiditate.
                </p>
            </div>

            <div class="col-2 border-left p-3 d-flex justify-content-center">
                <i class="fas fa-comment-alt fa-4x text-primary"></i>
            </div>
        </div>
    </div>
    <!-- <div class="card-footer d-flex flex-row-reverse">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#QuickAnsModal">
            Quick Answer </button>

        <?php //echo $donnees["id"]?>

    </div> -->
</div>





<?php endwhile; ?>