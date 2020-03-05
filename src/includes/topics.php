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

if (isset($_POST["topic_title"],$_POST["date"],$_POST["board_id"],$_POST["user_id"])) {
    $topic = $bdd->prepare('INSERT INTO topics(title, creation_date, boards_id, users_id)
    VALUES(:title, :creation_date, :boards_id, :users_id)');
    $topic->execute(array(
        'title' => $_POST["topic_title"],
        'creation_date' => $_POST["date"],
        'boards_id' => $_POST["board_id"],
        'users_id' => $_POST["user_id"]
    ));
}
?>
<form class="mb-2" action="index.php" method="post">
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





<div class="card">
    <div class="card-body">
        <h2 class="card-title">
            Titre du topic
        </h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore iste soluta perferendis aspernatur totam
            cupiditate
            exercitationem sequi dolorum dolores officia, vel minus corrupti vero sed ipsum est autem ad eius.</p>
    </div>
    <div class="card-footer">test</div>
</div>