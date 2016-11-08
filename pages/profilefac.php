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
    
    $stu = mysql_fetch_array(fetch_fac($user, fac_detail));
    //print_r($stu);


?>
<html>
    <head>
        <title>Home</title>
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../css/dash.css" />

        <link rel="stylesheet" type="text/css" href="../css/form.css" />
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
        <div class="hbox"><h3>Your Profile</h3><br></div>
            <div class="sbox">
                <?php
                    ?>
                        <div class="statusbox"><h5><?php
        echo "Name: ".$stu['name']."<br>";
        echo "SAP: ".$stu['sap']."<br>";
        //echo "Username: ".$stu['username']."<br>";
        echo "Gender: ".$stu['gender']."<br>";
        echo "Post: ".$stu['post']."<br>";
        echo "Email: ".$stu['email']."<br>";
        echo "Contact: ".$stu['contact'];
        ?></h5></div>
                 <?php
                    ?>
                    </div>
                </div>
        </div>
        </div><br><br>
</body>
</html>
