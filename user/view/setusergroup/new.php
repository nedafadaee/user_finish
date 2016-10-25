<?php
    $GLOBALS['acl']->PagePermission('user_new_setusergroup');
    $model     = new model();
	$model->group_id = $_GET['groupid'];
    if(isset($_POST['sendBtn'])){
    $model->Save($_POST);
	}
?>
<form method="post">
    <table width="200" border="0" class="newRecord" dir="rtl">

      <tr>
        <td> اختصاص گروه به کاربر</td>
        <td> 
        <select name="drp_users[]" id="team" multiple>
         <option value="0">انتخاب کنید</option>
         <?php foreach($model->GetAllUsers() as $itemuser){
			 echo "<option value=\"".$itemuser->id."\"";
			 foreach($model->GetRolesAllocate() as $allocate){
					  if($allocate->user_id == $itemuser->id){
						  echo "selected";
						  }
					  }
			 echo ">".$itemuser->name."  ".$itemuser->familly."</option>";
			 } ?>
        </select>
        </td>
       </tr>

       <tr>

        <td>&nbsp;</td>

        <td><input type="submit" name="sendBtn" value="ذخیره"></td>

      </tr>

    </table>

</form>

 