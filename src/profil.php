<?php 
session_start(); 
include('./includes/update.php');
include('./includes/delete.php');
include("./includes/functions.php");
// include("testimg.php");

try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');

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

//-------------------------------------------------------------------------------------
// error_reporting(0);
$host="mysql";
$user="root";
$pass="root";
$bdname="bcbb";

$conn=mysqli_connect($host,$user,$pass,$bdname);

if(!$conn){
    die("Error".mysqli_connect_error());
    }else{
        if(isset($_POST['submit'])){
            $result="";
            $image='assets/image/'.$_FILES['image']['name'];
            $image=mysql_real_escape_string($conn,$image);

            if(preg_match("!image!",$_FILES['image']['type'])){
                if(copy($_FILES['image']['tmp_name'], $image)){
                    $sql="INSERT INTO image(imagepath)VALUES('$image')";
                    if(mysqli_query($conn,$sql)){
                        $result="Image succes!";
                    }else{
                        $result="image faild!";
                    }
                }else{
                    $result="image faild!";
                }
            }else{
                $result="only up JPG, PNG & GIF images!";
        }

    }
}

mysqli_close($conn);

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
                <div class="container-fluid d-flex">
                <div class="m-3 text-center">
                    <h1><?php  echo $nickname;?></h1>
                    <img src="<?php echo get_gravatar($email)?>" class="avatar" alt="avatar">
                    <div class="text-center">
                    <from action="profil.php" method="POST" enctype="multipart/from-data">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" class="inp" required>
                    <input type="submit" name="submit" value="Upload" class='btn-danger'>
                    </from><br>
                    <h2><?= $result ?></h2>
                    <div class="card-img"><img src="<?= $image ?>"></div>
                        <!-- <h6>Upload a different photo...</h6>                        
                         <form enctype="multipart/form-data" action="#" method="post">
                            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                            <input type="file" name="fic" size=50 />
                            <input type="submit" value="Envoyer" />
                        </form>
                        <p><a href="liste.php">Liste</a></p> -->
                    </div>
                </div>
                </hr><br>
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

    </div>






    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/profile.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- il ne faut pas mettre src/ puisque localhost est src (racine de notre site)-->
</body>

</html>




<!-- <div class="form-group">

                                            <div class="col-xs-6">
                                                <label for="password">
                                                    <h4>Password</h4>
                                                </label>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="" title="enter your password.">
                                            </div>
                                        </div> -->