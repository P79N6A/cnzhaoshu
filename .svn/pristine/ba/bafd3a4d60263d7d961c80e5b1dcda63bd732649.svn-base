<?php
// 审核会员
require 'checkhost.php';
require 'db2.php';

$userid = $_GET['userid'];
$phone = $_GET['phone'];
$state = $_GET['state'];
$isrenzheng = $_GET['isrenzheng'];
$role = $_GET['role'];

$db = new db();

if (isset($role)) {
	if (isset($userid)) {
		// 删除
		$sql = 'update user set role=? where userid=?';
		$db->prepare_exec($sql, array($role, $userid));
	} else {
		// 添加
		$sql = 'update user set role=? where phone=?';
		$db->prepare_exec($sql, array($role, $phone));
	}

	$isrenzheng = $role=='101' ? '1' : '0';
}

if (isset($isrenzheng)) {
	if (isset($userid)) {
		$sql = 'update user set isrenzheng=? where userid=?';
		$db->prepare_exec($sql, array($isrenzheng, $userid));

		// 更新临时树state
		$treestate = $isrenzheng=='1' ? (isset($role) && $role=='101' ? 3 : 2) : 0;
		$sql =  'update treetemp set state=? where userid=?';
		$db->prepare_exec($sql, array($treestate, $userid));

		// 更新正式树state
		$treestate = $isrenzheng=='1' ? (isset($role) && $role=='101' ? 3 : 2) : 1;
		$sql =  'update tree set state=? where userid=?';
		$db->prepare_exec($sql, array($treestate, $userid));
	} else {
		$sql = 'update user set isrenzheng=? where phone=?';
		$db->prepare_exec($sql, array($isrenzheng, $phone));

		// 更新临时树state
		$treestate = $isrenzheng=='1' ? (isset($role) && $role=='101' ? 3 : 2) : 0;
		$sql =  'update treetemp set state=? where wechatid in (select wechatid from user where phone=?)';
		$db->prepare_exec($sql, array($treestate, $phone));

		// 更新正式树state
		$treestate = $isrenzheng=='1' ? (isset($role) && $role=='101' ? 3 : 2) : 1;
		$sql =  'update tree set state=? where userid in (select userid from user where phone=?)';
		$db->prepare_exec($sql, array($treestate, $phone));
	}
} else{
	$grouporder = $state*1 >= 1000 ? 'grouporder=0,' : ''; 

	if (isset($userid)) {
	 	$sql =  'update user set '.$grouporder.'state=? where userid=?';
	 	$sql_array = array($state, $userid);
	} else {
		$sql =  'update user set '.$grouporder.'state=? where phone=?';
		$sql_array = array($state, $phone);
	}	

	$db->prepare_exec($sql, $sql_array);
}


// 新添加，返回用户信息
if ($isrenzheng=='1' || $userstate!='0') {
	$sql = 'select userid,name,phone,isrenzheng,province,city from user where phone=?';
	$result = $db->prepare_query($sql, array($phone));	
	echo $result ? json_encode($result) : '';
}

unset($db);

?>