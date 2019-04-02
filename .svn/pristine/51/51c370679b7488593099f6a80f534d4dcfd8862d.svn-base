<?php

require 'checkhost.php';
include 'db2.php';


$orderid = $_GET['orderid'];
$userid = $_GET['userid'];

$db = new db();
$sql = 'select * from v_bid_order where bid_userid=? and orderid=?';
$result = $db->prepare_query($sql,array($userid,$orderid));

$sql = 'select * from tree_order_index where id=?';
$result1 = $db->prepare_query($sql,array($orderid))[0];

$data = [];
$data['bidinfo'] = $result;
$data['orderinfo'] = $result1;
echo json_encode($data);
unset($db);



