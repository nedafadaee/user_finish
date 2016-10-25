<?php
include("../include/config.php");
$db = new db();
$db->connect();
class sethistory extends db{
	function GetUsers(){
		parent::query("select * from user");
		foreach(parent::LoadResult() as $item){
			$query = "insert into UserHistory (user_id , isdelete) values ('".$item->id."' , '0')";
			$result= mysql_query($query);
			}
		}
	}
	$set = new sethistory;
	$set->GetUsers();