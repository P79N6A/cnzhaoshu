<?php
// 获取 旗舰店首页数据
require 'checkhost.php';
require 'db2.php';

$userid = (int)$_GET['shopid'];

if($userid){
	$db = new db();
	// 苗店基本信息, 如果是分店 只用分店的电话
	$sql = 'select userid,shopid,name,shopname,phone,email,introduction,version,dianmi,role from user where userid=?';
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
	$shop['honor'] = $honor;

	// 项目信息 图文信息图片名字为本条id
	$sql = 'select id,msg_title,msg_desc,msg_link from shop_project where shopid=? order by time desc';
	$project = $db->prepare_query( $sql, array($shopid));
	$shop['project'] = $project;

	// 地图定位
	$sql = 'select x,y from v_tree where userid=? order by time desc limit 0,1';
	$gps = $db->prepare_query( $sql, array($shopid));
	if ($gps) $shop['gps'] = $gps[0];	

	$sql = 'select * from ( select @rownum := @rownum + 1 as `index`, user.userid,user.dianmi from (select @rownum := 0) r, user order by dianmi desc )a where a.userid=?';
	$order = $db->prepare_query($sql, array($shopid));
	$shop['dianmiOrder'] = $order[0]['index'];
	

	unset($db);

	if ( file_exists($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$shopid.'.jpg') ) {
		$shop['headimg'] = 1;
	}
}

echo json_encode($shop);


?>