<?php
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$limit = $_GET['limit'];
$begin = $_GET['begin'];
$end = $_GET['end'];


if($id){
	$db = new db();
	if($begin) $str = 'and a.time >= ? and a.time <= ?';
	$limit = explode(',', $limit);

	$sql = 'select a.id,b.tree_name,b.tree_attribute,a.active,a.type,a.photo,a.gps,a.name,a.phone,a.time from maps_record a left join (select o.id,o.tree_name,o.tree_attribute,o.map_id from maps m left join maps_order o on m.id = o.map_id) b on a.map_order_id = b.id where b.map_id=? '.$str.' order by a.time desc limit ?,?';

	if($begin){
		$begin .= ' 00:00:00';
		$end .= ' 23:59:59';
		$result = $db->prepare_query($sql,array($id,$begin,$end,$limit[0],$limit[1]));
	}else{
		$result = $db->prepare_query($sql,array($id,$limit[0],$limit[1]));
	}
	unset($db);
	echo json_encode($result);
}




