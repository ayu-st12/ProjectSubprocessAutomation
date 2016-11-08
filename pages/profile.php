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
    $teamid = fetch1(teamid, user_detail, username, $user);
    $namestu = fetch1(name, user_detail, username, $user);

    $stu = mysql_fetch_array(fetch_stu($user, user_detail));
    //print_r($stu);

    $true = $_POST['true'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Profile</title>
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
                <li><a href="../pages/profile.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
        <div class="status">
        <div class="hbox"><h3>Your Profile</h3><br></div>
            <div class="sbox">
                <?php
                    if(!$true){?>
                        <div class="statusbox"><h5><?php
        echo "Name: ".$stu['name']."<br>";
        echo "SAP: ".$stu['sap']."<br>";
        echo "Student Mail: ".$stu['username']."<br>";
        echo "Roll: ".$stu['roll']."<br>";
        echo "Branch: ".$stu['branch']."<br>";
        echo "Sem: ".$stu['sem']."<br>";
        echo "Year: ".$stu['year']."<br>";
        echo "Email: ".$stu['email']."<br>";
        echo "Contact: ".$stu['contact'];
                    }?></h5></div>
                    </div>
                </div>
        </div>
        </div><br><br>
</body>
</html>
