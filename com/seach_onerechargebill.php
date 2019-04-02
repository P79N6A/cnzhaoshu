<?php 
require 'db2.php';
$db = new db();
$name = $_GET['name'];
$limit = $_GET['limit'];
$limit = explode(',', $limit);

$isnum = is_numeric($name);
if($isnum){
	if($name < 6){
		$sql = 'select a.*,b.name,b.phone from (select * from recharge_bill) a left join (select name,phone,userid from user) b on a.userid=b.userid where a.way = ? order by a.time desc limit ?,?';
		$result = $db->prepare_query($sql,array($name,$limit[0],$limit[1]));
	}else{
		$phone = $name;
		$sql = 'select a.*,b.name,b.phone from (select * from recharge_bill) a left join (select name,phone,userid from user) b on a.userid=b.userid where b.phone like ? order by a.time desc limit ?,?';
		$result = $db->prepare_query($sql,array('%'.$phone.'%',$limit[0],$limit[1]));
	}
}else{
	$sql = 'select a.*,b.name,b.phone from (select * from recharge_bill) a left join (select name,phone,userid from user) b on a.userid=b.userid where b.name like ? order by a.time desc limit ?,?';
	$result = $db->prepare_query($sql,array('%'.$name.'%',$limit[0],$limit[1]));
}

echo json_encode($result);

unset($db);


