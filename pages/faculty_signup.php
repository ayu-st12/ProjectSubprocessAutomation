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
            <a href="../pages/student_signup.php">Student Registration</a>
            <a href="../pages/faculty_signup.php" class="active">Faculty Registration</a>
            <a href="../others/about.html">About</a>
            </div>
        </nav>
    <br>

        <h1 class="title">Faculty Signup</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <section class="sectionaf">
       <div class="formha"><h4>Account Details</h4></div>
   <p class="ffh">Name:</p><input class="finput" type="text" name="name" placeholder="Your Name" required=required>
   <span class="error"><?php echo $nameErr;?></span>
   <br><br>

  
   <p class="ffh">Institute Email: (This will be your Username)</p><input class="finput" type="email" name="email" placeholder="someone@ddn.upes.ac.in" required="required">
   <span class="error"><?php echo $emailErr;?></span>
    <br><br>

   <p class="ffh">Password: </p><input type="password" class="finput" name="password" placeholder="Min. 8 characters" required="required">
   <span class="error"><?php echo $passwordErr;?></span>
   <br><br>
        
    <p class="ffh">SAP ID: </p><input class="finput" type="number" name="sap" placeholder="SAP ID" required="required">
   <span class="error"><?php echo $sapErr;?></span>
   <br><br>
   <p class="ffh">Gender: </p>
   <label for="female" class="ffha">Female</label>
   <input type="radio" name="gender" value="female" id="female">
   <label for="male" class="ffha">Male</label>
   <input type="radio" name="gender" value="male" id="male">
   <span class="error"><?php echo $genderErr;?></span>
   <br><br>

   <p class="ffh">Contact No.: </p><input class="finput" type="number" name="contact" placeholder="Contact No." required="required">
   <span class="error"><?php echo $contactErr;?></span>
   <br><br>
    <p class="ffh">Post and Branch: </p>
    <select name="post" id="post" oninput="getpost()">
    <option value="mentor">Mentor</option>
    <option value="ac">AC</option>
    <option value="program head">Program Head</option>
    </select>
    
    <select name="branch" required="required" id="branch" disabled="disabled">
        <option value="select"> Select Branch </option>
        <option value="B.Tech Computer Science & Engineering with specialization in Graphics and Gaming in association with IBM"> B.Tech Computer Science & Engineering with specialization in Graphics and Gaming in association with IBM </option>
        <option value="B.Tech Computer Science & Engineering with specialization in IT Security & Cyber Forensics in association with IBM"> B. Tech Computer Science & Engineering with specialization in IT Security & Cyber Forensics in association with IBM </option>
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

    <script type="text/javascript">
        function getpost() {
            var pst = document.getElementById('post');
            var p = pst.options[pst.selectedIndex].value;
            if ((p == "program head") || (p == "ac")) {
                var branch = document.getElementById('branch');
                branch.disabled = "";
            }
            else {
                var branch = document.getElementById('branch');
                branch.disabled = "disabled";
            }
        }
    </script>
        <br><br>
   <input type="submit" name="submit" value="Submit" class="facsub"><br><br>
        </section>
</form>
</body>
</html>

<?php 
    
    $nam = $_POST['name'];
    $con = $_POST['contact'];
    
    if($nam && $con){
        $br = $_POST['branch'];
        if(empty($br))
            $br = NULL;
        $fac = new faculty($_POST['name'], $_POST['sap'], $_POST['email'], $_POST['email'], $_POST['gender'], $_POST['contact'], $_POST['password'], $_POST['post'], $br);
        $fac->set_code(create_confirm_code());

        $res = check_facobj($fac);
        
        if($res == 1)
         {}
        else
        {
            //echo "Voila";
        
            $c = connect();
            select_db();
            $add = add_fac($fac, temp_fac_detail);
            if($add)
            {
                echo '<script type="text/javascript">alert("Thank You for Registration Please visit your UPES mail to continue");</script>'; //put a javascript message here
                if(send_confirm_code($fac->email, $fac->confirm_code)){
                    //echo "Mail Sent Successfully";
                    $base = "http://localhost:13138";
                    header("Location: $base");
                } //mailing function
                else 
                    echo '<script type="text/javascript">alert("Registeration Error Please try again");</script>';
            }

        else
            echo "Data not Added Successfully";
        }
        
    }
?>