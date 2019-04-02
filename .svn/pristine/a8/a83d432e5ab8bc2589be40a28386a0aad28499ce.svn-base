<?php 
	require('db.php');
	$db = new db();
	// 获取参数
	$userid = $_GET['uid'];
	$data = $_GET['data'];
	echo '<pre>';
	$fileds = array();
	$values = array();
	$fileds_kay = array();
	if (isset($data)) {
		!$userid && exit;
		$data = json_decode($data, true);
		
		// 对数组进行处理
		$array_key .= 'userid,';
		$array_value .= '\''.$userid.'\',';
		// 将规格里的数组变为字符串
		foreach ($data as $k => $v) {
			$array_key .= $k.',';
			if(is_array($v)){
				if(isset($v[1])){
					$data[$k] = $v[0].','.$v[1];
				}elseif($v[0]){
					$data[$k] = $v[0];
				}
			}else{
				$data[$k] = $v;
			}

		}
		foreach ($data as $key => $value) {
			array_push($fileds,$key);
			array_push($values,$value);
			array_push($fileds_kay,'?');

		}
		array_push($fileds,'userid');
		array_push($values,$userid);
		array_push($fileds_kay,'?');
		var_dump($fileds,$values,$fileds_kay);
		// $array_key = rtrim($array_key, ",");
		// $array_value = rtrim($array_value, ",");
		// var_dump($array_key,$array_value);
		$sql = 'insert into tree_order_temp('.join(',' , $fileds).') values('.join(',' , $fileds_kay).')';

		echo $sql;
		echo json_encode($values);
		$db->prepare_exec( $sql, $values );
		// $db->exec($sql);
		// unset($db);
	}

























 ?>