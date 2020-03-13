<?php
session_start(); 
include "includes/functions.php";
include "includes/testconnect.php";


try{
  // On se connecte à MySQL
  $bdd = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
  // En cas d'erreur, on affiche un message et on arrête tout
  die('Erreur : '.$e->getMessage());
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a990d1fe00.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css" />
  <title>Sweeney</title>
</head>

<body>

  <?php include "includes/topmenu.php";?>

  <div class="wrapper">
    <?php include "includes/sidebar.php";?>
    <div class="content">

      <?php 
      $req_board_details = $bdd->prepare('SELECT * from boards WHERE id =?');
      $req_board_details->execute(array($_GET["board_id"]));
      if(empty($_GET)): ?>
      
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-3">
            <div class="card">
              <div class="card-body">
              
                <h2>
                <?php 
                while($boards = $req_board_details->fetch()):
                   echo $boards["name"]; 
                endwhile?>
                    
                    </h2>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <?php endif ?>



      <?php include "includes/topics.php";?>



    </div>
  </div>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</body>

</html>