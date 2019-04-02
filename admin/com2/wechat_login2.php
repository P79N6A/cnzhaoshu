<?php
// 微信浏览器，绑定身份，没有code通过回调获取
// 每次都要重新获取user
// m.php, m2.php 引用

// function wechatLogin($form='m')
function wechatLogin($form)
{
	function getUser($id, $isUserid)
	{
		include 'db3.php';
		include 'user.php';

		$user = $isUserid ? user::getUserByUserId( $id ) : user::getUserByWechatId( $id );
		if (!$user) {
			if ($isUserid) {
				return null;
			} else {			
				$user = user::init( $id );  // 初始化用户
			}
		}
		// 写入cookie，不写introduction，微信彻底关闭后失效，不关闭10年有效，换账号失效
		$introduction = $user['introduction'];
		unset( $user['introduction'] );

		if ( !file_exists($_SERVER['DOCUMENT_ROOT'].'/headimage/m/'.$user['userid'].'.jpg') ) {
			$user['nothasimage'] = 1;
		}
		setcookie('user', json_encode( $user ), time() + 315360000, '/', 'renyangshu.com');
		$user['introduction'] = $introduction;
		return $user;
	}

	function reload()
	{
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0fc67840da12b408&redirect_uri='.urlEncode('http://renyangshu.com'.$_SERVER['REQUEST_URI']).'&response_type=code&scope=snsapi_base#wechat_redirect';
		
		header('Location: '.$url);
		exit;
	}

	
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == true ) {
		$user = $_COOKIE['user'];
		if ( $user ) {
			$user = json_decode($user, true);
			if ($user['userid']) {
				$user = getUser($user['userid'], true);
				if (!$user) {
					// 用户失效
					setcookie('user', '', -1, '/', 'renyangshu.com');
					reload();
				}
			} else {
				// cookie损坏，删除cookie
				setcookie('user', '', -1, '/', 'renyangshu.com');
				reload();
			}
		} else {
			$code = $_REQUEST['code'];	// 微信回调
			if (empty($code)) {
				reload();
			} else {
				include 'openid.php';
				$wechatid = openid::getOpenid( $code );
				if($wechatid){
					$user = getUser($wechatid);
				}
			}
		}
	}
}