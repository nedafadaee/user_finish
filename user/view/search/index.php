<page title="مدیریت پرسشها" />
<?php
   $toolbar = new toolbar();
   $task     = new tasks();
   $task->dir      = __DIR__;
   @$task->action = $_GET['action'];
   echo "<div  class=\"col-md-12\">" ;
   echo "<div id=\"TaskIcon1\"><a href=\"#\">جستجوی پیشرفته کاربران</a></div>";
   //////////////////////////////////////////// 
  echo "</div>";  
  echo "<div id='ContentBar' class=\"col-md-12\">" ;
  $task->render();
  echo "</div>";  
   
?>

