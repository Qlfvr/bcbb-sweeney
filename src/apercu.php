<?php
    
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
