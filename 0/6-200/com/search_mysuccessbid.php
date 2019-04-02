<?php 
require 'db2.php';

	
	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',',$limit);
	$db = new db();
	$sql = 'select a.*,b.money from (select * from v_bid_order where bid_userid=? and state > 1) a left join (select tree_order_id,money from orders where bid_userid=?) b on a.id=b.tree_order_id  order by a.id desc limit ?,?';
	$result = $db->prepare_query($sql,array($userid,$userid,$limit[0],$limit[1]));
	echo json_encode($result);
	unset($db);
