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
                <div class="id"><p><?php echo $my_branch; ?></p></div>
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

        <?php 
            $team_id = array();
            $proj_id = array();
            //finding all the teamid related to a branch
            $query = "select distinct teamid from user_detail where branch = '$my_branch'";
            $result = myquery($query);
            while($value = mysql_fetch_array($result))
                array_push($team_id, $value);

            //print_r($team_id);
            //finding all the project id's related to the teamid's 
            for($i=0;$i<count($team_id);$i++){
                $td = $team_id[$i][0];
                $query = "select pid from project_team_info where teamid = '$td'";
                $result = myquery($query);
                while($value = mysql_fetch_array($result))
                    array_push($proj_id, $value);
            }
            //print_r($proj_id);

            //selecting the projects form the project table w.r.t. the teamid acq. above
            //for($i=0;$i<count($proj_id);$i++){
                $td = $proj_id[0][0];
                $query = "select * from project_detail where pid = '$td' and acceptance_ac = 'true'";
                $result = myquery($query);
             
        ?>
            <div class="status">
        <div class="hbox"><h3>Title(s) Under Your Branch: </h3></div>
                <div class="sbox">      
               <?php if(($result)){?>
                    <div class="tbox"><h3>*Click on the Title to view about Project</h3></div>  
        <table border="1">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Activity Coordinator</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<count($proj_id);$i++){
                $td = $proj_id[$i][0];
                $query = "select * from project_detail where pid = '$td' and acceptance_ac = 'true'";
                $result = myquery($query);
                if($result){            
                while($value = mysql_fetch_array($result)){
                    ?>
                <tr>
                    <td><?php echo $value['pid'];?></td>
                    <td><a href="http://localhost:13138/others/displayinfo.php?passkey=<?php echo $value['pid'];?>"><?php echo $value['ptitle'];?></a></td>
                    <td><?php echo $value['ac'];?></td>
                    <td><?php echo $value['type'];?></td>
                </tr>
            <?php                }}}
                ?>
            </tbody>
        </table>
        <?php
                }
             else{   
              ?>     <div class="tbox"><h3>No New Titles In Your Branch</h3></div> <?php
             }
                ?>
      <br>
        </div>
        </div>
           <br><br><br>
    <?php 
            $query = "select * from project_detail where mentor = '$myname' and acceptance_mentor = 'true'";
            $result = myquery($query);
            if($result){
        ?>
            <div class="status">
        <div class="hbox"><h3>Title(s) Under You: </h3></div>
                <div class="sbox">      
                    <div class="tbox"><h3>*Click on the Title to view about Project</h3></div>  
        <table border="1">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Activity Coordinator</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php            
                while($value = mysql_fetch_array($result)){
                    ?>
                <tr>
                    <td><?php echo $value['pid'];?></td>
                    <td><a href="http://localhost:13138/others/displayinfo.php?passkey=<?php echo $value['pid'];?>"><?php echo $value['ptitle'];?></a></td>
                    <td><?php echo $value['ac'];?></td>
                    <td><?php echo $value['type'];?></td>
                </tr>
            <?php                }?>
            </tbody>
        </table>
        <?php
            }?>
      <br>
        </div>
        </div>
            </div>
    </body>
</html>
<?php
    
?>