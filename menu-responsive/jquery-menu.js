$(document).ready(function() {
	
    $(".drop").click(function() {
		if($(this).find('ul').css('display')=='none'){
			$(this).addClass('add');
			$(this).find("ul").fadeIn(100);
			
		}else{
			$(this).removeClass('add');
			$(this).find("ul").fadeOut(100);
			
		}
	})
	
});
