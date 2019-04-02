<?php
// 统计关键词搜索频次
require 'db.php';


$userid = (int)$_GET['shopid'];

if($userid){
	$db = new db();
	// 苗店基本信息, 如果是分店 只用分店的电话
	$sql = 'select userid,shopid,name,phone,email,introduction,version from user where userid=?';
	$shop = $db->prepare_query( $sql, array($userid))[0];

	$shopid = $shop['shopid'];
	if ($shopid != $userid) {
		$phone = $shop['phone'];
		$shop = $db->prepare_query( $sql, array($shopid))[0];
		$shop['phone'] = $phone;
	}

	// 苗店资质 
	$sql = 'select id,name from shop_honor where shopid=? order by time desc';
	$honor = $db->prepare_query( $sql, array($shopid));

	// 项目信息 图文信息图片名字为本条id
	$sql = 'select id,msg_title,msg_desc,msg_link from shop_project where shopid=? order by time desc';
	$project = $db->prepare_query( $sql, array($shopid));

	unset($db);

	$shop['honor'] = $honor;
	$shop['project'] = $project;
}

echo json_encode($shop);


?>