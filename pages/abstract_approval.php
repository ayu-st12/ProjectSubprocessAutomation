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

    $co = connect();
    select_db();
    $query = "select * from user_detail where username = '$user'";
    $result = myquery($query);
    $value = mysql_fetch_array($result);
    $teamid = $value['teamid'];

    $query = "select * from project_team_info where teamid = '$teamid'";
    $result = myquery($query);
    $value = mysql_fetch_array($result);
    $abstract_status = $value['abstract_status_mentor'];
    $title_status = $value['title_status_phead'];
    $pid = $value['pid'];
    if((($abstract_status==1)||($abstract_status==2)))
    {
            $base = "http://localhost:13138/pages/student_front.php?pagevalue=abstract" ;
            header("Location: $base");
    }
    else if(($title_status==0)||($title_status==1))
    {
            $base = "http://localhost:13138/pages/student_front.php?pagevalue=abstract1" ;
            header("Location: $base");
    }

    $query = "select * from project_detail where pid = '$pid'";
    $result = myquery($query);
    $value = mysql_fetch_array($result);
    $title = $value['ptitle'];
    $type = $value['type'];

    $mentor = $value['mentor'];
    $ac = $value['ac'];

    $namestu = fetch1(name, user_detail, username, $user);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Abstract Approval Form</title>
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
                <div class="header"><h1>Welcome, <?php echo $namestu;?></h1>
            <div class="nav2"><ul>
                <li><a href="#"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
        <div class="status">
        <div class="hbox"><h3>Project Abstract Approval Form</h3><br></div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <br><h4 class="ffh">Major/Minor: <?php echo $type;?></h4><br>
       <p class="ffh"><?php echo "Project Title: ".$title;?></p><br>
        <p class="ffh">Abstract (300 words)</p><textarea class="pobj" type="text" name="abstract" placeholder="Write Abstract..."></textarea><br><br>
        <p class="ffh">Introduction</p><textarea class="pobj" name="intro" placeholder="Introduction"></textarea><br><br>
        <p class="ffh">Problem Statement</p><textarea class="pobj" name="ps" placeholder="Problem Statement"></textarea><br><br>
        <p class="ffh">Literature Review</p><textarea class="pobj" name="lr" placeholder="Literature Review"></textarea><br><br>
        <p class="ffh">Objectives</p><textarea class="pobj" name="obs" placeholder="Objectives"></textarea><br><br>
        <p class="ffh">Methodology</p><textarea class="pobj" name="method" placeholder="Methodology"></textarea><br><br>
        <p class="ffh">System Requirements</p><textarea class="pobj" name="sr" placeholder="System Requirements"></textarea><br><br>
        <p class="ffh">References</p><textarea class="pobj" name="ref" placeholder="References"></textarea><br>
    <input type="submit" value="Submit" class="fsub"><br><br>
    </form></div>
    </div>
        <br>
    </body>
</html>
<?php 

    $abstract = $_POST['abstract'];
    $intro = $_POST['intro'];
    $ps = $_POST['ps'];
    $lr = $_POST['lr'];
    $obs = $_POST['obs'];
    $method = $_POST['mehtod'];
    $sr = $_POST['sr'];
    $ref = $_POST['ref'];

    if($abstract && $ref)
    {
        $query = "insert into project_abstract_info values('$abstract','$intro','$ps','$lr','$obs','$method','$sr','$ref','$teamid','$pid', 1,0,0)";
        $result = myquery($query);
         
        $query = "update project_team_info set abstract_status_mentor=1";
        $result = myquery($query);

        $email_mentor = fetch1(email, fac_detail, name, $mentor);
        $email_ac = fetch1(email, fac_detail, name, $ac);

        if($result)
            {
                echo '<script type="text/javascript">alert("Your Project Abstract Approval Form has been submitted successfully");</script>'; //put a javascript message here
                send_confirm_code_abstract($email_mentor, $pid, $code);
                send_confirm_code_abstract($email_ac, $pid, $code);
                    //echo "Mail Sent Successfully";
                    $base1 = "http://localhost:13138/pages/student_front.php";
                    header("Location: $base1");
             } //mailing function
                else 
                    echo '<script type="text/javascript">alert("Registeration Error Please try again");</script>';
    }

?>