
<?php

class student{
    var $name;
    var $sap;
    var $roll;
    var $teamid;
    var $branch;
    var $year;
    var $sem;
    var $email;
    var $stumail;
    var $gender;
    var $contact;
    var $confirm_code;
    var $password;

 function __construct($n, $sp, $r, $b, $y, $s, $e, $st, $g, $c, $p)
{
    $this->name = $n;
    $this->sap = $sp;
    $this->roll = $r;
    $this->branch = $b;
    $this->year = $y;
    $this->sem = $s;
    $this->email = $e;
    $this->stumail = $st;
    $this->gender = $g;
    $this->contact = $c;
    $this->password = $p;
}

function set_code($conf){
    $this->confirm_code = $conf;
}

function set_tid($tid){
    $this->teamid = $tid;
}
}

/*$stu = new student('a',1,'c','d','e','F',2,3,'i','j','k','l','m');
print_r($stu);

$c = connect();
select_db();
$add = 0;
$add = add_stu($stu);

if($add)
echo "data added";*/
?>