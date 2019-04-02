<?php

require 'db2.php';

$db = new db();

$name = $_GET['name'];
$userid = $_GET['userid'];

$sql = 'select c.*,d.state from (select a.*,b.address,b.expiration_date from (select * from tree_order where name like ?) a left join (select * from tree_order_index) b on a.orderid = b.id where b.tendering = 1) c left join (select * from bid_order where userid=?) d on c.orderid = d.orderid and c.id = d.id';

$result = $db->prepare_query($sql,array('%'.$name.'%',$userid));

echo json_encode($result);

unset($db);



