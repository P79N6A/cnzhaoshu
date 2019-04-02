<?php
// 获取购树车数量
require 'checkhost.php';
include 'db2.php';

$userid = $_GET["userid"];

$db = new db();
$sql = 'select count(*) as count from v_mytree where userid=? and state>0';
$result = $db->prepare_query($sql, array($userid));
unset($db);

echo $result[0]['count'];

?>