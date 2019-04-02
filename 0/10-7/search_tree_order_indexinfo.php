<?php 


require 'db2.php';

$db = new db();

$id = $_GET['id'];
$userid = $_GET['userid'];

$sql = 'select a.*,b.state from (select * from tree_order where orderid=?) a left join (select * from bid_order where userid=? and orderid=?) b on a.orderid=b.orderid and a.id=b.id order by a.id asc';

$result = $db->prepare_query($sql,array($id,$userid,$id));

unset($db);

echo json_encode($result);








 ?>