<?php
// 微信第三方开放平台，扫码接入
require 'checkhost.php';
require 'db2.php';

$userid = $_REQUEST["userid"];

$platform_id = $_REQUEST["id"];
$company = $_REQUEST["name"];
$appID = $_REQUEST["appID"];
$appSecret = $_REQUEST["appSecret"];
$contact = $_REQUEST["contact"];
$phone = $_REQUEST["phone"];

$db = new db();

if (empty($platform_id)) {
	// 查找用户已经绑定的数据
	$sql = 'select appid,appsecret,platformid,company,contact,phone from openadmin where userid=?';
	$result = $db->prepare_query($sql, array($userid));	
	if ($result) echo json_encode($result[0]);
}else{
	// 如果platform_id 和 appID已经存在 update,否则 insert 
	$sql = 'select * from openadmin where platformid=? and appid=?';
	if ($db->prepare_query($sql, array($platform_id, $appID))) {
		$sql = 'update openadmin set userid=?,platformid=?,appid=?,appsecret=?,company=?,
				contact=?,phone=? where platformid=? and appid=?';
		$sql_array = array($userid, $platform_id, $appID, $appSecret, $company, $contact, $phone, $platform_id, $appID);
	}else{
		$sql = 'insert into openadmin (userid,platformid,appid,appsecret,company,contact,phone) 
				values(?,?,?,?,?,?,?)';
		$sql_array = array($userid, $platform_id, $appID, $appSecret, $company, $contact, $phone);
	}

	$db->prepare_exec($sql, array($sql_array));

	// echo json_encode(array('txt' =>$sql));
}

unset($db);

?>