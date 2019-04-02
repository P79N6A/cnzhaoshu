<?php 
require 'checkhost.php';
require 'db2.php';

$limit = $_GET['limit'];
$begin = $_GET['begin'];
$end = $_GET['end'];
$id = $_GET['id'];

$limit = explode(',', $limit);

$db = new db();
if($begin) $str = 'where d.time >= ? and d.time <= ?';

if($id){
	$sql = 'select d.id,c.tree_name,c.tree_attribute,c.qrcode,d.active,d.type,d.photo,d.gps,d.name,d.phone,d.time from (select b.id,b.tree_name,b.qrcode,b.tree_attribute from maps a left join maps_order b on a.id = b.map_id where a.id=? and b.state > 0) c left join maps_record d on c.id = d.map_order_id '.$str.' order by d.time desc limit ?,?';
	if($begin){
		$begin .= ' 00:00:00';
		$end .= ' 23:59:59';
		$result = $db->prepare_query($sql,array($id,$begin,$end,$limit[0],$limit[1]));
	}else{
		$result = $db->prepare_query($sql,array($id,$limit[0],$limit[1]));
	}
}else{
	$sql = 'select d.id,c.tree_name,c.tree_attribute,c.qrcode,d.active,d.type,d.photo,d.gps,d.name,d.phone,d.time from (select b.id,b.tree_name,b.qrcode,b.tree_attribute from maps a left join maps_order b on a.id = b.map_id where b.state > 0) c left join maps_record d on c.id = d.map_order_id '.$str.' order by d.time desc limit ?,?';
	if($begin){
		$begin .= ' 00:00:00';
		$end .= ' 23:59:59';
		$result = $db->prepare_query($sql,array($begin,$end,$limit[0],$limit[1]));
	}else{
		$result = $db->prepare_query($sql,array($limit[0],$limit[1]));
	}
}
	

echo json_encode($result);
unset($db);



