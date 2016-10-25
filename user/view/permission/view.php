<page title="گروهای کاربری" />
<?php
    $model = new model();
    $controller = new controller();
    $toolbar = new toolbar;
   if(isset($_POST['sortBtn'])){ 
    @$model->SortSave($controller->AllowSort($_POST['sortID']));
   } 
   if(isset($_POST['DelID'])){ 
    @$model->DeleteSave($controller->AllowDelete($_POST['DelID']));
   }
   error_reporting(0)
  //  session_destroy()
?>

<form action="" method="post">
<table width="800" border="0" class="ListRecord" style="width: 100%;">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td>نام</td>
    <td width="150">تاریخ ایجاد</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo $toolbar::DeteteTask($item->id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $item->name ?>
              </a>
    </td>  
 
    <td><?php echo Time_Fa($item->time) ?></td>       
  </tr>
  <?php
 }
  ?>
</table>
<?php echo $model->Pagerend() ?>
</form>