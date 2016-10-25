<?php
	error_reporting(0);

    $model     = new model();
    $controler = new controller();
    echo $model->Save($_POST);
?>
<style>
.permtable select {
    margin-right: 22px;
    width: 90px !important;
}
</style>
<div id="addBoxRight">
 <p style="padding-right:5px">ویرایش سطح دسترسی گروه: 
  <b><?php echo $model->groupName() ?></b>
 </p>
<form method="post">
 <?php  
    $db = new db;
    $path = $db->systempath.'/22admin92/com/';
    $tree = new treeview( $path );
    echo $tree->build();
 ?>
</form>
 </div>