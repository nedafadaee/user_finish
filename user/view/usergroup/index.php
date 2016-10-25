<page title="گروههاي کاربري" />

<?php
   $toolbar = new toolbar();
   $task     = new tasks();
   $task->dir      = __DIR__;
   @$task->action = $_GET['action'];
 echo "<div id='sideBar'>" ;
  echo "
   <div id=\"TaskIcon1\">
      <a href=\"#\">
	     تعریف گروه کاربری
     </a>
   </div>
   ";
   echo $toolbar->NewICON();
   echo $toolbar->ListIcon();
   echo $toolbar->DeleteICON();
   echo "</div>";  
   echo "<div id='ContentBar' style='width:98%'>" ;
   $task->render();
   echo "</div>";  
?>



