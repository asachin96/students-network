<?php
	session_start();
	$seen=0;
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
    	require_once("functions/functions.php");
        $query="select * from event where seen='{$seen}' and temail='{$email}'";
        $r=mysql_query($query,$db);
        $n=mysql_affected_rows();
        if($n!=0)
        	echo "(".$n.")";
?>