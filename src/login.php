<?php
session_start();

// // Connection à la base de donnée
   try {
    $bdd = new PDO('mysql:host=g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=qzd0dusw8ob73fdo;charset=utf8','hpya3i8f0c3nymfm','xvxw1nfar44r7iin');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
//------------------------------------------------------------------------//
$nickname = htmlspecialchars($_POST['nickname']);
$password = htmlspecialchars($_POST['password']);

$request_user_and_password = $bdd->prepare('SELECT id, password FROM users WHERE nickname = :nickname');
if(isset($_POST['submit_sign_in'])){
    $request_user_and_password->execute(array(
        'nickname' => $nickname));
    $resultat = $request_user_and_password->fetch();
    
    if(!$resultat) {
        // echo 'Wrong nickname ! :(';
        header("Location: index.php");
    } else {
        //Comparaison password du form avec password du bdd
        $password_correct = password_verify($password, $resultat['password']);
        if($password_correct){
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['nickname'] = $nickname;
            header("Location: index.php"); // Une fois tout ok, redirige vers index.php
            die(); //stop
        } else {
            // echo 'Wrong password ! :(';
            header("Location: index.php");
        }
    }

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <title>Sign in or sign up</title>
</head>

<body>
    <?php include "includes/topmenu.php";?>
    <div class="wrapper">
        <?php include "includes/sidebar.php";?>
        <div class="content">
            <div class="warning">
                <?php 
                        $reqmail = $bdd->prepare('SELECT id FROM users WHERE email=?');
                        if(isset($_POST['submit_sign_up'])){
                            $reqmail->execute(array($_POST['email']));
                            $donnees = $reqmail->fetch();
                            if($donnees['id'] == 0){
                            
                                echo'Mail is valid !';
                                echo '<div class="box-sg">';
                                echo '<form method="post" action="login.php">';
                                echo '<div class="form-group">';
                                echo '<label for="exampleInputNickname1">Nickname</label>';
                                echo '<input type="text" name="nickname" class="form-control" id="exampleNickname1" placeholder="Nickname" required>';
                                echo '</div>';
                                echo '<div class="form-group">';
                                echo '<label for="exampleInputPassword1">Password</label>';
                                echo '<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>';
                                echo '</div>';
                                echo '<div class="modal-footer">';
                                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
                                echo '<button type="submit" name="submit_sign_in" id="submit_sign_in" class="btn btn-primary">Sign in</button>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                                
                            } else{
                                echo '<h1>mail not valid, change email !</h1>';
                                echo '<form method="post" action="login.php">';
                                echo '<div class="form-group">';
                                echo '<label for="exampleInputNickname1">Nickname</label>';
                                echo '<input type="text" name="nickname" class="form-control" id="exampleNickname1" placeholder="Nickname" required>';
                                        echo '</div>';
                                        echo '<div class="form-group">';
                                        echo '<label for="exampleInputEmail1">Email address</label>';
                                        echo '<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" required>';
                                        echo '</div>';
                                        echo '<div class="form-group">';
                                        echo '<label for="exampleInputPassword1">Password</label>';
                                        echo '<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>';
                                        echo '</div>';
                                        echo '<div class="modal-footer">';
                                        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
                                        echo '<button type="submit" name="submit_sign_up" id="submit_sign_up" class="btn btn-primary">Sign up </button>';
                                        echo '</div>';
                                        echo '</form>';
                                    
                            }  
                        }

                        $new_user = $bdd->prepare('INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)');
                        if(isset($_POST['submit_sign_up'])){ // Si il y a envoie du formulaire valide, execute l'ajout des champs dans la BDD
                            $new_user->execute(array(
                                'nickname' => htmlspecialchars($_POST['nickname']),
                                'email' => htmlspecialchars($_POST['email']),
                                'password' => htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT))
                            ));
                        }
                    ?>
            </div>
            <!-- <div class="box-sg">
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="exampleInputNickname1">Nickname</label>
                            <input type="text" name="nickname" class="form-control" id="exampleNickname1" placeholder="Nickname" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit_sign_in" id="submit_sign_in" class="btn btn-primary">Sign in</button>
                        </div> 
                    </form>-->
        </div>
    </div>
    </div>
</body>

</html>