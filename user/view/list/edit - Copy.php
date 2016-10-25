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

<form method="post">

    <table width="200" border="0" class="newRecord" dir="rtl">
        <tr>

            <td width="200">شماره همراه:</td>
           <!-- <td><?php //echo $model->ListContentEdit('mobile') ?></td>-->
            <td><input type="text" name="phone" value="<?php echo $model->ListContentEdit('mobile') ?>"    class="intval" placeholder="مثال: 09121111111" maxlength="11" ></td>

        </tr>
        <tr>

            <td width="200">سایر شماره های این کاربر:</td>

            <td><input type="text" name="otherphone" value="<?php echo $model->Get_cellphones('cellphone') ?>">
                شماره های مورد نظر را با خط تیره (-) از هم جدا کنید. مثال: 09121234567-09120123456
            </td>

        </tr>
        <tr>

            <td width="200">نام:</td>

            <td>

                <input type="text" name="name" value="<?php echo $model->ListContentEdit('name') ?>">

            </td>

        </tr>





        <tr>

            <td width="200">نام خانوادگی:</td>

            <td><input type="text" name="familly" value="<?php echo $model->ListContentEdit('familly') ?>"></td>

        </tr>

        <tr>

            <td>جنسیت:</td>

            <td>

                <select name="drp_jender">
                    <option value="0">انتخاب کنید </option>
                    <option value="men" <?php if( $model->ListContentEdit('sex')=="men"){ ?> selected <?php } ?>>مرد</option>
                    <option value="women" <?php if( $model->ListContentEdit('sex')=="women"){ ?> selected <?php } ?>>زن </option>
                </select>
            </td>

        </tr>



        <tr>

            <td>ایمیل:</td>

            <td><input type="text" name="email" value="<?php echo $model->ListContentEdit('email') ?>"></td>

        </tr>

        <tr>

            <td>نام شهر:</td>
            <td> <?php echo $model->ListContentEdit('city_name'); ?></td>
        </tr>
        <tr>

            <td>نام منطقه:</td>
            <td> <?php echo $model->ListContentEdit('area_name'); ?></td>
        </tr>
        <tr>

            <td>آدرس:</td>

            <td>
                <input type="text" name="address"  autocomplete="off"  value="<?php echo $model->ListContentEdit('address') ?>">
            </td>

        </tr>

        <tr>

            <td>رمز عبور:</td>

            <td><input  autocomplete="off"  type="password" name="password" value=""></td>

        </tr>

<tr>

        <td>بازاریاب:</td>

        <td>

          <label><input type="checkbox" name="marketer"  id="marketer"  value="1"  <?php if($model->ListContentEdit('marketer') == '1' ){ ?> checked="checked" <?php } ?>    /></label>

        </td>

      </tr>   

        <tr>
            <td>تامین کننده:</td>
            <td>
                <label><input type="checkbox" name="manufacture" id="manufacture" value="1"  <?php if($model->ListContentEdit('manufacture') == '1' ){ ?> checked="checked" <?php } ?>    /></label>
            </td>
        </tr>
        <tr>
            <td>انتخاب کسب و کار
            <td>
                <label>
                    <select name="drp_manufacture" id="team" multiple>
                        <option value="0" >انتخاب کنید</option>
                        <?php
                        foreach($model->Get_besiness() as $item){

                            echo "<option value=\"".$item->id."\"";
                            echo  $model->Get_business_id($item->id);
                            //if($item->id == $model->ListContentEdit('business_id')  ){echo "selected";}
                            echo ">".$item->name."</option>";
                        }
                        ?>
                    </select></label>

            </td>

        </tr>
        <tr>

            <td>دسترسي به بخش مديريت:</td>

            <td>

                <label><input type="checkbox" name="admin" value="1"  <?php if($model->ListContentEdit('UserType') == 'SuperAdmin' ){ ?> checked="checked" <?php } ?>    /></label>

            </td>

        </tr>
       
        <!--<tr>
            <td>گروه کاربري:</td>
            <td>
                <?php //echo $model->user_group() ?>
            </td>
        </tr>-->
        <tr>

            <td>تعیین سرپرست:</td>

            <td>

                <select name="drp_sarparast">

                    <option value="0" >انتخاب کنید</option>

                    <?php

                    foreach($model->Get_sarparast() as $item){
                        echo "<option value=\"".$item->id."\"";
                        if($item->id == $model->ListContentEdit('sarparast')  ){echo "selected";}
                        echo">".$item->name." ".$item->familly."</option>";
                    }
                    ?>
                </select>

            </td>

        </tr>
        <tr>

            <td>تعیین سرتیم:</td>

            <td>

                <select name="drp_sarteam">

                    <option value="0" >انتخاب کنید</option>

                    <?php

                    foreach($model->Get_sarparast() as $item){
                        echo "<option value=\"".$item->id."\"";
                        if($item->id == $model->ListContentEdit('sarteam')  ){echo "selected";}
                        echo">".$item->name." ".$item->familly."</option>";
                    }
                    ?>
                </select>

            </td>

        </tr>
        <tr>

            <td>تغییر اعتبار</td>

            <td>

                موجودی فعلی کاربر: <?php echo $model->GetPrice() ?><br>

                <input type="text" name="creditNew" value="0">

                <select name="changetype">

                    <option>نوع تغییر</option>

                    <option value="1">افزایش</option>

                    <option value="2">کاهش</option>





                </select>

            </td>

        </tr>

        <tr>

            <td>فعال/غیر فعال سازی</td>

            <td>

                <?php if($model->ListContentEdit('activation') == '1'){ ?>

                    <a href="http://odnoos.ir/22admin92/index.php?page=user&view=list&action=edit&id=<?php echo $_GET['id'] ?>&userdactive">غیر فعال شود</a> <?php }else{ ?>

                    <a href="http://odnoos.ir/22admin92/index.php?page=user&view=list&action=edit&id=<?php echo $_GET['id'] ?>&useractive">فعال شود</a>



                <?php } ?>

            </td>

        </tr>


        <tr>
            <td>کد پستی:</td>
            <td><input type="text" name="postalcode" value="<?php echo $model->ListContentEdit('postalcode') ?>"></td>

        </tr>


        <tr>
            <td>شماره ثابت:</td>
            <td><input type="text" name="tell" value="<?php echo $model->ListContentEdit('tell') ?>"></td>
        </tr>

        <tr>

            <td>&nbsp;</td>

            <td><input type="submit" name="sendBtn" value="ذخیره"></td>

        </tr>

    </table>

</form>

