<?php

// create topic into database

if (isset($_POST["content"],$_POST["create_date"],$_POST["topic_id"],$_POST["user_id"])) {
$create_message = $bdd->prepare('INSERT INTO messages(content, creation_date, topics_id, users_id)
VALUES(:title, :creation_date, :boards_id, :users_id)');
$create_message->execute(array(
'content' => $_POST["topic_title"],
'creation_date' => $_POST["date"],
'topics_id' => $_POST["board_id"],
'users_id' => $_POST["user_id"]
));
}
?>



<form id="topicForm" class="mb-2" action="index.php" method="post">
    <div class="form-group">
        <label for="messageContent">Message</label>
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