<html>
   <head>
      <title>Stock d'images</title>
   </head>
   <body>
      <?php
         include"connexion.php";
         $req = "SELECT img_nom, img_id " .
                "FROM images ORDER BY img_nom";
         $ret = mysqli_query($conn,$req) or die(mysqi_error ($conn));
         while($col = mysqli_fetch_row($ret))
         {
             echo "<a href=\"apercu.php?id=" . $col[1] . "\">" . $col[0] . "</a><br />";
         }
      ?>
   </body>
</html>
