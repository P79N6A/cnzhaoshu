<?php 

require 'db.php';

$serial = $_GET['serial'];
$witch = $_GET['witch'];
$who = $_GET['who'];

$db = new db();

if($witch == 'orders'){
	if($who == 1){
		$sql = 'update orders set sell_del = 0 where serial_number=?';
		$result = $db->prepare_exec($sql,array($serial));
	}else{
		$sql = 'update orders set buy_del = 0 where serial_number=?';
		$result = $db->prepare_exec($sql,array($serial));
	}
}elseif($witch == 'order_one'){
	if($who == 1){
		$sql = 'update order_one set sell_del = 0 where id=?';
		$result = $db->prepare_exec($sql,array($serial));
	}else{
		$sql = 'update order_one set buy_del = 0 where id=?';
		$result = $db->prepare_exec($sql,array($serial));
	}
}
unset($db);

echo $result;