<?php 
session_start(); 

try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Update autre

    // $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_STRING);
    // $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    // $signature = filter_input(INPUT_POST, "signature", FILTER_SANITIZE_STRING);
    
    if (isset($_POST["nickname"],$_POST["signature"],$_POST["id"])) {
  $insert = $bdd->prepare("UPDATE `users` SET `nickname` = :nickname , `signature` =
  :signature WHERE `id` = :id");

  $insert->execute(['nickname' => $_POST['nickname'], 'signature' => $_POST['signature'], 'id' => $_POST['id']]);
    ?>
<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
    Your profile has been updated !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php }
      



// Modification du mots de passe



    if (isset($_POST["password"], $_POST["confirm-password"])){


       if ($_POST["password"]!="") {

        if ($_POST["password"] == $_POST["confirm-password"]) {



if (isset($_POST["password"],$_POST["id"])) {
$insert = $bdd->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");

$insert->execute(['password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT)), 'id' =>
$_POST['id']]);
}

            
            echo "parfait";?>

<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
    Your profile has been updated !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>





<?php
        } else { ?>

<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
    Your password doesn't match ! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php  }

        
       }
       else { ?>
<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
    You can't use an empty password ! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php }




    }




?>