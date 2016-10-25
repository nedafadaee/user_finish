<page title="کاربران" />
<?php
    $GLOBALS['acl']->PagePermission('user_view');
    $model = new model();
    $controller = new controller();
    $toolbar = new toolbar;
   if(isset($_POST['sortBtn'])){ 
    @$model->SortSave($controller->AllowSort($_POST['sortID']));
   } 
   if(isset($_POST['DelID'])){ 
    @$model->DeleteSave($controller->AllowDelete($_POST['DelID']));
   }
   if($_GET['manage']=='true'){
	   $model->manage_user();
   }
   if(isset($_GET['duid'])){
	   $model->DeleteRecord();
	   }
   $db = new db;
   echo "<a href=\"".$db->SITE_URL."api/report/report.xls\">دریافت فایل خروجی اکسل</a>";
?>
<form action="" method="post"  class="form-horizontal bg-form">
 <div class="form-group">
      
      <div class="col-md-3">
        <input id="txt_search" name="txt_search" type="text" placeholder="کاربر را جستجو کنید" class="form-control">
      </div>
      <div class="col-md-3">
        <input type="submit" name="btn_search" id="btn_search" value="جستجو"  class="btn btn-primary showicon">
      </div>
      
      <div class="col-md-3">
        <input id="txt_club" name="txt_club" type="text" placeholder="باشگاه را جستجو کنید" class="form-control">
      </div>
      <div class="col-md-3">
        <input type="submit" name="btn_club" id="btn_club" value="جستجو"  class="btn btn-primary showicon" />
      </div>
 </div>

<!--<input type="text" name="txt_search" id="txt_search" placeholder="کاربر را جستجو کنید" class="form-conrol" />
<input type="submit" name="btn_search" id="btn_search" value="جستجو">
<input type="text" name="txt_club" id="txt_club" placeholder="باشگاه را جستجو کنید" />
<input type="submit" name="btn_club" id="btn_club" value="جستجو">-->



  <div class="row">
     <div class="col-xs-12">
       <div class="transaction table-responsive ">
            <table class="table table-transaction">
<!--<table width="800" border="0"  class="orderRecordmeeeee" style="width: 100%;">-->

  <thead>

    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>

    <td width="78">نام</td>
    <td width="72">نام خانوادگی</td>
    <td width="340">نام باشگاه</td>
    <td width="340">شماره همراه</td>
    <td width="100">ایمیل</td>
    <td width="340">زمان ثبت نام</td>
    <!--<td width="340">آخرین بازدید</td>-->
     <td width="112">وضعیت</td>
    <td width="109">نوع کاربری</td>
    <!--<td width="150">تعیین گروه کاربر</td>-->
    <!--<td width="150">تعیین نقش کاربر</td>-->
    <td width="150">ورود به صفحه شخصی کاربر</td>
    <td width="150">عملیات</td>
    <!--<td width="94">اختصاص کد هدیه</td>-->
  </thead>

 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->id) ?></td>
    <td>
      <a href="<?php echo $toolbar->EditTask($item->id) ?>" onclick="parent.address('<?php echo $item->id ?>','<?php echo @import_note($_GET['input']) ?>')" >
              <?php echo $item->name ?>
      </a>
    </td>  
    <td><?php echo $item->familly ?></td>
 <td ><?php echo $item->club_name ?></td>
    <td><?php echo $item->mobile ?></td>
   <td><?php echo $item->email ?></td>
    <td><?php echo Time_Fa($item->reg_time) ?></td>
    <!--<td><?php //if($item->last_visit !=""){echo Time_Fa($item->last_visit);} ?></td>-->
     <td><?php if($item->login == '1'){ echo 'آنلاین';}else{ echo 'آفلاین'; } ?></td>
     <td><?php if($item->business_id == '1') echo "کسب و کار";
	 if($item->marketer == '1') echo "بازاریاب";
	  else  if($item->marketer != '1' && $item->business_id != '1'){ echo "کاربر عادی";}
	    ?></p>
</td>
<!--<td align="center">
        <a  style="float: right; margin-left: 4px;" target="_blank"
         href="?page=user&view=setusergroup&action=add&userid=<?php //echo $item->id ?>"
          target="new"  ><img src="<?php //echo $db->AdminUrl ?>/templates/red/image/setgroup.png" width="25px" height="25px" /></a>
    </td>-->
<!--<td align="center">
        <a  style="float: right; margin-left: 4px;" target="_blank"
         href="?page=user&view=setrole&action=add&userid=<?php //echo $item->id ?>"
          target="new"  ><img src="<?php //echo $db->AdminUrl ?>/templates/red/image/setrole.png" width="25px" height="25px" /></a>
    </td>-->
    <td align="center">
        <a  style="float: right; margin-left: 4px;" target="_blank"
        href="?page=user&view=list&manage=true&id=<?php echo $item->id ?>&blog=<?php echo $item->blog_url ?>"
        >ورود</a>
    </td>
    <td align="center">
    <?php echo "<a  class=\"showicon\" onclick=\"return confirm('آیا برای حذف مطمئن هستید؟')\" 
	href=\"?page=user&view=list&duid=".$item->id."\">حذف</a>"; ?>
       <!-- <a class="showicon"
        href="?page=user&view=list&duid=<?php echo $item->id ?>"
        >حذف</a>-->
    </td>
     </tr>
  <?php
 }
  ?>
</table>
</div>
</div>
</div>
<?php
 $model->exelOutput();
 echo $model->Pagerend() ?>

</form>