<?php
// require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$name = $_GET['name'];
$x = $_GET['x'];
$y = $_GET['y'];
$address = $_GET['address'];

file_put_contents('1.txt', json_encode($_GET));

if($userid){

	$db = new db();
	$sql = 'insert into maps(userid,x,y,name,address) values(?,?,?,?,?)';
	$result = $db->prepare_insert($sql,array($userid,$x,$y,$name,$address));
	$time = date('Y-m-d H:i:s',time());
	if($result){
		echo $result.';'.$time;
	}
	unset($db);
}

