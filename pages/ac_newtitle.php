<?php
    //include("../others/detailed_fachead.php");
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
    
    $obj = mysql_fetch_array(fetch_fac($user, fac_detail));
    $myname = $obj['name'];
    $post = $obj['post'];
    $my_branch = fetch1(branch, fac_detail, username, $user);
            

    $query = "select * from project_detail where ac = '$myname' and acceptance_ac = 'false' and acceptance_mentor = 'true'";
    $result1 = mysql_fetch_array(myquery($query));
    //print_r($result1);
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
                <?php if ($post == "ac"){?>
                <div class="id"><p><?php echo $my_branch; ?></p></div>
                <?php } ?>
            </div>
            <hr>
        <nav class="stufront">
            <ul>
            <li><a href="../pages/ac_front.php">Home</a></li>
            <li><a href="../pages/ac_newtitle.php">New Title(s)</a></li>
            <li><a href="../pages/ac_newabstracts.php">New Abstract(s)</a></li>
            <li><a href="../others/ac_msgfac.php">Messages</a></li>
            <li><a href="../others/ac_teamlistfac.php">Team List</a></li>
            <li><a href="../pages/fsubmission.php">Mid/End Evaluation</a></li>
            </ul>
        </nav>
        </div>
        <div class="main">
            <div class="header"><h1>Welcome, <?php echo $myname;?></h1>
            <div class="nav2"><ul>
                <li><a href="../pages/ac_profilefac.php"><img src="../images/user1.png" alt="Profile">Profile</a></li>
                <li><a href="../others/signout.php"><img src="../images/sout.png" alt="Signout">SignOut</a></li>
            </ul></div></div>

                        <div class="status">
        <div class="hbox"><h3>Title(s) Under Your Branch: </h3></div>
                <div class="sbox">        

<?php
            if($result1){
        ?>
                        <div class="tbox"><h3>*Click on the Title to view about Project</h3></div>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Project Objectives</th>
                    <th>Activity Coordinator</th>
                    <th>Type</th>
                    <th>Approve?</th>
                    <th>Reject?</th>
                </tr>
            </thead>
            <tbody>
                <?php            
                $res = myquery($query);
                $test = mysql_num_rows($res);
                for($i=0;$i<$test;$i++){
                  $result1 = mysql_fetch_array($res);
                  $pid = $result1['pid'];
                  $conf = $result1['confirm_code'];
                    ?>
                <tr>
                    <td><?php echo $result1['pid'];?></td>
                    <td><a href="http://localhost:13138/others/displayinfo.php?passkey=<?php echo $result1['pid'];?>"><?php echo $result1['ptitle'];?></a></td>
                    <td><?php echo $result1['objectives'];?></td>
                    <td><?php echo $result1['ac'];?></td>
                    <td><?php echo $result1['type'];?></td>
                    <td><a href="http://localhost:13138/others/confirmation.php?passkey=<?php echo $conf;?>&passkey1=<?php echo $pid?>&ae=ac"><input type="button" value="Approve"></a></td>
                    <td><a href="http://localhost:13138/others/confirmation.php?passkey=1&passkey1=<?php echo $pid?>&ae=ac"><input type="button" value="Reject"></a></td>
                </tr>
            <?php       } ?>
            </tbody>
        </table>
    <br>
                </div>
        <?php
            }
            else{
                ?> 
            <div class="tbox"><h3>No New Titles To Approve</h3></div>
        <?php
            }?>
    </div>

</body>
</html>
<?php
  
?>