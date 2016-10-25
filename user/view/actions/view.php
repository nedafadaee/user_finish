<page title="لیست اکشن ها " />
<?php
    $GLOBALS['acl']->PagePermission('user_view_action');
    $model = new model();
    $toolbar = new toolbar;
    $db = new db;
?>
<form action="" method="post">

 <div class="row">
     <div class="col-xs-12">
       <div class="transaction table-responsive ">
            <table class="table table-transaction">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td>عنوان فارسی</td>
    <td>عنوان انگلیسی</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php  echo $item->action_id ?></td>
    <td><?php  echo $item->action_name_fa ?></td>
    <td> <?php echo $item->action_name ?></td>  
  </tr>
  <?php } ?>
</table>
</div>
</div>
</div>
</form>