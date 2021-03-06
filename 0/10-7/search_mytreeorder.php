<?php 
require('db2.php');

	$qrcodeid = $_GET['qrcodeid'];
	$userid = $_GET['userid'];

	if($qrcodeid && $userid){
		$db = new db();
		$sql = 'select userid from tree_order_index where qrcode=?';
		$userid1 = $db->prepare_query($sql,array($qrcodeid))[0]['userid'];

		if($userid == $userid1){
			$sql = 'select tree_order.* from tree_order right join (select id from tree_order_index where qrcode=?) a on tree_order.orderid = a.id';
			$result1 = $db->prepare_query($sql,array($qrcodeid));

			$sql = 'select a.*,b.username,b.city,b.phone from (select * from bid_order where orderid=? and state=2) a left join (select name username,city,phone,userid from user) b on a.userid = b.userid where b.phone is not null';
			$result2 = $db->prepare_query($sql,array($result1[0]['orderid']));
			$result = [];
			$result['order'] = $result1;
			$result['bidorder'] = $result2;
			echo json_encode($result);
		}
		unset($db);
	}
