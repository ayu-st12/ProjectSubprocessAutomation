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
        <div class="hbox"><h3>Create New Message</h3></div>
                <div class="sbox">
                    <form action="" method="post">
                    <div class="tbox"><h3>To:</h3></div>
                    <?php connect();
                      select_db();
                                          $teamarray = array();

    $query = "select distinct teamid from user_detail where branch = '$my_branch'";
    $result1 = myquery($query);
    $num = mysql_num_rows($result1);
    for($i=0;$i<$num;$i++)
    {
        $team = mysql_fetch_array($result1);
        array_push($teamarray,$team);
    }

                      ?>
                    <select name="to">
                        <option value="all">All Groups</option>
                <?php  
                        for($i=0;$i<count($teamarray);$i++){?>
                        <option value="<?php echo $teamarray[$i][0]; ?>"><?php echo $teamarray[$i][0]; ?></option>
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
