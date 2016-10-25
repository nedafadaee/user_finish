<page title="گروههاي کاربري" />

<?php
    $GLOBALS['acl']->PagePermission('user_view_usergroup');
    $model = new model();
    $toolbar = new toolbar;
    if(isset($_POST['DelID'])){ 
      @$model->DeleteSave($_POST['DelID']);
    }
    $db = new db;
?>

<form action="" method="post">

<div class="row">
     <div class="col-xs-12">
       <div class="transaction table-responsive ">
            <table class="table table-transaction">
  <thead>
    <td width="56">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td width="392">عنوان</td>
    <td width="353">اختصاص نقش به گروه کاربری</td>
    <td width="353">کاربران</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->group_id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->group_id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $item->group_name ?>
              </a>
    </td>
    <td>
        <a class="showicon" target="_blank"
         href="?page=user&view=roletogroup&action=add&groupid=<?php echo $item->group_id ?>">
        نقش به گروه کاربری
        </a>
    </td>
    <td>
        <a class="showicon" target="_blank"
         href="?page=user&view=setusergroup&action=add&groupid=<?php echo $item->group_id ?>">
        کاربران
        </a>
    </td>
  </tr>
  <?php } ?>
</table>
</div>
</div>
</div>

</form>