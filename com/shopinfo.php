<?php
// 统计关键词搜索频次
require('db.php');
	$db = new db();


	$where = $_POST['where'];	
	$userid = $_POST['userid'];	
	$where = json_decode($where, true);

	$sql = 'select shopid from user where userid=?';
	$shopid = $db->prepare_query($sql , array($userid));
	$id = $shopid[0]['shopid'];
	if($id){
		$datas = '';
		$havekey = [];
		$i = 0;
		foreach ($where as $key => $value) {
			if($key != 'id'){
				$datas .= $key."='".$value."',";
			}
			$havekey[$i] = $key;
			$i++;
		}
		$datas = rtrim($datas, ",");
		$sql = 'update shop set '.$datas.' where id='.$id;
		$result = $db->exec( $sql );
		if($result){
			echo '2';
		}else{
			echo '3';
		}
	}else{
		$fileds = [];
		$values = [];
		$fileds_kay = [];

		foreach ($where as $key => $value) {
				array_push($fileds,$key);
				array_push($values,$value);
				array_push($fileds_kay,'?');

		}
		$sql = 'insert into shop('.join(',' , $fileds).') values('.join(',' , $fileds_kay).')';

		$result = $db->prepare_insert( $sql, $values );

		if($result){
			$sql = 'update user set shopid = ? where userid=?';
			$result = $db->prepare_exec( $sql, array($result , $userid ));
			echo $result;
		}else{
			echo $result;
		}
	}
	unset($db);



?>