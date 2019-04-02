<?php
// 统计关键词搜索频次
require('db.php');
$db = new db();


$userid = $_GET['userid'];	
$sql = 'select shopid from user where userid = ?';
$id = $db->prepare_query($sql , array($userid));
$shopid = $id[0]['shopid'];
if($shopid){
	$sql = 'select id,shopid,msg_title,msg_desc,msg_link from shop_project where shopid=?';

	$result = $db->prepare_query($sql , array($shopid));

	echo json_encode($result);	
}else{
	echo '0';
}

unset($db);



?>