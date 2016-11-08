<?php
    include("proc_data.php");
    //include("others/session.php");
    //include("DBA_related/dbfunc.php");
    
    connect();
    select_db();

    $username = $_GET['passkey'];
    $conf = $_GET['passkey1'];
    $user = check_utype($username);
    if($user==1)
        $match_conf = fetch1(confirm_code, user_detail, username, $username);
    else
        $match_conf = fetch1(confirm_code, fac_detail, username, $username);
    if($conf == $match_conf){
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to UPES Project Portal</title>
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../css/main.css" />
        <link rel="stylesheet" type="text/css" href="../css/form.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <nav class="head">
            <img src="../images/upeslogo.png">
            <div class="box">
            <a href="../index.php" class="active">Home</a>
            <a href="../pages/student_signup.php">Student Registration</a>
            <a href="../pages/faculty_signup.php">Faculty Registration</a>
            <a href="../others/about.html">About</a>
            </div>
        </nav>
    <br>   
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <br> <br>
         <section class="form1">
       <div class="formha"><h4>Password Reset</h4></div><br>
       <p class="ffh">Enter New Password:</p><input class="finput" type="password" name="password" placeholder="Your Password" required="required"><br><br>
         <input type="hidden" value="<?php echo $username?>" name="use">
             <input type="submit" name="submit" class="facsub">
             <br><br>
        <br></section>
        </form>      

<?php
    
    $password = $_POST['password'];
    $username = $_POST['use'];
    if($password != NULL || $password != "")
    {
        $r = check_utype($username);
        if($r == 1)
        {   
                $pass = md5($password);
                $query = "update login_detail set password='$pass' where username = '$username'";
                $res = myquery($query);
                if($res)
                {
                echo '<script type="text/javascript">alert("Password Updated.");</script>';                                    
                }
                else
                {
                echo '<script type="text/javascript">alert("Try again.");</script>';                                    
                }
        }
      if($r == 2)
        {
                $pass = md5($password);
                $query = "update login_detail set password='$pass' where username='$username'";
                $res = myquery($query);
                if($res)
                {
                echo '<script type="text/javascript">alert("Password Updated.");</script>';                                    
                }
                else
                {
                echo '<script type="text/javascript">alert("Try again.");</script>';                                    
                }        
        }
    }
    }
    else{
        $base = "http://localhost:13138" ;
            header("Location: $base");   
    }
    
    if((empty($username))&&(empty($conf))){
        $base = "http://localhost:13138" ;
            header("Location: $base");   
    }


?>

    </body>
</html>