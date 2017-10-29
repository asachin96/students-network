$(document).ready(function(){
	$set=0;
	
	var h= $("#mid_wrap").height()+270;
	$("#mid_wrap").animate({ scrollTop: h }, "slow");
	$(".search_img").click(function(e) {
        var searc =$("#search").val();
		window.location="search.php?query="+searc;
		return false;
   	 });
   	 var pic=$("#full").attr('p');
	$("#full").css("background","url("+pic+") fixed").css('background-size','cover');
	
	//events design
	setInterval(function(){
		$.ajax({
			type:'POST',
			url:"online_check.php",
			success:function(data){
				
			}
		});
	},30000);
	$(".events_wrap").css("left",$("#menu_last").position().left);
	$("#menu_last .menu_icons1").toggle(function(){
		$(".events_wrap").show(1200);
		$(".events_wrap").html("<img src='images/waiting.gif' width='25' height='25' class='wait'/>");
		$.ajax({
			type:"POST",
			url:'event_retrieve.php',
			success:function(data){
				$(".events_wrap").html(data);
				$("#no_events").html("");
			}
		});
		$(this).animate({width:"190px"},1200);
	},function(){
		$(".events_wrap").hide();
		$(this).animate({width:"59px"},1500);
	});
	$.ajax({
		type:'POST',
		url:"noofevents.php",
		success:function(data){
			$("#no_events").html(data);
		}
	});
	setInterval(function(){
		$.ajax({
			type:'POST',
			url:"noofevents.php",
			success:function(data){
				$("#no_events").html(data);
			}
		});
	},30000);
	$(".menu_icons1").click(function(){
	
		return false;
	});
	$(".events_event").live("click",function(){
		var lnk=$(this).attr("ref");
		window.location=lnk;
	});
	
	$(".events_event").live("mouseover",function(){
		$(this).css('background-color','rgba(9,83,111,.9)');
	});
	
	$(".events_event").live("mouseout",function(){
		$(this).css('background-color','rgba(9,83,111,.5)');
	});
	
	//events design ends here
	
	
	
	$("#settings").toggle(function(){
		$set=1;
		$(".backimg_form").fadeIn(1000);
		s=$(this).css('color');
		$(this).css('color','red');
	},function(){
		$set=0;
		if($("#im").val()=='')
        		$(".backimg_form").hide();
        	$(this).css('color',s);
	});
	$(".bug").toggle(function(){
		$('.feedback').show(500,"linear");
		return false;
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
				$('.feedback').html("").html("<div class='thanks'>thanks</div>");
				$(".thanks").fadeOut(3000);
			}
		});
		return false;
	});
	$.ajax({
		type:"POST",
		url:'delete_discussion.php'
		});	
	$(".menu_bar").click(function(){
		var p=$(this).attr('p');
		var lnk=$("#"+p).attr('href');
		if($(this).attr("id")!='menu_last')	
		window.location=lnk;
	});
	$(".menu_bar").mouseover(function(){
		$(this).css("border-bottom",'2px solid white');
		var p=$(this).attr('p');
		$("#"+p).css('color','#A9C9D3');
	});
	$(".menu_bar").mouseout(function(){
		$(this).css('border-bottom','none');
		var p=$(this).attr('p');
		$("#"+p).css('color','#c0c0c0');
	});
	$(".sub_name").live("mouseover",function(){
		$(this).css('box-shadow','inset 1px 1px 10px black');
	});
	$(".sub_name").live("mouseout",function(){
		$(this).css('box-shadow','inset 1px 1px 2px black');
	});
	$("#search").live("focusin",function(){
		$(this).val('');
		$(this).animate({width:"200px"},900);
	});
	$("#search").live("focusout",function(){
		if($(this).val()=='')
			$(this).val('search here..');
		$(this).animate({width:"130px"},900);
	});
	$("#search").live("focusout",function(){
		if($(this).val()=='')
			$(this).val('search here..');
		$(this).animate({width:"130px"},900);
	});

	
	$('a.recommended').live("click",function (){
		
		var id=$(this).attr('article_id');
		var email=$(this).attr('email');
		var tag=$(this);
		$.ajax({
		type:"POST",
		url:'recommend.php',
		data:'email='+email+'&art='+id,
		success:function(data){
			if(data == 1){
				$(tag).append("<div class='er'>already selected</div>");
				$('.er').fadeOut(3000);
			}
			else{
		       $(tag).html(data);
			}
		}
		});
		return false;
	});	
	

	
	/*college page operations*/
	
	$('.share').live("click",function(){
		var topic=$('.topic').val();
		var d=$('.details').val();
		var d1=$('.cate').val();
		if($.trim(topic)==''){
			$('.req').append("<div id='required1'>required</div>");
			return false;
		}
		else{
			$('#required1').html("");
		}
		if($.trim(d)==''){
			$('.req1').append("<div id='required2'>required</div>");
			return false;
		}
		else{
			$('#required2').html("");
		}
		if(d1=='select category'){
			$('.req2').append("<div id='required3'>required</div>");
			return false;
		}
		else{
			$('#required3').html("");
		}
	});
	
	//download operation
	$('.download').live("click",function(){
		var ref=$(this).attr('href');
		if(ref=='no'){
			$(this).css('color','white');
			return false;
		}
	});
	
	$('.news_wrapper').mouseover(function(){
		$(this).append("");
	});
		
	$('.subm').live("click",function(){
		var art_id=$(this).attr('art_id');
		var email=$(this).attr('email');
		var text=$.trim($('#area'+art_id).val());
		if(text!=''){
			$.ajax({
				type:'POST',
				url:'comment.php',
				data:'content='+text+'&art='+art_id+'&email='+email,
				success: function(data){
						$('#comment'+art_id).load('comment_show.php?art_id='+art_id);
				}
			});
			$('#area'+art_id).val('').focus();
		}
	return false;
	});
		
	$(".comments").live("click",function(){
		var id=$(this).attr('id');
		$(this).hide();
		$('#c'+id).show();
		$('.reply_form'+id).show();
		$('.com_waiting'+id).show();
		$.ajax({
			type:'POST',
			url:'comment_show.php',
			data:'art_id='+id,
			success: function(data){
				$('.com_waiting'+id).hide();
				$('#comment'+id).html(data);
			}
		});
		return false;
     });

	$(".clo").live("click",function(){
		var id=$(this).attr('pa');
		$(this).hide();
		$("#"+id).show();
		$('.reply_form'+id).hide();
		return false;
	});
	
	$('#sub_cat').hide();
	$("#main_cat").change(function(){
		var option=$(this).val();
		if(option=='general'||option=='select category')
			$('#sub_cat').hide();
		else
			$('#sub_cat').show();
		if(option!='select category')
		$.ajax({
				type:'POST',
				url:'options_load.php',
				data:'option='+option,
				success:function(data){
					$("#sub_cat").html(data);
				}
			});
	});
	$("#ask_doubt").mouseover(function(){
		$(this).css('color','#A9C9D3');
	});
	$("#ask_doubt").mouseout(function(){
		$(this).css('color','#CCCCCC');
	});
	$("#ask_doubt").toggle(function(){
		$('#doubt_wrap').show(500,"linear");
		$('#doubt_img').attr('src','images/collapse.png');
		return false;
	},function(){
		$('#doubt_wrap').hide(500,"linear");
		$('#doubt_img').attr('src','images/expand.png');
		return false;
	});
	setInterval(function(){
		$.ajax({
			type:'POST',
			url:"online.php"
		});
	},30000);
	
	$(".discuss_start_button").click(function() {
   	 var txt=$.trim($("#discussion_input").val());
		if(txt==''){
			alert("enter the topic name");
			return false;
		}
        });
	   $(".answers").live("click",function(){
		var id=$(this).attr('id');
		$(this).hide();
		$('#c'+id).show();
		$('.reply_form'+id).show();
		$('.com_waiting'+id).show();
		$.ajax({
			type:'POST',
			url:'answer_show.php',
			data:'art_id='+id,
			success: function(data){
				$('.com_waiting'+id).hide();
				$('#comment'+id).html(data);
			}
		});
		return false;
	     });
		 $(".answer_close").live("click",function(){
			var id=$(this).attr('pa');
			$(this).hide();
			$("#"+id).show();
			$('.reply_form'+id).hide();
			return false;
		});
		
		$('.answer_submit').live("click",function(){
		var art_id=$(this).attr('art_id');
		var email=$(this).attr('email');
		var text=$('#area'+art_id).val();
		if(text!=''){
			$.ajax({
				type:'POST',
				url:'answer.php',
				data:'content='+text+'&art='+art_id+'&email='+email,
				success: function(data){
						$('#comment'+art_id).append(data);
				}
			});
			$('#area'+art_id).val('').focus();
		}
		return false;
		});
		
		$('a.ans_recommended').live("click",function (){
		var id=$(this).attr('article_id');
		var email=$(this).attr('email');
		var tag=$(this);
		$.ajax({
		type:"POST",
		url:'answer_recommend.php',
		data:'email='+email+'&art='+id,
		success:function(data){
			if(data == 1){
				$(tag).append("<div class='er'>already selected</div>");
				$('.er').fadeOut(3000);
			}
			else{
		       		$(tag).html(data);
			}
		}
		});
		return false;
	});	
	$(".doubt_expand").toggle(function(){
		var branch=$(this).attr('p');
		$("."+branch).show(800,"linear");
		$(".p"+branch).attr('src','images/minus.png');
		return false;
	},function(){
		var branch=$(this).attr('p');
		$("."+branch).hide(800,"linear");
		$(".p"+branch).attr('src','images/plus.png');
		return false;
	});
	$.ajax({
		url:"users_online.php",
		type:"POST",
		success:function(data){
			if(data!='')
				$(".onlin").html(data);
			else
				$(".onlin").html("No is Online");
		}
	});
	setInterval(function() {
		$.ajax({
			url:"users_online.php",
			type:"POST",
			success:function(data){
			if(data!='')
				$(".onlin").html(data);
			else
				$(".onlin").html("No is Online");
			}
		});
	},30000);
	$(".online_ur").live("click",function(){
		var temail=$(this).attr("email");
		var ref=$(this).attr("ref");
		$.ajax({
			url:"invitation.php",
			type:"POST",
			data:"temail="+temail+"&ref="+ref,
			success:function(data){
				$(".online_ur").html("Invitation Sent");	
			}
		});
	});
	var id=$("#online_users").attr('p');
	var buff='';
	var buff1='';
	var buffer='';
	$.ajax({
		url:"user_check.php",
		type:"POST",
		data:"id="+id,
		success:function(data){
			if(data!='')
				$("#online_users").html(data);
			else
				$("#online_users").html("No One In Discussion");
		}
	});
	setInterval(function() {
		$.ajax({
			url:"user_check.php",
			type:"POST",
			data:"id="+id,
			success:function(data){
				if(data!=''){
					if(buff!=data)
						$("#online_users").html(data);
					buff=data;
				}
				else
					$("#online_users").html("No One In Discussion");
			}
		});
		$.ajax({
			url:"discuss_test.php",
			success:function(data){
				if(buffer!=data)
					$(".sub_wrap").html(data);
				buffer=data
			}
		});
		},30000);
	$('.dis_comment').focus();	
	$('.dis_submit').click(function () {
		var dis_id=$(this).attr('dis_id');
		var comment=$.trim($('.dis_comment').val());
		if(comment=='')
			return false;
		$('.dis_comment').val('');
		$.ajax({
			type:"POST",
			url:'dis_post.php',
			data:'dis_id='+dis_id+'&comment='+comment,
			success:function(data){
				h= $("#mid_wrap").scrollTop()+70;
				$("#mid_wrap").animate({ scrollTop: h }, "slow");
				$("#mid_wrap").append(data);
			}
		});
	return false;
	});

	setInterval(function() {
		var dis_id=$('.dis_submit').attr('dis_id');
		$.ajax({
			url:"post_update.php",
			type:"POST",
			data:"dis_id="+dis_id,
			success:function(data){
				if(buff1!=data)
					$("#mid_wrap").append(data);
				t=new Date();
				t=Math.ceil(t.getTime()/1000);
				buff1=data;
			}
		});
	},1000);
	
	$('#bug').click(function(){
		$('#feedback').show();
		return false;
	});
	
	$('.bug_class').click(function () {
		var page=$(this).attr('page');
		var content=$('#area').val();
		$.ajax({
			type:'POST',
			url:'feedback.php',
			data:'page='+page+'&content='+content,
			success:function(data) {
				
			}
		});
		return false;
	});
	$(".colleges_results").mouseover(function(){
		$(this).css("box-shadow",'inset 5px 5px 55px rgba(0,0,0,.7)');
	});
	$(".colleges_results").mouseout(function(){
		$(this).css("box-shadow",'inset 5px 5px 25px rgba(0,0,0,.3)');
	});
});