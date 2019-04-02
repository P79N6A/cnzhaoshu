<?php 


require 'db2.php';

$db = new db();

$evaluate = $_GET['evaluate'];
$starnumber = $_GET['starnumber'];
$tenderuserid = $_GET['tenderuserid'];
$userid = $_GET['userid'];
$id = $_GET['id'];
$starnumber=(int)$starnumber;

$sql = 'select shopid,star from user where userid=?';
$shopinfo = $db->prepare_query($sql , array($tenderuserid))[0];

$sql = 'update bid_order set is_evaluates=1 where id=? and userid=?';
$result = $db->prepare_exec($sql,array($id,$userid));

$sql = 'insert into order_evaluate(shopid,userid,evaluate,star) values(?,?,?,?)';
$result = $db->prepare_insert($sql,array($shopinfo['shopid'],$userid,$evaluate,$starnumber));

if($result){
	$sql = 'select count(star),sum(star) from order_evaluate where shopid=?';
	$starinfo = $db->prepare_query($sql , array($shopinfo['shopid']))[0];

	$star = ($starinfo['sum(star)']/$starinfo['count(star)'])*10;
	$star=(int)$star;
	$sql = 'update user set star=? where shopid=?';
	$result = $db->prepare_exec($sql,array($star,$shopinfo['shopid']));

	echo true;
}

unset($db);













 ?>