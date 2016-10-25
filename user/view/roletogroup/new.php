<?php
$GLOBALS['acl']->PagePermission('user_new_roletogroup');
    $model     = new model();
	$model->group_id = intval($_GET['groupid']);
    if(isset($_POST['btnsave'])){
    $model->Save($_POST);
	}
?>
<form method="post">
    <table border="0" class="newRecord" >
      <?php foreach($model->ListRoles() as $roles){ ?>
      <tr>                  
        <td><?php echo $roles->name ?></td>
		<td><input type="checkbox" name="chk_role[]" value="<?php echo $roles->chk_role ?>"
        <?php 
		foreach($model->ListRoleToGroup() as $actiontorole){
		  if($actiontorole->role_id == $roles->role_id){echo "checked";}	
		}
		 ?>
         /></td>
      </tr>
      <?php } ?>
      <tr>                  
        <td></td>
		<td><input type="submit" name="btnsave" value="ثبت" /></td>
      </tr>
    </table>
</form>

 