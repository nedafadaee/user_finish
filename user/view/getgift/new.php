<style type="text/css">
	.display{display:block}
	.nodisplay{display:none}
    
</style>
<script type="text/javascript">
$(document).ready(function(e) {
	
	/*$("input#chk_selectcity").each(function() {
    	if($(this).is(":checked")) {
        	id = $(this).attr('aria-id')
        	$('#area_name_'+id).show('');
    	}
		}); */		 
	 $("input#chk_numberCode").click(function() {
		
    	if($(this).is(":checked")) {
        	$('#txt_codeNumber').show('');
			$("#txt_code").attr("disabled", "disabled");
    	} 
		else {
        	$('#txt_codeNumber').hide('');
			$("#txt_code").removeAttr("disabled"); 
        
    	}
});	 

	
});
</script>
<?php
error_reporting(0);
    $model     = new model();
    $controler = new controller();
    $model->Save($_POST);
?>
<form method="post">
    <table width="500" border="0" class="newRecord" dir="rtl">
    <tr>
        <td height="25" ><span style="float:right">تولید کد خودکار توسط سیستم</span>
            <span style="float:left"><input type="checkbox" name="chk_numberCode" id="chk_numberCode"  /></span> :
            </td>
      <td><input type="text" name="txt_codeNumber" id="txt_codeNumber" 
        class="nodisplay" placeholder="تعداد مورد نظر را وارد کنید" /></td>
      </tr>
      <tr>
        <td width="200">کـــد:</td>
        <td><input type="text" name="txt_code" id="txt_code"></td>
      </tr>
      <tr>
        <td width="200">مبلغ کـــد :</td>
        <td><input type="text" name="txt_price"></td>
      </tr>
      <tr>
        <td width="200">تاریخ شروع:</td>
        <td>
                    <input  type="text" name="txt_start" id="txt_start" />
                    [<span id='date_btn_start'>انتخاب</span>]
                    </td>
                     <script type="text/javascript">
                Calendar.setup({
                    inputField     :    "txt_start",   // id of the input field
                    button         :    "date_btn_start",   // trigger for the calendar (button ID)
                    ifFormat       :    "%Y-%m-%d",       // format of the input field
                    showsTime      :    false,
                    dateType       :    'jalali',
                    timeFormat     :    "24",
                    weekNumbers    : false
                });
            </script>
      </tr>
     <tr>
        <td width="200">تاریخ پایان:</td>
         <td>
                    <input id="txt_end" type="text" name="txt_end" />
                    [<span id='date_btn_end'>انتخاب</span>]
                    </td>
                     <script type="text/javascript">
                Calendar.setup({
                    inputField     :    "txt_end",   // id of the input field
                    button         :    "date_btn_end",   // trigger for the calendar (button ID)
                    ifFormat       :    "%Y-%m-%d",       // format of the input field
                    showsTime      :    false,
                    dateType       :    'jalali',
                    timeFormat     :    "24",
                    weekNumbers    : false
                });
            </script>
      </tr>
      <tr>
        <td width="200">تعداد دفعات استفاده از کد:</td>
        <td><input type="text" name="txt_number"></td>
      </tr> 
       <tr>
        <td width="200">لیست کاربران:</td>
        <td>
        <select id="drp_userid"  multiple="multiple" name="drp_userid[]"  >
        <?php 
		foreach($model->list_allusers() as $item){ 
		
			echo "<option value=\"".$item->id."\">".$item->name." ".$item->familly."</option>";
		}
		?>
        </select>
       
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="sendBtn" value="ذخیره"></td>
      </tr>
    </table>
</form>
 