<?php
// 获取旗舰店 精品项目
require 'checkhost.php';
require 'db2.php';


$shopid = $_GET['userid'];	

if($shopid){
	$db = new db();
	$sql = 'select id,msg_title,msg_desc,msg_link from shop_project where shopid=? order by time desc';
	$result = $db->prepare_query($sql , array($shopid));
	unset($db);

	echo json_encode($result);
}


?>