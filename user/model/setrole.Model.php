<?php
   Cmsimport('pagination');
   class model extends db{
       var $contentId;
	   var $role_id;
       var $perpage = '10';
  
    function Save($post){
		  parent::query("delete from acl_user_role where role_id = '".$this->role_id."'");
		  precode($post['drp_users']);
		  foreach ($post['drp_users'] as $key=>$value){
			   if($value!=""){
				 $data['role_id'] = $this->role_id;
				 $data['user_id'] = $value;
				 parent::insert('acl_user_role',$data);
				}// ond of if value !=""
		   }//end of foreach	
		  header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=roll&action=List');
		  exit;
	}
	function GetAllUsers(){
		 parent::query("SELECT * FROM user left join UserHistory on UserHistory.user_id = user.id
		 where UserHistory.isdelete !='1'");
         return  parent::LoadResult(); 
	}
	function GetRolesAllocate(){
		 parent::query("SELECT * FROM acl_user_role where role_id = '".$this->role_id."'");
         return  parent::LoadResult(); 
	}  
 }
