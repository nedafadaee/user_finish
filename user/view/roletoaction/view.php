<page title="گروههاي کاربري" />

<?php
    $GLOBALS['acl']->PagePermission('user_view_roletoaction');
    $model = new model();
    $toolbar = new toolbar;
    if(isset($_POST['DelID'])){ 
      @$model->DeleteSave($_POST['DelID']);
    }
    $db = new db;
?>

<form action="" method="post">

<table width="800" border="0" class="ListRecord" style="width: 100%;">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td>عنوان</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->role_id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->role_id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $item->name ?>
              </a>
    </td>  
  </tr>
  <?php } ?>
</table>

</form>