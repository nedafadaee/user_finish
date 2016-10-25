<?php $db = new db; ?>
<script type="text/javascript" src="<?php echo $db->AdminUrl ?>/com/shop/js/tabs/jquery-1.9.1.js"></script>
<script src="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.js"></script>
<link href="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.css" rel="stylesheet">
<script>
 $('#team').searchableOptionList({
	 alert('2');
        maxHeight: '300px',
        converter: null,
        onRendered: null,
        texts : {
          noItemsAvailable: 'No entries found',
          selectAll: 'انتخاب همه',
          selectNone: 'حذف انتخاب شده ها',
          quickDelete: '&times;'
        },
        classes: {
          selectAll: null,
          selectNone: null
        },
        useBracketParameters: true,
        showSelectAll: true,
        showSelection: true,
        showSelectionBelowList: true

        });
})
</script>
<?php
    $GLOBALS['acl']->PagePermission('user_new_setrole');
    $model          = new model();
	$model->role_id = $_GET['roleid'];
    if(isset($_POST['sendBtn'])){
    $model->Save($_POST);
	}
?>
<div class="col-xs-12">
          <form class="form-horizontal bg-form" action="" method="post" >
              <fieldset>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">اختصاص نقش به کاربر:</label>
                  <div class="col-md-4">
                    <select name="drp_users[]" id="team" multiple  class="form-control ui search dropdown">
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
