<?php 
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];

$db = new db();

$sql = 'select a.*,b.tree_name,b.tree_attribute from map_records a left join (select tree_name,tree_attribute,id from map_supervision) b on a.supervision_id = b.id where b.id=? order by time desc';

$result = $db->prepare_query($sql,array($id));

echo json_encode($result);

unset($db);



