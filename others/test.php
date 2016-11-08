<?php
    require("../DBA_related/dbfunc.php");
    
    $conn = connect();    

    select_db();
    
    /*$res = fetchnw3(col1, col2, col3, test);

    while($row1 = mysql_fetch_array($res)) 
	{
        print_r($row1);
    }*/

    class student{
        
        var $user;
        var $pwd;

        function __construct($u, $p){
            $this->user = $u;
            $this->pwd = $p;

        }
    }

    //$stu = new student('a','c');

    $a = array('x', 'y');
    $query = "insert into student values('$a[0]', '$a[1]')";

    $res = myquery($query);

    if($res){
        echo "Data Added";
    }
?>
