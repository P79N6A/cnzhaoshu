<?php 

require 'db.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select a.order_tree_id,b.ordername,b.address,b.userid,b.id from (select orderid,userid bid_userid,id order_tree_id from bid_order where state > 2 and state < 18 and userid=?) a right join (select ordername,address,userid,id from tree_order_index where tendering = 1) b on a.orderid = b.id where a.order_tree_id is not null';

$result = $db->prepare_query($sql,array($userid));

echo json_encode($result);

unset($db);

