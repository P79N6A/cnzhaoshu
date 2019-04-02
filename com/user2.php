<?php

class user 
{
	public static function init($wechatid) 
	{
		$db = new db();

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

		$db->prepare_transaction( $sqls );

		$sql = 'select userid from user where wechatid=?';
		$user = $db->prepare_query( $sql, array( $wechatid ) );

		unset($db);

		return $user ? $user[0] : null;
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

	public static function getUserByWechatId($wechatid) 
	{
		$db = new db();

		$sql = 'select userid,shopid,name,shopname,phone,introduction,role,state,istrader,isrenzheng,dianmi,subscribe,nickname,sex,city,province,version,invoice from user where wechatid=?';
		$user = $db->prepare_query( $sql, array( $wechatid ) );

		unset($db);

		return $user ? $user[0] : null;
	}
	
	public static function getUserByUserId($userid) 
	{
		$db = new db();

		$sql = 'select userid,shopid,wechatid,name,shopname,phone,introduction,role,state,istrader,isrenzheng,dianmi,subscribe,nickname,sex,city,province,version,invoice from user where userid=?';
		$user = $db->prepare_query( $sql, array( $userid ) );

		unset($db);

		return $user ? $user[0] : null;
	}

	public static function update($userid, $value) 
	{
		$db = new db();

		$sql = 'update user set '.$value.' where userid=?';
		$db->prepare_exec($sql, array( $userid ));
		
		unset($db);
	}

	public static function role($wechatid) 
	{
		$db = new db();

		$sql = 'select role from user where wechatid=?';
		$user = $db->prepare_query($sql, array( $wechatid ));

		unset($db);

		return $user ? $user[0]['role'] : null;
	}
}

?>