<?php
error_reporting(E_ALL);
    $model     = new model();
    $model->contentId = intval($_GET['id']);
    $controler = new controller();
?>
<div id="addBoxRight">
<?php     $model->Edit($controler->AllowSave($_POST)); ?>
<form method="post">
        <table width="200" border="0" class="newRecord" dir="rtl">
      <tr>
        <td width="200">نام:</td>
        <td><input type="text" name="name" value="<?php echo $model->ListContentEdit('name') ?>"></td>
      </tr>     
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="sendBtn" value="ذخیره"></td>
      </tr>
    </table>
</form>
</div>