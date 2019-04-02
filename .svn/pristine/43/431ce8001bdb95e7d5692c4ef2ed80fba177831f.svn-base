<?php 
require 'db2.php';

$db = new db();

$name = $_GET['name'];
$limit = $_GET['limit'];
$limit = explode(',', $limit);

$isnum = is_numeric($name);
if($isnum){
	if(strlen($name) > 11){
		$serial_number = $name;
		$sql = 'select c.*,d.name tender_name,d.phone tender_phone from (select a.*,b.name bid_name,b.phone bid_phone from (select * from order_one where deposit_switch = 2 and (order_switch = 1 or (state > 2 and fullamount > 0)) and serial_number like ?) a left join (select userid,name,phone from user) b on a.treeuserid=b.userid) c left join (select userid,name,phone from user) d on c.userid=d.userid order by c.orderstart_time desc limit ?,?';
		$result = $db->prepare_query($sql,array('%'.$serial_number.'%',$limit[0],$limit[1]));
	}else{
		$phone = $name;
		$sql = 'select a.* from (select c.*,d.name tender_name,d.phone tender_phone from (select a.*,b.name bid_name,b.phone bid_phone from (select * from order_one where deposit_switch = 2 and (order_switch = 1 or (state > 2 and fullamount > 0))) a left join (select userid,name,phone from user) b on a.treeuserid=b.userid) c left join (select userid,name,phone from user) d on c.userid=d.userid) a where a.tender_phone like ? or a.serial_number like ? or a.bid_phone like ? order by a.orderstart_time desc limit ?,?';
		$result = $db->prepare_query($sql,array('%'.$phone.'%','%'.$phone.'%','%'.$phone.'%',$limit[0],$limit[1]));
	}
}else{
	$username = $name;
	$sql = 'select a.* from (select c.*,d.name tender_name,d.phone tender_phone from (select a.*,b.name bid_name,b.phone bid_phone from (select * from order_one where deposit_switch = 2 and (order_switch = 1 or (state > 2 and fullamount > 0))) a left join (select userid,name,phone from user) b on a.treeuserid=b.userid) c left join (select userid,name,phone from user) d on c.userid=d.userid) a where a.tender_name like ? or a.bid_name like ? order by a.orderstart_time desc limit ?,?';
	$result = $db->prepare_query($sql,array('%'.$username.'%','%'.$username.'%',$limit[0],$limit[1]));
}

echo json_encode($result);

unset($db);


