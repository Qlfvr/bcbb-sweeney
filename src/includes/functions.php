<?php


// function hello_world(){

//     echo "hello world!";
// }



function get_gravatar( $email, $s = 150, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
$url = 'https://www.gravatar.com/avatar/';
$url .= md5( strtolower( trim( $email ) ) );
$url .= "?s=$s&d=$d&r=$r";
if ( $img ) {
$url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
}
return $url;
}


function write_message($topic_id, $topic_title, $user_id){
// prepare the request 
?>

<div class="card mt-3 mb-3">

    <div class="card-body">
        <form action="addmessage.php" method="post">
            <textarea name="message_content" class="write-message p-2"
                placeholder="Type your message here..."></textarea>
    </div>
    <div class="card-footer d-flex flex-row-reverse">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <input type="hidden" name="date" value="<?php echo$now = date('Y-m-d H:i:s'); ?>" />
    <input type="hidden" name="user_id" value="<?php echo $user_id?>" />
    <input type="hidden" name="topic_id" value="<?php echo $topic_id ?>" />
    <input type="hidden" name="topic_title" value="<?php echo $topic_title ?>" />
    </form>
</div>
<?php
}


// function delete_message($bdd, $message_id){

//     $req_delete = $bdd->prepare(
//     'UPDATE messages 
//     SET deleted = 1    
//     WHERE id =? '
//     );

// $req_delete->execute(array($message_id));
// }




function get_pass_form(){

echo "<p>You need a password to access this content</p>"; ?>

<form action="<?php $_SERVER['REQUEST_URI']?>" method="get">

    <div class="form-group">
        <label for="boardPass">Password :</label>
        <input type="text" class="form-control" id="boardPass" name="pass" required>
    </div>
    <input type="hidden" name="board_id" value="<?php echo $_GET["board_id"]; ?>">
    <input type="hidden" name="topic_id" value="<?php echo $_GET["topic_id"]; ?>">

    <button type="submit" class="btn btn-primary">Unlock</button>
</form>

<?php } 




function connexion_form(){

 echo '<div class="box-sg">';
     echo '<form method="post" action="login.php">';
         echo '<div class="form-group">';
             echo '<label for="exampleInputNickname1">Nickname</label>';
             echo '<input type="text" name="nickname" class="form-control" id="exampleNickname1" placeholder="Nickname"
                 required>';
             echo '</div>';
         echo '<div class="form-group">';
             echo '<label for="exampleInputPassword1">Password</label>';
             echo '<input type="password" name="password" class="form-control" id="exampleInputPassword1"
                 placeholder="Password" required>';
             echo '</div>';
         echo '<div class="modal-footer">';
             echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
             echo '<button type="submit" name="submit_sign_in" id="submit_sign_in" class="btn btn-primary">Sign
                 in</button>';
             echo '</div>';
         echo '</form>';
     echo '</div>';

}


function smileys($texte){
$in=array(
":'(",
":(",
":)",
":D",
":p",
":s",
":o",
":O",
";)"
);

$out=array(
'<img src="../assets/img/emoticons/png/crying.png" alt=":\'(" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/sad.png" alt=":(" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/happy.png" alt=":)" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/happy-4.png" alt=":D" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/tongue-out-1.png" alt=":p" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/confused-1.png" alt=":s" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/surprised.png" alt=":o" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/surprised-1.png" alt=":O" class="resize-emoticon" />',
'<img src="../assets/img/emoticons/png/wink.png" alt=";)" class="resize-emoticon" />'
);

return str_replace($in,$out,$texte);
}





?>