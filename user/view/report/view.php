<page title="گزارش فعالیت" />
<?php
    $model = new model();
    $model->contentId = intval($_GET['id']);
    $controller = new controller();
    $toolbar = new toolbar;
   error_reporting(0)
  //  session_destroy()
?>

<form action="" method="post">
<table width="800" border="0" class="ListRecord" style="width: 100%;">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td width="170">نام</td>
    <td>صفحه</td>
    <td>تاریخ</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo $toolbar::DeteteTask($item->id) ?></td>
    <td>
              <a href="<?php echo $toolbar->EditTask($item->id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
                      <?php echo $model->ViewUser($item->u_id,'name') ?>
              </a>
    </td> 
    <td><span dir="ltr" style="text-align: left; float: left;"><?php echo $item->page ?></span></td>
 
    <td><?php echo Time_Fa($item->time) ?></td>
  </tr>
  <?php
 }
  ?>
</table>
<?php echo $model->Pagerend() ?>
</form>