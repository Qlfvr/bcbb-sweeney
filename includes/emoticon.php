<?php
$texte = $messages["content"];

    function smileys($texte){
    $in=array(
            ":'(",
            ":(",
            ":)",
            ":D",
            ":p",
            ":s",
            ":o",
            ":O",
            ";)"
            );

    $out=array(
            '<img src="../assets/img/emoticons/png/crying.png" alt=":\'(" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/sad.png" alt=":(" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/happy.png" alt=":)" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/happy-4.png" alt=":D" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/tongue-out-1.png" alt=":p" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/confused-1.png" alt=":s" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/surprised.png" alt=":o" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/surprised-1.png" alt=":O" class="resize-emoticon" />',
            '<img src="../assets/img/emoticons/png/wink.png" alt=";)" class="resize-emoticon" />'
            );

            return str_replace($in,$out,$texte);
    }

?>