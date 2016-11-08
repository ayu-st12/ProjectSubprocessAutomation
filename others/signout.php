<?php
    include("../others/session.php");

    session_begin();

    $res = session_close();
    
    if($res){
         $base = "http://localhost:13138" ;
         header("Location: $base");
    }    
    else{
        echo "SignOut Error";
    }
?>
