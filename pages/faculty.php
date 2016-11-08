<?php

class faculty{
    var $name;
    var $sap;
    var $username;
    var $email;
    var $gender;
    var $contact;
    var $confirm_code;
    var $pass;
    var $post;
    var $branch;
      
    function __construct($n, $s, $u, $e, $g, $c, $p, $pst, $br){
        $this->name = $n;
        $this->sap = $s;
        $this->username = $u;
        $this->email = $e;
        $this->gender = $g;
        $this->contact = $c;
        $this->pass = $p;
        $this->post = $pst;
        $this->branch = $br;
    }

    function set_code($conf){
        $this->confirm_code = $conf;
    }

}

?>