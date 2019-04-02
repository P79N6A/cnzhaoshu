<?php 
require('db.php');

	
	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	$limit = explode(',',$limit);
	$db = new db();
	$sql = 'select a.*,b.serial_number,b.refund_time,b.refund_mount,b.tree_order_id,b.deposit_refund_time,b.tender_userid,b.orderstart_time,b.deposit,b.deposit_time,b.deposit_switch,b.fullamount,b.fullamount_time,b.receipt_time,b.order_switch,b.order_switch_time,b.order_switch_remark,b.payment_no,b.payment_time,b.payment_mount,b.delivery_time from (select * from v_bid_order where bid_userid=? and state > 1 and state < 18) a left join (select serial_number,tree_order_id,tender_userid,orderstart_time,deposit,deposit_time,deposit_switch,fullamount,refund_time,refund_mount,deposit_refund_time,fullamount_time,receipt_time,order_switch,order_switch_time,order_switch_remark,payment_no,payment_time,payment_mount,delivery_time from orders where bid_userid=? and state < 10 and order_switch < 10) b on a.id=b.tree_order_id  order by a.state desc limit ?,?';
	$result = $db->prepare_query($sql,array($userid,$userid,$limit[0],$limit[1]));
	echo json_encode($result);
	unset($db);


