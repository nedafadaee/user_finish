<?php
$db= new db;
?>
<link  rel="stylesheet" type="text/css"  href="<?php echo $db->AdminUrl ?>/com/user/style/menu.css"  />
<div id="Supportmenu">
    <ul>
        <li><a <a href="index.php?page=user&view=actions&action=List">لیست اکشن های سایت</a> </li>
        <li><a <a href="index.php?page=user&view=roll&action=List"> نقش کاربری</a> </li>
        <li><a <a href="index.php?page=user&view=usergroup&action=List">ایجاد گروه کاربری</a> </li>
    </ul>
</div>