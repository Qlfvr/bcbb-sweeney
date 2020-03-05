<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page de test</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="/css/bootstrap.css" /> -->
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>

    <?php 
include "includes/topmenu.php";
?>


    <div class="container-fluid bg-secondary">

        <div class="row">

            <div class="col-md-4 col-xs-12">

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui fugit totam perspiciatis. Sapiente,
                    ullam reprehenderit! Totam, asperiores error? Corporis repudiandae ut eos quia distinctio placeat
                    hic impedit nemo dicta error?
                    Quas ipsam ea quasi ratione distinctio laudantium ullam earum magnam deleniti error eum nam est,
                    adipisci temporibus officia! Expedita distinctio est deserunt optio, nemo necessitatibus tempore
                    consectetur quis quaerat corporis.
                    Aliquid asperiores corrupti et laborum magni quas nostrum dolorum dolores voluptatibus, tenetur
                    fugit officia explicabo quos aut distinctio quod fuga nulla dolorem ea vitae ipsum nobis? Facere
                    animi dignissimos inventore.
                    Qui dolorem quas ipsum magni consequatur magnam laborum natus, illum nam distinctio blanditiis
                    accusamus officia iste, earum quasi consequuntur facilis doloremque voluptatum vel ut dicta hic?
                    Facere atque esse tempore.
                    Porro, accusamus amet eius non cupiditate odio, sequi voluptates deserunt commodi cumque
                    reprehenderit dolor eaque. Quidem facere voluptate non nesciunt quis, beatae sed, delectus corporis
                    necessitatibus facilis perferendis quaerat incidunt.
                    Iusto dignissimos libero praesentium hic molestiae doloribus saepe, soluta, dolores esse omnis odio.
                    Et consequuntur eveniet nesciunt, neque dicta illum. Ducimus, officia. Est sequi molestiae nemo hic
                    sunt, rem magnam.</p>

            </div>

            <div class="col">


                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, cum officiis voluptatum
                    eveniet quo atque maxime quia labore quam. Quae aliquam asperiores culpa laudantium et repudiandae
                    officiis aperiam, labore non!
                </p>
            </div>

        </div>

    </div>


</body>

</html>





<?php
// try
// {
// // On se connecte à MySQL
// $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
// }
// catch(Exception $e)
// {
// // En cas d'erreur, on affiche un message et on arrête tout
// die('Erreur : '.$e->getMessage());
// }


// $nickname ="Quentin";
// $email="lefevre.quentin@gmail.com";
// $password="12345";
// $signature="Bisous tout le monde !";



// $req = $bdd->prepare('INSERT INTO users(nickname, email, password, signature)
// VALUES(:nickname, :email, :password, :signature)');
// $req->execute(array(

// 'nickname' => $nickname,
// 'email' => $email,
// 'password' => $password,
// 'signature' => $signature
// ));

// echo 'Le jeu a bien été ajouté !';

// echo$now = date('Y-m-d H:i:s');





// user creation
// $users = $bdd->prepare('INSERT INTO users(nickname, email, password, signature)
// VALUES(:nickname, :email, :password, :signature)');
// $req->execute(array(
// 'nickname' => $nickname,
// 'email' => $email,
// 'password' => $password,
// 'signature' => $signature
// ));


?>



<!-- Modal Quick Answer-->
<div class="modal fade" id="QuickAnsModal" tabindex="-1" role="dialog" aria-labelledby="QuickAnsModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="QuickAnsModalTitle">Quick Answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php var_dump($donnees["id"])?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Publish</button>
            </div>
        </div>
    </div>
</div>