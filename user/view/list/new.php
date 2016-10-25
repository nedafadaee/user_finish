<?php
    $GLOBALS['acl']->PagePermission('user_new');
    $model     = new model();
    $controler = new controller();
     if(isset($_POST['sendBtn'])){
	  if(($_POST['drp_manufacture'] !="" && $_POST['manufacture'] !="1")){
		  echo error("در صورتی که این کاربر مربوط به کسب و کار است بر روی باکس کنار تامین کننده کلیک کنید");
		  
		  }
	  else if(($_POST['drp_manufacture'] =="" && $_POST['manufacture'] =="1")){
		  echo error("کسب و کار این تامین کننده را انتخاب کنید");		 
		  }
	  else{	  
	  //echo "ok";	  	
      $model->Save($controler->AllowSave($_POST));
	  }
    }
    //$model->Save($controler->AllowSave($_POST));

$db = new db;

?>
<script src="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.js"></script>
<script src="<?php echo $db->SITE_URL ?>/com/shop/js/pay.js"></script>
<link href="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.css" rel="stylesheet">
<script>

 $(document).ready(function(e) { 
      $("input#manufacture").click(function() {
		if($(this).is(":checked")) {
			//$("#show_manu").css("display", "block");
			alert('کسب و کار این کاربر را انتخاب کنید');
			$("#team").css('border','1px solid green')
		}
		/*else{
			$("#show_manu").css("display", "none");
		}*/
	  });
       
 
        $('#team').searchableOptionList({
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
                  <label class="col-md-2 control-label" for="familly">نام خانوادگی:</label>
                  <div class="col-md-4">
                    <input id="familly" name="familly" type="text" placeholder="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="drp_jender">جنسیت:</label>
                  <div class="col-md-4">
                    <select id="drp_jender"  name="drp_jender" class="form-control ui search dropdown">
                        <option>جنسيت</option>
                        <option value="men">مرد</option>
                        <option value="women">زن</option>
                    </select>
                  </div>
               </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="phone">شماره همراه:</label>
                  <div class="col-md-4">
                    <input type="text" name="phone"   class="form-control intval" 
                    placeholder="مثال: 09121111111"  maxlength="11"  class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="otherphone">سایر شماره های این کاربر:</label>
                  <div class="col-md-4">
                    <input type="text" name="otherphone" class="form-control" class="form-control">
        شماره های مورد نظر را با خط تیره (-) از هم جدا کنید. مثال: 09121234567-09120123456
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="email">ایمیل:</label>
                  <div class="col-md-4">
                    <input type="text" name="email"   class="form-control">
                  </div>
                </div>
                <div class="form-group">
              <label class="col-md-2 control-label" for="State">استان:</label>
              <div class="col-md-2">
                <select  id='ListProv' name="prov_id" aria-api='<?php echo $db->SITE_URL ?>' 
                class="form-control ui search dropdown">
                   <option>استان</option>
                   <?php foreach($model->listProvince() as $item){ ?>
                   <option value="<?php echo $item->id ?>" 
                   <?php if($item->id == $model->GetAddessInfoById('stateid')){ ?> 
                   selected="selected"<?php } ?>><?php echo $item->provance_name ?></option>
                   <?php } ?>
                </select>
              </div>
              <label class="col-md-1 control-label distance-lable" for="city">شهر:</label>
              <div class="col-md-2">
              <p id="listCity" aria-select='<?php echo  $model->GetAddessInfoById('cityid') ?>' style="width: 98%" ></p>
                <!--<select id="city" name="city" class="form-control ui search dropdown">
                  <option value="5">تهران</option>
                  <option value="6">کرج</option>
                </select>-->
              </div>
              <label class="col-md-1 control-label distance-lable" for="area">منطقه:</label>
              <div class="col-md-2">
              <p id="listarea"  aria-select='<?php echo  $model->GetAddessInfoById('regionid') ?>'  style="width: 98%" ></p>
                <!--<select id="area" name="area" class="form-control ui search dropdown">
                  <option value="7">منطقه1</option>
                  <option value="8">منطقه 2</option>
                </select>-->
              </div> </div>
            
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="address">آدرس :</label>
                  <div class="col-md-4">
                    <input type="text" name="address" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="password">پسورد:</label>
                  <div class="col-md-4">
                    <input type="text" name="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">بازاریاب:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="marketer"  id="marketer"  value="1" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">تامین کننده:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="manufacture"  id="manufacture"  value="1" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">انتخاب کسب و کار:</label>
                  <div class="col-md-4">
                    <select name="drp_manufacture"  class="form-control ui search dropdown" id="team" multiple>
                      <option value="0" >انتخاب کنید</option>
                      <?php 
                      foreach($model->Get_besiness() as $item){
                          echo "<option value=\"".$item->id."\">".$item->name."</option>";
                          }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">دسترسي به بخش مديريت:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="admin" value="1" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">تعیین سرپرست:</label>
                  <div class="col-md-4">
                    <select name="drp_sarparast"  class="form-control ui search dropdown">
                      <option value="0" >انتخاب کنید</option>
                     <?php 
					  foreach($model->Get_sarparast() as $item){
						  echo "<option value=\"".$item->id."\">".$item->name." ".$item->familly."</option>";
						  }
					  ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="drp_sarteam">تعیین سرتیم:</label>
                  <div class="col-md-4">
                    <select name="drp_sarteam"  class="form-control ui search dropdown">
                      <option value="0" >انتخاب کنید</option>
                      <?php 
					  foreach($model->Get_sarparast() as $item){
						  echo "<option value=\"".$item->id."\">".$item->name." ".$item->familly."</option>";
						  }
					  ?>
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
