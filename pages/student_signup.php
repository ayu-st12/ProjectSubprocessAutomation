<?php
    
    include("../others/proc_data.php");
    include("/DBA_related/dbfunc.php");
    include_once("student.php");

    function __autoload($className) { 
      if (file_exists($className . '.php')) { 
          require_once $className . '.php'; 
          return true; 
      } 
      return false; 
    }     
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
            <div class="box">
            <a href="../index.php">Home</a>
            <a href="../pages/student_signup.php" class="active">Student Registration</a>
            <a href="../pages/faculty_signup.php">Faculty Registration</a>
            <a href="../others/about.html">About</a>
            </div>
        </nav>
    <br>

        <h1 class="title">Student Signup</h1>

        <form method="post" name = "stu_signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <br> <br>

    
   <section class="sectiona">
       <div class="formha"><h4>Account Details</h4></div>
   <p class="ffh">Name:</p><input class="finput" type="text" name="name" id="name" placeholder="Your Name" required="required">
   <span class="error"><?php echo $nameErr;?></span>
   <br><br>
    
   <p class="ffh">SAP ID: </p><input class="finput" type="number" name="sap" placeholder="SAP ID" required="required" onkeypress="validateSAP()">
   <span class="error"><?php echo $sapErr;?></span>
   <br><br>

   <p class="ffh">Team ID: </p><input class="finput" type="text" name="teamid" placeholder="Max. 10 characters" required="required" onkeypress="validateTeamID()">
   <span class="error"><?php echo $teamidErr;?></span>
   <br><br>

   <p class="ffh">Institute Email: (This will be your Username)</p><input class="finput" type="email" name="stumail" placeholder="someone@stu.upes.ac.in" required="required">
   <span class="error"><?php echo $stumailErr;?></span>
    <br><br>

   <p class="ffh">Password: </p><input type="password" class="finput" name="password" placeholder="Min. 8 characters" required="required">
   <span class="error"><?php echo $passwordErr;?></span>
   <br><br>
    </section>

    
    <section class="sectionb">
    <div class="formho"><h4>Other Details</h4></div>    
    <p class="ffh">Roll No.: </p><input class="finput" type="text" name="rollno" placeholder="Roll No." required="required">
   <span class="error"><?php echo $rollErr;?></span>
   <br><br>

   <p class="ffh">Email: </p><input class="finput" type="email" name="email" placeholder="someone@example.com" required="required">
   <span class="error"><?php echo $emailErr;?></span>
   <br><br>

       <p class="ffh">Branch/Year/Semester: </p><br>
    <select name="branch" required="required">
        <option value="select"> Select Branch </option>
        <option value="B.Tech Computer Science & Engineering with specialization in Graphics and Gaming in association with IBM"> B.Tech Computer Science & Engineering with specialization in Graphics and Gaming in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with specialization in IT Security & Cyber Forensics in association with IBM"> B.Tech Computer Science & Engineering with specialization in IT Security & Cyber Forensics in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Banking, Financial Services and Insurance in association with IBM">B.Tech Computer Science & Engineering with Specialization in Banking, Financial Services and Insurance in association with IBM</option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Business Analytics and Optimization in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Business Analytics and Optimization in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Cloud Computing & Virtualization Technologies in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Cloud Computing & Virtualization Technologies in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with specialization in E-Commerce, Retail & Automation in association with IBM"> B.Tech Computer Science & Engineering with specialization in E-Commerce, Retail & Automation in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Healthcare Informatics in Association with IBM"> B.Tech Computer Science & Engineering with Specialization in Healthcare Informatics in Association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in IT Infrastructure in Association with IBM"> B.Tech Computer Science & Engineering with Specialization in IT Infrastructure in Association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Mainframe Technology in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Mainframe Technology in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Manufacturing Systems in Association with IBM"> B.Tech Computer Science & Engineering with Specialization in Manufacturing Systems in Association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Oil & Gas Informatics in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Oil & Gas Informatics in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Open Source & Open Standards in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Open Source & Open Standards in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with Specialization in Telecom Informatics in association with IBM"> B.Tech Computer Science & Engineering with Specialization in Telecom Informatics in association with IBM </option>
    </select>

    <select name="year" required="required">
        <option value="select"> Select Year </option>
        <option value="2"> 2 </option>
        <option value="3"> 3 </option>
        <option value="4"> 4 </option>
     </select>
 
    <select name="sem" required="required">
        <option value="select"> Select Sem </option>
        <option value="3"> 3 </option>
        <option value="4"> 4 </option>
        <option value="5"> 5 </option>
        <option value="6"> 6 </option>
        <option value="7"> 7 </option>
        <option value="8"> 8 </option>
    </select>
    <br><br>

   <p class="ffh">Gender: </p>
   <label for="female" class="ffha">Female</label>
   <input type="radio" name="gender" value="female" id="female">
   <label for="male" class="ffha">Male</label>
   <input type="radio" name="gender" value="male" id="male">
   <span class="error"><?php echo $genderErr;?></span>
   <br><br>

   <p class="ffh">Contact No.: </p><input class="finput" type="number" name="contact" placeholder="Contact No." pattern="[0-9]{10}" required="required">
   <span class="error"><?php echo $contactErr;?></span>
   <br><br>
    </section>
   <input type="submit" name="submit" value="Submit" class="fsub"> 
</form>
        
    </body>
</html>

<?php 
    
    $nam = $_POST['name'];
    $con = $_POST['contact'];
    $bra = $_POST['branch'];
    $sm = $_POST['sem'];
    $yr = $_POST['year'];

    if($nam && $con && $bra && $sm && $yr){
        $stu = new student($_POST['name'], $_POST['sap'], $_POST['rollno'], $_POST['branch'], $_POST['year'], $_POST['sem'], $_POST['email'], $_POST['stumail'], $_POST['gender'], $_POST['contact'] ,$_POST['password']);
        $stu->set_tid($_POST['teamid']);
        $stu->set_code(create_confirm_code());
    
    $res = check_stuobj($stu);
    
    if($res == 1)
        {}
    else
    {
        //echo "Voila";
        $c = connect();
        select_db();
        if(add_stu($stu, temp_user_detail) && send_confirm_code($stu->stumail, $stu->confirm_code))
            {
                    echo '<script type="text/javascript">alert("Thank You for Registration Please visit your Student mail to continue");</script>'; //put a javascript message here
                    $base = "http://localhost:13138";
                    header("Location: $base");
            }

        else
            echo '<script type="text/javascript">alert("Registeration Error Please try again");</script>';
            
    }
    
}
?>