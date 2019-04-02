<?php 
require 'db.php';

$userid = $_POST['userid'];
$qrcode = $_POST['qrcode'];

$db = new db();

$sql = 'insert into map_supervision(userid,qrcode) values(?,?)';
$result = $db->prepare_insert($sql,array($userid,$qrcode));

echo $result;
unset($db);

