<?php


 function delete_message($bdd, $message_id){

 $req_delete = $bdd->prepare(
 'UPDATE messages
 SET deleted = 1
 WHERE id =? '
 );

 $req_delete->execute(array($message_id));
 }


if($_POST['action'] == 'delete_message') {

    delete_message();


};

?>