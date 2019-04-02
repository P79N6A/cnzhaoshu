<?php
// 苗店分享统计
require 'checkhost.php';

$type = $_REQUEST["type"];		// 0 好友,1 朋友圈,2 QQ, 3微博
if ($type=='1') {

	$shopid = $_REQUEST["shopid"];
	$userid = $_REQUEST["userid"];
	$visitorid = $_REQUEST["visitorid"];
	$ip = $_SERVER["REMOTE_ADDR"];

	include 'db2.php';

	$db = new db();

	// 同一个人，同一天，同一途径，分享店铺1次有效，最多5个
	//$sql = 'select count(id) as count from shareshop where shopid=? and visitorid=? and type=? and to_days(time)=to_days(now())';
	// $result = $db->prepare_query($sql, array($shopid, $visitorid, $type));
	// 在朋友圈中分享苗店一次得1点米（该项每日最多10点米）
	$sql = 'select count(id) as count from shareshop where shopid=? and to_days(time)=to_days(now())';
	$result = $db->prepare_query($sql, array($shopid));

	if ($result[0]['count']<10) {
		$sqlList = array();

		$sql = array(
				'sql' => 'insert into shareshop(shopid,userid,visitorid,ip,type) values(?,?,?,?,?)',
				'parameter' => array($shopid, $userid, $visitorid, $ip, $type)
			);
		array_push($sqlList, $sql);	

		$sql = array(
				'sql' => 'update user set shares=shares+1,dianmi=dianmi+1 where userid=?',
				'parameter' => array($shopid)
			);
		array_push($sqlList, $sql);	


		// 更新找树圈总表
		$sql = 'select to_days(today)=to_days(now()) as istoday from zsq_record where userid=?';
		$zsq_shop = $db->prepare_query($sql, array($shopid));

		// 被分享的
		if (!$zsq_shop) {
			// 插入
			$sql = 'INSERT INTO zsq_record(userid, today, today_share, allshare) VALUES(?, now(), 1, 1)';
			$db->prepare_exec($sql, array($shopid));
		} else if (!$zsq_shop[0]['istoday']) {
			// 不是今天，置为今天
			$sql = 'UPDATE zsq_record SET today=now(), allshare=allshare+1, today_collect=0, today_visit=0, today_share=1, today_mycollect=0 WHERE userid=?';
			$db->prepare_exec($sql, array($shopid));
		} else {
			// 今天+1
			$sql = array(
					'sql' => 'UPDATE zsq_record SET today_share=today_share+1, allshare=allshare+1 WHERE userid=?',
					'parameter' => array($shopid)
				);
			array_push($sqlList, $sql);		
		}

		$db->prepare_transaction($sqlList);
	}

	unset($db);
}

?>