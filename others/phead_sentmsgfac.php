<?php include("../others/session.php");
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
        <div class="hbox"><h3>Messages</h3></div>
                <div class="sbox">
                    <div class="controls">
                    <a href="../others/newmsg.php" class="msg"><input type="submit" value="New Message" class="msga"></a>
                    <a href="../others/sentmsgfac.php" class="msg"><input type="submit" value="Sent Messages" class="msgb"></a>
                    </div>      
                    <div class="tbox"><h3>List of Messages:</h3></div>
                    <table border="1">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Message</th>
                    <th>To</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    $query = "select * from messages where username = '$user' order by dt_time desc";
                    $result = myquery($query);
                    while($value = mysql_fetch_array($result))
                    {
                ?>
                <tr>
                <td><?php echo $value['dt_time']; ?></td>
                <td><?php echo $value['message']; ?></td>
                <td><?php echo $value['to_g'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table><br>
        </div>
        </div>
        
    </body>
</html>
