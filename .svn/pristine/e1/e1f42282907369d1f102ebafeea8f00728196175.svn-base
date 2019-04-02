<?php 
require('db.php');

	$orderid = $_GET['orderid'];
	

	$db = new db();
	$sql = 'select e.*,f.successnum from (select a.*,b.num from (select * from tree_order where orderid=? order by id asc) a left join (select count(d.userid) num,d.id from (select bid_order.* from bid_order left join (select userid,supplier_id,state from supplier) c on bid_order.userid=c.userid where (c.state !=2 or c.state is null)) d where state=1 group by id) b on a.id=b.id) e left join (select count(userid) successnum,id from bid_order where state = 2 group by id) f on e.id=f.id order by e.id asc';

	$result1 = $db->prepare_query($sql,array($orderid));
	echo json_encode($result1);
	
	unset($db);





