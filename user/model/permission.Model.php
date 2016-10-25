<?php
   Cmsimport('pagination');
   class model extends db{
	   
       function ListEdit($page,$view,$value){
		   $group = intval($_GET['gr']);
		 //  echo "SELECT $value FROM admin_permission WHERE group_id = '$group' AND page_name = '$page' AND view_name = '$view'   "."<br>";
           parent::query("SELECT $value FROM admin_permission WHERE group_id = '$group' AND page_name = '$page' AND view_name = '$view'   ");
           return  parent::LoadResult($value);               
       }  

       function CheckforUpdate(){
		   $group = intval($_GET['gr']);
           $rec   = parent::query("SELECT * FROM admin_permission WHERE group_id = '$group'   ");
            if(mysql_num_rows($rec) > '0' ){
				return true;
			}else{
			   return false;
			}           
       }

       function Save($data){
		   $group = intval($_GET['gr']);
		 if(!empty($data)){  
          parent::query("DELETE FROM admin_permission WHERE group_id = '$group'  ");
          foreach($data as $page => $action){
			 $pagename = ($page);
		    foreach($action as $view => $k){				
				parent::query("INSERT INTO admin_permission(group_id,page_name,view_name,permission_view,permission_new,permission_delete,permission_edit)VALUES(
				  '".$group."',
				  '".$pagename."',
				  '".$view."',
				  '".$k['list']."',
				  '".$k['add']."',
				  '".$k['delete']."',
				  '".$k['edit']."'
				)");
			 }
		 }
		  echo ok("تعییرات به خوبی ثبت شد.");
		 }
	   }
       
	 function groupName(){
       $group = intval($_GET['gr']);
	   parent::query("SELECT * FROM admin_group WHERE id = '$group' ");
	   return parent::LoadResult('name');
	 } 
	   
     function DeleteSave($data){
            if(!empty($data)){
                foreach($data as $item){
                    parent::query("DELETE FROM admin_group WHERE id = '$item' ");
                }
                echo ok("عملیات حذف به خوبی انجام شد");
            }
     }  

   }
/*
 Folder Tree with PHP and jQuery.

 R. Savoul Pelister
 http://techlister.com

*/
error_reporting(0);
class treeview extends model {

    private $files;
    private $folder;

  function __construct($path){
       $rep     =   opendir($path);
        while ($file = readdir($rep)){
              if(is_dir($path)){  
                        if($file != '..' && $file !='.' && $file !=''){ 
                              if (is_dir($path."/$file")){
                                    $view2 = $path.'/'.$file.'/'.$file.'.xml';
                                    $this->FolderName[] = $view2;
                              }
                        }
              }
        }
       return  array_unique($this->FolderName); 
  }
  function loadXml(){
	$n = 0; 
	$b = 0; 
    foreach($this->FolderName as $item){
         if(file_exists($item)){
              $xml=simplexml_load_file($item) ;
			      $folder[$n]['parent']              = (string)$xml->title; 
             foreach($xml->folder as $itemm){
                  $folder[$n]['child'][$b]['title']   =  (string)($itemm->attributes()->title);;
                  $folder[$n]['child'][$b]['view']    =  (string)($itemm->attributes()->view);;
                  $folder[$n]['child'][$b]['page']    =  (string)($itemm->attributes()->page);;
				  $b++;
              }
         }else{
         }
		 $n++;
       }
       return ($folder);
    }
  function dropBox($page,$view,$value){
     if(parent::CheckforUpdate()){
	   $add    = parent::ListEdit($page,$view,'permission_new');  	 
	   $edit   = parent::ListEdit($page,$view,'permission_edit');  	 
	   $delete = parent::ListEdit($page,$view,'permission_delete');
	   $vieww  = parent::ListEdit($page,$view,'permission_view');  	  	 
    }
	if($value == 'add' ){
		 if($add == '1'){
		   $selected = "selected='selected' ";
		 }else{
		   $selected = "";	 
		 }
	}
	if($value == 'edit' ){
		 if($edit == '1'){
		   $selected = "selected='selected' ";
		 }else{
		   $selected = "";	 
		 }
	}
	if($value == 'delete' ){
	 if($delete == '1'){
	   $selected = "selected='selected' ";
	 }else{
	   $selected = "";	 
	 }
	}
	if($value == 'list' ){
		 if($vieww == '1'){
		   $selected = "selected='selected' ";
		 }else{
		   $selected = "";	 
		 }	 
	}
  
    $html = "<select name='".$page."[$view][$value]'>"	  
			   ."<option value='0' $selected>خیر</option>"	  
			   ."<option value='1' $selected>بله</option>"	  
			 ."</select>";	  
  	return $html; 
  }
  function build(){
    $html   = "<table border='0' class='newRecord permtable'>";
	$html  .= "<tr bgcolor='#CCCCCC'>";
	$html  .= "<td align='center' style='text-align:center'>عنوان صفحه</td>";
	$html  .= "<td align='center' style='text-align:center'>مشاهده</td>";
	$html  .= "<td align='center' style='text-align:center'>ایجاد</td>";
	$html  .= "<td align='center' style='text-align:center'>حذف</td>";
	$html  .= "<td align='center' style='text-align:center'>ویرایش</td>";
	$html  .= "</tr>";
	//debug(self::loadXml());
	foreach( self::loadXml() as $t){
			$html  .= "<tr><td colspan='5' bgcolor='grey'>".$t['parent']."</td></tr>";
	   foreach($t['child'] as $sub){
		$html  .= "<tr>";   
		$html  .= "<td width='600'>".$sub['title']."</td>";
		$html  .= "<td width='100'>".self::dropBox($sub['page'],$sub['view'],'list')." </td>";
		$html  .= "<td width='100'>".self::dropBox($sub['page'],$sub['view'],'add')." </td>";
		$html  .= "<td width='100'>".self::dropBox($sub['page'],$sub['view'],'delete')." </td>";
		$html  .= "<td width='100'>".self::dropBox($sub['page'],$sub['view'],'edit')." </td>";
		$html  .= "</tr>";	
	   }
	}	
	   $html  .= "<tr><td  colspan='5' ><input type='submit' value='ثبت' /></td></tr>"; 

	$html .= "</table>";
   return $html;		  
    	  
  }
	
	
	
  }
function debug($input) {
    echo "<pre dir='ltr' style='direction:ltr; text-align:left'>";
    print_r($input);
    echo "</pre>";
}
   //session_destroy();