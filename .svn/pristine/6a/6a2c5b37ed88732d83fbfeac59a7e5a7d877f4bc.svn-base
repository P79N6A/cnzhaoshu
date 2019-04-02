<?php
// 会员组内排序
require 'checkhost.php';
require 'db2.php';

$list = explode(',', $_GET["list"]);

$db = new db();

foreach ($list as $key => $userid) {
	$db->prepare_query('update user set grouporder=? where userid=?', array($key, $userid));
}

unset($db);

?>