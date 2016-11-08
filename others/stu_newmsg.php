<?php    
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
    $user = $obj['username'];
        $myname = $obj['name'];
    
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
                <div class="id"><p><?php echo $teamid; ?></p></div>
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
            <div class="header"><h1>Welcome, <?php echo $myname;?></h1>
            <div class="nav2"><ul>
                <li><a href="../pages/profile.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
            <div class="status">
        <div class="hbox"><h3>Create New Message</h3></div>
                <div class="sbox">
                    <form action="" method="post">
                    <div class="tbox"><h3>To:</h3></div>
                    <?php connect();
                      select_db();
                      $br = $obj['branch'];
                      $query = "select username from fac_detail where branch = '$br' and post = 'program head'";
                      $phead = mysql_fetch_array(myquery($query));
                      $pid = fetch1(pid, project_team_info, teamid, $teamid);   
                      $mentor_name = fetch1(mentor, project_detail, pid, $pid);
                      $mentor = fetch1(username, fac_detail, name, $mentor_name);
                      $ac_name = fetch1(ac, project_detail, pid, $pid);
                      $ac = fetch1(username, fac_detail, name, $ac_name);
                      ?>
                    <select name="to">
                        <?php if($mentor) {?><option value="<?php echo $mentor ?>">Mentor</option><?php }?>
                        <?php if($ac) {?><option value="<?php echo $ac; ?>">Activity Coordinator</option><?php }?>
                        <?php if($phead) {?><option value="<?php echo $phead[0]; ?>">Program Head</option><?php }?>
                    </select><br>
                    <div class="tbox"><h3>Message:</h3></div>
                    <textarea placeholder="write your message here..." name="msg"></textarea>
                    <br>
                    <input type="submit" value="Send Message" class="fsub"><br>
                        </form>
                </div>
        </div>
            </div>        
    </body>
</html>
<?php
    $to = $_POST['to'];
    $msg = $_POST['msg'];
   
    if($to && $msg){
    $res = send_message($to, $msg, $user);
        if($res == 1){
            echo '<script type="text/javascript">alert("Message sent");</script>';
        }
        else{
            echo '<script type="text/javascript">alert("Message not sent try again later");</script>';
        }
    }
?>
