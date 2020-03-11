<?php 
session_start(); 
include('./includes/update.php');
include('./includes/delete.php');
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

  <?php 
include "includes/topmenu.php";
?>
  <div class="wrapper">

    <?php include "includes/sidebar.php";?>

</div>

<body>

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
$req_users = $bdd->prepare('SELECT * FROM users WHERE id =?');
$req_users->execute(array($_SESSION["id"]));

$req_modif = $bdd->prepare('SELECT * FROM users WHERE id =?');
$req_modif->execute(array($_SESSION["id"]));


$req_info = $bdd->prepare('SELECT * FROM users WHERE id =?');
$req_info->execute(array($_SESSION["id"]));


?>

<div class="container bootstrap adapte-sg">
        <div class="row">
        
            <div class="col-sm-10 name-sg">
            <?php while($users_info = $req_info->fetch()): ?>
                <h1><?php  echo $users_info['nickname'];?></h1>
                <?php endwhile ?>
            </div>
           
            <div class="col-sm-2"><a href="" class="pull-right"><img></a></div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <!--left col-->


                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
                        alt="avatar">
                </div>
                </hr><br>

               
                <ul class="list-group puce-sg">
                <?php while($users = $req_users->fetch()): ?>
                    <li class="border border-dark rounded list-sg ">Information profil</li>
                    <li class="border border-dark rounded align-sg text-sg"><span class="pull-left"><strong>Pseudo : </strong></span><?php  echo $users['nickname'];?></li>
                    <li class="border border-dark rounded align-sg text-sg"><span class="pull-left"><strong>Signature : </strong></span><?php echo $users['signature'];?></li>
                    <li class="border border-dark rounded align-sg text-sg"><span class="pull-left"><strong>Adress mail : </strong></span><?php  echo $users['email'];?></li>
                    <?php endwhile ?>
                    </ul>
   
            </div>
            <!--/col-3-->
            <div class="col-sm-9">
            <?php  while($users_modif = $req_modif->fetch()): ?>
                <ul class="nav nav-tabs">
                
                    <button  class="btn btn-success ml-1" type="submit" id="modif"><a href="?table=users&action=update&id=<?php echo $users_modif["id"];?>">Modify</a></button>
                    <button  class="btn btn-danger ml-3" type="submit" id="delete" name="delete"><a href="?table=users&action=delete&id=<?php echo $users_modif["id"];?>">delete</a></button>
                         
                </ul>
                <?php endwhile ?>

               
               
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                     
                        <form class="form hiddenjs" action="" method="post" id="registrationForm">
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="nickname">
                                        <h4>Pseudo</h4>
                                    </label>
                                    <input type="text" class="form-control" name="nickname" id="nickname"
                                        placeholder="" title="enter your first name if any.">
                                </div>
                            </div>
                            <div class="form-group">
                            
                                <div class="col-xs-6">
                                    <label for="signature">
                                        <h4>Signature</h4>
                                    </label>
                                    <input type="text" class="form-control" name="signature" id="signature"
                                        placeholder="" title="enter your last name if any.">
                                </div>
                            
                           
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password">
                                        <h4>Password</h4>
                                    </label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="" title="enter your password.">
                                </div>
                            </div>
                            <div class="form-group">

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit" >Validez</button>                                  
                                </div>
                                
                            </div>
                        </form>
                        </div>

                        <hr>

                    </div>


                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>

        <!--/col-9-->
    </div>

<script src="/js/jquery.min.js"></script>
  <script src="/js/jquery.min.js"></script>
 <!-- il ne faut pas mettre src/ puisque localhost est src (racine de notre site)-->
</body>

</html>