<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	if(isset($_COOKIE['ln'])){
		$email=$_COOKIE['nm'];
		$query="select password from details where email='$email'";
		$s=mysql_query($query);
		$row=mysql_fetch_array($s);
		$pass=$row['password'];
		$redirect=$_POST['redirect'];
		$cook=$pass+$email;
		$cook=sha1($cook);
		echo $redirect;
		if($cook==$_COOKIE['ln']){	
			header("location:".$redirect);
			exit;
		}
	}
?><!doctype html>
<html>
    <head>
    <title>welcome to Students-Network</title>
    <meta name='description' content='This webpage is created to help students during curriculum. Signup for free and start cummuinicating'>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/login.css" />
	<link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>  
	<link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'>    
    </head>   
    <body>
    <div class='full_wrap'>
        <div class='login_top'>
            <div class='login_wrap'>
                <form action='loginenter.php' method='post'>
	           	   <div class='login_heading'>user login</div>
                   <label>email-address:<br/><input type='text' name="email" class='morewidth login_email' value=
											                   "<?php
											                   	if(isset($_GET['email']))
											                   		echo $_GET['email'];
											                   ?>"/><br/></label>
                   <input type="hidden" value="<?php 
                   					$redirect="index.php";
              						if(isset($_GET['redirect']))
								$redirect=$_GET['redirect'];
	                   				echo $redirect;
                   				?>" name="redirect">
                   <label>password:<br/><input type='password' name="password" class='morewidth login_password'/><br/></label>
                   <div class='login_button'><input type='submit' name='submit' value='login' class='login_submit button_submit'/> 
                   <span class='login_rem'>remember me<input type='checkbox' name='remember'/></span></div>
                   <label><a href='signup.php'>signup</a></label>
                   <label><span class='frgpwd'><a href='forgot1.php'>forgot password?</a></span></label>
                   <?php
				   if(isset($_GET['p']))
				   		echo"<span class='login_error'>username/password is not correct</span>";
                   ?>
                   <span class='p_error'></span>
                 </form>
             </div>
         </div>
        <div class='login_down'>
	        <div class='logo_down'><span class='logo_first'>students</span><img src='images/rotating.gif'/><span class='logo_last'>network</span>
        	<div class='theme'>Networking Redefined</div>
        </div>
        </div>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/login.js'></script>
    </body>
</html>
 