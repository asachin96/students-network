<?php 
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once("functions/functions.php");
	if(!isset($_GET['y'])){
	$email=$_POST['email'];
	$query="select question,answer from details where email='$email'";
	$p=mysql_query($query,$db);
	if(mysql_affected_rows()==0)
	 header("location:forgot1.php?x=1");}
    ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>step 2</title>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/login.css" />
    <link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'> 
</head>

<body>
<div class='login_top'>
    <div class='login_wrap'>
<?php
        if(!isset($_GET['y']))
	$email=$_POST['email'];
	else
	  $email=$_GET['email'];
	$query="select question,answer from details where email='$email'";
	$p=mysql_query($query,$db);
		$row=mysql_fetch_array($p);
		$q=$row['question'];
		$ans=$row['answer'];
	echo" <form action='forgot3.php?z=1&email=$email' method='post'>
	       	     <div class='login_heading'>step 2</div>
				<label>your question: <div id='ques'>$q</div><br/></label>
				<label>answer:<br/><br/><input type='text' name='answer' class='morewidth' autocomplete='off'></label>
				<input type='hidden' value='$email' name='email'/>
		   		<input type='submit' class='button_submit'>
			</form>";
	
?>
	</div>
</div>
<div class='login_down'>
   <div class='logo_down'><span class='logo_first'>students</span><img src='images/rotating.gif'/><span class='logo_last'>network</span></div>
</div>
<?php
if(isset($_GET['y'])){
	echo "<div id='message' class='email_error'>the answer you have entered is wrong</div>";
}
?>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/login.js'></script>
</body>
</html>