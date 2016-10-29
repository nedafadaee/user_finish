<?php
    $GLOBALS['acl']->PagePermission('user_new_setusergroup');
    $model     = new model();
	$model->group_id = $_GET['groupid'];
    if(isset($_POST['sendBtn'])){
    $model->Save($_POST);
	}
?>
<div class="col-xs-12">
          <form class="form-horizontal bg-form" action="" method="post" >
              <fieldset>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">اختصاص گروه به کاربر:</label>
                  <div class="col-md-4">
                  <select name="drp_users[]"   class="form-control ui search dropdown" id="team" multiple >
                     <option value="0">انتخاب کنید</option>
                     <?php foreach($model->GetAllUsers() as $itemuser){
                         echo "<option value=\"".$itemuser->id."\"";
                         foreach($model->GetRolesAllocate() as $allocate){
                                  if($allocate->user_id == $itemuser->id){
                                      echo "selected";
                                      }
                                  }
                         echo ">".$itemuser->name."  ".$itemuser->familly."</option>";
                         } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary"  name="sendBtn">ذخیره</button>
                  </div>
                </div>
               </fieldset>
              </form>
</div>   
