<?php 
require('db2.php');

	$id = $_GET['id'];
	$userid = $_GET['userid'];
	$orderid = $_GET['orderid'];
	$db = new db();
	$sql = 'select d.*,e.state relationshipstate from (select a.*,b.username,b.city,b.phone from (select k.*,j.unit from (select * from bid_order) k left join (select unit,orderid,id from tree_order) j on k.orderid=j.orderid and k.id=j.id  where k.id=? and k.state>0 and k.orderid=?) a left join (select name username,city,phone,userid from user) b on a.userid = b.userid where b.phone is not null) d left join (select userid,supplier_id,state from supplier where userid = ?) e on d.userid=e.supplier_id where (e.state != 2 or e.state is null) order by state desc';
	$result = $db->prepare_query($sql,array($id,$orderid,$userid));
	echo json_encode($result);
	unset($db);
