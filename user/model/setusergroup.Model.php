<?php
   Cmsimport('pagination');
   class model extends db{
       var $contentId;
	   var $group_id;
       var $perpage = '10';
  
    function Save($post){
		  parent::query("delete from user_set_group where group_id = '".$this->group_id."'");
		  foreach ($post['drp_users']  as $key=>$value){
			   if($value!=""){
				 $data['user_id'] = $value;
				 $data['group_id'] = $this->group_id;
				 parent::insert('user_set_group',$data);
				}// ond of if value !=""
		   }//end of foreach	
		  header('Location: '.$this->SITE_URL.'/22admin92/index.php?page=user&view=usergroup&action=List');
		  exit;
	}
	 function GetAllUsers(){
		  parent::query("SELECT * FROM user left join UserHistory on UserHistory.user_id = user.id
		  where UserHistory.isdelete !='1'");
          return  parent::LoadResult(); 
	}
	function GetRolesAllocate(){
		 parent::query("SELECT * FROM user_set_group where group_id = '".$this->group_id."'");
         return  parent::LoadResult(); 
		 }  
 }
