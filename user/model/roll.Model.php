<?php

   Cmsimport('pagination');

   class model extends db{

       var $contentId;

       var $perpage = '10';

   function ListContent(){
           parent::query("SELECT * FROM acl_role ORDER BY role_id DESC");
           return  parent::LoadResult();      
       }
   function ListContentEdit($val){
           parent::query("SELECT $val FROM acl_role WHERE role_id = '$this->contentId'   ");
           return  parent::LoadResult($val);               
       }

    function Save($data){
	         parent::query("INSERT INTO acl_role (name)VALUES('".scape($data['name'])."') ");
   	  	     header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=roll&action=List');
             exit;
	   }
	function Edit($data){
		parent::query("UPDATE acl_role SET 
			name        = '".scape($data['name'])."'
			WHERE role_id = '$this->contentId'  
		");  
		header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=roll&action=List');
        exit;
     }
     function DeleteSave($data){
            if(!empty($data)){
              foreach($data as $item){
				$row1 = parent::query("select user_role_id from acl_user_role where role_id = '".$item."'");
				$num1 = mysql_num_rows($row1);
				
				$row2 = parent::query("select role_action_id from acl_role_action where role_id = '".$item."'");
				$num2 = mysql_num_rows($row2);
				
				if($num1 == 0 && $num2 == 0){ 
				 
                    parent::query("DELETE FROM acl_role WHERE role_id = '$item' ");
					echo ok("عملیات حذف به خوبی انجام شد");
				   }
				   else {echo error("شما اجازه حذف این رکورد را ندارید");}
                }
                
            }
      } 
	function DeleteRecord(){
		$row1 = parent::query("select user_role_id from acl_user_role 
		where role_id = '".intval($_GET['duid'])."'");
		$num1 = mysql_num_rows($row1);
		
		$row2 = parent::query("select role_action_id from acl_role_action 
		where role_id = '".intval($_GET['duid'])."'");
		$num2 = mysql_num_rows($row2);
		if($num1 == 0 && $num2 == 0){   
			parent::query("delete from acl_role where role_id = '".intval($_GET['duid'])."'");
			echo ok("عملیات حذف به خوبی انجام شد");
		}
		else {
			echo error("شما اجازه حذف این رکورد را ندارید");
		 }
		} 
   }