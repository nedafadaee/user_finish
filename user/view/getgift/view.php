<page title="کاربران" />
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
    <td >#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td >کد هدیه</td>
  
    <td>تاریخ شروع </td>
     <td>تاریخ پایان</td>
     <td>تعداد دفعات استفاده</td>
  </thead>
 <?php foreach($model->listCodes() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->id) ?></td>
    <td>
        <a href="<?php echo $toolbar->EditTask($item->id) ?>" 
        onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
        <?php echo $item->code ?>
        </a>
    </td>
      
    
    <td><?php echo Time_Fa($item->start_time) ?></td>
    <td><?php echo Time_Fa($item->end_time) ?></td>
    <td><?php echo $item->number_of_use ?></td>
  </tr>
  <?php
 }
  ?>
</table>
<?php echo $model->Pagerend() ?>
</form>