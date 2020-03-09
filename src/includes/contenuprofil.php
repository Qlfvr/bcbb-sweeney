<?php
 session_start(); 
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
                    <li class="border border-dark rounded align-sg text-sg scroll"><span class="pull-left"><strong>code : </strong></span><?php  echo $users['password'];?></li>
                    <?php endwhile ?>
                </ul>
                
            </div>
            <!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Modify</a></li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="##" method="post" id="registrationForm">
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h4>Pseudo</h4>
                                    </label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="" title="enter your first name if any.">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h4>Signature</h4>
                                    </label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="" title="enter your last name if any.">
                                </div>
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

                                <div class="col-xs-6">
                                    <label for="password2">
                                        <h4>Verify</h4>
                                    </label>
                                    <input type="password" class="form-control" name="password2" id="password2"
                                        placeholder="" title="enter your password2.">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit">Modifier</button>
                                  
                                </div>
                            </div>
                        </form>

                        <hr>

                    </div>


                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>

        <!--/col-9-->
    </div>