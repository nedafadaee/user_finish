<?php

Cmsimport('pagination');

class model extends db{

    var $contentId;

    var $perpage = '10';
    function CheckMobile($m){
        $rec =  parent::query("SELECT * FROM user WHERE mobile = '$m' ");
        if(mysql_num_rows($rec) == 0 ){
            return true;
        }else{
            return false;
        }


    }
    function Get_cellphones($val){
        parent::query("select * from cellphone_business_tb where user_id = '".$this->contentId."'");
        return parent::Loadresult($val);
    }
    function exelOutput(){
        include $this->systempath."/api/report/report.php";
        $Creator = new Creator;
        $Creator->items['header'][] = "نام ";
		$Creator->items['header'][] = "نام خانوادگی ";
		$Creator->items['header'][] = "آدرس ایمیل ";
		$Creator->items['header'][] = "نام باشگاه ";
		$Creator->items['header'][] = " آدرس";
		$Creator->items['header'][] = "شماره موبایل ";
		$Creator->items['header'][] = "زمان ثبت نام ";
		$Creator->items['header'][] = "نوع کاربری ";
        $n=1;
		parent::query("SELECT user.*,club_tb.name as club_name from user 
		join club_tb on user.club_id = club_tb.id
		ORDER BY user.id DESC");
        foreach( parent::LoadResult() as $key=>$item){ 
		        if($item->UserType == 'SuperAdmin'){$usertype = "مدیر کل";} 
				if($item->marketer == '1'){$usertype = "بازاریاب";}
				if($item->UserType == 'user' && $item->manufacture == '0') {$usertype = "کاربر عادی";}
				if($item->manufacture == '1'){$usertype = "کسب و کار";}
				
				$Creator->items['body'][$n][] = $item->name ;
				$Creator->items['body'][$n][] = $item->familly ;
				$Creator->items['body'][$n][] = $item->email ;
				$Creator->items['body'][$n][] = $item->club_name ;
				$Creator->items['body'][$n][] = $item->address ;
				$Creator->items['body'][$n][] = $item->mobile ;
				$Creator->items['body'][$n][] = $item->reg_time ;
				$Creator->items['body'][$n][] = $usertype ;
				$n++;
             }
        echo($Creator->render());
    }
    function ListContent(){
		if($_POST['txt_club']){
			
				$search = "where club_tb.name = '".$_POST['txt_club']."'";
			} 

         if($_POST['txt_search']){
			if($_POST['txt_search'] == 'بازاریاب'){
				$search = "where marketer= '1' ";
			} 
			else if($_POST['txt_search'] == 'کسب و کار'){
				$search = "where manufacture = '1' ";
			} 
			else if($_POST['txt_search'] == 'کاربر'){
				$search = "where (manufacture != '1' and marketer != '1'";
			} 
			else if($_POST['txt_search'] == 'آنلاین'){
				$search = "where login = '1' ";
			} 
			else if($_POST['txt_search'] == 'آفلاین'){
				$search = "where login = '0' ";
			}
			else{ 
            $search = "where 
			     user.name   LIKE '%".$_POST['txt_search']."%' 
			  OR user.familly  LIKE '%".$_POST['txt_search']."%'
			  OR user.mobile   LIKE '%".$_POST['txt_search']."%' 
              OR user.email    LIKE '%".$_POST['txt_search']."%'
              ";
			}
        }
        ///else {$search = "";}


        global $nav;

        $nav = new pageNav();

        $nav->Queryrecord = "SELECT user.*,club_tb.name as club_name from user
			 join club_tb on user.club_id = club_tb.id $search
			   ORDER BY user.id DESC";
if($_POST['txt_search'] || $_POST['txt_club']){$nav->perPage = '1000';}
else{$nav->perPage = '20';}
        

        $start = $nav->startrecord();

        parent::query("SELECT user.*,club_tb.name as club_name from user
			 join club_tb on user.club_id = club_tb.id $search
			   ORDER BY user.id DESC  LIMIT $start,$nav->perPage  ");

        return  parent::LoadResult();

    }

    function Pagerend(){

        global $nav;
        return $nav->Render();

    }

    function userActive(){

        parent::query("UPDATE user SET activation = '1' WHERE id = '$this->contentId' ");

        echo ok("عملیات به خوبی انجام شد");

    }



    function userDActive(){

        // echo "UPDATE user SET activation = '0' WHERE id = '$this->contentId' ";

        parent::query("UPDATE user SET activation = '0' WHERE id = '$this->contentId' ");

        echo ok("عملیات به خوبی انجام شد");

    }

    function GetPrice(){

        parent::query("select price from mod_shop_user_price 

		where user_id ='".$this->contentId."'");



        $p = parent::LoadResult('price');

        if($p  == ''){

            return '0';

        }else{

            return $p;

        }

    }

    function CheckCredit(){

        $row = self::query("SELECT * FROM mod_shop_user_price WHERE  user_id = '$this->contentId' ");

        if(mysql_num_rows($row) > 0 ){

            return true;

        }else{

            return false;

        }

    }

    function newcredit(){

        $data['price']   = intval($_POST['creditNew']);

        $data['user_id'] = $this->contentId;

        $this->insert('mod_shop_user_price',$data);

        echo ok("تخصیص اعتبار به خوبی انجام شد");

    }

    function changeCredit($newprice){


        if($newprice > 0 ){

            if(self::CheckCredit()){

                if($_POST['changetype'] == '2'){

                    parent::query("UPDATE mod_shop_user_price SET price = price - $newprice WHERE user_id = '$this->contentId'");

                    echo ok("کاهش اعتبار به خوبی انجام شد");

                }

                if($_POST['changetype'] == '1'){

                    parent::query("UPDATE mod_shop_user_price SET price = price + $newprice WHERE user_id = '$this->contentId' ");

                    echo ok("افزایش اعتبار به خوبی انجام شد");

                }

            }else{

                self::newcredit();

            }

        }

    }
    function Get_sarparast(){
        parent::query("select id, name,familly from user where marketer='1' ");
        return parent::LoadResult();
    }
    function Get_besiness(){

        parent::query("select id, name from 	business_tb ");
        return parent::LoadResult();
    }

    function ListContentEdit($val){
        parent::query("SELECT user.* ,
		  mod_shop_area.area_name ,
		  mod_shop_city.city_name
		  FROM user
		  left join mod_shop_city on user.city_id = mod_shop_city.id
		  left join mod_shop_area on user.erea_id = mod_shop_area.id
		  WHERE user.id = '$this->contentId'   ");


        /* parent::query("SELECT

           user.* ,

           mod_shop_user.address ,
           mod_shop_user.sex,
           mod_shop_user.address,
           mod_shop_user.postalcode,
           mod_shop_user.tell
           FROM user

           left join mod_shop_user on mod_shop_user.user_id = user.id  WHERE user.id = '$this->contentId'   ");*/

        return  parent::LoadResult($val);

    }

    /*

           function shopUser($val){

               parent::query("SELECT $val FROM mod_shop_user WHERE user_id = '$this->contentId'   ");

               return  parent::LoadResult($val);

           }*/







    function ViewInfo($value=''){

        parent::query("SELECT * FROM mod_offer_user RIGHT JOIN user

                                            ON user.id=mod_offer_user.user_id 

                                            WHERE mod_offer_user.user_id ='$this->contentId' ");



        return  parent::LoadResult($value);

    }

    function userExist($mail){

        $rec = parent::query("SELECT * FROM user WHERE email = '".trim($mail)."' ");

        if(mysql_num_rows($rec) == '0'){

            return true;

        }else{

            return false;

        }

    }
    function manage_user(){
        $user_id = intval($_GET['id']);
        $manage = new manage_user;
        $manage->user_id = $user_id;
        $session["admin_login"] = true;
        $manage->set_sessions($session);
        $manage->login($this->SITE_URL);
    }
    function Get_business_id($busid){
        $row    = parent::query("SELECT business_id FROM user WHERE id= '".$this->contentId."' and FIND_IN_SET('".$busid."',business_id)");
        $number = mysql_num_rows($row);
        if($number>0){echo "selected";}
        else{echo "";}

    }



    function Sendsms_business($mobile,$busid){
        $db = new db;
        include($db->systempath."/include/sms.php");
        $sms        =new sms;
        $sms->to = scape($mobile);  //ارسال شماره ها
        $bus_expload = (explode(",",$busid));
        parent::query("SELECT * FROM business_tb");
        $code_business_final="";
        foreach(parent::LoadResult() as $item){
            if(in_array($item->id ,$bus_expload )){
                $code_expload = (explode("-",$item->code_business));
                $code_business_final .= "od".$code_expload[1]."-";
            }
        }
        $sms->text  = "فروشنده محترم با سلام، به خانواده ادنوس خوش آمدید؛ اطلاعات کسب و کار شما در سامانه ما با کد ".$code_business_final." ثبت شد";
        echo $sms->sendSMS();
    }
    /*function Sendsms_business($mobile){
            error_reporting(0);
            $db = new db;
            include($db->systempath."/include/sms.php");
            $sms        =new sms;
            $sms->to = scape($mobile);  //ارسال شماره ها
            parent::query("select code_business from business_tb where id ='".scape($_POST['drp_manufacture'])."'");
            $code = parent::Loadresult();
            $code_expload = (explode("-",$code[0]->code_business));
            $code_business_final = "od".$code_expload[1];
            $sms->text  = "فروشنده محترم با سلام، به خانواده ادنوس خوش آمدید؛ اطلاعات کسب و کار شما در سامانه ما با کد ".$code_business_final." ثبت شد";
            echo $sms->sendSMS();
        }*/
    function Save($data){
        $all_busid = '';// همه ی کسب و کار ها  که از صفحه پست شدن بهم وصل می کنیم
        foreach($_POST['drp_manufacture'] as $item){
            $all_busid .= $item.',';
        }
        if(!empty($data)){
//if(self::userExist($data['email'])){
            $password = $data['password'];
            if($_POST['admin']){$user_type= 'SuperAdmin';}
            else {$user_type= 'User';}
            if(strlen($_POST['phone']) =='11' ) {
                if (self::CheckMobile($_POST['phone'])) {
                    parent::query("INSERT INTO user (sarteam,sarparast,name,familly,sex,mobile,address,Password,email,reg_time,marketer,manufacture,business_id,UserType,activation)
						  VALUES(
                         '" . scape($_POST['drp_sarteam']) . "',
						 '" . scape($_POST['drp_sarparast']) . "',
						 '" . scape($_POST['name']) . "',
						 '" . scape($_POST['familly']) . "',
						 '" . scape($_POST['drp_jender']) . "',
						 '" . scape($_POST['phone']) . "',
						 '" . scape($_POST['address']) . "',
						 '" . $password . "',
						 '" . trim($data['email']) . "',
						 '" . time() . "',
						 '" . scape($_POST['marketer']). "',
						 '" . scape($_POST['manufacture']) . "',
						 '" . $all_busid . "',
						 '" . $user_type . "',
						 '1'
						 ) ");
					if(isset($_POST['otherphone']) && $_POST['otherphone'] !=""){
					
                    parent::query("insert into cellphone_business_tb (cellphone,user_id,business_id)
						 VALUES('".scape($_POST['otherphone'])."','" . mysql_insert_id() . "','" . $all_busid . "')");
						
						 }
                    self::SetUsergroup(mysql_insert_id());
                    if ($_POST['drp_manufacture'] != "") {//اگر برای این کاربر کسب و کار انتخاب کرد به شماره موبایلش  اس ام اس ارسال شود
                        self::Sendsms_business(scape($_POST['phone']), $all_busid);
                    }
                    header('Location: ' . $this->SITE_URL . '/22admin92//index.php?page=user&view=list&action=List');
                    exit;
                } else {
                    echo error("شماره موبایل تکراری است");
                }
            }else{echo error("فرمت شماره همراه اشتباه است");}
            //echo ok('به خوبی ثبت شد');

            /*}else{

             echo '<div id="error">ایمیل تکراری است.</div>';

            }*/

        }

    }



    function SetUsergroup($id){
        $row = parent::LoadResult("select id from admin_set_group  WHERE admin_id  = '$id'");
        if(mysql_num_rows($row)>0){
            parent::query("update admin_set_group set group_id='".scape($_POST['usergroup'])."' 
	  WHERE admin_id  = '$id'");
	 
        }
        else {
            parent::query("insert into admin_set_group(admin_id,group_id) values('$id','".scape($_POST['usergroup'])."')");
			
        }
    }
    function Selectbusiness(){
        parent::query("select manufacture from user where id = '$this->contentId' ");
        $row = parent::LoadResult();
        if ($row[0]->manufacture == '0'){return true;}
        else {return false;}
    }
    function Edit($data){
        $all_busid = '';// همه ی کسب و کار ها  که از صفحه پست شدن بهم وصل می کنیم
        foreach($_POST['drp_manufacture'] as $item){
            $all_busid .= $item.',';
        }
        if($_POST['manufacture'] !="" || $_POST['drp_manufacture'] !=""){
            $manufacture = '1';
        }
        if(isset($_POST['admin'])){

            $userType = 'SuperAdmin';

        }else{
            $userType = 'user';
        }
        $password    = md5($_POST['password']);
        if(!empty($data)){
           if (self::CheckDuplicateMobile($_POST['phone'])) {
               if (ValidMobile($_POST['phone']) && GetFirstNumber($_POST['phone'])) {
                   if ($_POST['password'] == '') {
                       $data2['sarteam'] = $_POST['drp_sarteam'];
                       $data2['sarparast'] = $_POST['drp_sarparast'];
                       $data2['mobile'] = $_POST['phone'];
                       $data2['name'] = $_POST['name'];
                       $data2['familly'] = scape($_POST['familly']);
                       $data2['sex'] = scape($_POST['drp_jender']);
                       $data2['address'] = scape($_POST['address']);
                       $data2['email'] = trim($data['email']);
                       $data2['tell'] = scape($_POST['tell']);
                       $data2['manufacture'] = scape($_POST['manufacture']);
                       $data2['business_id'] = $all_busid;
                       $data2['UserType'] = $userType;
					   $data2['marketer'] = scape($_POST['marketer']);
                       if (self::Selectbusiness()) {// اگر قبلا برای این کاربر کسب و کار انتخاب نکرده بود
                           if ($_POST['drp_manufacture'] != "") {/// و اگر الان برایش کسب و کار انتخاب کرد
                               self::Sendsms_business(self::ListContentEdit('mobile'), $all_busid);
                           }
                       }
                       $this->update('user', $data2, "WHERE id = '$this->contentId'");
                       self::update_modshop_user();
                       self::SetUsergroup($this->contentId);
                   } else {
                       //   echo "aaaaaaaaaaaaa";
                       $data['sarteam'] = $_POST['drp_sarteam'];
                       $data['sarparast'] = $_POST['drp_sarparast'];
                       $data['name'] = $_POST['name'];
                       $data['familly'] = scape($_POST['familly']);
                       $data['sex'] = scape($_POST['drp_jender']);
                       $data['mobile'] = $_POST['phone'];
                       $data['tell'] = scape($_POST['tell']);
                       $data['address'] = scape($_POST['address']);
                       $data['Password'] = $password;
                       $data['email'] = trim($data['email']);
                       $data['manufacture'] = scape($_POST['manufacture']);
                       $data['business_id'] = $all_busid;
                       $data['UserType'] = $userType;
					   $data['marketer'] = scape($_POST['marketer']);
                       if (self::Selectbusiness()) {// اگر قبلا برای این کاربر کسب و کار انتخاب نکرده بود
                           if (scape($_POST['drp_manufacture']) != "") {/// و اگر الان برایش کسب و کار انتخاب کرد
                               self::Sendsms_business(self::ListContentEdit('mobile'), $all_busid);
                           }
                       }
                       $this->update('user', $data, "WHERE id = '$this->contentId'");
                   }

                   self::cellphone();
                   self::changeCredit(intval($_POST['creditNew']));
                   self::update_modshop_user();
                   self::SetUsergroup($this->contentId);
                   header('Location: ' . $this->SITE_URL . '/22admin92//index.php?page=user&view=list&action=List');
                   exit;
               } else {
                   echo error("فرمت شماره موبایل معتبر نمی باشد");
               }
           }
            else{
                echo error("این شماره موبایل قبلا در سیستم ثبت نام کرده است");
            }
            //echo ok( 'به خوبی ذخیره شد');

        }

    }
    function CheckDuplicateMobile($mobile=''){

        if(isset($mobile)){
            $select = parent::query("SELECT * FROM user WHERE  mobile  = '$mobile'
            and id !='".$this->contentId."' ");
            if(mysql_num_rows($select) == 0 ){
                return true;
            }else{
                return false;
            }

        }
    }
    function cellphone(){
        $row = parent::query("select other_phone_id from cellphone_business_tb where user_id = '".$this->contentId."'");

        $num = mysql_num_rows($row);
        if($num > 0){
            parent::query("update cellphone_business_tb set cellphone = '".scape($_POST['otherphone'])."'
		 where user_id = '".$this->contentId."'");
        }
        else{
            parent::query("insert into cellphone_business_tb (cellphone,user_id,business_id)
						 VALUES('".scape($_POST['otherphone'])."','".$this->contentId."','".$all_busid."')
						 ");
        }
    }
    function update_modshop_user(){
        $data['tell']       = scape($_POST['phone']);
        $data['address']    = scape($_POST['address']);
        $data['postalcode'] = scape($_POST['postalcode']);

        $this->update('mod_shop_user',$data,"WHERE user_id = '$this->contentId'");

    }
    function DeleteRecord(){
		parent::query("delete from user where id = '".intval($_GET['duid'])."'");
		echo ok("عملیات حذف به خوبی انجام شد");
		}

    function DeleteSave($data){

        if(!empty($data)){

            foreach($data as $item){

                parent::query("DELETE FROM user WHERE id = '$item' ");

            }

            echo ok("عملیات حذف به خوبی انجام شد");

        }

    }



    function viewcity($id){

        parent::query("SELECT * FROM mod_offer_city  WHERE id = '$id'   ");

        return  parent::LoadResult('city_name');

    }

    function viewcount($id){
        parent::query("SELECT * FROM mod_offer_country  WHERE id = '$id'   ");
        return  parent::LoadResult('name');
    }

    function viewProvince($id){
        parent::query("SELECT * FROM mod_offer_province  WHERE id = '$id'   ");
        return  parent::LoadResult('province_name');
    }

    /*function ListUsergroup(){
        parent::query("SELECT * FROM admin_group");
        return parent::LoadResult();
    }
    function Get_adminGroup($val,$group){
        parent::query("select $val from admin_set_group  
		 WHERE group_id  = '".$group."'");
        return parent::Loadresult($val);
    }
    function user_group(){
        $html  = "<select name='usergroup'>";
        $html .=  "<option value='0'>بدون گروه</option>";
        foreach(self::ListUsergroup() as $item){
            $html .=  "<option value='$item->id'";
            if(self::Get_adminGroup('admin_id',$item->id) == $this->contentId){
                $html .= "selected";}
            $html .= ">$item->name</option>";
        }
        $html .= "</select>";
        return $html;
    }*/
  
}
