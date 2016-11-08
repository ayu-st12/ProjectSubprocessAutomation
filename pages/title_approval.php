<?php
    
    include("../others/session.php");
    include("../others/proc_data.php");
    
    session_begin();
    $user = session_resume();

    $co = connect();
    select_db();
    $query = "select * from user_detail where username = '$user'";
    $result = myquery($query);
    $value = mysql_fetch_array($result);
    $teamid = $value['teamid'];

    $query = "select * from project_team_info where teamid = '$teamid'";
    $result = myquery($query);
    $value = mysql_fetch_array($result);
    $title_status = $value['title_status_mentor'];
    $namestu = fetch1(name, user_detail, username, $user);                        

    if(empty($user))
    {
            $base = "http://localhost:13138" ;
            header("Location: $base");
    }

    if(($title_status==1)||($title_status==2))
    {
            $base = "http://localhost:13138/pages/student_front.php?pagevalue=title" ;
            header("Location: $base");
    }
    $i=0;
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Title Approval Form</title>
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
        <div class="hbox"><h3>Project Title Approval Form</h3><br></div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <br><p class="ffh" id="title">Type: </p>
            <select name="project" id="title">
                <option>Minor I</option>
                <option>Minor II</option>
                <option>Major I</option>
                <option>Major II</option>
            </select>
            <br>
            <br><p class="ffh">Project Title: </p><input type="text" name="ptitle" placeholder="Project Title" required="required"><br>
            <br><p class="ffh">Project Objectives: </p><textarea name="pobj" placeholder="Project Objectives" required="required"></textarea><br>
            <br><p class="ffh">Team Members Information: </p><br>
            <table border="1">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Name of the Student</th>
                        <th>Branch</th>
                        <th>Semester</th>
                        <th>Roll number</th>
                        <th>SAP Id</th>
                        <th>Role of Student</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                            $co = connect();
                            select_db();
                            $query = "select * from user_detail where username = '$user'";
                            $result = myquery($query);
                            $value = mysql_fetch_array($result);
                            $teamid = $value['teamid'];
                            $query1 = "select * from login_detail where teamid = '$teamid'";
                            $result1 = myquery($query1);
                            $value1 = mysql_fetch_array($result1);
                            $un = $value1['username'];
                            if(($value1 != NULL)){
                                $query = "select * from user_detail where username = '$un'";
                                $result = myquery($query);
                                $value = mysql_fetch_array($result);     
                    ?>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name1" value="<?php echo $value['name']; ?>"></td>
                        <td><input type="text" name="branch1" value="<?php echo $value['branch']; ?>"></td>
                        <td><input type="text" name="sem1" value=<?php echo $value['sem']; ?>></td>
                        <td><input type="text" name="roll1" value=<?php echo $value['roll']; ?>></td>
                        <td><input type="text" name="sap1" value=<?php echo $value['sap']; ?>></td>
                        <td><input type="text" name="role1" placeholder="Enter Role"></td>
                        
                    <?php }?>
                    </tr>
                <tr>
                    <?php
                        $value1 = mysql_fetch_array($result1);
                        $un = $value1['username'];
                        if(($value1 != NULL)){
                            $query = "select * from user_detail where username = '$un'";
                            $result = myquery($query);
                            $value = mysql_fetch_array($result);     
                    ?>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name2" value="<?php echo $value['name']; ?>"></td>
                        <td><input type="text" name="branch2" value="<?php echo $value['branch']; ?>"></td>
                        <td><input type="text" name="sem2" value=<?php echo $value['sem']; ?>></td>
                        <td><input type="text" name="roll2" value=<?php echo $value['roll']; ?>></td>
                        <td><input type="text" name="sap2" value=<?php echo $value['sap']; ?>></td>
                        <td><input type="text" name="role2" placeholder="Enter Role"></td>
                        
                    <?php }     else{
                               ?>
                                <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name2" placeholder="Enter Name"></td>
                        <td><input type="text" name="branch2" placeholder="Enter Branch"></td>
                        <td><input type="text" name="sem2" placeholder="Enter Branch"></td>
                        <td><input type="text" name="roll2" placeholder="Enter Roll Number"></td>
                        <td><input type="text" name="sap2" placeholder="Enter SAP Id"></td>
                        <td><input type="text" name="role2" placeholder="Enter Role"></td>
                
                                <?php
                           }
                    ?>
                </tr>
                <tr>
                    <?php
                        $value1 = mysql_fetch_array($result1);
                        $un = $value1['username'];
                        if(($value1 != NULL)){
                            $query = "select * from user_detail where username = '$un'";
                            $result = myquery($query);
                            $value = mysql_fetch_array($result);     
                    ?>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name3" value="<?php echo $value['name']; ?>"></td>
                        <td><input type="text" name="branch3" value="<?php echo $value['branch']; ?>"></td>
                        <td><input type="text" name="sem3" value=<?php echo $value['sem']; ?>></td>
                        <td><input type="text" name="roll3" value=<?php echo $value['roll']; ?>></td>
                        <td><input type="text" name="sap3" value=<?php echo $value['sap']; ?>></td>
                        <td><input type="text" name="role3" placeholder="Enter Role"></td>
                        
                    <?php }     else{
                               ?>
                                <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name3" placeholder="Enter Name"></td>
                        <td><input type="text" name="branch3" placeholder="Enter Branch"></td>
                        <td><input type="text" name="sem3" placeholder="Enter Branch"></td>
                        <td><input type="text" name="roll3" placeholder="Enter Roll Number"></td>
                        <td><input type="text" name="sap3" placeholder="Enter SAP Id"></td>
                        <td><input type="text" name="role3" placeholder="Enter Role"></td>
                
                                <?php
                           }
                    ?>
                </tr>
                <tr>
                    <?php
                        $value1 = mysql_fetch_array($result1);   
                        $un = $value1['username'];
                        if(($value1 != NULL)){
                            $query = "select * from user_detail where username = '$un'";
                            $result = myquery($query);
                            $value = mysql_fetch_array($result);     
                    ?>
                        <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name4" value="<?php echo $value['name']; ?>"></td>
                        <td><input type="text" name="branch4" value="<?php echo $value['branch']; ?>"></td>
                        <td><input type="text" name="sem4" value=<?php echo $value['sem']; ?>></td>
                        <td><input type="text" name="roll4" value=<?php echo $value['roll']; ?>></td>
                        <td><input type="text" name="sap4" value=<?php echo $value['sap']; ?>></td>
                        <td><input type="text" name="role4" placeholder="Enter Role"></td>
                        
                    <?php }     else{
                               ?>
                                <td><?php echo ++$i;?></td>
                        <td><input type="text" name="name4" placeholder="Enter Name"></td>
                        <td><input type="text" name="branch4" placeholder="Enter Branch"></td>
                        <td><input type="text" name="sem4" placeholder="Enter Branch"></td>
                        <td><input type="text" name="roll4" placeholder="Enter Roll Number"></td>
                        <td><input type="text" name="sap4" placeholder="Enter SAP Id"></td>
                        <td><input type="text" name="role4" placeholder="Enter Role"></td>
                
                                <?php
                           }
                    ?>
                </tr>
                </tbody>
            </table>
            <br><p class="ffh" id="title">Mentor:</p>
             <select name="mentor">
                 <?php 
                    $co = connect();
                    select_db();
                    $query = "select * from fac_detail where post = 'mentor'";
                    $result = myquery($query);
                    while($value = mysql_fetch_array($result)){
                    ?>
                <option><?php echo $value['name'];?></option>
                 <?php }?>
            </select>
            <br><br><p class="ffh" id="title">Activity Coordinator:</p>
              <select name="ac">
                 <?php 
                    $query = "select * from fac_detail where post = 'ac'";
                    $result = myquery($query);
                    while($value = mysql_fetch_array($result)){
                    ?>
                <option><?php echo $value['name'];?></option>
                 <?php }?>
            </select>
            <br><br>
            <input type="submit" value="Submit for Approval" class="fsub">
        </form><br></div>
            </div>
        <br>
    </body>
</html>

<?php
    $ptitle = $_POST['ptitle'];
    $pobj = $_POST['pobj'];
    $mentor = $_POST['mentor'];
    $ac = $_POST['ac'];
    $project = $_POST['project'];
    
    $name1 = $_POST['name1'];
    $name2 = $_POST['name2'];
    $name3 = $_POST['name3'];
    $name4 = $_POST['name4'];

    $branch1 = $_POST['branch1'];
    $branch2 = $_POST['branch2'];
    $branch3 = $_POST['branch3'];
    $branch4 = $_POST['branch4'];

    $sem1 = $_POST['sem1'];
    $sem2 = $_POST['sem2'];
    $sem3 = $_POST['sem3'];
    $sem4 = $_POST['sem4'];

    $roll1 = $_POST['roll1'];
    $roll2 = $_POST['roll2'];
    $roll3 = $_POST['roll3'];
    $roll4 = $_POST['roll4'];

    $sap1 = $_POST['sap1'];
    $sap2 = $_POST['sap2'];
    $sap3 = $_POST['sap3'];
    $sap4 = $_POST['sap4'];

    $role1 = $_POST['role1'];
    $role2 = $_POST['role2'];
    $role3 = $_POST['role3'];
    $role4 = $_POST['role4'];

    $pid = generate_pid(); //GENERATE RANDOM PROJECT ID
    $code = create_confirm_code();
    $stp_ptit = 0;
    $stp_pobj = 0;

    $stp_role1 = 0;
    $stp_role2 = 0;
    $stp_role3 = 0;
    $stp_role4 = 0;

    if(preg_match("/[0-9]+/",$ptitle) || preg_match("/^[a-z]*$/",$ptitle) && (strlen($ptitle)<=5 && strlen($ptitle)!=0))
    {
        $stp_ptit = 1;
        echo '<script type="text/javascript">alert("Enter Title Correctly.!!");</script>';
    }
    
    if(preg_match("/[0-9]+/",$pobj) || preg_match("/^[a-z]*$/",$pobj) && (strlen($pobj)<=5 && strlen($pobj)!=0))
    {
        $stp_pobj = 1;
        echo '<script type="text/javascript">alert("Enter Objective Correctly.!!");</script>';
    }

    if(preg_match("/[0-9]+/",$role1) || preg_match("/^[a-z]*$/",$role1) && (strlen($role1)<=5 && strlen($role1)!=0))
    {
        $stp_role1 = 1;
        echo '<script type="text/javascript">alert("Enter Role of 1st Student Correctly.!!");</script>';
    }

    if(preg_match("/[0-9]+/",$role2) || preg_match("/^[a-z]*$/",$role2) && (strlen($role2)<=5 && strlen($role2)!=0))
    {
        $stp_role2 = 1;
        echo '<script type="text/javascript">alert("Enter Role of 2nd Student Correctly.!!");</script>';
    }

    if(preg_match("/[0-9]+/",$role3) || preg_match("/^[a-z]*$/",$role3) && (strlen($role3)<=5 && strlen($role3)!=0))
    {
        $stp_role3 = 1;
        echo '<script type="text/javascript">alert("Enter Role of 3rd Student Correctly.!!");</script>';
    }

    if(preg_match("/[0-9]+/",$role4) || preg_match("/^[a-z]*$/",$role4) && (strlen($role4)<=5 && strlen($role4)!=0))
    {
        $stp_role4 = 1;
        echo '<script type="text/javascript">alert("Enter Role of 4th Student Correctly.!!");</script>';
    }

    if($ptitle && $mentor && $stp_pobj==0 && $stp_ptit==0 && $stp_role1==0 && $stp_role2==0 && $stp_role3==0 && $stp_role4==0)
    {
        $query = "insert into project_detail values('$pid', '$ptitle', '$pobj', '$mentor', '$ac', '$code', 'false', '$project', 'false', 'false')";
        $res = myquery($query);
        
        $query = "insert into project_team_info values('$pid','$teamid',1,0,0,0,0,0)";
        $res = myquery($query);

        if(empty($name1) && empty($branch1) && empty($sem1) && empty($roll1) && empty($sap1) && empty($role1)){}
        else{
            $qa = "insert into project_title_info values('$name1', '$branch1', '$sem1', '$roll1', '$sap1', '$role1', '$teamid')";
            $ra = myquery($qa);
        }
        if(empty($name2) && empty($branch2) && empty($sem2) && empty($roll2) && empty($sap2) && empty($role2)){}else{
        $qb = "insert into project_title_info values('$name2', '$branch2', '$sem2', '$roll2', '$sap2', '$role2', '$teamid')";
        $rb = myquery($qb);}
        if(empty($name3) && empty($branch3) && empty($sem3) && empty($roll3) && empty($sap3) && empty($role3)){}else{
        $qc = "insert into project_title_info values('$name3', '$branch3', '$sem3', '$roll3', '$sap3', '$role3', '$teamid')";
        $rc = myquery($qc);}
        if(empty($name4) && empty($branch4) && empty($sem4) && empty($roll4) && empty($sap4) && empty($role4)){}else{
        $qd = "insert into project_title_info values('$name4', '$branch4', '$sem4', '$roll4', '$sap4', '$role4', '$teamid')";
        $rd = myquery($qd);}

        $email_mentor = fetch1(email, fac_detail, name, $mentor);
        $email_ac = fetch1(email, fac_detail, name, $ac);
        //echo $email."hello";
        if($res)
            {
                echo '<script type="text/javascript">alert("Your Project Title Approval Form has been submitted successfully");</script>'; //put a javascript message here
                send_confirm_code_title($email_mentor, $pid, $code);
                send_confirm_code_title($email_ac, $pid, $code);
                    //echo "Mail Sent Successfully";
                    $base1 = "http://localhost:13138/pages/student_front.php";
                    header("Location: $base1");
             } //mailing function
                else 
                    echo '<script type="text/javascript">alert("Registeration Error Please try again");</script>';
    }
?>
