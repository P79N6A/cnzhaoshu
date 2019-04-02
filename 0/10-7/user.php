<?php
// require('db.php');


class user 
{
	// private static $wechatid = null;

	/**
	* 检查用户状态
	* step 默认1，1姓名，2电话，
	* 3苗木图片，4苗木名称，5胸径，6冠幅，7树高，8上车价，9数量，10位置，11提交成功开始下一颗=>3
	* 21重置联系人，22手机，23完成
	* 招标：31姓名，32手机，33名称，34数量，35胸径，36冠幅，37树高，38备注，39完成继续＝>33。
	*/
	private static function initUserSql($wechatid)
	{
		$sqls = array(
			array(
				'sql' => 'insert into user set wechatid=?',
				'parameter' => array($wechatid)
			),
			array(
				'sql' => 'insert into treetemp(userid,wechatid) select userid,wechatid from user where wechatid=?',
				'parameter' => array($wechatid)
			),
			array(
				'sql' => 'update user set shopid=userid where wechatid=?',
				'parameter' => array($wechatid)
			)
		);
		return $sqls;
	}
	public static function check($wechatid) 
	{
		$db = new db();
		$user = $db->getUser('wechatid',$wechatid);
		if (!$user) {
			// 新用户初始化2个用户表
			$sqls = self::initUserSql($wechatid);
			$db->prepare_transaction( $sqls );

			$step = 1;
		} else {
			$step = $user['step'];
			$change = 0;
			// 1小时3600秒失效，重新提交
			if (!$user['phone']) $step = $change = 1;
			else if (!$user['name']) $step = $change = 2;
			else if($user['passtime']>3600) $step = $change = 3; // 正在提交，但超时了

			$change && $db->setStep($wechatid, $step);
		}

		unset($db);
		
		return $step;
	}

	/**
	* 初始化用户
	*/
	public static function init($wechatid) 
	{
		$db = new db();

		$sqls = self::initUserSql($wechatid);
		$db->prepare_transaction( $sqls );

		$sql = 'select userid,name from user where wechatid=?';
		$user = $db->prepare_query( $sql, array( $wechatid ) );

		unset($db);

		return $user ? $user[0] : null;
	}


	/**
	* 检查用户权限
	*/
	public static function state($wechatid) 
	{
		$db = new db();
		$user = $db->getUser('wechatid',$wechatid);
		unset($db);

		return $user['state'];
	}
	public static function role($wechatid) 
	{
		$db = new db();

		$sql = 'select role from user where wechatid=?';
		$user = $db->prepare_query($sql, array( $wechatid ));

		unset($db);

		return $user ? $user[0]['role'] : null;
	}

	/**
	* 重置用户姓名、手机
	*/
	public static function reset($wechatid) 
	{
		$db = new db();
		$db->setStep($wechatid, 51);
		unset($db);

		return 51;
	}

	/**
	* 重置用户姓名、手机
	*/
	public static function step($wechatid) 
	{
		$db = new db();
		$step = $db->getStep($wechatid);
		unset($db);

		return $step;
	}

	/**
	* 中止提交，时间置为过期
	*/
	public static function stopSubmit($wechatid) 
	{
		$db = new db();
		$db->stopSubmit($wechatid);
		unset($db);
	}

	public static function stopSubmitByWechaId($wechatid) 
	{
		$db = new db();

		$sql = 'update user set steptime=0 where wechatid=?';
		$db->prepare_exec( $sql, array( $wechatid ) );

		unset($db);
	}

	public static function stopSubmitByUserId($userid) 
	{
		$db = new db();

		$sql = 'update user set steptime=0 where userid=?';
		$db->prepare_exec( $sql, array( $userid ) );

		unset($db);
	}

	/**
	* 二维码登录
	*/
	public static function loginQrcode($wechatid, $ticket) 
	{
		$db = new db();
		
		$sql = 'update qrcode set state=1,wechatid=? where ticket=?';
		$db->prepare_exec( $sql, array( $wechatid, $ticket ) );

		unset($db);
	}

	/**
	* 精确查找用户
	*/
	public static function get($where,$value) 
	{
		$db = new db();
		$result = $db->getUser($where, $value);
		unset($db);

		return $result;
	}
	public static function getUserByWechatId($wechatid) 
	{
		$db = new db();

		$sql = 'select userid,shopid,name,shopname,phone,introduction,role,state,istrader,isrenzheng,dianmi,subscribe,nickname,sex,city,province,version from user where wechatid=?';
		$user = $db->prepare_query($sql, array( $wechatid ));

		unset($db);

		return $user ? $user[0] : null;
	}

	/**
	* 查找有苗木的用户
	*/
	public static function getWithTreeByPhone($phone)
	{		
		$db = new db();
		$sql = 'select u.*,count(u.userid) as items,sum(t.count) as count from (select userid,shopid,name,phone,isrenzheng,dianmi from user where phone=?) as u join tree as t where t.userid=u.userid group by userid order by isrenzheng desc,dianmi desc,items desc';			
		$result = $db->prepare_query($sql, array($phone));
		unset($db);

		return $result;
	}	
	public static function likeWithTreeByName($name) 
	{		
		$db = new db();
		$sql = 'select u.*,count(u.userid) as items,sum(t.count) as count from (select userid,shopid,name,phone,isrenzheng,dianmi from user where name like ?) as u join tree as t where t.userid=u.userid group by userid order by isrenzheng desc,dianmi desc,items desc';			
		$result = $db->prepare_query($sql, array("%$name%"));
		unset($db);

		return $result;
	}


	public static function setUserByUserId($userid,$value) 
	{
		$db = new db();

		$sql = 'update user set '.$value.' where userid=?';
		$db->prepare_exec($sql, array( $userid ));
		
		unset($db);
	}

	/**
	* 苗木统计
	*/
	public static function totalTrees($userid) 
	{
		$db = new db();
		$result = $db->totalTrees($userid);
		unset($db);

		return $result;
	}

	/**
	* 常用地址
	*/
	public static function getUsedAddress($wechatid) 
	{
		$db = new db();
		$result = $db->getUsedAddress($wechatid);
		unset($db);

		return $result;
	}

	/**
	* 招标权限
	*/
	public static function bidding($wechatid) 
	{
		$db = new db();
		$user = $db->getUser('wechatid',$wechatid);
		
		if ($user[isbid]) {
			$step = $user[phone] ? 33 : ($user[name] ? 32 : 31);
			$db->setStep($wechatid, $step);
		}else{
			$step = 33;
		}

		unset($db);

		return $step;
	}

	/**
	* 设置最后访问时间
	*/
	public static function setLastAccessTime($wechatid) 
	{
		$db = new db();
		$db->exec("update user set accesstime=NOW() where wechatid='$wechatid'");
		unset($db);
	}

	/**
	* 检查开发平台用户是否绑定找树网
	*/
	public static function checkOpenPlatformWechatID($openwechatid) 
	{
		$db = new db();
		$result = $db->query("select wechatid from openplatform where openwechatid='$openwechatid'");
		unset($db);
	
		return $result ? $result[0][wechatid] : null;
	}

	public static function getOpenPlatform($platformid)
	{
		$db = new db();
		$result = $db->query("select appid,appsecret,maxnumber,province from openadmin where platformid='$platformid' and state>-1");
		unset($db);

		return $result ? $result[0] : null;
	}
	// 
	public static function save_temp_video($filename, $wechatid)
	{
		$db = new db();
		$db->exec("update user set video='$filename', video_checked=NULL where wechatid='$wechatid'");
		unset($db);
	}
	public static function deletevideo($wechatid)
	{
		$db = new db();
		$db->exec("update user set video=NULL, video_checked=NULL where wechatid='$wechatid'");
		unset($db);
	}

	public static function isRepeatMessage($wechatid, $msgid, $isReply)
	{
		$db = new db();
		$sql = 'select id,times from msgid where id=? and wechatid=?';
		$msg = $db->prepare_query($sql, array($msgid, $wechatid));


		if ($msg) {
			// 有重复，重复次数+1
			$sql = 'update msgid set times=times+1 where id=?';
			$db->prepare_exec($sql, array($msgid));			
		} else {
			// $isReply = true 清空该用户所有的消息
			if ($isReply) {
				$sql = 'delete from msgid where wechatid=?';
				$db->prepare_exec($sql, array($wechatid));
			}

			// 写入新的msgid
			$sql = 'insert into msgid (id,times,wechatid) values(?,?,?)';
			$db->prepare_exec($sql, array($msgid, $isReply?0:1, $wechatid));
		}
		unset($db);

		return $msg ? $msg[0]['times']+1 : 0;
	}
}

?>