<?php
    //echo "Hello from sessions";

    function session_begin(){
            session_start();
    }

    function session_set($value){
        $_SESSION['userid'] = $value;
    }

    function session_resume(){
        return $_SESSION["userid"];
    }

    function session_close(){
            session_unset(); 
            $unset = session_destroy();

            if($unset)
                return 1;
            else
                return 0;
    }
?>
