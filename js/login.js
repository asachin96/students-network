$(document).ready(function() {

	var wh=$(window).height();
	var wid=$(window).width();
	var th=wh*.7;
	var lh=wh*.3;
	$(".login_wrap").css("left",(wid-$(".login_wrap").width())/2);
	$(".logo_down").css("left",(wid-$(".login_wrap").width())/2+10);
	$(".login_top").css("height",th);
	$(".login_down").css("height",lh);
	$(".login_submit").click(function() {
	$(".login_error").html("");
        var email=$.trim($(".login_email").val());
        var password=$.trim($(".login_password").val());
		if(email==''&&password==''){
			$(".login_email").focus();
			$(".p_error").text("email/password is empty")
			return false;}
		else if(email==''){
			$(".login_email").focus();
			$(".p_error").html("email is empty");
			return false;}
		else if(password==''){
			$(".login_password").focus();
			$(".p_error").html("password is empty");
			return false;}
    });
	var t=10;
	$(".login_email").keyup(function(e) {
        $(".login_down").css('box-shadow','inset '+t+'px '+t+'px '+t*10+'px');
		t=t+10;
    });
    
   
    $('.button_submit').click(function ()  {
    var len=$('#pass').val().length;
    if(len<6)
      {
      $('#p').text("LN<6");
      return false;
      }
      else
      {
      $('#p').text("");
      return true;
      }
      
    });
    
	
});