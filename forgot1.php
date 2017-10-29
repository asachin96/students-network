<?php 
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
    
 ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>step 1</title>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/login.css" />
    <link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'>    
</head>

<body>
<div class='login_top'>
    <div class='login_wrap'>
        <form action='forgot2.php' method='POST'>
       	     <div class='login_heading'>step 1</div>
             <label>enter your email:<br/><br/><input type='email' name='email' class="morewidth" ></label>
             <input type='submit' class="button_submit " >
        </form>
	</div>
</div>
<div class='login_down'>
   <div class='logo_down'><span class='logo_first'>students</span><img src='images/rotating.gif'/><span class='logo_last'>network</span></div>
</div> 
 <?php
 if(isset($_GET['x'])){
 echo"<div class='email_error'>the email you have entered is not valid</div>";
 }
 ?>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/login.js'></script>
</body>
</html>