<page title="مدیریت پرسشها" />
<?php
   $toolbar = new toolbar();
   $task     = new tasks();
   $task->dir      = __DIR__;
   @$task->action = $_GET['action'];

 echo "<div id='ContentBar' style='width:98%'>" ;
   $task->render();
 echo "</div>";  
   
?>

