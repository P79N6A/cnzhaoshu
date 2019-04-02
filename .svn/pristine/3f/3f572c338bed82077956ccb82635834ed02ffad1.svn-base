<?php
// 微信浏览器，绑定身份，没有code通过回调获取
// 每次都要重新获取user
// m.php, m2.php 引用

// function wechatLogin($form='m')
function wechatLogin($form)
{
	function getUser($id, $isUserid)
	{
		include 'com/db2.php';
		include 'com/user2.php';

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

		if ( file_exists($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$user['userid'].'.jpg') ) {
			$user['headimg'] = 1;
		}

		setcookie('user2', json_encode( $user ), time() + 315360000, '/', 'cnzhaoshu.com');

		$user['introduction'] = $introduction;
		// $user['introduction'] = str_replace('"', '\"', $user['introduction']);
		
		return $user;
	}

	function reload()
	{
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx400fa6a12644f696&redirect_uri=http://www.cnzhaoshu.com/'.$_SERVER['REQUEST_URI'].'&response_type=code&scope=snsapi_base';

		header('Location: '.$url);
	}

	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
		$user = $_COOKIE['user2'];

		if ( $user ) {
			$user = json_decode($user, true);
			if ($user['userid']) {
				$user = getUser($user['userid'], true);
				if (!$user) {
					// 用户失效
					setcookie('user2', '', -1, '/', 'cnzhaoshu.com');
					reload();
				}
			} else {
				// cookie损坏，删除cookie
				setcookie('user2', '', -1, '/', 'cnzhaoshu.com');
				reload();
			}
		} else {
			$code = $_REQUEST['code'];	// 微信回调
			
			if (empty($code)) {
				reload();
				exit;
			} else {
				include 'wechat/openid.php';

				$wechatid = openid::getOpenid( $code );
				
				if($wechatid){
					$user = getUser( $wechatid );
				}
			}
		}

		if ( $form=='m2' ){
			$introduction = $user['introduction'];
			unset( $user['introduction'] );

			echo "<script type='text/javascript'>var visitor='".json_encode($user)."';</script>";

			$user['introduction'] = $introduction;
		}

		return $user;
	} else if ($form=='m2' && (strpos($_SERVER['QUERY_STRING'], 'userid')===false && empty($_REQUEST['treeid']))) {
		// 没有shopid(userid)、treeid，跳转到首页
		header('Location: http://www.cnzhaoshu.com/m.php');
		exit;
	}
}