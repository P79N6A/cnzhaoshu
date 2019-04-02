<?php
// 加入收藏
require 'checkhost.php';
require 'db2.php';

$userid = $_REQUEST['userid'];
$treeid = $_REQUEST['treeid'];
$shopid = $_REQUEST['shopid'];


$db = new db();

$sqlList = array();

$sql = array(
		'sql' => 'INSERT INTO mytree(userid,treeid,shopid) VALUES (?,?,?)',
		'parameter' => array($userid, $treeid, $shopid)
	);
array_push($sqlList, $sql);

if (empty($_REQUEST["isOwn"])) {
	$sql = array(
			'sql' => 'UPDATE tree SET collections=collections+1 WHERE treeid=?',
			'parameter' => array($treeid)
		);
	array_push($sqlList, $sql);
}

// 更新找树圈总表
$sql = 'select to_days(today)=to_days(now()) as istoday from zsq_record where userid=?';
$zsq_user = $db->prepare_query($sql, array($userid));
$zsq_shop = $db->prepare_query($sql, array($shopid));


// 我收藏的
if (!$zsq_user) {
	// 插入
	$sql = 'INSERT INTO zsq_record(userid, today, today_mycollect, allmycollect) VALUES(?, now(), 1, 1)';
	$db->prepare_exec($sql, array($userid));
} else if (!$zsq_user[0]['istoday']) {
	// 不是今天，置为今天
	$sql = 'UPDATE zsq_record SET today=now(), allmycollect=allmycollect+1, today_collect=0, today_visit=0, today_share=0, today_mycollect=1 WHERE userid=?';
	$db->prepare_exec($sql, array($userid));
} else {
	$sql = array(
			'sql' => 'UPDATE zsq_record SET today_mycollect=today_mycollect+1, allmycollect=allmycollect+1 WHERE userid=?',
			'parameter' => array($userid)
		);
	array_push($sqlList, $sql);		
}

// 收藏我的
if (!$zsq_shop) {
	// 插入
	$sql = 'INSERT INTO zsq_record(userid, today, today_collect, allcollect) VALUES(?, now(), 1, 1)';
	$db->prepare_exec($sql, array($shopid));
} else if (!$zsq_shop[0]['istoday']) {
	// 不是今天，置为今天
	$sql = 'UPDATE zsq_record SET today=now(), allcollect=allcollect+1, today_collect=1, today_visit=0, today_share=0, today_mycollect=0 WHERE userid=?';
	$db->prepare_exec($sql, array($shopid));
} else {
	// 我收藏的
	$sql = array(
			'sql' => 'UPDATE zsq_record SET today_collect=today_collect+1, allcollect=allcollect+1 WHERE userid=?',
			'parameter' => array($shopid)
		);
	array_push($sqlList, $sql);		
}

$db->prepare_transaction($sqlList);

unset($db);

echo 'ok';
