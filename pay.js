function loadCity(){
	
        url = $("#ListProv").attr('aria-api')+'/api/shop/city.php';
        val = $("#ListProv").val()
		selectt = $("#listCity").attr('aria-select')
        $.post(url,{provance:val,select:selectt},function succ(data){
            $("#listCity").html(data)
			loadArea()
        })
}	  
function loadArea(){
		selected = $("#listarea").attr('aria-select')
        val = $("#shahr_id option:selected").val();
        url = $("#ListProv").attr('aria-api')+'/api/shop/area.php'
        $.post(url,{city_id:val,select:selected},function succ(data){
            $("#listarea").html(data)
			loadDist()
    })
}
function loadDist(){
		selected = $("#listdist").attr('aria-select')
		val = $("#area_id option:selected").val();
        url = $("#ListProv").attr('aria-api')+'/api/shop/dist.php'
        $.post(url,{area:val,select:selected},function succ(data){
            $("#listdist").html(data)
        })
}

	$( "body" ).on("change",'#ListProv', function(){
    //$("#ListProv").change(function(e) {
        url = $(this).attr('aria-api')+'/api/shop/city.php';
        val = $(this).val()
        $.post(url,{provance:val},function succ(data){
            $("#listCity").html(data)
        })
    });
$(document).ready(function(e) {
       loadCity();
	   url = $("#ListProv").attr('aria-api')+'/api/shop/city.php';
       cityid = $("#ListProv").attr('aria-city');
       $.post(url,{provance:val,select:cityid},function succ(data){
            $("#listCity").html(data)
        })
	 
    $( "body" ).on("change",'#listCity select', function(){
        val = $("#shahr_id option:selected").val();
        url = $(this).attr('aria-api')+'/api/shop/area.php'
        $.post(url,{city_id:val},function succ(data){
            $("#listarea").html(data)
        })
    })

    $( "body" ).on("change",'#area_id', function(){
        val = $("#area_id option:selected").val();
        url = $(this).attr('aria-api')+'/api/shop/dist.php'
        $.post(url,{area:val},function succ(data){
            $("#listdist").html(data)
        })
    })


    })
	
//////شیوه های حمل///////
$(document).ready(function(e) {
	 	 proPrice =  '0';
		 free     =  '0'
        if(proPrice > free){
		 price = '0'			
		}else{
		 price = '0'			
		} 
		 allp  = parseInt(proPrice)+parseInt(price)
		// alert(allp)
		 
		 //$(".Shippingprice").text((price));
		 $("#allPrice").text((allp)) 
		 
		 
		 
		 

         desc = $("#peymentSelect option:selected").attr("aria-desc")
		 $(".payDesc").text(desc)
		 
		 
    $("#peymentSelect").change(function(e) {
         desc = $("#peymentSelect option:selected").attr("aria-desc")
		 $(".payDesc").text(desc) 
         if($(this).val() == '3'){
	       $("#bankFish").show()
		 }else{
	       $("#bankFish").hide()

	     }
    });	
 	
});


function numberFormat(number, decimals, dec_point, thousands_sep){
		// http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_number_format/
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec)
		{
		var k = Math.pow(10, prec);
		return '' + Math.round(n * k) / k;
		};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3)
		{
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec)
		{
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
}
return s.join(dec);
}
                         
  

 