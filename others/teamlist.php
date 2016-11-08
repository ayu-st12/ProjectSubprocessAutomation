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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Team List</title>
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
        <div class="hbox"><h3>Team: <?php echo $teamid;?></h3><br></div>
            <div class="sbox">
            <?php
    $query = "select * from user_detail where teamid = '$teamid'";
    $result = myquery($query);

    while($value = mysql_fetch_array($result)){
        ?><div class="tstatusbox"><h5><?php
        echo "Name: ".$value['name']."<br>";
        echo "SAP: ".$value['sap']."<br>";
        echo "Roll: ".$value['roll']."<br>";
        echo "Branch: ".$value['branch']."<br>";
        ?></h5></div><?php
    }
?>
                </div>
        </div>
        </div>
</body>
</html>
