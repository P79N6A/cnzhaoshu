<?php 
require 'checkhost.php';
require 'db2.php';
	
$limit = $_GET['limit'];
$limit = explode(',', $limit);
$db = new db();
$sql = 'select a.*,b.name,b.phone from (select * from recharge_bill) a left join (select name,phone,userid from user) b on a.userid=b.userid order by a.time desc limit ?,?';
$result = $db->prepare_query($sql,array($limit[0],$limit[1]));

echo json_encode($result);
unset($db);