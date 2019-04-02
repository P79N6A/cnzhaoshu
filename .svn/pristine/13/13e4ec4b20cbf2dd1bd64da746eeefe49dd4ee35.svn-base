<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];

$limit = explode(',', $limit);

$db = new db();

$sql = 'select d.id,c.tree_name,c.tree_attribute,d.active,d.type,d.photo,d.gps,d.name,d.phone,d.time from maps_order c right join maps_record d on c.id = d.map_order_id where d.userid=? order by d.time desc limit ?,?';

$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

echo json_encode($result);
unset($db);

