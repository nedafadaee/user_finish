<?php
Cmsimport('pagination');
class model extends db{
    var $contentId;
    var $perpage = '10';
    function CheckMobile($m){
        $rec =  parent::query("SELECT * FROM user WHERE mobile = '$m' ");
        if(mysql_num_rows($rec) == 0 ){
            return true;
        }
		else{
            return false;
        }
    }
    function Get_cellphones(){
        parent::query("select * from cellphone_business_tb where user_id = '".$this->contentId."'");
        return parent::Loadresult();
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
				$search = "and marketer= '1' ";
			} 
			else if($_POST['txt_search'] == 'کسب و کار'){
				$search = "and manufacture = '1' ";
			} 
			else if($_POST['txt_search'] == 'کاربر'){
				$search = "and (manufacture != '1' and marketer != '1'";
			} 
			else if($_POST['txt_search'] == 'آنلاین'){
				$search = "and login = '1' ";
			} 
			else if($_POST['txt_search'] == 'آفلاین'){
				$search = "and login = '0' ";
			}
			else{ 
            $search = "and 
			     user.name   LIKE '%".$_POST['txt_search']."%' 
			  OR user.familly  LIKE '%".$_POST['txt_search']."%'
			  OR user.mobile   LIKE '%".$_POST['txt_search']."%' 
              OR user.email    LIKE '%".$_POST['txt_search']."%'
              ";
			}
        }
        global $nav;
        $nav = new pageNav();
        $nav->Queryrecord = "SELECT user.*,
		club_tb.name as club_name from user
		join club_tb on user.club_id = club_tb.id
		left join UserHistory on UserHistory.user_id = user.id
		where UserHistory.isdelete !='1' $search
		ORDER BY user.id DESC";
		if($_POST['txt_search'] || $_POST['txt_club']){$nav->perPage = '1000';}
		else{$nav->perPage = '20';}
        $start = $nav->startrecord();
        parent::query("SELECT user.*,club_tb.name as club_name from user
		join club_tb on user.club_id = club_tb.id
		left join UserHistory on UserHistory.user_id = user.id 
		where UserHistory.isdelete !='1' $search
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
        parent::query("UPDATE user SET activation = '0' WHERE id = '$this->contentId' ");
        echo ok("عملیات به خوبی انجام شد");
    }
    function GetPrice(){
        parent::query("select price from mod_shop_user_price 
		where user_id ='".$this->contentId."'");
        $p = parent::LoadResult('price');
        if($p  == ''){
            return '0';
        }
		else{
            return $p;
        }
    }
    function CheckCredit(){
        $row = self::query("SELECT * FROM mod_shop_user_price WHERE  user_id = '$this->contentId' ");
        if(mysql_num_rows($row) > 0 ){
            return true;
        }
		else{
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
                    parent::query("UPDATE mod_shop_user_price SET price = price - $newprice 
					WHERE user_id = '$this->contentId'");
                    echo ok("کاهش اعتبار به خوبی انجام شد");
                }
                if($_POST['changetype'] == '1'){
                    parent::query("UPDATE mod_shop_user_price SET price = price + $newprice 
					WHERE user_id = '$this->contentId' ");
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

        parent::query("select id, name from business_tb ");
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
        return  parent::LoadResult($val);

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
        $row    = parent::query("SELECT business_id FROM user WHERE id= '".$this->contentId."' 
		and FIND_IN_SET('".$busid."',business_id)");
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
    function Save($data){
        $all_busid = '';// همه ی کسب و کار ها  که از صفحه پست شدن بهم وصل می کنیم
        foreach($_POST['drp_manufacture'] as $item){
            $all_busid .= $item.',';
        }
        if(!empty($data)){
            $password = $data['password'];
            if($_POST['admin']){$user_type= 'SuperAdmin';}
            else {$user_type= 'User';}
            if(strlen($_POST['phone']) =='11' ) {
                if (self::CheckMobile($_POST['phone'])) {
                    parent::query("INSERT INTO user (sarteam,sarparast,name,familly,mobile,Password,email,reg_time,marketer,manufacture,business_id,UserType,activation)
						  VALUES(
                         '" . scape($_POST['drp_sarteam']) . "',
						 '" . scape($_POST['drp_sarparast']) . "',
						 '" . scape($_POST['name']) . "',
						 '" . scape($_POST['familly']) . "',
						 '" . scape($_POST['phone']) . "',
						 '" . $password . "',
						 '" . trim($data['email']) . "',
						 '" . time() . "',
						 '" . scape($_POST['marketer']). "',
						 '" . scape($_POST['manufacture']) . "',
						 '" . $all_busid . "',
						 '" . $user_type . "',
						 '1'
						 ) ");
						$last_user_id =  mysql_insert_id() ; 
					if(isset($_POST['otherphone']) && $_POST['otherphone'] !=""){
						$exother = explode("-",scape($_POST['otherphone']));
						foreach($exother as $exx){
                    	parent::query("insert into cellphone_business_tb (cellphone,user_id,business_id)
						VALUES('".$exx."','" .$last_user_id. "','" . $all_busid . "')");
						 }
					}
					self::SetAddessInfo($last_user_id);
                    if ($_POST['drp_manufacture'] != "") {
						//اگر برای این کاربر کسب و کار انتخاب کرد به شماره موبایلش  اس ام اس ارسال شود
                        self::Sendsms_business(scape($_POST['phone']), $all_busid);
                    }
                    header('Location: ' . $this->SITE_URL .'/22admin92//index.php?page=user&view=list&action=List');
                    exit;
					} 
					else {
						echo error("شماره موبایل تکراری است");
					}
            }
			else{echo error("فرمت شماره همراه اشتباه است");}
        }
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
                   } 
				   else {
                       $data['sarteam'] = $_POST['drp_sarteam'];
                       $data['sarparast'] = $_POST['drp_sarparast'];
                       $data['name'] = $_POST['name'];
                       $data['familly'] = scape($_POST['familly']);
                       $data['mobile'] = $_POST['phone'];
                       $data['tell'] = scape($_POST['tell']);
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
				   if(isset($_POST['otherphone']) && $_POST['otherphone'] !=""){
				      self::UpdateCellPhone($all_busid);
				   }
                   self::changeCredit(intval($_POST['creditNew']));
                   self::SetAddessInfo($this->contentId);
                   header('Location: ' . $this->SITE_URL . '/22admin92//index.php?page=user&view=list&action=List');
                   exit;
               } else {
                   echo error("فرمت شماره موبایل معتبر نمی باشد");
               }
           }
            else{
                echo error("این شماره موبایل قبلا در سیستم ثبت نام کرده است");
            }
        }
    }
	function listProvince(){
			   parent::query("SELECT * FROM mod_shop_province ORDER BY id DESC ");
			   return  parent::LoadResult();      
		   }  
    function GetAddessInfoById($val){
		
			   parent::query("SELECT userprofile.* ,
			   mod_shop_province.provance_name,
			   mod_shop_city.city_name,
			   mod_shop_area.area_name
			   FROM userprofile
			   left join mod_shop_province on userprofile.stateid = mod_shop_province.id
			   left join mod_shop_city on userprofile.cityid =mod_shop_city.id 
			   left join mod_shop_area on  userprofile.regionid = mod_shop_area.id 
			   where userprofile.user_id = '".$this->contentId."'");
			   return  parent::LoadResult($val);      
		   }  		   
	function SetAddessInfo($user_id){
		$datai['gender']  = scape($_POST['drp_jender']);
        $datai['address'] = scape($_POST['address']);
		$datai['stateid'] = scape($_POST['prov_id']);
		$datai['cityid'] = scape($_POST['city_id']);
		$datai['regionid'] = scape($_POST['area_id']);
		$datai['user_id'] = $user_id;
		parent::insert('userprofile',$datai);
		}
	function Selectbusiness(){
        parent::query("select manufacture from user where id = '$this->contentId' ");
        $row = parent::LoadResult();
        if ($row[0]->manufacture == '0'){return true;}
        else {return false;}
    }
	function UpdateCellPhone($all_busid){
		
		parent::query("delete from cellphone_business_tb where user_id = '".$this->contentId."'");
		$explodec = (explode("-",scape($_POST['otherphone'])));
		foreach($explodec as $exxc){
			$datac['user_id']   = $this->contentId;
			$datac['cellphone'] = $exxc;
			$datac['business_id'] = $all_busid;  
			parent::insert('cellphone_business_tb',$datac);
		}
	}
    function CheckDuplicateMobile($mobile=''){
        if(isset($mobile)){
            $select = parent::query("SELECT * FROM user WHERE  mobile  = '$mobile'
            and id !='".$this->contentId."' ");
            if(mysql_num_rows($select) == 0 ){
                return true;
            }
			else{
                return false;
            }

        }
    }
    function DeleteRecord(){
	    $row = parent::query("select id from UserHistory where user_id = '".intval($_GET['duid'])."'");
		$number = mysql_num_rows($row);
		if($number > 0 ){
			parent::query("update UserHistory set isdelete = '1' where user_id = '".intval($_GET['duid'])."'");
		}
		else {
			parent::query("insert into UserHistory (user_id,isdelete)	VALUES('".intval($_GET['duid'])."','1')");	
		}
		//parent::query("delete from user where id = '".intval($_GET['duid'])."'");
		echo ok("عملیات حذف به خوبی انجام شد");
		}
    function DeleteSave($data){
        if(!empty($data)){
            foreach($data as $item){
				$row = parent::query("select id from UserHistory where user_id ='".$item."'");
				$number = mysql_num_rows($row);
				if($number > 0 ){
					parent::query("update UserHistory set isdelete = '1' where user_id = '".$item."'");
				}
				else {
					parent::query("insert into UserHistory (user_id,isdelete)	VALUES('".$item."','1')");	
				}
                //parent::query("DELETE FROM user WHERE id = '$item' ");
            }
            echo ok("عملیات حذف به خوبی انجام شد");
        }
    }
}
