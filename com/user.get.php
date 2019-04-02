<?php
// 统计关键词搜索频次
require 'db.php';
require 'user2.php';

$userid = $_GET['userid'];
if($userid){
	$result = user::getUserByUserId($userid);
}

echo json_encode($result);


?>