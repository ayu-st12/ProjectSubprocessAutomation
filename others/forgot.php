<?php
    include("proc_data.php");
    //include("others/session.php");
    //include("DBA_related/dbfunc.php");
    
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
       <p class="ffh">Enter Your UserName:</p><input class="finput" type="email" name="email" placeholder="Your Email" required="required"><br><br>
         <input type="submit" name="Submit" class="facsub">
             <br><br>
        <br></section>
        </form>

<?php
    connect();
    select_db();
    $username = $_POST['email'];
    if($username != NULL || $username != "")
    {
        $r = check_utype($username);
        //echo $r;
        if($r == 1)
        {
            if($res = fetch1(username, login_detail, username, $username))
            {
                $conf = fetch1(confirm_code, user_detail, username, $username);
                if(send_confirm_code_pass($username, $conf))
                {
                    echo '<script type="text/javascript">alert("Mail Sent. Please Visit Your Mail to continue");</script>'; 
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("Student not found!! Please Register.");</script>';                
            }
        }
        elseif($r == 2)
        {
            if($res = fetch1(username, login_detail, username, $username))
            {
                $conf = fetch1(confirm_code, fac_detail, username, $username);
                if(send_confirm_code_pass($username, $conf))
                {
                    echo '<script type="text/javascript">alert("Mail Sent. Please Visit Your Mail to continue");</script>'; 
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("Student not found!! Please Register.");</script>';                
            }        
        }    
        else{
            echo '<script type="text/javascript">alert("Invalid Email");</script>';
        }
       }


?>
</body>
</html>