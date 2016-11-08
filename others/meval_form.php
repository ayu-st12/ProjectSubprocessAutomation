<?php
    
    $pid = $_GET['passkey'];
    $teamid = $_GET['passkey1'];

    //echo $pid."t".$teamid;

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

    connect();
    select_db();

    static $i=0;
    $myname = fetch1(name, fac_detail, username, $user);
    $month = fetch1(month, monthly_eval, pid, $pid);
    $year = fetch1(year, monthly_eval, pid, $pid);
    $program = fetch1(branch, user_detail, teamid, $teamid);
    $sem = fetch1(sem, user_detail, teamid, $teamid);
    $type = fetch1(type, project_detail, pid, $pid);
    $mentor = fetch1(mentor, project_detail, pid, $pid);
    $title = fetch1(ptitle, project_detail, pid, $pid);
?>
<!DOCTYPE HTML>
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
            <li><a href="#">Team List</a></li>
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
        <div class="hbox"><h3>Monthly Progress Report <?php echo $month; ?> <?php echo $year; ?></h3><br></div>
                 <div class="sbox">
                     <div class="tbox">
        <h3>Program: <?php echo $program; ?></h3>
        <h3>Semester: <?php echo $sem; ?></h3>
        <h3>Type: <?php echo $type; ?></h3>
        <h3>Mentor: <?php echo $mentor; ?></h3>
        <h3>Title: <?php echo $title; ?></h3></div>
        <form action="" method="post">
            <table border="1">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name of Student</th>
                        <th>Roll No</th>
                        <th>SAP</th>
                        <th>1st Week Performance</th>
                        <th>2nd Week Performance</th>
                        <th>3rd Week Performance</th>
                        <th>4th Week Performance</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "select * from user_detail where teamid = '$teamid'";    
                    $result = myquery($query);
                    if($value = mysql_fetch_array($result))
                    { ?>
                
                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name1" value="<?php echo $value['name'];?>"></td>
                        <td><input type="text" name="roll1" value="<?php echo $value['roll'];?>"></td>
                        <td><input type="text" name="sap1" value="<?php echo $value['sap'];?>"></td>
                        <td><input type="text" name="gw1stu1"></td>
                        <td><input type="text" name="gw2stu1"></td>
                        <td><input type="text" name="gw3stu1"></td>
                        <td><input type="text" name="gw4stu1"></td>
                        <td><input type="text" name="remarksstu1"></td>
                    </tr>
                        
                    <?php }
                if($value = mysql_fetch_array($result))
                    {?>
                
                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name2" value="<?php echo $value['name'];?>"></td>
                        <td><input type="text" name="roll2" value="<?php echo $value['roll'];?>"></td>
                        <td><input type="text" name="sap2" value="<?php echo $value['sap'];?>"></td>
                        <td><input type="text" name="gw1stu2"></td>
                        <td><input type="text" name="gw2stu2"></td>
                        <td><input type="text" name="gw3stu2"></td>
                        <td><input type="text" name="gw4stu2"></td>
                        <td><input type="text" name="remarksstu2"></td>
                    </tr>
                        
                    <?php }
                   if($value = mysql_fetch_array($result))
                    {?>
                
                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name3" value="<?php echo $value['name'];?>"></td>
                        <td><input type="text" name="roll3" value="<?php echo $value['roll'];?>"></td>
                        <td><input type="text" name="sap3" value="<?php echo $value['sap'];?>"></td>
                        <td><input type="text" name="gw1stu3"></td>
                        <td><input type="text" name="gw2stu3"></td>
                        <td><input type="text" name="gw3stu3"></td>
                        <td><input type="text" name="gw4stu3"></td>
                        <td><input type="text" name="remarksstu3"></td>
                    </tr>
                        
                    <?php }

                    if($value = mysql_fetch_array($result))
                    {?>
                
                    <tr>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name4" value="<?php echo $value['name'];?>"></td>
                        <td><input type="text" name="roll4" value="<?php echo $value['roll'];?>"></td>
                        <td><input type="text" name="sap4" value="<?php echo $value['sap'];?>"></td>
                        <td><input type="text" name="gw1stu4"></td>
                        <td><input type="text" name="gw2stu4"></td>
                        <td><input type="text" name="gw3stu4"></td>
                        <td><input type="text" name="gw4stu4"></td>
                        <td><input type="text" name="remarksstu4"></td>
                    </tr>
                        
                    <?php }
                if($value = mysql_fetch_array($result))
                    {?>
                
                    <tr>
                        <td>1</td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['roll'];?></td>
                        <td><?php echo $value['sap'];?></td>
                        <td><input type="text" name="gw1"></td>
                        <td><input type="text" name="gw2"></td>
                        <td><input type="text" name="gw3"></td>
                        <td><input type="text" name="gw4"></td>
                        <td><input type="text" name="remarks"></td>
                    </tr>
                        
                    <?php }
                ?>
                </tbody>
            </table>
         <input type = "submit" name="Accept" value = "Accept" class="fsub">
            </div>
                 <br>
        </form><br>
        </div>
    </body>
</html>

<?php
    
    $name1 = $_POST['name1'];
    $name2 = $_POST['name2'];
    $name3 = $_POST['name3'];
    $name4 = $_POST['name4'];

    $roll1 = $_POST['roll1'];
    $roll2 = $_POST['roll2'];
    $roll3 = $_POST['roll3'];
    $roll4 = $_POST['roll4'];

    $sap1 = $_POST['sap1'];
    $sap2 = $_POST['sap2'];
    $sap3 = $_POST['sap3'];
    $sap4 = $_POST['sap4'];

    $gw1stu1 = $_POST['gw1stu1'];
    $gw1stu2 = $_POST['gw1stu2'];
    $gw1stu3 = $_POST['gw1stu3'];
    $gw1stu4 = $_POST['gw1stu4'];

    $gw2stu1 = $_POST['gw2stu1'];
    $gw2stu2 = $_POST['gw2stu2'];
    $gw2stu3 = $_POST['gw2stu3'];
    $gw2stu4 = $_POST['gw2stu4'];

    $gw3stu1 = $_POST['gw3stu1'];
    $gw3stu2 = $_POST['gw3stu2'];
    $gw3stu3 = $_POST['gw3stu3'];
    $gw3stu4 = $_POST['gw3stu4'];

    $gw4stu1 = $_POST['gw4stu1'];
    $gw4stu2 = $_POST['gw4stu2'];
    $gw4stu3 = $_POST['gw4stu3'];
    $gw4stu4 = $_POST['gw4stu4'];

    $remarks1 = $_POST['remarksstu1'];
    $remarks2 = $_POST['remarksstu2'];
    $remarks3 = $_POST['remarksstu3'];
    $remarks4 = $_POST['remarksstu4'];

    
    if(isset($_POST['Accept'])){

        $query = "select month from monthly_eval where pid = '$pid' and status = 1";
        $result = myquery($query);
        $m = mysql_fetch_array($result);
        $month = $m[0];
        $query1 = "select year from monthly_eval where pid = '$pid' and status = 1";
        $result1 = myquery($query1);
        $y = mysql_fetch_array($result1);
        $year = $y[0];
            
    if($name1 && $roll1 && $sap1 && $gw1stu1 && $gw2stu1 && $gw3stu1 && $gw4stu1 && $remarks1 && $month && $year){
        $query = "insert into eval_details values('$name1', '$roll1', $sap1, '$gw1stu1', '$gw2stu1', '$gw3stu1', '$gw4stu1', '$remarks1', '$month', '$year')";
        $result = myquery($query);
        //if($result)
            //echo "Success 1";
    }

    if($name2 && $roll2 && $sap2 && $gw1stu2 && $gw2stu2 && $gw3stu2 && $gw4stu2 && $remarks2 && $month && $year){
        $query = "insert into eval_details values('$name2', '$roll2', $sap2, '$gw1stu2', '$gw2stu2', '$gw3stu2', '$gw4stu2', '$remarks2', '$month', '$year')";
        $result = myquery($query);
        //if($result)
            //echo "Success 2";
    }

    if($name3 && $roll3 && $sap3 && $gw1stu3 && $gw2stu3 && $gw3stu3 && $gw4stu3 && $remarks3 && $month && $year){
        $query = "insert into eval_details values('$name3', '$roll3', $sap3, '$gw1stu3', '$gw2stu3', '$gw3stu3', '$gw4stu3', '$remarks3', '$month', '$year')";
        $result = myquery($query);
        //if($result)
            //echo "Success 3";
    }

    if($name4 && $roll4 && $sap4 && $gw1stu4 && $gw2stu4 && $gw3stu4 && $gw4stu4 && $remarks4 && $month && $year){
        $query = "insert into eval_details values('$name4', '$roll4', $sap4, '$gw1stu4', '$gw2stu4', '$gw3stu4', '$gw4stu4', '$remarks4', '$month', '$year')";
        $result = myquery($query);
        //if($result)
            //echo "Success 4";
    }

   
    $query = "Update monthly_eval set status = 2 where pid = '$pid' and month = '$month'";
    $result = myquery($query);
   
    if($result){
        echo '<script type="text/javascript">alert("Monthly Evaluation Submitted");</script>';
        }
    }
?>