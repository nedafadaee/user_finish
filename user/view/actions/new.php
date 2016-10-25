<?php
    $GLOBALS['acl']->PagePermission('user_new_action');
    $model     = new model();
    if(isset($_POST['sendBtn'])){
    $model->Save($_POST);
	}
?>
<form method="post">

    <table width="200" border="0" class="newRecord" dir="rtl">

      <tr>

        <td width="200">نام:</td>

        <td><input type="text" name="name"></td>

      </tr>

       <tr>

        <td>&nbsp;</td>

        <td><input type="submit" name="sendBtn" value="ذخیره"></td>

      </tr>

    </table>

</form>

 