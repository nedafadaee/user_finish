<?php
//error_reporting(E_ALL);
   Cmsimport('pagination');
   class model extends db{
       var $contentId;
       var $perpage = '10';
	   
       function listCodes(){
             global $nav;
             $nav = new pageNav();
			 
             $nav->Queryrecord = "SELECT 
			 					  all_codes.id , 
								  all_codes.code ,
								  code_details.user_id ,
								  code_details.start_time ,
								  code_details.end_time ,
								  code_details.number_of_use ,
								  code_details.price 
								  FROM all_codes 
								  join code_details on code_details.code_id = all_codes.id";
             $nav->perPage = $this->perpage;
             $start = $nav->startrecord();
           parent::query("SELECT 
			 					  all_codes.id , 
								  all_codes.code ,
								  code_details.user_id ,
								  code_details.start_time ,
								  code_details.end_time ,
								  code_details.number_of_use ,
								  code_details.price 
								  FROM all_codes 
								  join code_details on code_details.code_id = all_codes.id ORDER BY id DESC 
								  LIMIT 			$start,$nav->perPage  ");
           return  parent::LoadResult();      
       }
	   public function Random_code_gift() // کد عمومی را تولید می کند
     	{

		 $randstring1=array();
		 $characters1 = '01234mnopqrstuvwxyz';
		 for ($i = 0; $i < '5'; $i++) {
			 
			$randstring1[$i] = $characters1[rand(0, strlen($characters1)-1)];
			
		 }
		 return $randstring1;
     }
	         function Save($data){
           
			  
			   $user_id = json_encode($_POST['drp_userid']); 
			   $start_date = self::ConvertTime($_POST['txt_start']);
			   $end_date = self::ConvertTime($_POST['txt_end']);
			   
               if($_POST['txt_codeNumber']){// تولید کد خودکار توسط سیستم
				   
				   for($i=0 ; $i<=$_POST['txt_codeNumber'];$i++){
					   
					   $random_code = self::Random_code_gift();
					   $random_code_final=implode("",$random_code);
					   
					   parent::query("INSERT INTO all_codes (code) VALUES('".$random_code_final."') ");
					   $insert_id = mysql_insert_id();
					   if($insert_id){
						
						parent::query("INSERT  INTO code_details (code_id , user_id , start_time , end_time , 	number_of_use , price) VALUES('".$insert_id."' , '".$user_id."' , '".$start_date."' , '".$end_date."' , '".scape($_POST['txt_number'])."' , '".scape($_POST['txt_price'])."' ) ");
						}// end of if
					   }// enf of for
					   echo ok('به خوبی ثبت شد');
				}// end of if
				/********************************************************/
				else if($_POST['txt_code']){ // تولید کد توسط خود مدیر سایت
					
					parent::query("INSERT INTO all_codes (code) VALUES('".$data['txt_code']."') ");
					
					$insert_id = mysql_insert_id();
					if($insert_id){
						
						parent::query("INSERT  INTO code_details (code_id , user_id , start_time , end_time , 	number_of_use , price) VALUES('".$insert_id."' , '".$user_id."' , '".$start_date."' , '".$end_date."' , '".scape($_POST['txt_number'])."' , '".scape($_POST['txt_price'])."' ) ");
						}// end of if
						echo ok('به خوبی ثبت شد');
					}// end of else
			   
                    
         
	   }
    function list_allusers(){
		
		parent::query("SELECT id , name , familly , manufacture  FROM user where manufacture != '1' ");
        return  parent::LoadResult();   
		
		}
		
       function Pagerend(){
              global $nav;
              return $nav->Render();
       }
       
      
     
	function ConvertTime($data){
        if(!empty($data)){
            $array          = explode("-",$data);
            $sal             = $array[0];
            $month        = $array[1];
            $day            = $array[2];
            $stamptime =  jmktime(0,0,0,$month,$day,$sal);
           return ($stamptime);
        }
    }    
  
		   
   function select_one_record($val){
	  
	   parent::query("SELECT 
					  all_codes.id , 
					  all_codes.code ,
					  code_details.user_id ,
					  code_details.start_time ,
					  code_details.end_time ,
					  code_details.number_of_use ,
					  code_details.price 
					  FROM all_codes 
					  join code_details on code_details.code_id = all_codes.id
					  where all_codes.id = '".$this->contentId."'");//بقیه موارد مربوط به این کد
		return parent::LoadResult($val);			  
	   
	   }
	  
	function Get_users_codes($getid){
		
	$user_id = json_decode(self::select_one_record('user_id'));//آرایه از کاربرانی که این کد را دریافت کرده اند
		
		$result_allusers = parent::query("select id , name , familly from user ");
		$num_allusers = mysql_num_rows($result_allusers); 
		
		for ($i= 1 ; $i<=$num_allusers ; $i++){
			
			if (in_array($getid , $user_id)) {
				
				$checked = "selected";
				return $checked;	
			}
		
		}  
	}
	function Edit_codes($data){
	 

	
           if(!empty($data)){
               if(isset($data['txt_code'])){
                   parent::query("UPDATE all_codes SET  code        = '".scape($data['txt_code'])."'
                   WHERE id = '$this->contentId'  ");  
				   
				   $user_id = json_encode($_POST['drp_userid']); 
			   	   $start_date = self::ConvertTime($_POST['txt_start']);
			   	   $end_date = self::ConvertTime($_POST['txt_end']);
				   
				   parent::query("
				   UPDATE code_details SET  
				   start_time = '".$start_date."' ,
				   end_time = '".$end_date."' ,
				   price = '".intval($data['txt_price'])."' ,
				   number_of_use = '".intval($data['txt_number'])."' ,
				   user_id = '".$user_id."'
                   WHERE id = '$this->contentId'  ");             
           }
            echo ok( 'به خوبی ذخیره شد');
         }
       }
       
     function DeleteSave($data){
            if(!empty($data)){
                foreach($data as $item){
                    parent::query("DELETE FROM user WHERE id = '$item' ");
					parent::query("DELETE FROM code_details WHERE code_id = '$item' ");
                }
                echo ok("عملیات حذف به خوبی انجام شد");
            }
     }  

     
    
     
       
   }
