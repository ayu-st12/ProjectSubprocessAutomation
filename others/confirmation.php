<?php
    include("proc_data.php");
    ///include("../DBA_related/dbfunc.php");
    
    $conf = $_GET['passkey'];
    $user = $_GET['passkey1'];
    $tpe = $_GET['type'];
    $ae = $_GET['ae'];
    echo $ae;
    $c = connect();
    select_db();
    $type = check_utype($user);

    if($tpe == 1){
        $pid = $user;

        $teamid = fetch1(teamid, project_team_info, pid, $pid);
        
       if($ae == 'ac'){
         if($conf == 1){
            $query = "delete from project_abstract_info where teamid = '$teamid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/ac_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_abstract_info set acceptance_ac = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_abstract_info set acceptance_phead = 1 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set abstract_status_ac = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set abstract_status_phead = 1 where pid = '$pid'";
            $result = myquery($query);

            if($result){
                $base = "http://localhost:13138/pages/ac_front.php";
                header("Location: $base");
            }
        }   
        }
        if($ae == 'phead'){
         if($conf == 1){
            $query = "delete from project_abstract_info where teamid = '$teamid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/phead_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_abstract_info set acceptance_phead = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set abstract_status_phead = 2 where pid = '$pid'";
            $result = myquery($query);

            if($result){
                $base = "http://localhost:13138/pages/phead_front.php";
                header("Location: $base");
            }
        }   
        }
        if(!$ae){
        if($conf == 1){
            $query = "delete from project_abstract_info where teamid = '$teamid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/faculty_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_abstract_info set acceptance_mentor = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_abstract_info set acceptance_ac = 1 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set abstract_status_mentor = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set abstract_status_ac = 1 where pid = '$pid'";
            $result = myquery($query);

            if($result){
                $base = "http://localhost:13138/pages/faculty_front.php";
                header("Location: $base");
            }
        }
        }
    }


    if($type == 1)
    {
        $key = fetch1(confirm_code, temp_user_detail, username, $user);
        if($key == $conf){
        $r = fetch_stu($user, temp_user_detail);
        $row = mysql_fetch_array($r);

        $query = "insert into user_detail values('$row[0]', $row[1], '$row[2]', '$row[3]', '$row[4]', '$row[5]', $row[6], $row[7], '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]')";
        $result = myquery($query);
        if($result){
            //echo "Data Transferred Successfully";
            $base = "http://localhost:13138/pages/student_front.php";
            header("Location: $base");
        }
    }
    }
    else if($type == 2)
    {
        $key = fetch1(confirm_code, temp_fac_detail, username, $user);
        if($key == $conf){
        $r = fetch_fac($user, temp_fac_detail);
        $row = mysql_fetch_array($r);

        $query = "insert into fac_detail values('$row[0]', $row[1], '$row[2]', '$row[3]', '$row[4]', $row[5], '$row[6]', '$row[7]', '$row[8]')";
        $result = myquery($query);
         if($result){
            //echo "Data Transferred Successfully";
            $base = "http://localhost:13138/pages/student_front.php";
            header("Location: $base");
            }
        }
    }

    if($tpe !=1)
    { if($ae == 'ac'){
        $pid = $user;

        $teamid = fetch1(teamid, project_team_info, pid, $pid);

        if($conf == 1){
            $query = "delete from project_team_info where pid = '$pid'";
            $result = myquery($query);   

            $query = "delete from project_title_info where teamid = '$teamid'";
            $result = myquery($query);

            $query = "delete from project_detail where pid = '$pid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/ac_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_detail set acceptance_ac = 'true' where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set title_status_ac = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set title_status_phead = 1 where pid = '$pid'";
            $result = myquery($query);

            if($result){
                $base = "http://localhost:13138/pages/ac_front.php";
                header("Location: $base");
            }
        }
    }
    else if($ae == 'phead'){
        $pid = $user;

        $teamid = fetch1(teamid, project_team_info, pid, $pid);

        if($conf == 1){
            $query = "delete from project_team_info where pid = '$pid'";
            $result = myquery($query);   

            $query = "delete from project_title_info where teamid = '$teamid'";
            $result = myquery($query);

            $query = "delete from project_detail where pid = '$pid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/phead_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_detail set acceptance_phead = 'true' where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set title_status_phead = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "insert into start_p values('$pid', NULL)";
            $result = myquery($query);
            
            if($result){
                $base = "http://localhost:13138/pages/phead_front.php";
                header("Location: $base");
            }
        }
    }

    else{
        $pid = $user;

        $teamid = fetch1(teamid, project_team_info, pid, $pid);

        if($conf == 1){
            $query = "delete from project_team_info where pid = '$pid'";
            $result = myquery($query);   

            $query = "delete from project_title_info where teamid = '$teamid'";
            $result = myquery($query);

            $query = "delete from project_detail where pid = '$pid'";
            $result = myquery($query);

            if($result){
            $base = "http://localhost:13138/pages/faculty_front.php";
            header("Location: $base");
            }
        }
        else{
            $query = "update project_detail set acceptance_mentor = 'true' where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set title_status_mentor = 2 where pid = '$pid'";
            $result = myquery($query);

            $query = "update project_team_info set title_status_ac = 1 where pid = '$pid'";
            $result = myquery($query);

            if($result){
                $base = "http://localhost:13138/pages/faculty_front.php";
                header("Location: $base");
            }
        }
    }
    }
?>
