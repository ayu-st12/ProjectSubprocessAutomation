<?php

    include("../DBA_related/dbfunc.php");

    function check_utype($username){
        if(strpos($username,'stu.upes.ac.in')==TRUE && $username!=NULL) {
        $is_student = 1;
        return $is_student;
        }
        if(strpos($username,'ddn.upes.ac.in')==TRUE && $username!=NULL) {
        $is_faculty = 2;
        return $is_faculty;
        }
    }

    function if_stud_exists($username,$password){
        $exists = 0;
        $connection = connect();
        select_db();
        $res = fetch2(username, password, login_detail, username, $username);
        $row1 = mysql_fetch_array($res); 
	    if(($username == $row1[username]) && ($password == $row1[password])){
            $exists = 1;
            return $exists;
        }
        else
            return $exists;
        }

    function if_stud_user_exists($username){
        $exists = 0;
        $connection = connect();
        select_db();
        $res = fetch2(username, login_detail, username, $username);
        $row1 = mysql_fetch_array($res); 
	    if(($username == $row1[username])){
            $exists = 1;
            return $exists;
        }
        else
            return $exists;
        }

    function if_fac_exists($username,$password){
        $exists = 0;
        $co = connect();
        select_db();
        $res = fetch2(username, password, login_detail, username, $username);
        $row1 = mysql_fetch_array($res); 
	    if(($username == $row1[username]) && ($password == $row1[password])){
            $exists = 1;
            return $exists;
        }
        else
            return $exists;
        }

    function if_fac_user_exists($username){
        $exists = 0;
        $co = connect();
        select_db();
        $res = fetch2(username,login_detail, username, $username);
        $row1 = mysql_fetch_array($res); 
	    if(($username == $row1[username])){
            $exists = 1;
            return $exists;
        }
        else
            return $exists;
        }

    function check_pass($p){
        if((strlen($p))<8)
            { echo "fpass";
            return 1;}
        else
            return 0;
    }

    function check_ys($y, $s){
        
        if($y==2){
            if(($s==3) || ($s==4))
                return 0;
            else{ 
                echo '<script type="text/javascript">alert("FOR 2ND YEAR, STUDENT MUST BE IN 3RD AND 4TH SEM");</script>';
                return 1;
            }
        }

        if($y==3){
            if(($s==5) || ($s==6))
                return 0;
            else{ 
                echo '<script type="text/javascript">alert("FOR 3RD YEAR, STUDENT MUST BE IN 5TH AND 6TH SEM");</script>';
                return 1;
            }
        }

        if($y==4){
            if(($s==7) || ($s==8))
                return 0;
            else{ 
                echo '<script type="text/javascript">alert("FOR 4TH YEAR, STUDENT MUST BE IN 7RD AND 8TH SEM");</script>';
                return 1;
            }
        }
    }

    function check_stuobj($s){
        $Esap=$Econt=$EteamID=$fid=$Estumail=$Ename=$Eemail=$Erolln=$fys=0;
        $sap = $s->sap;
        $SAP = (string)$sap;
        $stumail = (string)$s->stumail;
        $rolln = $s->roll;
        if(!preg_match("/^[a-zA-Z\s]+$/",$s->name) || (strlen($s->name))<3)
        {
            $Ename = 1;
            echo '<script type="text/javascript">alert("Only Alphabets allowed in name(Min: 3 Characters)!");</script>';
        }

        if((strlen($s->sap))!=9 || $SAP[0]!=5 || $SAP[1]!=0 || $SAP[2]!=0 || $SAP[3]!=0 || !preg_match("/^[0-9]*$/",$s->sap))
        {
            $Esap = 1;
            echo '<script type="text/javascript">alert("Enter SAP Correctly!");</script>';
        }

        if((strlen($s->teamid))>10 || !preg_match("/^[a-zA-Z0-9]*$/",$s->sap))
        {   
            //echo "in StuMail";
            $EteamID = 1;
            echo '<script type="text/javascript">alert("Enter TeamID Correctly(Max length: 10 and Alphanumeric only)!");</script>';
        }

        if((!filter_var($s->stumail, FILTER_VALIDATE_EMAIL))||(check_utype($s->stumail)!=1))
        {
            ///echo "in StuMail";
            $Estumail = 1;
            echo '<script type="text/javascript">alert("Enter student Email ID Correctly!");</script>';
        }

        if(($rolln[0]!='R') || (strlen($rolln)!=10 ))
        {
           
            $Erolln = 1;
            echo '<script type="text/javascript">alert("Enter Roll no. Correctly(Ex; R###..)!");</script>';
        }

        if(strlen($s->contact)!=10)
        {
            
            $Econt = 1;
            echo '<script type="text/javascript">alert("Enter Contact Correctly!");</script>';
        }

        if(!filter_var($s->email, FILTER_VALIDATE_EMAIL))
        {
            
            $Eemail = 1;
            echo '<script type="text/javascript">alert("Enter Email Correctly!");</script>';
        }

        if($Ename == 0 && $Esap == 0 && $EteamID == 0 && $Estumail == 0 && $Erolln == 0 && $Eemail == 0 && $Econt ==0 )
        {
            return 0;
        }
        else{
            return 1;
        }
    }

    function create_confirm_code(){
    $code = "";
    $length = 16;
    $code = substr(str_shuffle(md5(time())),0,$length);
    return $code;
    }
 
    function generate_pid(){
    $code = "";
    $length = 8;
    $code = substr(str_shuffle(md5(time())),0,$length);
    return "P".$code;  
    }

    function send_confirm_code($email, $conf){
        // send e-mail to ...
        $to=$email;
        // Your subject
        $subject="Your confirmation link here";
        // From
        $header = "From:admin@ishan.com \r\n";
        // Your message
        $message = "Hello Ayush\n You have successfully registered with UPES Project Portal \n Please visit the link below to confirm your account";
        $message.="Your Comfirmation link \r\n";
        $message.="Click on this link to activate your account \r\n";
        $message.="http://localhost:13138/others/confirmation.php?passkey=$conf&passkey1=$email";   //HOPE YOU CAN!
        // send email
        $sentmail = mail($to,$subject,$message,$header);
        
        if($sentmail==1){
            return 1;
        }
        else{
            return 0;
        }
    }
    send_confirm_code();
    
    function send_confirm_code_title($email, $pid, $conf){
        $to=$email;
        $subject="Title Approval";
        $header = "From:admin@ishan.com \r\n";
        $message="Your Comfirmation link \r\n";
        $message.="Click on this link to activate your account \r\n";
        $message.="http://localhost:13138/others/confirmation.php?passkey=$conf&passkey1=$pid";  
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail==1){
            return 1;
        }
        else{
            return 0;
        }
    }

    function send_confirm_code_abstract($email, $pid, $conf){
        $to=$email;
        $subject="Abstract Approval";
        $header = "From:admin@ishan.com \r\n";
        $message="Your Comfirmation link \r\n";
        $message.="Click on this link to activate your account \r\n";
        $message.="http://localhost:13138/others/confirmation.php?passkey=$conf&passkey1=$pid"; 
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail==1){
            return 1;
        }
        else{
            return 0;
        }
    }

    function seteval($teamid){
        
        $date = getdate();
        $month = $date['month'];
        $year = $date['year'];

        $pid = fetch1(pid, project_team_info, teamid, $teamid);
        $mentor = fetch1(mentor, project_detail, pid, $pid);
        $mentor_email = fetch1(username, fac_detail, name, $mentor);
        
        $co = connect();
        select_db();

        $query =  "insert into monthly_eval values('$pid','$teamid',1,'$month',$year)";
        $result = myquery($query);

        if(send_meval($mentor_email, $pid)){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    function send_meval($email, $pid){
        $to=$email;
        $subject="Monthly Evaluation";
        $header = "From:admin@ishan.com \r\n";
        $message="Your Comfirmation link \r\n";
        $message.="Click on this link to evaluate the project\r\n";
        $message.="http://localhost:13138/others/meval_form.php?passkey=$pid"; 
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail==1){
            return 1;
        }
        else{
            return 0;
        }
    }

    function check_facobj($s){
        $Esap=$Econt=$EteamID=$fid=$Estumail=$Ename=$Eemail=$Erolln=$fys=0;
        $sap = $s->sap;
        $SAP = (string)$sap;
        $stumail = (string)$s->username;
        $rolln = $s->rollno;
        if(!preg_match("/^[a-zA-Z\s]+$/",$s->name) || (strlen($s->name))<3)
        {
            $Ename = 1;
            echo '<script type="text/javascript">alert("Alphabets allowed only in name(Min: 3 Characters)!");</script>';
        }

        if((strlen($s->sap))!=8 || $SAP[0]!=4 || $SAP[1]!=0 || $SAP[2]!=0 || $SAP[3]!=0 || !preg_match("/^[0-9]*$/",$s->sap))
        {
            $Esap = 1;
            echo '<script type="text/javascript">alert("Enter SAP Correctly!");</script>';
        }

        if((!filter_var($s->username, FILTER_VALIDATE_EMAIL) )||(check_utype($s->username)!=2))
        {
            ///echo "in StuMail";
            $Estumail = 1;
            echo '<script type="text/javascript">alert("Enter faculty Email ID Correctly!");</script>';
        }

        if(strlen($s->contact)!=10)
        {
            
            $Econt = 1;
            echo '<script type="text/javascript">alert("Enter Contact Correctly!");</script>';
        }

        if($Ename == 0 && $Esap == 0 && $Estumail == 0 && $Econt ==0 )
        {
            return 0;
        }
        else{
            return 1;
        }

    }

    function send_message($t, $m, $u){
        if($t == "all"){
            $pd = array();
            $myname = fetch1(name, fac_detail, username, $u);
            
            $query = "select pid from project_detail where mentor = '$myname'";
            $result = myquery($query);
            while($value = mysql_fetch_array($result)){
                array_push($pd, $value);
            }
            for($i=0;$i<count($pd);$i++){
                $a = $pd[$i][0];
                $query1 = "insert into messages values('$a', '$m', '$u', NULL)";
                $result1 = myquery($query1);
            }
            return $result1;
        }
        else{
                $query = "insert into messages values('$t', '$m', '$u', NULL)";
                $result = myquery($query);
                return $result;
        }
    }
?>