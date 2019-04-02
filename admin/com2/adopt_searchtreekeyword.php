<?php 
require 'checkhost2.php';
require 'db3.php';
$db = new db();

$keyword = $_GET['keyword'];

$user = json_decode($_COOKIE['user'],true);

if(($user['role'] == 6) || ($user['role'] == 8)){

	$userid = $user['userid'];

	$sql = 'select id from adopt_project where userid=?';
	$projectid = $db->prepare_query($sql,array($userid))[0]['id'];

	$sql = "select c.*,d.username,d.phone from (select a.*,b.userid from adopt_tree a left join adopt_adopt b on a.id = b.tree_id where a.project_id=?) c left join adopt_user d on c.userid = d.userid where c.qrcode like ? or d.username like ? or d.phone like ?";

	$searching = '%'.$keyword.'%';

	$result = $db->prepare_query($sql,array($projectid,$searching,$searching,$searching));

	if(count($result)){
		$return['return_code'] = '200';
		$return['return_msg'] = '查询成功';
		$return['return_data'] = $result;
	}else{
		$return['return_code'] = '201';
		$return['return_msg'] = '未查询到相似结果';
	}

	echo json_encode($return);
	unset($db);
}

