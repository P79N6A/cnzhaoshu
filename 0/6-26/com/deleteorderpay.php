<?php

require 'db2.php';


$serial_number = $_GET['serial_number'];
$db = new db();

$sql = 'delete from orders where serial_number=?';
$data = $db->prepare_exec($sql,array($serial_number));

echo $data;
	
unset($db);
