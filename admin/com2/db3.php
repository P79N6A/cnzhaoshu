<?php
/*
用法
同时操作多条Sql语句，用事务方法
考虑效率和安全的问题，尽量用prepare_query(), prepare_exec() 少用 query(), exec()
 
$db = new db(); // 创建
// 事务提交
$sqls = array(
	"insert ignore into treetemp set wechatid='$wechatid'",
	"insert ignore into user set wechatid='$wechatid'"
);

$db->transaction( $sqls );

// prepare_query
$sql = 'select userid from user where wechatid=?';
$user = $db->prepare_query( $sql, array( $wechatid ) );

// prepare_exec
$sql = 'update user set steptime=0 where wechatid=?';
$db->prepare_exec( $sql, array( $wechatid ) );


// query
$sql = 'select userid from user where wechatid=?';
$user = $db->query( 'select * from tree where userid=1' );

// exec
$db->exec( 'update user set steptime=0 where userid=1' );



unset($db);  // 销毁

 */
class db 
{
	private static $dsn = 'mysql:host=localhost;dbname=renyang';
	private static $username = 'renyang';
	private static $password = 'k3h6d4h9dh';
	private $pdo = null; 

	/**
	* 构造函数
	*/
	public function __construct($type='utf8mb4') 
	{
		$this->pdo = new PDO(self::$dsn, self::$username, self::$password);
		$this->pdo->query('SET NAMES '.$type);  // 设置数据库编码 utf8mb4 存微信名称特殊字符
		$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	/**
	* 析构函数
	*/
	public function __destruct() 
	{
		$this->pdo = null;
	}

	/***********************************************************************************
	通用方法
	***********************************************************************************/

	/**
	* 查询语句
	*/
	public function query($sql) 
	{
		$result = $this->pdo->query($sql);		
		$result->setFetchMode(PDO::FETCH_ASSOC);

		if ($result->rowCount()==0) {
			return null;
		}else {
			return $result->fetchAll();
		}
	}
	/**
	* 允许异常的查询语句
	*/
	public function query_try($sql) 
	{
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);//开启异常处理 
		try{
			$result = $this->pdo->query($sql);		
			$result->setFetchMode(PDO::FETCH_ASSOC);

			if ($result->rowCount()==0) {
				return null;
			}else {
				return $result->fetchAll();
			}
		}catch(Exception $e){
			return null;
		}	
	}
	/**
	* 执行语句
	*/
	public function exec($sql) 
	{
		return $this->pdo->exec($sql);		
	}

	public function prepare_query($sql,$array)
	{
		$result = $this->pdo->prepare($sql);
		$result->execute($array);

		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		if ($result->rowCount()==0) {
			return null;
		}else {
			return $result->fetchAll();
		}
	}

	public function prepare_exec($sql,$array) 
	{
		$result = $this->pdo->prepare($sql);
		return $result->execute($array);
	}
	/**
	* 执行插入语句，返回插入id
	*/
	public function insert($sql) 
	{
		$this->pdo->exec($sql);
		return $this->pdo->lastinsertid();
	}
	public function prepare_insert($sql,$array) 
	{
		$result = $this->pdo->prepare($sql);
		$result->execute($array);
		return $this->pdo->lastinsertid();
	}

	public function transaction($sqls) 
	{
		$pdo = $this->pdo;
		$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);//这个是通过设置属性方法进行关闭自动提交和上面的功能一样 
        $pdo->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);//开启异常处理 
		try{
			$pdo->beginTransaction();

			foreach ($sqls as $sql) {
				$pdo->exec( $sql );
			}

			$pdo->commit();

			return true;
		}catch(Exception $e){
			$pdo->rollBack();

			return false;
		}		
	}
}
?>