<?php 
require 'checkhost.php';
require 'db2.php';

// 获取参数
$userid = $_GET['uid'];

$datas = $_GET['data'];

$addressprices = $_GET['addressprices'];

$useraddress = $_GET['useraddress'];

$ordername = $_GET['ordername'];

if (isset($datas)) {
	!$userid && exit;
	$datas = json_decode($datas, true);

	$addressprices = json_decode($addressprices, true);
	
	$db = new db();
	$sql = 'insert into tree_order_index(userid,ordername,address) values(?,?,?)';
	$orderid = $db->prepare_insert($sql,array($userid,$ordername,$useraddress));
	$havekey = [];
	$i = 0;
	foreach ($addressprices[0] as $key => $value) {
		$havekey[$i] = $key;
		$i++;
	}
	for ($j=0; $j < count($datas); $j++) { 
		$addresspricesj = $addressprices[$j];
		
		$fileds = array();
		$values = array();
		$fileds_kay = array();
		$data = $datas[$j];
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
			if($key != 'orderid' && $key != 'address_price' && $key != 'userid'){
				array_push($fileds,$key);
				array_push($values,$value);
				array_push($fileds_kay,'?');
				
			}

		}
		$address_price = '';
		foreach ($addresspricesj as $key => $value) {
			if(count($addresspricesj) > 1){
				if($key != 'id'){
					$address_price .= $key.':'.$value.',';
				}
			}
		}
		$address_price = rtrim($address_price, ",");
		array_push($fileds,'address_price');
		array_push($values,$address_price);
		array_push($fileds_kay,'?');
		array_push($fileds,'userid');
		array_push($values,$userid);
		array_push($fileds_kay,'?');
		array_push($fileds,'orderid');
		array_push($values,$orderid);
		array_push($fileds_kay,'?');
		$sql = 'insert into tree_order('.join(',' , $fileds).') values('.join(',' , $fileds_kay).')';
		
		$db->prepare_exec( $sql, $values );

	}
		$sql = 'delete from tree_order_temp where userid=?';
		$db->prepare_exec( $sql, array($userid) );
		unset($db);
	
}

?>