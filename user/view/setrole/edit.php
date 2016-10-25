<?php
    $GLOBALS['acl']->PagePermission('user_edit_setrole');
    $model     = new model();
    if(isset($_POST['sendBtn'])){
    $model->Edit($_POST);
	}
?>
<form method="post">
    <table width="200" border="0" class="newRecord" dir="rtl">

      <tr>
        <td> اختصاص نقش به کاربر</td>
        <td> 
           <li style="list-style:none">
           <label>
           <?php foreach($model->GetRoles() as $item){
                 echo "<input type=\"checkbox\" name=\"setrole[]\" value=\"0\" style=\"width:60px\" />".$item->name."<br>";
               } ?>
           </label>
           </li>
        </td>
       </tr>

       <tr>

        <td>&nbsp;</td>

        <td><input type="submit" name="sendBtn" value="ذخیره"></td>

      </tr>

    </table>

</form>

 