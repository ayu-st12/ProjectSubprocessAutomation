<?php
    $pid = $_GET['passkey'];

    include("../others/detailed_fachead.php");
    include("../others/session.php");
    include("../others/proc_data.php");
    //include("../DBA_related/dbfunc.php");

    session_begin();
    $user = session_resume();
    if(empty($user))
    {
            $base = "http://localhost:13138" ;
            header("Location: $base");
    }

    $co = connect();
    select_db();

    $query = "select * from project_detail where pid = '$pid'";
    $result = myquery($query);

    $project_detail = mysql_fetch_array($result);

    print_r($project_detail);

    $query = "select * from project_team_info where pid = '$pid'";
    $result = myquery($query);

    $project_stats = mysql_fetch_array($result);
    $teamid = $project_stats['teamid'];
    print_r($project_stats);

    if($project_stats['title_status']!=0){
        $query = "select * from project_title_info where teamid = '$teamid'";
        $result = myquery($query);

        while($project_team = mysql_fetch_array($result))
            print_r($project_team);
    }

    if($project_stats['abstract_status']!=0){
        $query = "select * from project_abstract_info where pid = '$pid'";
        $result = myquery($query);

        while($project_abstract = mysql_fetch_array($result))
            print_r($project_abstract);
    }
?>
