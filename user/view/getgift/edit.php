<?php
//error_reporting(E_ALL);
    $model     = new model();
    $controler = new controller();
	$model->contentId = intval($_GET['id']);
	if(isset($_POST['txt_code'])){
		
    	$model->Edit_codes($_POST);
	}
?>
<form method="post">
    <table width="200" border="0" class="newRecord" dir="rtl">
    <tr>
        <td width="200">کـــد:</td>
        <td><input type="text" name="txt_code" value="<?php echo $model->select_one_record('code'); ?>"></td>
      </tr>
      <tr>
        <td width="200">مبلغ کـــد :</td>
        <td><input type="text" name="txt_price" value="<?php echo $model->select_one_record('price'); ?>"></td>
      </tr>
      <tr>
        <td width="200">تاریخ شروع:</td>
        <td>
       
                    <input  type="text" name="txt_start" id="txt_start" value="<?php echo Time_Fa3($model->select_one_record('start_time')) ?>" />
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
       
                    <input id="txt_end" type="text" name="txt_end"  value="<?php echo Time_Fa3($model->select_one_record('end_time')) ?>" />
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
        <td><input type="text" name="txt_number" value="<?php echo $model->select_one_record('number_of_use'); ?>"></td>
      </tr> 
       <tr>
        <td width="200">لیست کاربران:</td>
        <td>
        <select id="drp_userid"  multiple="multiple" name="drp_userid[]"  >
        <?php 
		
		foreach($model->list_allusers() as $item){ 
		
			echo "<option value=\"".$item->id."\" "; 
			echo $model->Get_users_codes($item->id);
			echo ">".$item->name." ".$item->familly."</option>";
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
 