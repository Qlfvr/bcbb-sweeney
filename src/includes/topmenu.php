<?php


// Connection à la base de donnée
// try {
//     $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8mb4', 'root', 'root');

//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (Exception $e) {
//     die('Error : ' . $e->getMessage());
// }
// $reqmail = $bdd->prepare("SELECT * FROM users WHERE email =s?");
// $reqmail->execute(array($email));

                        ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="/" class="navbar-brand">Sweeney</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">

        <?php

    if (empty($_SESSION)): ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!-- <a class="nav-link btn btn-outline-secondary" href="#">Sign Up</a> -->
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                    data-target="#exampleModalCenter2">
                    Sign up
                </button>
            </li>

            &nbsp;

            <li class="nav-item">
                <!-- <a class="nav-link btn btn-primary text-white" href="#">Sign In</a> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Sign In
                </button>
            </li>
        </ul>
        <?php
        else : ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="#" class="nav-link"><?php echo $_SESSION["nickname"]; ?></a> <!-- replace # by profil link -->
            </li>
            <li class="nav-item">
                <a href="signout.php" class="nav-link">Sign Out</a> <!-- replace # by profil link -->
            </li>
        </ul>
        <?php endif;?>

        <!-- Modal Sign in -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Do you want to sign in ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Sign in -->
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="exampleInputNickname1">Nickname</label>
                                <input type="text" name="nickname" class="form-control" id="exampleNickname1"
                                    placeholder="Nickname" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit_sign_in" id="submit_sign_in" class="btn btn-primary">Sign
                            in</button>
                    </div>
                    </form> <!-- Fin du form pour que le bouton du modal fonctionne -->
                </div>
            </div>
        </div>

        <!-- Modal Sign up -->
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle2">Do you want to sign up ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Sign up -->
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="exampleInputNickname1">Nickname</label>
                                <input type="text" name="nickname" class="form-control" id="exampleNickname1"
                                    placeholder="Nickname" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="E-mail" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password" required>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit_sign_up" id="submit_sign_up" class="btn btn-primary">Sign up
                        </button>

                    </div>
                    </form> <!-- Fin du form pour que le bouton du modal fonctionne -->
                </div>
            </div>
        </div>




    </div>
</nav>