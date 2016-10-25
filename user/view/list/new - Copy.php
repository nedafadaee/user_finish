<?php
    $GLOBALS['acl']->PagePermission('user_new');
    $model     = new model();
    $controler = new controller();
     if(isset($_POST['sendBtn'])){
	  if(($_POST['drp_manufacture'] !="" && $_POST['manufacture'] !="1")){
		  echo error("در صورتی که این کاربر مربوط به کسب و کار است بر روی باکس کنار تامین کننده کلیک کنید");
		  
		  }
	  else if(($_POST['drp_manufacture'] =="" && $_POST['manufacture'] =="1")){
		  echo error("کسب و کار این تامین کننده را انتخاب کنید");		 
		  }
	  else{	  
	  //echo "ok";	  	
      $model->Save($controler->AllowSave($_POST));
	  }
    }
    //$model->Save($controler->AllowSave($_POST));

$db = new db;

?>
<script src="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.js"></script>

<link href="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.css" rel="stylesheet">
<script>

 $(document).ready(function(e) { 
      $("input#manufacture").click(function() {
		if($(this).is(":checked")) {
			//$("#show_manu").css("display", "block");
			alert('کسب و کار این کاربر را انتخاب کنید');
			$("#team").css('border','1px solid green')
		}
		/*else{
			$("#show_manu").css("display", "none");
		}*/
	  });
       
 
        $('#team').searchableOptionList({
        maxHeight: '300px',
        converter: null,
        onRendered: null,
        texts : {
          noItemsAvailable: 'No entries found',
          selectAll: 'انتخاب همه',
          selectNone: 'حذف انتخاب شده ها',
          quickDelete: '&times;'
        },
        classes: {
          selectAll: null,
          selectNone: null
        },
        useBracketParameters: true,
        showSelectAll: true,
        showSelection: true,
        showSelectionBelowList: true

        });
})
</script>

<form method="post">

        <table width="200" border="0" class="newRecord" dir="rtl">

      <tr>

        <td width="200">نام:</td>

        <td>

        <input type="text" name="name" />

        </td>

      </tr>
       <tr>

        <td width="200">نام خانوادگی:</td>

        <td><input type="text" name="familly" /></td>

      </tr>

	 <tr>

        <td>جنسیت:</td>

        <td>
        <select name="drp_jender">
          <option value="0">انتخاب کنید </option>
          <option value="men">مرد</option>
          <option value="women">زن </option>
        </select>
        </td>

      </tr>

      <tr>

        <td width="200">شماره همراه:</td>

        <td><input type="text" name="phone"   class="intval" placeholder="مثال: 09121111111" maxlength="11" /></td>

      </tr>
<tr>

        <td width="200">سایر شماره های این کاربر:</td>

        <td><input type="text" name="otherphone" />
        شماره های مورد نظر را با خط تیره (-) از هم جدا کنید. مثال: 09121234567-09120123456
        </td>

      </tr>
      <tr>

        <td>ایمیل:</td>

        <td><input type="text" name="email" /></td>

      </tr>

      

      <tr>

        <td>آدرس:</td>

        <td>
<input type="text" name="address" /></td>

      </tr>

     <tr>

        <td>رمز عبور:</td>

        <td><input type="text" name="password" ></td>

      </tr>  

   
<tr>

        <td>بازاریاب:</td>

        <td>

          <label><input type="checkbox" name="marketer"  id="marketer"  value="1"  /></label>

        </td>

      </tr>   
      <tr>

        <td>تامین کننده:</td>

        <td>

          <label><input type="checkbox" name="manufacture"  id="manufacture"  value="1"  /></label>

        </td>

      </tr>      

        <tr>

        <td>انتخاب کسب و کار

        <td>

          <label>

          <select name="drp_manufacture" id="team" multiple>

          <option value="0" >انتخاب کنید</option>

          <?php 

		  foreach($model->Get_besiness() as $item){
			  echo "<option value=\"".$item->id."\">".$item->name."</option>";
			  }
		  ?>
          </select></label>
        </td>

      </tr>      

      <tr>

        <td>دسترسي به بخش مديريت:</td>

        <td>

          <label><input type="checkbox" name="admin" value="1"    /></label>

        </td>

      </tr>        

      

     <!-- <tr>

        <td>گروه کاربري:</td>

        <td>

         <?php //echo $model->user_group() ?>

        </td>

      </tr> -->
      <tr>

        <td>تعیین سرپرست:</td>

        <td>

         <select name="drp_sarparast">

          <option value="0" >انتخاب کنید</option>

          <?php 

		  foreach($model->Get_sarparast() as $item){
			  echo "<option value=\"".$item->id."\">".$item->name." ".$item->familly."</option>";
			  }
		  ?>
          </select>

        </td>

      </tr> 
<tr>

        <td>تعیین سرتیم:</td>

        <td>

         <select name="drp_sarteam">

          <option value="0" >انتخاب کنید</option>

          <?php 

		  foreach($model->Get_sarparast() as $item){
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
