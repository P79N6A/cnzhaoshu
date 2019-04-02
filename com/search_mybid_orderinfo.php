<?php

require 'checkhost.php';
include 'db2.php';


$orderid = $_GET['orderid'];
$id = $_GET['id'];
$userid = $_GET['userid'];

$db = new db();
$sql = 'select * from bid_order where userid=? and orderid=? and id=?';
$result = $db->prepare_query($sql,array($userid,$orderid,$id))[0];

echo json_encode($result);
unset($db);
