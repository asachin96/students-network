$(document).ready(function() {
	$set=0;
	$flag=0;
	$(".search_img").click(function(e) {
        var searc =$("#search").val();
		window.location="search.php?query="+searc;
		return false;
    });
    	  
    	var pic=$("#full").attr('p');
	$("#full").css("background","url("+pic+") fixed").css('background-size','cover');
	$load=1;
	$(document).scroll(function(){
		$(".bck_show").css('top',$(document).scrollTop());
		var win=$(window).height();
		var doc=$(document).height();
		$(".loading").hide();
		if($load==1)
			$("#middle").append("<div class='loading' align='center' style='margin:30px 0 30px 0;color:rgba(8,93,111,.8)'>Loading</div>");
		if(win+$(document).scrollTop()==doc){
			if($flag==0){
				$flag=1;
				$.ajax({
					type:"POST",
					url:'scroll_network.php',
					success:function(data){
						if(data.length<30){
							$load=0;
						}
						$(".loading").hide();
						$("#middle").append(data);
						$flag=0;
					}
				});
			}
		}
		if($(document).scrollTop()>3000)
			$(".scroll_top").show();
		else
			$(".scroll_top").hide();
	});
	
	//events design
	setInterval(function(){
		$.ajax({
			type:'POST',
			url:"online_check.php",
			success:function(data){
				
			}
		});
	},60000);
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
	},60000);
	
	$(".events_event").live("click",function(){
		var lnk=$(this).attr("ref");
		window.location=lnk;
	});
	
	$(".menu_icons1").click(function(){
		return false;
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
		$("#change_button").fadeIn(1000);
		s=$(this).css('color');
		$(this).css('color','red');
	},function(){
		$set=0;
		if($("#im").val()=='')
        		$(".backimg_form").hide();
        	$("#change_button").hide();
        	$(this).css('color',s);
	});
	
	$(".menu_bar").click(function(){
		var p=$(this).attr('p');
		var lnk=$("#"+p).attr('href');	
		if($(this).attr("id")!='menu_last')
			window.location=lnk;
	});
	var current = $(".menu_bar1").attr('q');
	
	$(".menu_bar").mouseover(function(){
		$(this).css('border-bottom','2px solid white');
		//$(this).animate({border-bottom:"2px solid white"},900);
		var p=$(this).attr('p');
		$("#"+p).css('color','#A9C9D3');
	});
	$(".menu_bar").mouseout(function(){
		$(this).css('border-bottom','none');
		var p=$(this).attr('p');
		$("#"+p).css('color','#c0c0c0');
	});
	
	$("#change_button").live("click",function(){
		$("#change").fadeIn(1000);
		$("#change_button").hide();
		return false;
	});
	
	$("#close").live("click",function(){
		$("#change").fadeOut(500);
		return false;
	});
	$("#change_save").live("click",function(){
		$(this).hide();
		$("#change_upload").show();
	});
	$(".net_wrap").live("mouseover",function(){
		$(this).css('box-shadow','inset -1px -1px 25px black');
	});
	$(".net_wrap").live("mouseout",function(){
		$(this).css('box-shadow','inset -1px -1px 5px black');
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
	
	
	$('.network_name').live("click",function(){
		var email=$(this).attr('email');
		$("#middle").html("<img src='images/waiting.gif' width='75' height='75' class='wait'/>");		
           	$.post('network.php',{email:email},function(data){			
			$('#outline').html(data);
		});
		return false;
	});	
	// recommends list
	$(".rec_wrap").live("mouseover",function(){
		$(this).css("background-color","rgba(8,93,111,.4)");
	});
	
	$(".rec_wrap").live("mouseout",function(){
		$(this).css("background-color","white");
	});
	
	$(".rec_wrap").live("click",function(){
		window.location=$(this).attr("ref");
	});
	
	$(".recommended").mouseover(function(){
		var id=$(this).attr("article_id");
		var temp=$(this).text()
		var t=temp.split(")");
		t=t[0].split("(");
		if(t[1]!='0'){
			$(".frecommend").remove();
			$("#art"+id).append("<div class='frecommend'><h4 align='center' class='rec_head'>Recommended By</h4></div>");
			$.ajax({
				type:"POST",
				url:'recommendsshow.php',
				data:'art='+id,
				success:function(data){
					$(".frecommend").html(data);
				}
			});
		}
	});
	
	$(".frecommend").live("mouseover",function(){
		$(this).show();
	});
	
	$(".frecommend").live("mouseout",function(){
		$(this).hide();
	});
	$(".news_top").live("mouseout",function() {
		$(".frecommend").hide();
        });
         $("#right,#left,#header").live("mouseover",function() {
		$(".frecommend").hide();
        });
        //ends here
	$(".news").live("mouseout",function() {
   		var id=$(this).attr('i');
		$("#del"+id).hide();
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
	
	$('a.offensive').live("click",function (){
		
		var id=$(this).attr('article_id');
		var email=$(this).attr('email');
		var tag=$(this);
		$.ajax({
		type:"POST",
		url:'offensive.php',
		data:'email='+email+'&art='+id,
		success:function(data){
			if(data == 1){
				$(tag).append("<ul><li class='er'>already selected</li></ul>");
				$('.er').fadeOut(3000);
			}
		}
		});
		return false;
	});	
	$('#manage').toggle(function(){
		$('.del').show();
		$('.sub_name').css('width','91%');
		return false;
		},function(){
			$('.sub_name').css('width','100%');
			$('.del').hide()
			return false;
	});	  
	  $('#my_net').toggle(function(){
		$('.del_net').show();
		$(".net_image_name").css('width','90%')
		return false;
		},function(){$('.del_net').hide()
		$(".net_image_name").css('width','100%')
			return false;
		});
		
	$('.del_net').click(function (){
		var email=$(this).attr('email');
		$.ajax({
			type:'POST',
			url:'delete_network.php',
			data:'email='+email,
			success:function(data){
				window.location.reload(true);
			}
			});
		return false;
	});
	
	/*college page operations*/
	
	$('.share').live("click",function(){
		var topic=$('.topic').val();
		if($.trim(topic)==''){
			$('.req').append("<div id='required'>required</div>");
			return false;
		}
	});
	
	//download operation
	$('.download').live("click",function(){
		var ref=$(this).attr('href');
		if(ref=='no'){
			$(this).css('color','white');
			alert('nothing to download')
			return false;
		}
	});
	
	//getiing the info abut particular subject
	$('.branch_sub').click(function () {
		var college=$(this).attr('college');
		var subject=$(this).attr('subject');
		$("#outline").html("<img src='images/waiting.gif' height='30' width='30' align='center'/>");
		$.ajax({
			type:'POST',
			url:'branch_middle.php',
			data:'college='+college+'&subject='+subject,
			success: function(data){
				$('#outline').html(data);
			}
			});
			return false;
	});
	
	//getting the subjects of the other branches
	$('.other_branch').live("click",function() {
		var college=$(this).attr('college');
		var branch=$(this).attr('branch');
		$("#right").html("<img src='images/waiting.gif' height='30' width='30' align='center'/>");
		$.ajax({
			type:'POST',
			url:'other_branch.php',
			data:'college='+college+'&branch='+branch,
			success: function(data){
				$('#right').html(data);
			}
			});
			return false;
	
		});
	
	//getting the information about the subjects of other branches 
	$('.branch_sub1').live("click",function () {
		var college=$(this).attr('college');
		var subject=$(this).attr('subject');
		$("#outline").html("<img src='images/waiting.gif' height='30' width='30' align='center'/>");
		$.ajax({
			type:'POST',
			url:'branch_sub1.php',
			data:'college='+college+'&subject='+subject,
			success: function(data){
				$('#outline').html(data);
			}
			});
			return false;
	});	
	$('.news_wrapper').mouseover(function(){
		$(this).append("");
	});
	
	//subscribe to a particular subject
	$('#subscribe').live("click",function() {
		var college=$(this).attr('college');
		var subject=$(this).attr('subject');

		$.ajax({
			type:'POST',
			url:'subscibe.php',
			data:'college='+college+'&subject='+subject,
			success: function(data){
				alert(data);
			}
			});
			return false;
	
		});
	
	$('.add_network').live("click",function() {
		var user=$(this).attr('user');
		var network=$(this).attr('network');

		$.ajax({
			type:'POST',
			url:'add_network.php',
			data:'user='+user+'&network='+network,
			success: function(data){
				alert(data);
			}
			});
			return false;
	
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
		$(".delete_art").live("click",function(){
			var email=$(this).attr('email');
			var id=$(this).attr('oid');
			$.ajax({
				type:'POST',
				url:'delete_art.php',
				data:'email='+email+'&id='+id,
				success: function(data){
					$("#art"+id).html("");
				}
			});
			return false;			
		});
		
		$(".news").live("mouseover",function() {
			if($set==1){
	            		var id=$(this).attr('i');
				$("#del"+id).show();
			}
        	});
		
		$('#bug').click(function(){
		$('#feedback').show();
		return false;

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
	$(".focus_image").click(function() {
			var h=$(window).height();
			var w=$(window).width();
			var s=$(document).scrollTop();
			var p=$(this).attr('src');
			$(".bck_nshow").css('width',w).css('height',h).css('top',s).addClass('bck_show').html("<a href='' class='lk_wr'><div class='img_cen' ><img src='" + p + "'class='dwn_rimg'/></div></a>");
			$(".dwn_rimg").css('height',h*.8).css('width',w*.8);
			$(".img_cen").css('left',w*.1).css('top',h*.1);
			return false;       
    });
	$(".bck_rm").click(function() {
			$("img_cen").css('display','none');
			$(".bck_nshow").removeClass('bck_show');
			return false;
	});
});