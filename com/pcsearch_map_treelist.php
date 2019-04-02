<?php
require 'checkhost.php';
require 'db2.php';


$id = $_GET['id'];


$db = new db();

$sql = 'select * from maps_order where map_id = ? and tree_name is not null order by convert(tree_name using gbk)';
$result = $db->prepare_query($sql,array($id));

unset($db);
echo json_encode($result);


