<?php

require 'db.php';

$db = new db();

$serial = $_GET['serial'];
$time = date('Y-m-d H:i:s',time());
$sql = 'update orders set order_switch=3,negotiation_time=? where serial_number=?';

$result = $db->prepare_exec($sql,array($time,$serial));
if($result){
	echo $time;
}
unset($db);


