<?php 
require 'db.php';

	$qrcodeid = $_GET['qrcodeid'];
	$userid = $_GET['userid'];
	$db = new db();

	$data = [];
	$data['ismyorder'] = null;
	$data['ismygrouporder'] = null;

	if($userid){
		$sql = 'select a.userid,a.id,b.name,b.shopid from (select userid,id from tree_order_index where qrcode=?) a left join (select name,userid,shopid from user) b on a.userid=b.userid';
		$result1 = $db->prepare_query($sql,array($qrcodeid));

		if($result1[0]['userid'] != $userid){
			$sql = 'select orderid from order_permission where userid=? and permission_userid=? and orderid=?';
			$orderid = $db->prepare_query($sql,array($result1[0]['userid'],$userid,$result1[0]['id']));
			if(!$orderid){
				$sql = 'select b.*,c.bid_userid,c.bid_number,c.bid_price,c.bid_image,c.bid_state from (select tree_order.* from tree_order right join (select id from tree_order_index where qrcode=? and tendering=1) a on tree_order.orderid=a.id) b left join (select userid bid_userid,number bid_number,price bid_price,id,orderid,image bid_image,state bid_state from bid_order where userid=?) c on b.id=c.id and b.orderid=c.orderid order by b.id asc';
				$result = $db->prepare_query($sql,array($qrcodeid,$userid));
			}else{
				$data['ismygrouporder'] = 1;
				$data['orderuserid'] = $result1[0]['userid'];
				$sql = 'select e.*,f.successnum from (select a.*,b.num from (select tree_order.* from tree_order right join (select id from tree_order_index where qrcode=? and tendering=1) a on tree_order.orderid=a.id) a left join (select count(d.userid) num,d.id from (select bid_order.* from bid_order left join (select userid,supplier_id,state from supplier where supplier_id=?) c on bid_order.userid=c.userid where (c.state !=2 or c.state is null)) d where state=1 group by id) b on a.id=b.id) e left join (select count(userid) successnum,id from bid_order where state = 2 group by id) f on e.id=f.id order by e.id asc';
				$result = $db->prepare_query($sql,array($qrcodeid,$userid));				
			}
		}else{
			$data['ismyorder'] = 1;
			$sql = 'select e.*,f.successnum from (select a.*,b.num from (select tree_order.* from tree_order right join (select id from tree_order_index where qrcode=? and tendering=1) a on tree_order.orderid=a.id) a left join (select count(d.userid) num,d.id from (select bid_order.* from bid_order left join (select userid,supplier_id,state from supplier where supplier_id=?) c on bid_order.userid=c.userid where (c.state !=2 or c.state is null)) d where state=1 group by id) b on a.id=b.id) e left join (select count(userid) successnum,id from bid_order where state = 2 group by id) f on e.id=f.id order by e.id asc';
			$result = $db->prepare_query($sql,array($qrcodeid,$userid));
		}

	}


	$data['orderinfo'] = $result;
	$data['username'] = $result1[0]['name'];
	unset($db);
	echo json_encode($data);




