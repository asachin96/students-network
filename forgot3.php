<?php 
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once("functions/functions.php");
    
 ?>
<?php
	if($_SERVER['HTTP_REFERER']!="http://students-network.com/forgot2.php"){
		header("location:login.php");
		exit();
	}
	if(isset($_GET['z'])&& ($_GET['z']!=0) ){
	$ans=$_POST['answer'];
	$email=$_POST['email'];
	$query="select answer from details where email='$email'";
	$s=mysql_query($query,$db);
	$row=mysql_fetch_array($s);
	$answer=$row['answer'];
	if($answer!=$ans) {   
		header("location:forgot2.php?y=1&email=$email");
		exit(); }
	}
			
?>


<!DOCTYPE HTML>

<html>

<head>
    <meta charset="utf-8">
    <title>step 3</title>
   <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/login.css" />
    <link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'> 
</head>
<body>
<div class='login_top'>
    <div class='login_wrap'>
	<?php
		 if(isset($_GET['z'])&& ($_GET['z']!=0) ){
			$ans=$_POST['answer'];
			$email=$_GET['email'];
			$query="select answer from details where email='$email'";
			$s=mysql_query($query,$db);
			$row=mysql_fetch_array($s);
			$answer=$row['answer'];
			if($answer==$ans){
				echo"<form action='forgot_process.php' method='post'>
	       	     <div class='login_heading'>step 3</div>
				<label>enter new-password:<input type='text' name='pass1' id='pass' class='morewidth' autocomplete='off'><div id='p'></div></label>
				<label>re-enter your new-password:<input type='text' name='pass2' class='morewidth' autocomplete='off'></label>
				<input type='hidden' value='$email' name='email'/>
				<label><input type='submit' class='button_submit pos_set'></label>";
			}
			
        }
        else{
            $email=$_POST['email'];
            echo"<form action='forgot_process.php' method='post'>
	       	     <div class='login_heading'>step 3</div>
				<label>enter new-password:<input type='text' name='pass1'  class='morewidth' autocomplete='off'></label>
				<label>re-enter your new-password:<input type='text' name='pass2' class='morewidth' autocomplete='off'></label>
				<input type='hidden' value='$email' name='email'/>
				<label><input type='submit' class='button_submit pos_set'></label>";
            echo "<div class='email_error1'>password did not match</div>";
        }
    ?>
	</div>
</div>
<div class='login_down'>
   <div class='logo_down'><span class='logo_first'>students</span><img src='images/rotating.gif'/><span class='logo_last'>network</span></div>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/login.js'></script>
</body>
</html>