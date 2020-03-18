<?php 
session_start(); 
include('./includes/update.php');
include('./includes/delete.php');
include("./includes/functions.php");

try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8mb4', 'root', 'root');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
$req_users = $bdd->prepare('SELECT * FROM users WHERE id =?');
$req_users->execute(array($_SESSION["id"]));


while($users = $req_users->fetch()){

$nickname = $users['nickname'];
$email = $users["email"];
$signature = $users['signature'];
$id = $users['id'];
$email = $users['email'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>

    <?php include "includes/topmenu.php";?>
    <div class="wrapper">
        <?php include "includes/sidebar.php";?>

        <div class="content">

            <?php if(isset($_SESSION["nickname"])):?>



            <div class="container-fluid d-flex">


                <div class="m-3 text-center">
                    <h1><?php  echo $nickname;?></h1>
                    <img src="<?php echo get_gravatar($email)?>" class="avatar" alt="avatar">
                </div>

                <!--/col-3-->

                <div class="m-3 mt-5 w-100">

                    <form class="form" action="" method="post" id="registrationForm">
                        <div class="form-group">
                            <label for="nickname">
                                <h4>Nickname</h4>
                            </label>
                            <input type="text" class="form-control" name="nickname" id="nickname"
                                value="<?php echo $nickname?>">
                        </div>

                        <div class="form-group">

                            <label for="signature">
                                <h4>Signature</h4>
                            </label>
                            <input type="text" class="form-control" name="signature" id="signature"
                                value="<?php echo $signature?>">

                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="form-group mt-2">
                                <button class="btn btn btn-success" type="submit">Update</button>
                                <button class="btn btn-danger" type="submit" id="delete" name="delete">
                                    <a class="button-link"
                                        href="?table=users&action=deleteusers&id=<?php echo $id;?>">Delete
                                        Profile</a>
                                </button>
                            </div>
                    </form>

                    <hr>
                    <form class="form" action="" method="post" id="registrationForm">
                        <div class="form-group">
                            <label for="password">
                                <h4>New Password</h4>
                                <p>(leave blank to keep current password)</p>
                            </label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="form-group">

                            <label for="signature">
                                <h4>Password confirmation</h4>
                            </label>
                            <input type="password" class="form-control" name="confirm-password" id="confirmPwd">

                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="form-group mt-2">
                                <button class="btn btn btn-success" type="submit">Update</button>

                            </div>
                        </div>
                    </form>



                </div>


            </div>

        </div>


        <?php

        else : 

            connexion_form();
    
    
    endif; ?>


    </div>



    </div>


    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>