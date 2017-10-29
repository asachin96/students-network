<?php	
	require_once("header.php");
	$email=$_SESSION['email'];
	require_once("functions/functions.php");
?>

<div class="outline_wrapper">
<div id='middle1'>
	<div id="goal">
    		This site is created to help students during their academics
	</div>
    	<div class='panel'>
    		our team
   	</div>
	<div class="sachin">
	        <div class='sachin_post'><span class='sachin_name'>Sachin A</span>,Designer and Developer at students-network.com</div>
	    	<div class='sachin_img'><img src="images/sachin.jpg" width="200" height='300'></div>
	        <div class='sachin_myself'><pre>
Hey guys we have been working on this website for about 8 months.Hope it reaches the level we expected.
Yeah nobody can be 100% perfect, even though i have attempted work very carefully, there may be some flaws and bugs. 
We are always ready to hear both positive and negative feedbacks and both are appreciated. We hope you people enjoy this.
Lastly I would like to thank all people who were involved in this wonderful journey.

Technical skills:
Expertise in using PHP, Mysql, Jquery, css, HTML, C, C++ and currently learning Java.

Contact details:
email:asachin96@yahoo.in  and  ph-no:+91-889-225-7027</pre>
	        </div>
	</div>
    	<div class="sachin">
	        <div class='sachin_post'><span class='sachin_name'>Shravan</span>,Admin and Content Manager</div>
	    	<div class='sachin_img'><img src="images/shravan.jpg" width="200" height='300'></div>
	        <div class='sachin_myself'>
		         
		        email:asachin96@yahoo.in
		        ph-no:+918892257027    	
		</div>
        </div>
</div>

<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script> 
<script type='text/javascript' src='js/index.js'></script>
<script type='text/javascript' src='js/correct.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>