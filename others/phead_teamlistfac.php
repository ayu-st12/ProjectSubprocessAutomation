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
    $tid = $_GET['tid'];

    if(empty($tid)){
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
            <li><a href="../pages/phead_newtitle.php">New Title(s)</a></li>
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
        <div class="hbox"><h3>Team Lists</h3></div>
                <div class="sbox">
                  <?php
                      connect();
                      select_db();
                      
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
                        //print_r($td);
                  ?>
                      <div class="tbox"><h3>*Select the team to view info</h3></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                    <div class="tbox"><h3>Team: </h3></div>
                    <select name="tid">
                        <?php for($i=0;$i<count($teamarray);$i++){
                        ?>
                        <option value="<?php echo $teamarray[$i][0];?>"><?php echo $teamarray[$i][0]; ?></option>
                        <?php } ?>
                    </select>
                        <input class="fsub" type="submit">
                    </form>
                  </div>
            </div>
</div>
</body>
</html>
<?php
 }
 else{
?>
<!DOCTYPE html>
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
                <li><a href="../pages/profile.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>
            <div class="status">
            <div class="hbox"><h3>Team: <?php echo $tid;?></h3><br></div>
            <div class="sbox">
            <?php
    $query = "select * from user_detail where teamid = '$tid'";
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

<?php 
 }
?>
