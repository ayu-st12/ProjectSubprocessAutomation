<?php
$dbpass = 'root';
$dbuser = 'root';
$dbhost = 'localhost';
$dbname = 'PPA_revisited';

//CONNECTING TO DATABASE

function connect()
	{
		$conn = mysql_connect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']);
		
		if(! $conn )
		{
		  die('Could not connect: ' . mysql_error());
          return 0;
		}
		else
		  return $conn;
	}

//SELECTING DATABASE

function select_db()
	{
	   mysql_select_db($GLOBALS['dbname']);
	}

//QUERYING THE DATABASE

function myquery($query)
    {
        $res = mysql_db_query($GLOBALS['dbname'], $query) or die ("error in connection 1".mysql_error());
        return $res;
    }

//FETCHING SINGLE ATTRIBUTE FROM A RELATION WITH A WHERE CLAUSE CONDITION

    function fetch1($col_sel, $table, $where, $cond)
	{
	    	$query = "SELECT $col_sel FROM $table where $where = '$cond'";
            $result = myquery($query);
            $value = mysql_fetch_array($result);
            return $value[$col_sel];
	}   

//FETCHING SINGLE ATTRIBUTE FROM A RELATION WITHOUT A WHERE CLAUSE CONDITION

    function fetchnw1($col_sel, $table)
	{
	    	$query = "SELECT $col_sel FROM $table";
            $result = myquery($query);
            return $result;
	}

//FETCHING TWO ATTRIBUTES FROM A RELATION WITH A WHERE CLAUSE CONDITION

    function fetch2($col_sel1,$col_sel2,$table,$where,$cond)
	{
        $query = "SELECT $col_sel1, $col_sel2 FROM $table WHERE $where = '$cond'";
        $result = myquery($query);
        return $result;
	}

//FETCHING TWO ATTRIBUTES FROM A RELATION WITHOUT A WHERE CLAUSE CONDITION

    function fetchnw2($col_sel1, $col_sel2, $table)
	{
	    	$query = "SELECT $col_sel1, $col_sel2 FROM $table";
            $result = myquery($query);
            return $result;
	}

//FETCHING THREE ATTRIBUTES FROM A RELATION WITH A WHERE CLAUSE CONDITION

    function fetch3($col_sel1,$col_sel2, $col_sel3, $table,$where,$cond)
	{
		$query = "SELECT $col_sel1, $col_sel2, $col_sel3 FROM $table WHERE $where = '$cond'" ;
        $result = myquery($query);
        return $result;
	}

//FETCHING THREE ATTRIBUTES FROM A RELATION WITHOUT A WHERE CLAUSE CONDITION

    function fetchnw3($col_sel1, $col_sel2, $col_sel3, $table)
	{
	    	$query = "SELECT $col_sel1, $col_sel2, $col_sel3 FROM $table";
            $result = myquery($query);
            return $result;
	}

//DELETE A ROW

    function delete($table, $col, $val)
	{
		$query = "DELETE FROM $table WHERE $col = '$val'";
        $result = myquery($query);
        return $result;	
	}

//ADD LOGIN DETAILS OF STUDENT

    function add_login_detail($a, $b, $c)
    {
        $c = md5($c);
        $query = "insert into login_detail values('$a','$b','$c')";
        $result = myquery($query);
        return $result;
    }

    function start($user){
        $query = "insert into start values('$user', Null)";
        $result = myquery($query);
        return $result;
    }

//ADD A STUDENT OBJECT

    function add_stu($o, $table)
    {
        if(add_login_detail($o->teamid, $o->stumail, $o->password) && start($o->stumail)){
        $query = "insert into $table values('$o->name', $o->sap, '$o->roll', '$o->teamid', '$o->stumail', '$o->branch', $o->year, $o->sem, '$o->email', '$o->stumail', '$o->gender', '$o->contact', '$o->confirm_code')";
        $result = myquery($query);
        return $result;}
    }

//ADD FACULTY OBJECT

    function add_fac($o, $table)
    {
        if(add_login_detail('faculty', $o->username, $o->pass)){
            $query = "insert into $table value('$o->name', '$o->sap', '$o->username', '$o->email', '$o->gender' , '$o->contact', '$o->confirm_code', '$o->post', '$o->branch')";
            $result = myquery($query);
            return $result;
        }    
    }

//FETCH A STUDENT OBJECT

    function fetch_stu($id, $table){
        $co = connect();
        select_db();
        $query = "select * from $table where username = '$id'";
        $result = myquery($query);
        return $result;
    }


//FETCH A FACULTY OBJECT

    function fetch_fac($id, $table){
        $co = connect();
        select_db();
        $query = "select * from $table where username = '$id'";
        $result = myquery($query);
        return $result;
    }

//echo "EOF";
?>

