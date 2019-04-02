<?php
require 'checkhost.php';
include 'db2.php';

$db = new db();
$userid = $_GET['userid'];
$sql = 'select get_msg from user where userid=?';
$get_msg = $db->prepare_query($sql,array($userid))[0]['get_msg'];
echo $get_msg;

unset($db);






