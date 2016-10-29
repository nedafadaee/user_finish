<page title="کاربران" />
<?php
    $GLOBALS['acl']->PagePermission('user_view_search');
    $model = new model();
	if(isset($_POST['sendBtn'])){
		$model->ListContent();
		}
?>

  <div class="col-xs-12">
          <form class="form-horizontal bg-form" action="" method="post" >
              <fieldset>
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">نام:</label>
                  <div class="col-md-4">
                    <input id="names" name="names" type="text" placeholder="" class="form-control" 
                    value="<?php echo scape($_POST['names']) ?>">
                  </div>
                  <div class="col-md-2">
                    <input id="chk_name" name="chk_name" type="checkbox" placeholder="" class="form-control" 
                    value="1" <?php if(scape($_POST['chk_name']) == '1'){echo "checked";} ?>>
                  </div>
                </div>
                
                
                 <div class="form-group">
                  <label class="col-md-2 control-label" for="name">نام خانوادگی:</label>
                  <div class="col-md-4">
                    <input id="familly" name="familly" type="text" placeholder="" class="form-control" value="<?php  echo scape($_POST['familly']) ?>">
                  </div>
                  <div class="col-md-2">
                    <input id="chk_familly" name="chk_familly" type="checkbox" placeholder="" class="form-control">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">جنسیت:</label>
                  <div class="col-md-4">
                    <select name="jender"  class="form-control ui search dropdown">
                    <option value="">انتخاب کنید</option>
                     <option value="men" <?php if(scape($_POST['jender']) == "men"){echo "selected";} ?>>مرد</option>
                     <option value="women" <?php if(scape($_POST['jender']) == "women"){echo "selected";} ?>>زن</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <input id="chk_jender" name="chk_jender" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_jender']) == '1'){echo "checked";} ?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-md-2 control-label" for="name">شماره همراه:</label>
                  <div class="col-md-4">
                    <input id="cellphone" name="cellphone" type="text" placeholder="" class="form-control" value="<?php  echo scape($_POST['cellphone']) ?>">
                  </div>
                  <div class="col-md-2">
                    <input id="chk_cellphone" name="chk_cellphone" type="checkbox" placeholder="" 
                    class="form-control">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">ایمیل:</label>
                  <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="" class="form-control" value="<?php  echo scape($_POST['email']) ?>">
                  </div>
                  <div class="col-md-2">
                    <input id="chk_email" name="chk_email" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_email']) == '1'){echo "checked";} ?>>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-2 control-label" for="name">نوع کاربری:</label>
                  <div class="col-md-4">
                    <input id="typeuser" name="typeuser" type="text" placeholder="" class="form-control"
                    value="<?php  echo scape($_POST['typeuser']) ?>">
                  </div>
                  <div class="col-md-2">
                   <input id="chk_typeuser" name="chk_typeuser" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_typeuser']) == '1'){echo "checked";} ?>>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label class="col-md-2 control-label" for="name">نام باشگاه:</label>
                  <div class="col-md-4">
                    <input id="club" name="club" type="text" placeholder="" class="form-control" value="<?php  echo scape($_POST['club']) ?>">
                  </div>
                  <div class="col-md-2">
                    <input id="chk_club" name="chk_club" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_club']) == '1'){echo "checked";} ?>>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label class="col-md-2 control-label" for="name">از تاریخ:</label>
                  <div class="col-md-4">
                    <input id="start" name="start" type="text" placeholder="" class="form-control">
                    [<span id='date_btn_2'>انتخاب</span>]
                     <script type="text/javascript">
					Calendar.setup({
						inputField     :    "start",   // id of the input field
						button         :    "date_btn_2",   // trigger for the calendar (button ID)
						ifFormat       :    "%Y/%m/%d",       // format of the input field
						showsTime      :    false,
						dateType       :    'jalali',
						timeFormat     :    "24",
						weekNumbers    : false
					});
					</script>
                  </div>
                  <div class="col-md-2">
                    <input id="chk_start" name="chk_start" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_start']) == '1'){echo "checked";} ?>>
                     
                  </div>
                </div>
                
                 <div class="form-group">
                  <label class="col-md-2 control-label" for="name">تا تاریخ :</label>
                  <div class="col-md-4">
                    <input id="end" name="end" type="text" placeholder="" class="form-control">
                    [<span id='date_btn_3'>انتخاب</span>]
                    <script type="text/javascript">
					Calendar.setup({
						inputField     :    "end",   // id of the input field
						button         :    "date_btn_3",   // trigger for the calendar (button ID)
						ifFormat       :    "%Y/%m/%d",       // format of the input field
						showsTime      :    false,
						dateType       :    'jalali',
						timeFormat     :    "24",
						weekNumbers    : false
					});
					</script>
                  </div>
                  <div class="col-md-2">
                    <input id="chk_end" name="chk_end" type="checkbox" placeholder="" class="form-control"
                     value="1" <?php if(scape($_POST['chk_end']) == '1'){echo "checked";} ?>>
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
<?php 

if(isset($_SESSION['search'])){ ?>
<div class="row">
     <div class="col-xs-12">
       <div class="transaction table-responsive ">
            <table class="table table-transaction">
  <thead>
    <td width="20">#<input type="submit" name="DeleteBtn" class="DeleteRowInput" style="display: none;" /></td>
    <td width="78">نام</td>
    <td width="72">نام خانوادگی</td>
    <td width="340">نام باشگاه</td>
    <td width="340">شماره همراه</td>
    <td width="100">ایمیل</td>
    <td width="340">زمان ثبت نام</td>
     <td width="112">وضعیت</td>
    <td width="109">نوع کاربری</td>
    <td width="150">ورود به صفحه شخصی کاربر</td>
    <td width="150">عملیات</td>
  </thead>
 <?php foreach($model->ListContent() as $item){ ?> 
  <tr>
    <td><?php echo toolbar::DeteteTask($item->id) ?></td>
    <td>
      <a href="?page=user&view=list&action=edit&id=<?php echo $item->id ?>" >
              <?php echo $item->name ?>
      </a>
    </td>  
    <td><?php echo $item->familly ?></td>
 <td ><?php echo $item->club_name ?></td>
    <td><?php echo $item->mobile ?></td>
   <td><?php echo $item->email ?></td>
    <td><?php if($item->reg_time !=""){echo Time_Fa($item->reg_time); }else{echo "";} ?></td>
     <td><?php if($item->login == '1'){ echo 'آنلاین';}else{ echo 'آفلاین'; } ?></td>
     <td><?php if($item->business_id == '1') echo "کسب و کار";
	 if($item->marketer == '1') echo "بازاریاب";
	  else  if($item->marketer != '1' && $item->business_id != '1'){ echo "کاربر عادی";}
	    ?></p>
</td>

    <td align="center">
        <a  style="float: right; margin-left: 4px;" target="_blank"
        href="?page=user&view=list&manage=true&id=<?php echo $item->id ?>&blog=<?php echo $item->blog_url ?>"
        >ورود</a>
    </td>
    <td align="center">
    <?php echo "<a  class=\"showicon\" onclick=\"return confirm('آیا برای حذف مطمئن هستید؟')\" 
	href=\"?page=user&view=list&duid=".$item->id."\">حذف</a>"; ?>
    </td>
     </tr>
  <?php
 }
  ?>
</table>
<?php
 echo $model->Pagerend() ?>
        </div>
     </div>          
</div>     
<?php } ?>