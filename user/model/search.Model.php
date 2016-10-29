<?php
Cmsimport('pagination');
class model extends db{
    var $contentId;
    var $perpage = '20';
   
	 function ConvertTime2($data){
        if(!empty($data)){
            $array          = explode("/",$data);
            $sal             = $array[0];
            $month        = $array[1];
            $day            = $array[2];
            $stamptime =  jmktime(00,00,00,$month,$day,$sal);
           return ($stamptime);
        }
    }  
  
    function ListContent(){
		 if(scape($_POST['names']) != "" && scape($_POST['chk_name']) =="1"){
				$search = "and user.name LIKE '%".scape($_POST['names'])."%'";
			}
		 if(scape($_POST['familly']) != "" && scape($_POST['chk_familly']) !=""){
				$search .= "and user.familly  LIKE '%".scape($_POST['familly'])."%'";
			}
		if(scape($_POST['jender']) != "" && scape($_POST['chk_jender']) !=""){
				$search .= "and userprofile.gender  LIKE '%".scape($_POST['jender'])."%'";
			}
			
			
		if(scape($_POST['typeuser']) != "" && scape($_POST['chk_typeuser']) !=""){
				if($_POST['typeuser'] == 'بازاریاب'){
				$search = "and user.marketer= '1' ";
				} 
				else if($_POST['typeuser'] == 'کسب و کار'){
					$search = "and user.manufacture = '1' ";
				} 
				else if($_POST['typeuser'] == 'کاربر'){
					$search = "and (user.manufacture != '1' and user.marketer != '1'";
				} 
			}
			if(scape($_POST['club']) != "" && scape($_POST['chk_club']) !=""){
				$search .= "and club_tb.name  = '".scape($_POST['club'])."'";
			}
			if(scape($_POST['start']) != "" && scape($_POST['chk_start']) !=""){
				$search .= "and user.reg_time  >= '".self::ConvertTime2($_POST['start'])."'";
			}
			if(scape($_POST['end']) != "" && scape($_POST['chk_end']) !=""){
				$search .= "and user.reg_time  <= '".self::ConvertTime2($_POST['end'])."'";
			} 
			
			if(scape($_POST['cellphone']) != "" && scape($_POST['chk_cellphone']) !=""){
				$search .= "and user.mobile  LIKE '%".scape($_POST['cellphone'])."%'";
			}
			
			if(scape($_POST['email']) != "" && scape($_POST['chk_email']) !=""){
				$search .= "and user.email  LIKE '%".scape($_POST['email'])."%'";
			}
			if($search != '' ){
			$_SESSION['search'] = $search;
			}
        global $nav;
        $nav = new pageNav();
		$nav->perPage = '2';
        $nav->Queryrecord = "SELECT user.*,
		club_tb.name as club_name from user
		join club_tb on user.club_id = club_tb.id
		left join UserHistory on UserHistory.user_id = user.id
		left join userprofile on userprofile.user_id = user.id
		where UserHistory.isdelete !='1' ".$_SESSION['search']."
		ORDER BY user.id DESC";
		/*if($_POST['txt_search'] || $_POST['txt_club']){$nav->perPage = '1000';}
		else{;}*/
        $start = $nav->startrecord();
		
        parent::query("SELECT user.*,club_tb.name as club_name from user
		join club_tb on user.club_id = club_tb.id
		left join UserHistory on UserHistory.user_id = user.id 
		left join userprofile on userprofile.user_id = user.id
		where UserHistory.isdelete !='1' ".$_SESSION['search']."
		ORDER BY user.id DESC  LIMIT $start,$nav->perPage  ");
		if($_SESSION['search'] !=""){
          return  parent::LoadResult();
		}
    }
    function Pagerend(){
        global $nav;
        return $nav->Render();
    }
 

    function manage_user(){
        $user_id = intval($_GET['id']);
        $manage = new manage_user;
        $manage->user_id = $user_id;
        $session["admin_login"] = true;
        $manage->set_sessions($session);
        $manage->login($this->SITE_URL);
    }
  
 
}
