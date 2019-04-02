<?php
/*
返回登录二维码ticket
 */
if ( empty($_SERVER['HTTP_REFERER']) || strtolower($_SERVER['SERVER_NAME'])!='cnzhaoshu.com') exit; 

require '../wechat/wechat.class.php';
require 'db2.php';

$weObj = new Wechat();

$qrcode = $weObj->getQRCode(time());
$ticket = $qrcode['ticket'];

if (empty($ticket)) {
	$weObj->deleteAccessToken();
	$qrcode = $weObj->getQRCode(time());
	$ticket = $qrcode['ticket'];
}

// IE6/7 下载到本地
$agent = $_SERVER['HTTP_USER_AGENT'];
if ( strpos($agent,'MSIE') !== false ) {
	$url = $weObj->getQRUrl($ticket);
	$img = $weObj->http_get($url);

	if (!$img) {
		$weObj->deleteAccessToken();
		$url = $weObj->getQRUrl($ticket);
		$img = $weObj->http_get($url);
	}

	file_put_contents('../qrlogin/'.strtolower($ticket).'.jpg', $img);
	unset($img);
}

unset($weObj);


$db = new db();

$sql = "insert into qrcode(ticket) values(?)";
$db->prepare_exec($sql, array( $ticket ));

unset($db);


echo $ticket;

?>