<?php 

require 'db.php';
$db = new db();

$sql = 'select userid,shopid from user where userid < 20';
$result = $db->query($sql);
$time = date('Y-m-d',time());

for ($i=0; $i < count($result); $i++) { 
	$sql = 'select count(visitorid) from visitshop where userid=?';
	$result1 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(visitorid)'];

	$sql = 'select count(visitorid) from visitshop where userid=? and date >= \''.$time.'\'';
	$result2 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(visitorid)'];
	
	$sql = 'select count(visitorid) from shareshop where userid=?';
	$result3 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(visitorid)'];

	$sql = 'select count(visitorid) from shareshop where userid=? and time >= \''.$time.'\'';
	$result4 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(visitorid)'];
	
	$sql = 'select count(shopid) from mytree where userid=?';
	$result5 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(shopid)'];

	$sql = 'select count(shopid) from mytree where userid=? and time >= \''.$time.'\'';
	$result6 = $db->prepare_query($sql,array($result[$i]['userid']))[0]['count(shopid)'];

	$sql = 'select count(userid) from mytree where shopid=?';
	$result7 = $db->prepare_query($sql,array($result[$i]['shopid']))[0]['count(userid)'];

	$sql = 'select count(userid) from mytree where shopid=? and time >= \''.$time.'\'';
	$result8 = $db->prepare_query($sql,array($result[$i]['shopid']))[0]['count(userid)'];

	$sql = 'insert into zsq_record(userid,today,today_collect,allcollect,today_visit,allvisit,today_share,allshare,today_mycollect,allmycollect) values(?,?,?,?,?,?,?,?,?,?)';
	
	$reults = $db->prepare_insert($sql,array($result[$i]['userid'],$time,$result2,$result1,$result8,$result7,$result4,$result3,$result6,$result5));
}
unset($db);
 ?>