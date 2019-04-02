<?php
if ( empty($_SERVER['HTTP_REFERER']) || strtolower($_SERVER['SERVER_NAME'])!='cnzhaoshu.com') exit; 

header('P3P: CP=CAO PSA OUR');
require 'db2.php';

$ticket = $_GET['ticket'];

$db = new db();

$sql = 'select wechatid from qrcode where state=1 and now()-time<1800 and ticket=?';
$result = $db->prepare_query( $sql, array( $ticket ) );

if ($result) {
	include 'user2.php';

	$user = user::getUserByWechatId( $result[0]['wechatid'] );
	unset( $user['introduction'] );

	if ( file_exists($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$user['userid'].'.jpg') ) {
		$user['headimg'] = 1;
	}

	$user = json_encode($user);
	
	$expire = $_GET['autoLogin']=='true' ? time() + 315360000 : 0;
	setcookie('user2', $user, $expire, '/', 'cnzhaoshu.com');
	
	echo $user;
} else {
	echo json_encode(null);
}

unset($db);

?>