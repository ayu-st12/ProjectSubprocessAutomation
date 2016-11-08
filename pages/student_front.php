<?php
    $pvalue = $_GET['pagevalue'];    

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
    
    $obj = mysql_fetch_array(fetch_stu($user, user_detail));
    $teamid = $obj['teamid'];

    $title_status_mentor=0;
    $title_status_ac=0;
    $title_status_phead=0;
    $abstract_status=0;
    $eval_status=0;

    $date = getdate();
    $month = $date['month'];
    $year = $date['year'];
?>
<html>
    <head>
        <title>Home</title>
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../css/dash.css" />
    </head>
    <body>
        <div class="nav">
            <div class="box">
                <div class="img"><img src="../images/upeslogo.png"/></div>
                <div class="id"><p><?php echo $obj['username']; ?></p></div>
                <div class="id"><p><?php echo $obj['teamid']; ?></p></div>
            </div>
            <hr>
        <nav class="stufront">
            <ul>
            <li><a href="../pages/student_front.php">Home</a></li>
            <li><a href="../pages/title_approval.php">Title Approval</a></li>
            <li><a href="../pages/abstract_approval.php">Abstract Approval</a></li>
            <li><a href="../others/teamlist.php">Team List</a></li>
            <li><a href="../others/news.php">Messages</a></li>
            </ul>
        </nav>
        </div>
        <div class="main">
            <div class="header"><h1>Welcome, <?php echo $obj['name']?></h1>
            <div class="nav2"><ul>
                <li><a href="../pages/profile.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
        <div class="status">
        <div class="hbox"><h3>Your Project Status</h3></div>
        <?php
            $co = connect();
            select_db();
            $title_status_mentor = fetch1(title_status_mentor, project_team_info, teamid, $teamid);
            $title_status_ac = fetch1(title_status_ac, project_team_info, teamid, $teamid);
            $title_status_phead=fetch1(title_status_phead, project_team_info, teamid, $teamid);
            if(($title_status_mentor==2)&&($title_status_ac==2)&&($title_status_phead==2)){
                $p = fetch1(pid, project_team_info, teamid, $teamid);
                $title = fetch1(ptitle, project_detail, pid, $p);
                ?>
                <div class="tbox"><h3>Title: <?php echo $title;?></h3></div>
                <?php
            }
        ?>
            <div class="sbox">
        <div class="tstatusbox"><h4>Title Approval: </h4>
        <?php 
            if($title_status_mentor == 1){ ?>
            <h4 id="title_stat"><?php echo"Approval Pending by Mentor";?></h4>                       
        <?php }    
            if($title_status_mentor == 2){
                                if($title_status_ac==2){
                                    if($title_status_phead==1){
                                        ?><h4 id="title_stat"><?php echo"Approval Pending by Program Head";?></h4><?php 
                                    }
                                    else{
                                        ?><h4 id="title_stat"><?php echo"Approved";?></h4><?php
                                    }
                                }
                                elseif($title_status_ac==1){
                                    ?> <h4 id="title_stat"><?php echo"Approval Pending by Activity Coordinator";?></h4> <?php
                                }
                             } ?>
        <?php if($title_status_mentor == 0){ ?>
        <h4 id="title_stat"><?php echo"Yet to be Submitted";?></h4>
        
        <?php            } ?>
        </div>
                
        <div class="astatusbox"><h4>Abstract Approval: </h4>
        <?php 
            $co = connect();
            select_db();
            $abstract_status_mentor = fetch1(abstract_status_mentor, project_team_info, teamid, $teamid);
            $abstract_status_ac = fetch1(abstract_status_ac, project_team_info, teamid, $teamid);
            $abstract_status_phead=fetch1(abstract_status_phead, project_team_info, teamid, $teamid);
         
            if($abstract_status_mentor == 1){ ?>
            <h4 id="title_stat"><?php echo"Approval Pending by Mentor";?></h4>                       
        <?php }    
            if($abstract_status_mentor == 2){
                                if($abstract_status_ac==2){
                                    if($abstract_status_phead==1){
                                        ?><h4 id="title_stat"><?php echo"Approval Pending by Program Head";?></h4><?php 
                                    }
                                    else{
                                        ?><h4 id="title_stat"><?php echo"Approved";?></h4><?php
                                    }
                                }
                                elseif($abstract_status_ac==1){
                                    ?> <h4 id="title_stat"><?php echo"Approval Pending by Activity Coordinator";?></h4> <?php
                                }
                             } ?>
        <?php if($abstract_status_mentor == 0){ ?>
        <h4 id="title_stat"><?php echo"Yet to be Submitted";?></h4>
        
        <?php            } ?>
        </div></div></div>
            <?php
            if(($title_status_phead==2)&&($abstract_status_phead==2)){
                $co = connect();
                select_db();
                $pid = fetch1(pid, project_team_info, teamid, $teamid);
                $auery = "select status from monthly_eval where pid = '$pid' and month = '$month'";
                $result = myquery($auery);
                $value = mysql_fetch_array($result);
                $eval_status = $value['status'];
               if($eval_status==0)
               {
                ?>
        <br><div class="status">
        <div class="hbox"><h3>Monthly Evaluation</h3></div><div class="tbox"><h3>Monthly Evaluation for <?php echo $month." ".$year." ";?><a href="http://localhost:13138/pages/meval.php">Apply Here</a></h3><br></div></div>
        <?php               }
               else if($eval_status==1){?>
            <br><div class="status">
            <div class="hbox"><h3>Monthly Evaluation</h3></div><div class="tbox"><h3>Monthly Evaluation for <?php echo $month." ".$year." ";?>To Be Marked</h3><br></div></div>          
               <?php }
                else if($eval_status==2){?>
        <br><div class="status">
            <div class="hbox"><h3>Monthly Evaluation</h3></div><div class="tbox"><h3>Monthly Evaluation for <?php echo $month." ".$year." ";?>Evaluated</h3><br></div></div>          
               <?php }}?>
        <!--<br><h5>understand if you can</h5>
        <h6><?php print_r($obj); ?></h6>-->
            </div>
    </body>
</html>
<?php

    if($pvalue=='title')
        echo '<script type="text/javascript">alert("Your Title Approval Form has been Submitted Already");</script>';
    else if($pvalue=='abstract')
        echo '<script type="text/javascript">alert("Your Abstract Approval Form has been Submitted Already");</script>';
    else if($pvalue=='abstract1')
        echo '<script type="text/javascript">alert("Your Title Approval Form has not been approved or submitted");</script>';
?>