<?php
/**
* 添加苗店的访问记录,每店、每天、每个ip、每类型终端一次有效
* 事务处理：插入visitshop、 user.visits++,dianmi=dianmi+2
*/
require 'checkhost.php';
require 'db2.php';

$shopid = $_REQUEST['shopid'];
$userid = $_REQUEST['userid'];
$visitorid = $_REQUEST['visitorid'];
$flagid = isset($_REQUEST['flagid']) ? $_REQUEST['flagid'] : null;
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;		// 0对话，1朋友圈，2qq，3微博，4网站
$ip = $_SERVER['REMOTE_ADDR'];

$db = new db();

$sqlList = array(
	array(
		'sql' => 'insert into visitshop(shopid,userid,visitorid,flagid,ip,type) values (?,?,?,?,?,?)',
		'parameter' => array($shopid, $userid, $visitorid, $flagid, $ip, $type)
	),
	array(
		'sql' => 'update user set visits=visits+1 where shopid=?',
		'parameter' => array($shopid)
	)
);

// 更新找树圈总表
$sql = 'select to_days(today)=to_days(now()) as istoday from zsq_record where userid=?';
$zsq_shop = $db->prepare_query($sql, array($shopid));

// 被访问的
if (!$zsq_shop) {
	// 插入
	$sql = 'INSERT INTO zsq_record(userid, today, today_visit, allvisit) VALUES(?, now(), 1, 1)';
	$db->prepare_exec($sql, array($shopid));
} else if (!$zsq_shop[0]['istoday']) {
	// 不是今天，置为今天
	$sql = 'UPDATE zsq_record SET today=now(), allvisit=allvisit+1, today_collect=0, today_visit=1, today_share=0, today_mycollect=0 WHERE userid=?';
	$db->prepare_exec($sql, array($shopid));
} else {
	// 今天+1
	$sql = array(
			'sql' => 'UPDATE zsq_record SET today_visit=today_visit+1, allvisit=allvisit+1 WHERE userid=?',
			'parameter' => array($shopid)
		);
	array_push($sqlList, $sql);		
}


$db->prepare_transaction($sqlList);
unset($db);

?>