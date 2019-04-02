<?php 


require 'db2.php';

$db = new db();

$name = $_GET['name'];


$limit = $_GET['limit'];

$limit = explode(",", $limit);

$sql = 'select  id,ordername,address,expiration_date,time from tree_order_index where tendering = 1 and (ordername like ? or address like ?) order by time desc limit ?,?';

$result = $db->prepare_query($sql , array('%'.$name.'%','%'.$name.'%',$limit[0],$limit[1]));

unset($db);

echo json_encode($result);












 ?>