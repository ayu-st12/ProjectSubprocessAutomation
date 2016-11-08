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

    $obj = mysql_fetch_array(fetch_fac($user, fac_detail));
    $myname = $obj['name'];
    $post = $obj['post'];
    
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
            </div>
            <hr>
        <nav class="stufront">
            <ul>
            <li><a href="../pages/faculty_front.php">Home</a></li>
            <li><a href="../pages/newtitles.php">New Title(s)</a></li>
            <li><a href="../pages/newabstracts.php">New Abstract(s)</a></li>
            <li><a href="../pages/display_eval.php">Monthly Evaluation</a></li>
            <li><a href="../others/msgfac.php">Messages</a></li>
            <li><a href="../others/teamlistfac.php">Team List</a></li>
            </ul>
        </nav>
        </div>
        <div class="main">
            <div class="header"><h1>Welcome, <?php echo $myname;?></h1>
            <div class="nav2"><ul>
                <li><a href="../pages/profilefac.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
            <div class="status">
        <div class="hbox"><h3>Create New Message</h3></div>
                <div class="sbox">
                    <form action="" method="post">
                    <div class="tbox"><h3>To:</h3></div>
                    <?php connect();
                      select_db();
                      
                      $pd = array();

                      $query="select pid from project_detail where mentor = '$myname'";
                      $result = myquery($query);
                      while($value = mysql_fetch_array($result)){
                        array_push($pd, $value);}
                      ?>
                    <select name="to">
                        <option value="all">All Groups</option>
                <?php  
                        for($i=0;$i<count($pd);$i++){?>
                        <option value="<?php echo fetch1(teamid, project_team_info, pid, $pd[$i][0]); ?>"><?php echo fetch1(teamid, project_team_info, pid, $pd[$i][0]); ?></option>
                        <?php                        }?>
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
