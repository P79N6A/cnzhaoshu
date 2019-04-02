<?php
require 'db2.php';

$id = $_GET['id'];

$db = new db();

$sql = 'select send_msg from tree_order_index where id=?';
$result = $db->prepare_query($sql,array($id))[0]['send_msg'];

echo $result;
unset($db);