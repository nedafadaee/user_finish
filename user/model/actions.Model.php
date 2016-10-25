<?php
   class model extends db{
       var $contentId;
       var $perpage = '10';
	   
   function ListContent(){
           parent::query("SELECT * FROM acl_role_action_list");
           return  parent::LoadResult();      
       }
   }
