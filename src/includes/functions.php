<?php


function hello_world(){

    echo "hello world!";
}

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
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

<div class="card m-3">
    <form action="addmessage.php" method="post">
        <textarea name="message_content" class="write-message p-2" placeholder="Type your message here..."></textarea>
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
?>