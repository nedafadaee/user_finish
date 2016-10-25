<?php 
   class controller{
	   var $error = array();
       function AllowSave($data = array() ){
            if(!empty($data)){  
                  $record['name']               = import_note($data['name']);
                if($record['name'] != '' ){
                    return $record;
                }else{
                    echo error( 'فیلدهای ستاره دار کامل شود');
                }
              }
       }
       
        function AllowDelete($data = array()){
             if(!empty($data)){
                 $record = array();
                 $n=0;
                 foreach($data as $item){
                     $record[$n] = intval($item);
                     $n++;
                 }
                return($record);
             }else{
                 echo error("حداقل یک مورد انتخاب شود");
             }
       }      
        function error($error = array()){
             $this->error = $error;
             echo error($this->error);
           }      
       
   }

?>