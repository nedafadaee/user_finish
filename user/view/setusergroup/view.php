<page title="گروههاي کاربري" />

<?php
    $GLOBALS['acl']->PagePermission('user_view_setusergroup');
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
    <td>سطح دسترسی</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->group_id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->group_id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $item->group_name ?>
              </a>
    </td>
    <td ><a href="?page=user&view=seo&action=add&pid=<?php echo $item->id  ?>"> 
<img src="<?php echo $db->AdminUrl ?>/templates/red/image/access.png" width="25px" height="25px" />
</a></td> 
  </tr>
  <?php } ?>
</table>

</form>