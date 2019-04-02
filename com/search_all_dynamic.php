<?php 

require 'db2.php';

$limit = $_GET['limit'];
$limit = explode(',', $limit);

$db = new db();

$sql = 'select * from order_dynamic order by time desc limit ?,?';

$result = $db->prepare_query($sql,array($limit[0],$limit[1]));

echo json_encode($result);

unset($db);