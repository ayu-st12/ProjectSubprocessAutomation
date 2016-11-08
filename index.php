<?php
    chdir('others');
    include(getcwd()."/proc_data.php");
    include(getcwd()."/session.php");
    //include("DBA_related/dbfunc.php");
    chdir('../');
    session_begin();
    $s = session_resume();
    if(!empty($s))
    {
        $user = check_utype($s);
        if($user == 1){
            $base = "http://localhost:13138/pages/student_front.php" ;
            header("Location: $base");
        }
        elseif($user == 2){
            $base = "http://localhost:13138/pages/faculty_front.php" ;
            header("Location: $base");
        }
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to UPES Project Portal</title>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    </head>
    <body>
        
        <nav class="head">
            <img src="images/upeslogo.png">
            <div class="box">
            <a href="../index.php" class="active">Home</a>
            <a href="../pages/student_signup.php">Student Registration</a>
            <a href="../pages/faculty_signup.php">Faculty Registration</a>
            <a href="../others/about.html">About</a>
            </div>
        </nav>
    <br>
        
       <div class="form"> 
           <div class="header"><h4>Sign in</h4></div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="email" name="signin" placeholder="Username" required="required">
                <br>
            <input type="password" name="pass" placeholder="Password" required="required">
                <br>
            <input type="submit" value="Submit" name="Submit">
            </form>
           <div class="bottom"><a href="others/forgot.php">Forget Password?</a></div>
        </div>
    </body>
</html>
<?php 
    $un = $_POST['signin']; // Username of the User
    $pwd = $_POST['pass'];  // Password of the User
    $pwd = md5($pwd);
    $type = 0;
    if($un && $pwd){
        $type = check_utype($un);
        if($type==1)
            {
                $ex = if_stud_exists($un,$pwd);
                if($ex){
                    session_set($un);
                    $base = "http://localhost:13138/pages/student_front.php";
                    header("Location: $base");
                }
                else
                    echo '<script type="text/javascript">alert("Enter Correct Username or Password!");</script>';
            }
        
        else if($type==2)
            {
                $ex = if_fac_exists($un,$pwd);
                if($ex){
                    session_set($un);
                    $who = fetch1(post, fac_detail, username, $un);
                    if($who == "mentor"){
                        $base = "http://localhost:13138/pages/faculty_front.php" ;
                        header("Location: $base");
                    }
                    else if($who == "ac"){
                        $base = "http://localhost:13138/pages/ac_front.php" ;
                        header("Location: $base");
                    }
                    else if($who == "program head"){
                        $base = "http://localhost:13138/pages/phead_front.php" ;
                        header("Location: $base");
                    }
                }
                else
                    echo '<script type="text/javascript">alert("Enter Correct Password!");</script>';
            }
        else
            echo '<script type="text/javascript">alert("Enter Correct Username(Institute Email ID)!");</script>';
    }   

?>
