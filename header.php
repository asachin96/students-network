<?php
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once('functions/functions.php');
	check_login();	
	$email=$_SESSION['email'];
	$f=0;
	$time=time();
	$query='select email from usersonline';
	$ro=mysql_query($query,$db);
	while($row=mysql_fetch_array($ro))
		if($row['email']==$_SESSION['email'])
			$f=1;
	if($f==0)
		$query="insert into usersonline(email,time) value('{$email}','{$time}')";
	mysql_query($query,$db);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>welcome to Students-Network</title>
    <meta name='description' content='This webpage is created to help students during curriculum. Signup for free and start commuinication'>
    <meta property="og:url" content="http://www.students-network.com" />
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <noscript>
    	<meta http-equiv="refresh" content="0; url=logout.php">
    </noscript>
</head>
<body>

<div class='scroll_top'>
	<a href='#full'><img src='images/scroll_top.jpg' width='25' height='25'/></a>
</div>
<div id='full' p="
	<?php
		require_once('functions/functions.php');
		$row=get_info($email);
		$path=$row['backimage'];
		echo "$path";
    ?>
">
<div class='backimg_wrap' >
	<div class='backimg_form'>
        <form action="backprocess.php" method="post" enctype='multipart/form-data'>
            <label>change background photo:<input type="file" name='image' id='im'></label>
            <input type="submit">
        </form>
    </div>
</div>
<a href='' class='bck_rm'><div class='bck_nshow'></div></a>
<div class='top_wrap'>
	<div class='top_links'><div class='sharelink'>
		<g:plusone size='small'></g:plusone>
		<script type='text/javascript'>
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	</div></div>
	<div class='top_links'><div class='sharelink'>
		<iframe src='//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.students-network.com%2Findex.php&amp;send=false&amp;layout=standard&amp;width=120&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=35' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:270px; height:20px;' allowTransparency='true'></iframe>
	</div></div>
    <div class='top_links'><a href='' id='settings'>settings</a></div>
    <div class='top_links'><a href='' class='bug' >report a bug</a></div>
    <div class='top_links'><a href="contact.php" >contactus</a></div>
    <div class='top_links'><a href="logout.php" >Signout</a></div>
 </div>
 <div class='feed'>
  <div class='feedback' style="display:none">
    <textarea id='area' rows="2"; cols="50"></textarea>
    <input type='submit' page=<?php echo $_SERVER['REQUEST_URI'];?> class='bug_class button_submit' />
  </div>
</div>
<div id="body">
<header id="header">
    <div id="mlogo">
        <div id="logo">
           <img src="images/logo.png" width="160" height="100"/>
        </div>
    </div>
   	<div id="header_sub">
        <div id="Menu">
            <ul>
            <?php
			 $cur_url=$_SERVER['REQUEST_URI'];
			      echo"<div><li class='menu_bar' p='home' align='center'><a href='index.php' class='menu_icons' id='home'>Home</a></li></div>";
			
              echo"<div><li class='menu_bar";
              		if(strpos($cur_url,'discussion')>0) echo "1'"; else echo "'";
              echo " p='Discussion_Doubt' align='center'><a href='discussion.php' class='menu_icons' id='Discussion_Doubt'>Discussion/Doubt</a></li></div>";
              			
		   	
              echo"<div><li class='menu_bar";
              if(strpos($cur_url,'mynetwork')>0) echo "1'"; else echo "'";
              echo  " p='myNetwork' align='center'><a href='mynetwork.php' class='menu_icons' id='myNetwork'>My Network</a></li>                      </div>";
			
			
               echo"<div><li class='menu_bar";
               if(strpos($cur_url,'colleges')>0) echo "1'"; else echo "'";
               echo " p='colleges1' align='center'><a href='colleges.php' class='menu_icons' id='colleges1' >Colleges</a></li>  </div>";
			
				echo"<div id='as'><li class='menu_bar'  id='menu_last'>
					<a href='#' class='menu_icons1' align='center'>Events<span id='no_events'></span></a></li>
					<div class='events_wrap' ><img src='images/waiting.gif' class='wait' width='30' height='30' /></div>
				</div>";
			?>
            </ul>
        </div>
        <div id="form"><form action="search.php" method="GET"><input class="text" type="text" id='search' value='search here..' name='query'>
        <a href='' class='search_img'><img src='images/search.jpg'  id='search_image'/></a></form></div>
    </div>
</header>