<?php
    $GLOBALS['acl']->PagePermission('user_new_roll');
    $model     = new model();
    if(isset($_POST['sendBtn'])){
    $model->Save($_POST);
	}
?>
<div class="col-xs-12">
          <form class="form-horizontal bg-form" action="" method="post" >
              <fieldset>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">نام:</label>
                  <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="" class="form-control">
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
