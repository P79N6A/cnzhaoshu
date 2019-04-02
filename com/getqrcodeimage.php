<?php 
require 'db2.php';
require '../wechat/wechat.class.php';
require '../wechat/message.audit1.php';

	$orderid = $_GET['orderid'];
	$db = new db();

	$sql = 'select user.userid,user.wechatid,user.accesstime,a.media_id,a.qrcode from user right join(select userid,media_id,qrcode from tree_order_index where id=?) a on user.userid=a.userid';
	$userinfo = $db->prepare_query($sql,array($orderid))[0];
	$media_id = $userinfo['media_id'];

	if($media_id){
		$accesstime = strtotime($userinfo['accesstime']);
		$nowtime = time();
		$oldtonow = $nowtime - $accesstime;
		$weObj = new Wechat();
		$wechatid = $userinfo['wechatid'];
		if($oldtonow >= 48*60*60){
		    $title = '招标图片';
		    $remark = '找树网';
		    $url = 'qrcodeimage.html?image='.$userinfo['qrcode'];
		    $keyword = '获取招标图片!';
		    sendMessage($wechatid , $title, $keyword, $remark, $url,$weObj);
		}else{
		    sendImage($wechatid, $media_id,$weObj);
		}
	}else{
		echo true;
	}

	unset($db);




