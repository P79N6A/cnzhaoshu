<?php 
require 'checkhost.php';
require 'db2.php';

// 获取参数
// echo '<pre>';
$datas = $_GET['data'];
$datas = json_decode($datas, true);
var_dump($datas);
if ($datas) {
	$db = new db();
	for ($i=0; $i < count($datas); $i++) { 
		$fileds = array();
		$values = array();
		$fileds_kay = array();
		$data = $datas[$i];
		// 将规格里的数组变为字符串
		foreach ($data as $k => $v) {
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
			if($key != 'orderid' && $key != 'address_price'){
				array_push($fileds,$key);
				array_push($values,$value);
				array_push($fileds_kay,'?');
				
			}

		}
		$sql = 'insert into tree_order_temp('.join(',' , $fileds).') values('.join(',' , $fileds_kay).')';
		// echo $sql;
		// var_dump($values);
		$db->prepare_exec( $sql, $values );
	}
	unset($db);
}



?>