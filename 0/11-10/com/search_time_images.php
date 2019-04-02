<?php 
require 'db.php';

$userid = $_GET['userid'];
$limit = $_GET['limit'];
$begin = $_GET['begin'];
$end = $_GET['end'];
$limit = explode(',', $limit);

$db = new db();
if($begin) $str = ' and a.time >= ? and a.time <= ?';

$sql = 'select a.*,b.tree_name,b.tree_attribute from map_records a left join (select tree_name,tree_attribute,id from map_supervision where userid=?) b on a.supervision_id = b.id where b.id is not null'.$str.' order by time desc limit ?,?';

if($begin){
	$result = $db->prepare_query($sql,array($userid,$begin,$end,$limit[0],$limit[1]));
}else{
	$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));
}

echo json_encode($result);
unset($db);



