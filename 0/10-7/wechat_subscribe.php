<?php
// 关注后 如果没有用户头像， 拉取用户信息, 存数据库，保存头像
// 为兼容开放平台，$wechatid－找树网的，$weObj->getRevFrom()－公众号的
function saveWechatUserInformation($weObj, $wechatid, $userid, $isOpenPlatform, $open_wechatid, $isUpdate)
{
	$db = new db('utf8mb4');

	
	if ( $isOpenPlatform ) {
		// 来自开放平台，检查是否关注找树网
		$weObj_zhaoshu = new Wechat();
		$user = $weObj_zhaoshu->getUserInfo( $wechatid );
		unset($weObj_zhaoshu);

		$subscribe_zhaoshu = $user && $user['subscribe']==1 ? 1 : 0;
		if ( $subscribe_zhaoshu==0 ) {
			// 没有关注找树网，从当前公众号拉取信息
			if ( !$open_wechatid ) $open_wechatid = $weObj->getRevFrom();
			$user = $weObj->getUserInfo( $open_wechatid );
		}
	} else {
		$user = $weObj->getUserInfo( $wechatid );
		$subscribe_zhaoshu = $user['subscribe'];
	}	


	if ($user && $user['subscribe']==1) {
		// 保存头像
		if (!empty($imgurl=$user['headimgurl'])) {

			// 从数据库，获取userid
			if ( !$userid ) {
				$sql = 'select userid from user where wechatid=?';
				$user2 = $db->prepare_query( $sql, array( $wechatid ) );
				$userid = $user2[0]['userid'];
				unset($user2);
			}

			// 不是强制更新(来自关注公众号)，并且已经有头像了，退出，避免覆盖自己上传的logo
			if ( $isUpdate || !file_exists($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$userid.'.jpg') ) {
				$img0 = $weObj->http_get( $imgurl );
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/headimg/0/'.$userid.'.jpg', $img0);
				unset($img0);	

				$imgurl = substr($imgurl, 0, strlen($imgurl)-1);
				$img96 = $weObj->http_get( $imgurl.'96' );
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$userid.'.jpg', $img96);
				unset($img96);	
				
				// $img46 = basic::resizeImage(imagecreatefromstring($img96), 46, 46);
				// imagejpeg($img46, '../headimg/46/'.$userid.'.jpg', 70);			
				// unset($img46);			
			}
		}

		$sql = 'update user set subscribe=?,nickname=?,sex=?,city=?,province=? where userid=?';
		$sql_array = array( 
			$subscribe_zhaoshu,
			mb_substr($user['nickname'], 0, 30, 'utf-8'), 
			$user['sex'], 
			mb_substr($user['city'], 0, 20, 'utf-8'), 
			mb_substr($user['province'], 0, 20, 'utf-8'), 
			$userid );
	}else{
		$sql = 'update user set subscribe=0 where userid=?';
		$sql_array = array( $userid );
	}

	// 存数据库
	$db->prepare_exec($sql, $sql_array);

	unset($db);

	return $user && $user['subscribe']==1 ? true : false;
}

function unsubscribeWechat($wechatid)
{
	$db = new db();

	$sql = 'update user set subscribe=0 where wechatid=?';
	$db->prepare_exec( $sql, array( $wechatid ) );

	unset($db);
}

?>