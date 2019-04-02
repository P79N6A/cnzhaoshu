<?php 
require('db.php');

	
	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',',$limit);
	$db = new db();
	$sql = 'select a.*,b.serial_number,b.refund_time,b.refund_mount,b.tree_order_id,b.bid_userid,b.negotiation_time,b.tender_userid,b.orderstart_time,b.deposit,b.deposit_time,b.deposit_switch,b.fullamount,b.fullamount_time,b.receipt_time,b.order_switch,b.order_switch_time,b.order_switch_remark,b.payment_no,b.payment_time,b.payment_mount from (select * from v_bid_order where bid_userid=? and state > 1 and state<8) a left join (select serial_number,tree_order_id,bid_userid,tender_userid,orderstart_time,deposit,deposit_time,deposit_switch,fullamount,refund_time,refund_mount,fullamount_time,negotiation_time,receipt_time,order_switch,order_switch_time,order_switch_remark,payment_no,payment_time,payment_mount from orders where bid_userid=? and state<4 and order_switch<4) b on a.id=b.tree_order_id  order by a.id desc limit ?,?';
	$result = $db->prepare_query($sql,array($userid,$userid,$limit[0],$limit[1]));
	echo json_encode($result);
	unset($db);


