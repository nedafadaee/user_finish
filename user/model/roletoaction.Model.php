<?php
   Cmsimport('pagination');
   class model extends db{
       var $role_id;
       var $perpage = '10';
	 function ListActions($componentid){
           parent::query("SELECT * FROM acl_role_action_list where component_id = '".$componentid."'");
           return  parent::LoadResult();      
       }
	 function ComponentName(){
           parent::query("SELECT * FROM acl_all_components");
           return  parent::LoadResult();      
       }
	   
	 function Save($post){
		  parent::query("delete from acl_role_action where role_id = '".$this->role_id."'");
		  foreach ($post['chk_action'] as $key=>$value){
			   if($value!=""){
				 $data['role_id']   = $this->role_id;
				 $data['action_id'] = $value;
				 //var_dump($data);
				 parent::insert('acl_role_action',$data);
				}// ond of if value !=""
		   }//end of foreach	
		  header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=roll&action=List');
		  exit;
	} 
    function ListActionToRole(){
           parent::query("SELECT * FROM acl_role_action where role_id = '".$this->role_id."'");
           return  parent::LoadResult();      
       }   
   }
