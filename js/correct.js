$("#full").css('height',$(document).height());

$(".colleges_results").mouseover(function(){
		$(this).css("box-shadow",'inset 5px 5px 55px rgba(0,0,0,.7)');
});
$(".colleges_results").mouseout(function(){
	$(this).css("box-shadow",'inset 5px 5px 25px rgba(0,0,0,.3)');
});