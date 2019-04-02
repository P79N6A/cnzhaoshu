<?php

require('db.php');
$db = new db();

$userid = $_GET['userid'];
if($userid){
	$sql = 'select userid,shopid,photo,photonames from user where userid = ?';
	$result1 = $db->prepare_query( $sql, array($userid));
	$shopid = $result1[0]['shopid'];

	$sql = 'select name,phone,email,introduction from shop where id = ?';
	$result2 = $db->prepare_query( $sql, array($shopid));

	// 图文信息图片名字为本条id
	$sql = 'select id,shopid,msg_title,msg_desc,msg_link from shop_project where shopid = ?';
	$result3 = $db->prepare_query( $sql, array($shopid));

	foreach ($result2[0] as $key => $value) {
		$result1[0][$key] = $value;
	}
	$result1[0]['projects'] = $result3;
	echo json_encode($result1);
}

