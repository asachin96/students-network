<?php

session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
include("functions/functions.php");
    echo"   <ul id='sub'>
            <h4>My Network</h4>";
				$email=$_SESSION['email'];
				$query="select friend from network where email='{$email}' ";
				$s=mysql_query($query,$db);
				while($row=mysql_fetch_array($s)){
					$friend=$row['friend'];
					$values=get_info($friend);
					$network_email=$values['email'];
					$name=$values['firstname'];
					$src=$values['path'];
					$college=$values['college'];
					echo"<li><img src='{$src}' width='30' height='30' class='network_image'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href='' class='network_name' email='{$network_email}'>{$name},{$college}</a>";
				}
		echo"</ul>
        <a href='#' >manage mynetworks</a>";
?>