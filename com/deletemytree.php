<?php
// 删除找树车的苗木
require 'checkhost.php';
require 'db2.php';

$userid = $_GET["userid"];
$treeid = $_GET["treeid"];

$db = new db();
$db->prepare_exec('delete from mytree where userid=? and treeid=?', array($userid, $treeid));
unset($db);

?>