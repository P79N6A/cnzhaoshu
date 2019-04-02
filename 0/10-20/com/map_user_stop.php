<?php 
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$id = $_GET['id'];

$db = new db();

$sql = 'update map set switch=2 where id=? and userid=?';

$result = $db->prepare_exec($sql,array($id,$userid));

echo $result;

unset($db);