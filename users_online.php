<?php
	session_start();
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
    	require_once("functions/functions.php");
        $query="select * from network where email='{$email}'";
        $r=mysql_query($query,$db);
        while($row=mysql_fetch_array($r)){
        	$femail=$row['friend'];
        	$query="select * from online where email='{$femail}'";
        	$r1=mysql_query($query,$db);
        	$p=mysql_affected_rows();
        	$query="select * from update_com where email='{$femail}'";
        	$r1=mysql_query($query,$db);
        	$q=mysql_affected_rows();
        	if($p>0&&$q==0){
        		$details=get_info($femail);
        		$src=$details['path'];
        		$name=$details['firstname'];
        		$college=$details['college'];
        		$ref=$_SERVER['HTTP_REFERER'];
        		echo"<li class='net_wrap online_ur' email='{$femail}' ref='$ref' style='cursor:pointer;'>
				  <div>
					  <div class='network_image'><img src='{$src}' width='25' height='22'/></div>
					  <div class='network_names'>$name,$college</div>
				  </div>
			  </li>";
        	}
        }
    ?>