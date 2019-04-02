<?php 
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];


$db = new db();
$sql = 'select * from tree_order where id=?';
$result = $db->prepare_query($sql,array($id))[0];

echo json_encode($result);
unset($db);

