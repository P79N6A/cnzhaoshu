<?php 


require 'db.php';

$db = new db();

$evaluate = $_GET['evaluate'];
$starnumber = $_GET['starnumber'];
$treeuserid = $_GET['treeuserid'];
$userid = $_GET['userid'];
$id = $_GET['id'];
$starnumber=(int)$starnumber;

$sql = 'select shopid,star from user where userid=?';
$shopinfo = $db->prepare_query($sql , array($treeuserid))[0];

$sql = 'update order_one set is_evaluate=1 where id=?';
$result = $db->prepare_exec($sql,array($id));

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