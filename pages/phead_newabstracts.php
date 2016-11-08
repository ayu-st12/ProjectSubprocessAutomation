<?php
    //include("../others/detailed_fachead.php");
    include("../others/session.php");
    include("../others/proc_data.php");
    //include("../DBA_related/dbfunc.php");
    $i=0;
    session_begin();
    $user = session_resume();
    if(empty($user))
    {
            $base = "http://localhost:13138" ;
            header("Location: $base");
    }

    $co = connect();
    select_db();
    
    $obj = mysql_fetch_array(fetch_fac($user, fac_detail));
    $myname = $obj['name'];
    $post = $obj['post'];
    $my_branch = fetch1(branch, fac_detail, username, $user);

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
                <div class="id"><p><?php echo $user; ?></p></div>
                 <?php if ($post == "program head"){?>
                <div class="id"><p><?php echo $my_branch; ?></p></div>
                <?php } ?>
            </div>
            <hr>
        <nav class="stufront">
            <ul>
            <li><a href="../pages/phead_front.php">Home</a></li>
            <li><a href="../pages/phead_newtitles.php">New Title(s)</a></li>
            <li><a href="../pages/phead_newabstracts.php">New Abstract(s)</a></li>
            <li><a href="../others/phead_msgfac.php">Messages</a></li>
            <li><a href="../others/phead_teamlistfac.php">Team List</a></li>
            </ul>
        </nav>
        </div>
        <div class="main">
            <div class="header"><h1>Welcome, <?php echo $myname;?></h1>
            <div class="nav2"><ul>
                <li><a href="../pages/phead_profilefac.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>

                        <div class="status">
        <div class="hbox"><h3>Abstract(s) Under You: </h3></div>
                <div class="sbox">        

<?php
    $obj = mysql_fetch_array(fetch_fac($user, fac_detail));
    $myname = $obj['name'];
    $post = $obj['post'];
    $my_branch = fetch1(branch, fac_detail, username, $user);
    
    $teamarray = array();
    $projectarray = array();        
    
    $query = "select distinct teamid from user_detail where branch = '$my_branch'";
    $result1 = myquery($query);
    $num = mysql_num_rows($result1);
    for($i=0;$i<$num;$i++)
    {
        $team = mysql_fetch_array($result1);
        array_push($teamarray,$team);
    }

    for($i=0;$i<count($teamarray);$i++){
        $td = $teamarray[$i][0];
        $query = "select pid from project_team_info where teamid = '$td'";
        $result1 = myquery($query);
        if($result1)
        {
            $project = mysql_fetch_array($result1);
            array_push($projectarray,$project);
        }    
    }
    $td = $projectarray[0][0];
    $query = "select * from project_abstract_info where pid = '$td' and acceptance_phead = 1 and acceptance_ac = 2 and acceptance_mentor = 2";
    $result1 = mysql_fetch_array(myquery($query));
    //print_r($val);
            if($result1){        
                ?>
                    <div class="tbox"><h3>*Click on the Title to view about Project</h3></div>
                    <div class="tbox"><h3>Abstract(s) to Approve: </h3></div>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Approve?</th>
                    <th>Reject?</th>
                </tr>
            </thead>
            <tbody>
                <?php    
               $res = myquery($query);
                $test = mysql_num_rows($res);
                for($i=0;$i<$test;$i++){
                  $result1 = mysql_fetch_array($res);
                  $pid = $result1['pid'];
                  $conf = $result1['confirm_code'];
                  $ptitle = fetch1(ptitle, project_detail, pid, $pid);
                    ?>
                <tr>
                    <td><?php echo $pid;?></td>
                    <td><a href="http://localhost:13138/others/displayinfo.php?passkey=<?php echo $pid;?>"><?php echo $ptitle;?></a></td>
                    <td><a href="http://localhost:13138/others/confirmation.php?passkey=2&passkey1=<?php echo $pid;?>&type=1&ae=phead"><input type="button" value="Approve"></a></td>
                    <td><a href="http://localhost:13138/others/confirmation.php?passkey=1&passkey1=<?php echo $pid;?>&type=1&ae=phead"><input type="button" value="Reject"></a></td>
                </tr>
            <?php                }?>
            </tbody>
        </table><br>
        <?php
            }else{
                ?> 
            <div class="tbox"><h3>No New Abstracts To Approve</h3></div>
        <?php
            }?>
</div>
</div><br>
</body>
</html>
<?php
    ///include("../others/main_foot.php");
?>