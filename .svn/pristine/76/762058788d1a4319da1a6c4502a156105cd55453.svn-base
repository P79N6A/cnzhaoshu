<?php
	require 'db2.php';

	$db = new db();

	$sql = 'select sum(money) from recharge_bill where way = 2 or way = 3';

	$result = $db->prepare_query($sql);

	unset($db);

	echo $result[0]['sum(money)'];
