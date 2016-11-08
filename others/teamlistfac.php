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
        <div class="hbox"><h3>Team Lists</h3></div>
                <div class="sbox">
                  <?php
                      connect();
                      select_db();
                      
                      $pd = array();
                      $td = array();
                      $query="select pid from project_detail where mentor = '$myname'";
                      $result = myquery($query);
                      while($value = mysql_fetch_array($result)){
                        array_push($pd, $value);
                        }

                        for($i=0;$i<count($pd);$i++){
                            array_push($td, fetch1(teamid, project_team_info, pid,  $pd[$i][0]));
                        }
                        //print_r($td);
                  ?>
                      <div class="tbox"><h3>*Select the team to view info</h3></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                    <div class="tbox"><h3>Team: </h3></div>
                    <select name="tid">
                        <?php for($i=0;$i<count($td);$i++){
                        ?>
                        <option value="<?php echo $td[$i];?>"><?php echo $td[$i]; ?></option>
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
