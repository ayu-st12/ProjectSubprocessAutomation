<?php
    
//    include("../others/detailed_fachead.php");
    include("../others/session.php");
    include("../others/proc_data.php");
    //include("../DBA_related/dbfunc.php");

    $s = $_GET['success'];

    session_begin();
    $user = session_resume();
    if(empty($user))
    {
            $base = "http://localhost:13138" ;
            header("Location: $base");
    }
    connect();
    select_db();
    $myname = fetch1(name, fac_detail, username, $user);
    static $i=0;
    $set=0;
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
        <div class="hbox"><h3>Evaluation(s) Applied: </h3></div>
                <div class="sbox"><br>

        <?php
            $name = fetch1(name, fac_detail, username, $user);
            $query = "select pid from project_detail where mentor = '$name'";
            $result = myquery($query);
            $p = array();
            while($value = mysql_fetch_row($result))
            {
                //echo "value";print_r($value);
                foreach ($value as $a)
                {
                $query1 = "select * from monthly_eval where pid = '$a' and status = 1";
                $result1 = myquery($query1);
                while($value1 = mysql_fetch_array($result1)) 
                    array_push($p, $value1); 
                } 
            }
            //echo(count($p));         
            if($p)
            { $set=1; ?> 
                <table border="1">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>PID</th>
                            <th>Project Title</th>
                            <th>Teamid</th>
                            <th>Month</th>
                            <th>Evaluate?</th>
                        </tr>
                    </thead>
            <?php
                for($x=0;$x<count($p);$x++)
                {
                        //echo "Hello".$i;
                        $title = fetch1(ptitle, project_detail, pid, $p[$i]['pid']);
                        ?>
                    <tbody>
                        <tr>
                            <td><?php echo ++$i;?></td>
                            <td><?php echo $p[$x]['pid']; ?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $p[$x]['teamid'];?></td>
                            <td><?php echo $p[$x]['month'];?></td>
                            <td><a href = "http://localhost:13138/others/meval_form.php?passkey=<?php echo $p[$x]['pid']; ?>&passkey1=<?php echo $p[$x]['teamid'];?>"><input type=submit value=Evaluate></a></td>
                        </tr>
                    </tbody>
                        <?php
                }
            ?>
                </table><br></div>
            <?php
            }
            if($set==0){
                ?><div class="tbox"><h3>No New Evaluations Applied</h3></div><?php
            }

        if($s)
            echo '<script type="text/javascript">alert("Monthly Evaluation Submitted");</script>';
        ?>
    </div>
    </body>
</html>
