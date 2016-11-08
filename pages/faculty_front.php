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