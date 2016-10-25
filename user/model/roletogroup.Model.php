<?php
   Cmsimport('pagination');
   class model extends db{
       var $group_id;
       var $perpage = '10';
	 function ListRoles(){
           parent::query("SELECT * FROM acl_role");
           return  parent::LoadResult();      
       }
	 function Save($post){
		  parent::query("delete from acl_role_action where role_id = '".$this->role_id."'");
		  precode($post['chk_action']);
		  foreach ($post['chk_action'] as $key=>$value){
			   if($value!=""){
				 $data['role_id']   = $this->role_id;
				 $data['action_id'] = $value;
				 //var_dump($data);
				 parent::insert('acl_role_action',$data);
				}// ond of if value !=""
		   }//end of foreach	
		  header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=roletoaction&action=List');
		  exit;
	} 
    function ListRoleToGroup(){
           parent::query("SELECT * FROM acl_role_group where group_id = '".$this->group_id."'");
           return  parent::LoadResult();      
       }   
   }
