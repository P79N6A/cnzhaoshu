<?php

class user 
{
	public static function init($wechatid) 
	{
		$db = new db();

		$sqls = array(
			array(
				'sql' => 'insert into adopt_user set wechatid=?',
				'parameter' => array($wechatid)
			)
		);

		$db->prepare_transaction( $sqls );

		$sql = 'select userid from adopt_user where wechatid=?';
		$user = $db->prepare_query( $sql, array( $wechatid ) );

		unset($db);

		return $user ? $user[0] : null;
	}


	public static function getUserByWechatId($wechatid) 
	{
		$db = new db();

		$sql = 'select userid,wechatid,username,phone,address,role,version from adopt_user where wechatid=?';
		$user = $db->prepare_query( $sql, array( $wechatid ) );

		unset($db);

		return $user ? $user[0] : null;
	}
	
	public static function getUserByUserId($userid) 
	{
		$db = new db();

		$sql = 'select userid,wechatid,username,phone,address,role,version from adopt_user where userid=?';
		$user = $db->prepare_query( $sql, array( $userid ) );

		unset($db);

		return $user ? $user[0] : null;
	}

	public static function update($userid, $value) 
	{
		$db = new db();

		$sql = 'update adopt_user set '.$value.' where userid=?';
		$db->prepare_exec($sql, array( $userid ));
		
		unset($db);
	}

	public static function role($wechatid) 
	{
		$db = new db();

		$sql = 'select role from adopt_user where wechatid=?';
		$user = $db->prepare_query($sql, array( $wechatid ));

		unset($db);

		return $user ? $user[0]['role'] : null;
	}
}

?>