<?php

$GLOBALS['acl']->PagePermission('user_edit');
$model     = new model();
$model->contentId = intval($_GET['id']);
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
        $model->Edit($controler->AllowSave($_POST));
    }
}
if(isset($_GET['useractive'])){

    $model->userActive();

}

if(isset($_GET['userdactive'])){

    $model->userDActive();

}

/* if(isset($_POST['creditNew'])){

  $model->changeCredit();

}
*/
$db = new db;
?>
<script src="<?php echo $db->SITE_URL ?>/com/shop/js/pay.js"></script>
<script src="<?php echo $db->AdminUrl ?>/com/club/js/src/searchableOptionList.js"></script>
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
                    <input id="name" name="name" type="text" placeholder="" class="form-control"
                     value="<?php echo $model->ListContentEdit('name') ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="familly">نام خانوادگی:</label>
                  <div class="col-md-4">
                    <input id="familly" name="familly" type="text" placeholder="" class="form-control"
                     value="<?php echo $model->ListContentEdit('familly') ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="drp_jender">جنسیت:</label>
                  <div class="col-md-4">
                    <select id="drp_jender"  name="drp_jender" class="form-control ui search dropdown">
                        <option>جنسيت</option>
        <option value="men" <?php if( $model->GetAddessInfoById('gender')=="men"){ ?> selected <?php } ?>>مرد</option>
        <option value="women" <?php if( $model->GetAddessInfoById('gender')=="women"){ ?> selected <?php } ?>>زن </option>
                    </select>
                  </div>
               </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="phone">شماره همراه:</label>
                  <div class="col-md-4">
                    <input type="text" name="phone"   class="form-control intval" 
                    placeholder="مثال: 09121111111"  maxlength="11"  class="form-control"  
                    value="<?php echo $model->ListContentEdit('mobile') ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="otherphone">سایر شماره های این کاربر:</label>
                  <div class="col-md-4">
                    <input type="text" name="otherphone"   class="form-control intval" 
                    placeholder="مثال: 09121111111"  maxlength="11"  class="form-control"
                     value="<?php 
					 $cellphone = "";
					 foreach($model->Get_cellphones() as $citem){
						 $cellphone .= $citem->cellphone." - ";
						 }
						 echo rtrim($cellphone, ' - ');
					  ?>" />
        شماره های مورد نظر را با خط تیره (-) از هم جدا کنید. مثال: 09121234567-09120123456
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="email">ایمیل:</label>
                  <div class="col-md-4">
                    <input type="text" name="email"   class="form-control"
                      value="<?php echo $model->ListContentEdit('email') ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="address">آدرس :</label>
                  <div class="col-md-4">
                    <input type="text" name="address" class="form-control"
                     value="<?php echo $model->GetAddessInfoById('address') ?>" />
                  </div>
                 </div>
                               <div class="form-group">
              <label class="col-md-2 control-label" for="State">استان:</label>
              <div class="col-md-2">
                <select  id='ListProv' name="prov_id" aria-api='<?php echo $db->SITE_URL ?>' 
                class="form-control ui search dropdown" 
                aria-city="<?php echo $model->GetAddessInfoById('cityid') ?>" >
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
              </div>
              <label class="col-md-1 control-label distance-lable" for="area">منطقه:</label>
              <div class="col-md-2">
              <p id="listarea"  aria-select='<?php echo  $model->GetAddessInfoById('regionid') ?>'  style="width: 98%" ></p>
              </div> </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="password">پسورد:</label>
                  <div class="col-md-4">
                    <input type="text" name="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">بازاریاب:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="marketer"  id="marketer"  value="1" class="form-control"
                    <?php if($model->ListContentEdit('marketer') == '1' ){ ?> checked="checked" <?php } ?> />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">تامین کننده:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="manufacture"  id="manufacture"  value="1" class="form-control"
                    <?php if($model->ListContentEdit('manufacture') == '1' ){ ?> checked="checked" <?php } ?> />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">انتخاب کسب و کار:</label>
                  <div class="col-md-4">
                    <select name="drp_manufacture"  class="form-control ui search dropdown" id="team" multiple>
                      <option value="0" >انتخاب کنید</option>
                      <?php
                        foreach($model->Get_besiness() as $item){

                            echo "<option value=\"".$item->id."\"";
                            echo  $model->Get_business_id($item->id);
                            //if($item->id == $model->ListContentEdit('business_id')  ){echo "selected";}
                            echo ">".$item->name."</option>";
                        }
                        ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">دسترسي به بخش مديريت:</label>
                  <div class="col-md-4">
                    <input type="checkbox" name="admin" value="1" class="form-control"<?php if($model->ListContentEdit('UserType') == 'SuperAdmin' ){ ?> checked="checked" <?php } ?>  />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="marketer">تعیین سرپرست:</label>
                  <div class="col-md-4">
                    <select name="drp_sarparast"  class="form-control ui search dropdown">
                      <option value="0" >انتخاب کنید</option>
                      <?php

                    foreach($model->Get_sarparast() as $item){
                        echo "<option value=\"".$item->id."\"";
                        if($item->id == $model->ListContentEdit('sarparast')  ){echo "selected";}
                        echo">".$item->name." ".$item->familly."</option>";
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
                        echo "<option value=\"".$item->id."\"";
                        if($item->id == $model->ListContentEdit('sarteam')  ){echo "selected";}
                        echo">".$item->name." ".$item->familly."</option>";
                    }
                    ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="familly">تغییر اعتبار:</label>
                  <div class="col-md-4">
                    موجودی فعلی کاربر: <?php echo $model->GetPrice() ?><br>
                <input type="text" name="creditNew" value="0" class="form-control">
                <select name="changetype"  class="form-control ui search dropdown">
                    <option>نوع تغییر</option>
                    <option value="1">افزایش</option>
                    <option value="2">کاهش</option>
                </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="familly">فعال/غیر فعال سازی:</label>
                  <div class="col-md-4">
                    <?php if($model->ListContentEdit('activation') == '1'){ ?>

                    <a href="http://odnoos.ir/22admin92/index.php?page=user&view=list&action=edit&id=<?php echo $_GET['id'] ?>&userdactive">غیر فعال شود</a> <?php }else{ ?>

                    <a href="http://odnoos.ir/22admin92/index.php?page=user&view=list&action=edit&id=<?php echo $_GET['id'] ?>&useractive">فعال شود</a>



                <?php } ?>
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
