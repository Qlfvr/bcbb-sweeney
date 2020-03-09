<?php
//     $texte = $_POST["message_content"];
    function smileys($texte){
    $in=array(
            ":'(",
            ":(",
            ":)",
            ":D",
            ":p",
            );

    $out=array(
            '<img src="../assets/img/emoticons/png/crying.png" alt=":\'(" />',
            '<img src="../assets/img/emoticons/png/sad.png" alt=":(" />',
            '<img src="../assets/img/emoticons/png/happy.png" alt=":)" />',
            '<img src="../assets/img/emoticons/png/happy-4.png" alt=":D" />',
            '<img src="../assets/img/emoticons/png/tongue-out-1.png" alt=":p" />',
            );

            return str_replace($in,$out,$texte);
    }

    echo smileys($texte);
?>