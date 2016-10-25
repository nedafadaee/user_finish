<?php
   Cmsimport('pagination');
   class model extends db{
       var $contentId;
       var $perpage = '60';
       function ListContent(){
           global $nav;
             $nav = new pageNav();
             $nav->Queryrecord = "SELECT * FROM user_visit_history WHERE u_id= '$this->contentId'  ORDER BY id DESC";
             $nav->perPage = $this->perpage;
             $start = $nav->startrecord();
           parent::query("SELECT * FROM user_visit_history WHERE u_id= '$this->contentId' ORDER BY id DESC LIMIT $start,$nav->perPage  ");
           return  parent::LoadResult();      
       }
       function Pagerend(){
              global $nav;
              return $nav->Render();
       }
 
     function ViewUser($id,$value){
           parent::query("SELECT $value FROM user WHERE id= '$id' ");
           return  parent::LoadResult($value);          
     }
       
   }
//session_destroy();