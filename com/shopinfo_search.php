<?php
// 统计关键词搜索频次
require('db.php');
$db = new db();


$userid = $_GET['userid'];	
$sql = 'select shopid from user where userid = ?';
$id = $db->prepare_query($sql , array($userid));
$shopid = $id[0]['shopid'];
if($shopid){
	$sql = 'select name,phone,email,introduction from shop where id='.$shopid;

	$result = $db->query($sql);

	echo json_encode($result);
}else{
	return false;
}

unset($db);



?>