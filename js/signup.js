$(document).ready(function (){
		var $f1=0;
		var $f2=1;
		var ecode;
		var send=1;
		$(".signup_left").css('height',$(".signup_right").css('height'));
		//validation for the signup page 
		$("#email").focusout(function(data){
			var email=$.trim($(this).val());
			if(email!=''){
				$.post('emailcheck.php',{email:email},function(data){
					if(data=="already used"){
						$('#email1').html("<span class='mes'>"+data+"</span>");
						$f1=1;
					}
					else{
						$('#email1').html("");
						$f1=0;
					}
				});
			}
		});
		$(".confirm_code").focusout(function(data){
			var ucode=$.trim($(".code").val());
			$.post('codecheck.php',{ucode:ucode,ecode:ecode},function(data){
				if(data=="not equal"){
					$('#code').html("<span class='mes'>wrongcode</span>");
					$f2=1;
				}
				else{
					$('#code').html("<span class='mes'>correctcode</span>");
					$f2=0;
				}
				});
		});
		$(".bug").toggle(function(){
			$('.feedback').show(500,"linear");
		},function(){
			$('.feedback').hide(500,"linear");
			return false;
		});
	
	$('.bug_class').click(function () {
		var page=$(this).attr('page');
		var content=$.trim($('#area').val());
		if(content=='')
			return false;
		$.ajax({
			type:'POST',
			url:'feedback.php',
			data:'page='+page+'&content='+content,
			success:function(data) {
				$('.feedback').html("").html("<div class='thanks'>we will take care of next things</div>");
				$(".thanks").fadeOut(12000);
				$(".bug").hide();
			}
		});
		return false;
	});
		var ww=$("#email").position().left;
		$("#branch").css("left",ww);
		$("#college").css("left",ww);
		$(".bug").css("left",ww+10);
		$('#signup_submit').click(function () {
			$f=0;
			var name=$('#name').val();
			var college=$('#college').val();
			var branch=$('#branch').val();
			var email=$('#email').val();
			var password=$('#password').val();
			var len=$('#password').val().length;
			var repassword=$('#repassword').val();
			var ques=$('#ques').val();
			var ans=$('#answer').val();
			
			if($.trim(name)==""){
				$('#name1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#name1').html("");
			}
				
			if($.trim(college)==""){
				$('#college1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#college1').html("");
			}
			
			if($.trim(branch)==""){
				$('#branch1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#branch1').html("");
			}
			
			if($.trim(email)==""){
				$('#email1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else {
				$('#email1').html("");
			}
			
			
			if($.trim(ques)==""){
				$('#ques1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#ques1').html("");
			}
			
			if($.trim(ans)==""){
				$('#answer1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#answer1').html("");
				
			}
			
			if($.trim(password)==""){
				$('#password1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else if(len<6){
				$('#password1').html("<span class='mes'>strength>6</span>");
				$f=1;
			}
			else if($.trim(repassword)==""){
				$('#repassword1').html("<span class='mes'>required</span>");
				$f=1;
			}
			else{
				$('#password1').html("");
				$('#repassword1').html("");
			}
			
			
			if(password!=repassword){
			    $('#repassword1').html("<span class='mes'>notmatching</span>");
				$f=1;
			}
			else{
				$('#repassword1').html("");
				
			}
			$("#resend").click(function(){
				if(email!=''){
					$("#resend").hide();
					$.post('confirmcode.php',{email:email},function(data){
						if(data=="failed")
							alert("mailing system failed please enter valid email or try again later");
						else{
							ecode=data;	
							alert("re sent");				
						}
					});
					$("#resend").show();
				}
				return false;
			});
			if($f==1)
			   	return false;
			else if($f1==1){
				$('#email1').html("<span class='mes'>already used</span>");
				return false;
			}
			else{
				/*$(".confirm_code").show();
				$("#resnd").show();
				if(send==1){
				send=0;			
					$.post('confirmcode.php',{email:email},function(data){
						if(data=="failed")
							alert("mailing system failed please enter valid email or try again later");
						else
							ecode=data;					
					});
				}*/				
				return true;
			}
	});
})