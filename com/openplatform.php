<?php
// 微信第三方开放平台，db2.php
// 
class openplatform 
{
	public static function setPlatform($userid,$platformid,$name,$appid,$refresh_token)
	{
		$db = new db();

		// 如果platform_id 和 appID已经存在 update,否则 insert 
		$sql = 'select * from openadmin where appid=?';
		$platform = $db->prepare_query( $sql, array( $appid ) );
		
		if ( $platform ) {
			$sql = 'update openadmin set userid=?,platformid=?,company=?,refresh_token=?,state=1 where appid=?';
		}else{
			$sql = 'insert into openadmin(userid,platformid,company,refresh_token,appid) values(?,?,?,?,?)';
		}

		$db->prepare_exec( $sql, array( $userid,$platformid,$name,$refresh_token,$appid ) );

		// 返回id暨flagid
		$sql = 'select id from openadmin where platformid=?';
		$result = $db->prepare_query( $sql, array( $platformid ) );

		unset($db);

		return $result ? $result[0]['id'] : '';
	}

	// 一个用户可能绑定多个开放平台
	public static function getPlatformByUserID($userid)
	{
		$db = new db();

		// $sql = 'select * from openadmin where userid=?';
		$sql = 'select * from openadmin where find_in_set(?,userid)';		
		$result = $db->prepare_query( $sql, array( $userid ) );	

		unset($db);

		return $result;
	}

	public static function getPlatformByAppID($appid)
	{
		$db = new db();

		$sql = 'select * from openadmin where appid=?';
		$result = $db->prepare_query( $sql, array( $appid ) );

		unset($db);

		return $result ? $result[0] : null;
	}

	public static function getPlatformByPlatformID($platformid)
	{
		$db = new db();

		$sql = 'select * from openadmin where platformid=?';
		$result = $db->prepare_query( $sql, array( $platformid ) );

		unset($db);

		return $result ? $result[0] : null;
	}


	public static function unauthorizedByAppID($appid)
	{
		$db = new db();

		$sql = 'update openadmin set state=-2 where appid=?';
		$db->prepare_exec( $sql, array( $appid ) );

		unset($db);
	}

	public static function getPlatformAdmin($userid, $platformid)
	{
		$db = new db();

		// $sql = 'select id,platformid,company from openadmin where find_in_set(?,userid) and platformid=?';
		$sql = 'select id,platformid,company from openadmin where find_in_set(?,userid)';
		$result = $db->prepare_query( $sql, array( $userid ) );

		unset($db);

		return $result ? $result[0] : null;
	}

}

?>