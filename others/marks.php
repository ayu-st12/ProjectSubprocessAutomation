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
    $pid = $_GET['passkey'];
    static $j,$k=0;
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
            <li><a href="../pages/fsubmission.php">Final Submission</a></li>
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
        <div class="hbox"><h3>Evaluation Form</h3></div>
                <div class="sbox"><br>
                    <form action="submission.php">
                    <h3 class="ffh">Evalutaion Type:</h3>
                    <select name="eval_type">
                        <option selected>Mid Term</option>
                        <option>End Term</option>
                    </select>      
                    <div class="tbox"><h3>Program: <?php echo $my_branch;?></h3></div>
                    <div class="tbox"><h3>Title: <?php echo fetch1(ptitle, project_detail, pid, $pid);?></h3></div>
                    <?php $name = array();
                            $teamd = fetch1(teamid, project_team_info, pid, $pid);
                            $q = "select name from user_detail where teamid = '$teamd'";
                            $result = myquery($q);
                            while($value = mysql_fetch_array($result)){
                                array_push($name, $value);
                            }
                            $roll = array();
                            $sap = array();
                            $branch = array();
                            $sem = array();
                            $q = "select * from user_detail where teamid = '$teamd'";
                            $result = myquery($q);
                            while($value = mysql_fetch_array($result)){
                                array_push($roll, $value['roll']);
                                array_push($sap, $value['sap']);
                                array_push($branch, $value['branch']);
                                array_push($sem, $value['sem']);
                            }

                            $q = "select name from fac_detail where branch = '$my_branch' and post = 'program head'";
                            $phead_name = mysql_fetch_array(myquery($q));
                            
                ?>
                    <div class="tbox"><h3><?php for($i=0;$i<count($name);$i++){ echo "Member ".($i+1)." : ".$name[$i][0]."<br>";} ?></h3></div>

                    <table border="1">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name of Student</th>
                        <th>Specialization</th>
                        <th>Sem</th>
                        <th>Roll No</th>
                        <th>SAP</th>
                        <th>Report(10)</th>
                        <th>Presentation(10)</th>
                        <th>Implementation and Result(10)</th>
                        <th>Quality(10)</th>
                        <th>Viva(10)</th>
                        <th>Total(50)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo ++$j;?></td>
                        <td><input type="text" value="<?php echo $name[$k][0];?>" name="name1"></td>
                        <td><input type="text" value="<?php echo $branch[$k];?>" name="branch1"></td>
                        <td><input type="text" value="<?php echo $sem[$k];?>" name="sem1"></td>
                        <td><input type="text" value="<?php echo $roll[$k];?>" name="roll1"></td>
                        <td><input type="text" value="<?php echo $sap[$k]; $k++;?>" name="sap1"></td>
                        <td><input type="text" name="report1"></td>
                        <td><input type="text" name="present1"></td>
                        <td><input type="text" name="inr1"></td>
                        <td><input type="text" name="quality1"></td>
                        <td><input type="text" name="viva1"></td>
                        <td><input type="text" name="total1"></td>
                    </tr>
                    <tr>
                        <td><?php echo ++$j;?></td>
                        <td><input type="text" value="<?php echo $name[$k][0];?>" name="name2"></td>
                        <td><input type="text" value="<?php echo $branch[$k];?>" name="branch2"></td>
                        <td><input type="text" value="<?php echo $sem[$k];?>" name="sem2"></td>
                        <td><input type="text" value="<?php echo $roll[$k];?>" name="roll2"></td>
                        <td><input type="text" value="<?php echo $sap[$k]; $k++;?>" name="sap2"></td>
                        <td><input type="text" name="report2"></td>
                        <td><input type="text" name="present2"></td>
                        <td><input type="text" name="inr2"></td>
                        <td><input type="text" name="quality2"></td>
                        <td><input type="text" name="viva2"></td>
                        <td><input type="text" name="total2"></td>
                    </tr>
                    <tr>
                        <tr>
                        <td><?php echo ++$j;?></td>
                        <td><input type="text" value="<?php echo $name[$k][0];?>" name="name3"></td>
                        <td><input type="text" value="<?php echo $branch[$k];?>" name="branch3"></td>
                        <td><input type="text" value="<?php echo $sem[$k];?>" name="sem3"></td>
                        <td><input type="text" value="<?php echo $roll[$k];?>" name="roll3"></td>
                        <td><input type="text" value="<?php echo $sap[$k]; $k++;?>" name="sap3"></td>
                        <td><input type="text" name="report3"></td>
                        <td><input type="text" name="present3"></td>
                        <td><input type="text" name="inr3"></td>
                        <td><input type="text" name="quality3"></td>
                        <td><input type="text" name="viva3"></td>
                        <td><input type="text" name="total1"></td>
                    </tr>
                    <tr>
                        <tr>
                        <td><?php echo ++$j;?></td>
                        <td><input type="text" value="<?php echo $name[$k][0];?>" name="name4"></td>
                        <td><input type="text" value="<?php echo $branch[$k];?>" name="branch4"></td>
                        <td><input type="text" value="<?php echo $sem[$k];?>" name="sem4"></td>
                        <td><input type="text" value="<?php echo $roll[$k];?>" name="roll4"></td>
                        <td><input type="text" value="<?php echo $sap[$k]; $k++;?>" name="sap4"></td>
                        <td><input type="text" name="report4"></td>
                        <td><input type="text" name="present4"></td>
                        <td><input type="text" name="inr4"></td>
                        <td><input type="text" name="quality4"></td>
                        <td><input type="text" name="viva4"></td>
                        <td><input type="text" name="total4"></td>
                    </tr>
                    </tr>
                </tbody>
            </table><br>
         <p class="ffh">Remarks: </p><input class="finput" type="text" name="remarks" placeholder="Remarks" required="required">                     
           <br><br><p class="ffh">Acceptance: </p>
           <label for="accept" class="ffha">Accept</label>
           <input type="radio" name="accept" value="accept" id="female">
           <label for="revision" class="ffha">Accept with minor revision</label>
           <input type="radio" name="revision" value="revision" id="male">
            <label for="reject" class="ffha">Reject</label>
           <input type="radio" name="reject" value="reject" id="male"><br><br>
           <table border="1">
                <thead>
                    <tr>
                        <th>Panel Members</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Examiner 1</td>
                    <td><input type="text" name="ex1" placeholder="Examiner-1"></td>
                    <td><input type="text" name="ex1_email" placeholder="Email"></td>
                    </tr>
                    <tr>
                    <td>Examiner 2</td>
                    <td><input type="text" name="ex2" placeholder="Examiner-2"></td>
                    <td><input type="text" name="ex2_email" placeholder="Email"></td>
                    </tr>
                    <tr>
                    <td>Mentor</td>
                    <td><input type="text" name="mentor" value ="<?php $mentor_nm = fetch1(mentor, project_detail, pid, $pid); echo  $mentor_nm ; ?>"></td>
                    <td><input type="text" name="mentor_email" value="<?php echo fetch1(email, fac_detail, name, $mentor_nm)?>"></td>
                    </tr>
                    <tr>
                    <td>Activity Coordinator</td>
                    <td><input type="text" name="ac" value="<?php echo $myname; ?>"></td>
                    <td><input type="text" name="mentor_email" value="<?php echo fetch1(email, fac_detail, name, $myname)?>"></td>
                    </tr>
                    <tr>
                    <td>Program Head</td>
                    <td><input type="text" name="phead" value="<?php echo $phead_name[0]; ?>"></td>
                    <td><input type="text" name="mentor_email" value="<?php echo fetch1(email, fac_detail, name, $phead_name[0])?>"></td>
                    </tr>
                </tbody>
            </table><br>
                        <input type="Submit" value="Submit">
                </form>
                </div>
        </div>
</div>
        <br>
</body>
</html>