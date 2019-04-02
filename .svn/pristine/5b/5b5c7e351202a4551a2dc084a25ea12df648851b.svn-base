<?php

require 'db.php';


$id = $_GET['id'];
$orderid = $_GET['orderid'];
$db = new db();

$sql = 'select * from tree_order where id=? and orderid=?';

$data = $db->prepare_query($sql,array($id,$orderid))[0];

echo json_encode($data);
unset($db);
