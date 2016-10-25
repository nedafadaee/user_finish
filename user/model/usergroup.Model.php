<?php

   Cmsimport('pagination');

   class model extends db{

       var $contentId;

       var $perpage = '10';

   function ListContent(){
           parent::query("SELECT * FROM user_group ORDER BY group_id DESC");
           return  parent::LoadResult();      
       }
   function ListContentEdit($val){
           parent::query("SELECT $val FROM user_group WHERE group_id = '$this->contentId'   ");
           return  parent::LoadResult($val);               
       }

    function Save($data){
	         parent::query("INSERT INTO user_group (group_name)VALUES('".scape($data['name'])."') ");
   	  	     header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=usergroup&action=List');
             exit;
	   }
	function Edit($data){
		parent::query("UPDATE user_group SET 
			group_name        = '".scape($data['name'])."'
			WHERE group_id = '$this->contentId'  
		");  
		header('Location: '.$this->SITE_URL.'/22admin92//index.php?page=user&view=usergroup&action=List');
        exit;
     }
     function DeleteSave($data){
            if(!empty($data)){
                foreach($data as $item){
                    parent::query("DELETE FROM user_group WHERE group_id = '$item' ");
                }
                echo ok("عملیات حذف به خوبی انجام شد");
            }
     }  
   }
