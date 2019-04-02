<?php
// 统计关键词搜索频次
require 'db.php';


$userid = $_GET['userid'];
if($userid){
	$db = new db();
	// 苗店基本信息
	$sql = 'select userid,shopid,name,phone,email,introduction from user where userid=?';
	$shop = $db->prepare_query( $sql, array($userid))[0];
	$shopid = $shop['shopid'];

	// 苗店资质 
	$sql = 'select id,name,image from shop_honor where shopid=? order by time desc';
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