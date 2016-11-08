<?php
    
    include("../others/session.php");
    include("../others/proc_data.php");

    session_begin();
    $user = session_resume();
    if(empty($user))
    {
            $base = "http://localhost:13138" ;
            header("Location: $base");
    }
    
    $co = connect();
    select_db();

    $teamid = fetch1(teamid, user_detail, username, $user);
    
    $res = seteval($teamid);
    echo $res;
    if($res){
        $basea = "http://localhost:13138/pages/student_front.php";
        header("Location: $basea");
    }
    else{echo '<script type="text/javascript">alert("Registeration Error Please try again");</script>';}
?>
