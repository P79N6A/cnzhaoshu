<?php 
// 管理员审核发票资质
require 'db2.php';
require 'user2.php';
require '../wechat/message.audit.php';

$userid = $_POST['userid'];
$license = $_POST['invoice'];
if($userid){
	$db = new db();

	$sql = 'select shopid from user where userid=?';
	$shopid = $db->prepare_query($sql,array($userid))[0]['shopid'];

	$sql = 'update user set invoice=? where shopid=?';
	$result = $db->prepare_exec($sql,array($license,$shopid));
	
	unset($db);

	if($result){
		$user = user::getUserByUserId($userid);
		$title = '发票资格审核提醒消息';
		$remark = '找树网';
		$url = 'admin/financial.html';
		$keyword = $license ? '您发票的审核已通过' : '您发票的审核未通过(发票不符合要求)';
		sendMessage($user['wechatid'], $title, $keyword, $remark, $url);
	}
	echo json_encode($result);
}


 ?>