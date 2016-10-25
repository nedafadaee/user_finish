<page title="گروههاي کاربري" />
<?php
    $GLOBALS['acl']->PagePermission('user_view_roll');
    $model = new model();
    $toolbar = new toolbar;
    if(isset($_POST['DelID'])){ 
      @$model->DeleteSave($_POST['DelID']);
    }
	if(isset($_GET['duid'])){
	   $model->DeleteRecord();
	}
    $db = new db;
?>
<form action="" method="post">
<div class="row">
     <div class="col-xs-12">
       <div class="transaction table-responsive ">
            <table class="table table-transaction">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td>دسترسی</td>
    <td>مدیریت اکشن ها</td>
    <td>کاربران</td>
    <td>حذف</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->role_id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->role_id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $item->name ?>
              </a>
    </td>
    <td>
        <a class="showicon" target="_blank"
         href="?page=user&view=roletoaction&action=add&roleid=<?php echo $item->role_id ?>">
         اکشن ها
        </a>
    </td>
     <td>
        <a class="showicon" target="_blank"
         href="?page=user&view=setrole&action=add&roleid=<?php echo $item->role_id ?>">
         کاربران   
       </a>
    </td>
    <td align="center">
    <?php echo "<a  class=\"showicon\" onclick=\"return confirm('آیا برای حذف مطمئن هستید؟')\" 
	href=\"?page=user&view=roll&duid=".$item->role_id."\">حذف</a>"; ?>
    </td>  
  </tr>
  <?php } ?>
</table>
</div>
</div>
</div>

</form>