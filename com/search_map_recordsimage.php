<?php 

require 'db.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];

$limit = explode(',', $limit);

$db = new db();

$sql = 'select a.*,b.tree_name,b.tree_attribute from map_records a left join (select tree_name,tree_attribute,id from map_supervision where switch=1 and userid=?) b on a.supervision_id = b.id where b.id is not null order by time desc limit ?,?';

$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));

echo json_encode($result);

unset($db);



