<?php 
	require 'checkhost.php';
	require('db2.php');
	
	// 获取参数
	$userid = $_POST['userid'];
	$address = $_POST['address'];
	$ordername = $_POST['ordername'];
	$orderid = $_POST['orderid'];
	
	$db = new db();

	$time =  date("Y-m-d", strtotime('30 day'));

	$sql = 'insert into tree_order_index(userid,ordername,address,expiration_date) values(?,?,?,?)';
	$neworderid = $db->prepare_insert($sql,array($userid,$ordername,$address,$time));
	

	$sql = 'select id,userid,name,unit,type,typename,count,trunk_diameter,ground_diameter,plant_height,crown,branch_number,bough_number,age,branch_length,bough_length,branch_point_height,pot_diameter,plant_height_cm,crown_cm,substrate from tree_order where orderid=?';

	$result = $db->prepare_query($sql,array($orderid));

	for ($i=0; $i < count($result); $i++) { 
		$data = $result[$i];
		$keyarr = array();
		$modelarr = array();
		$valuearr = array();
		foreach ($data as $key => $value) {
			if($key == 'id'){
				$value = date("YmdHis",time()).($i+100);
			}
			array_push($keyarr, $key);
			array_push($modelarr, '?');
			array_push($valuearr, $value);
		}
		array_push($keyarr, 'orderid');
		array_push($modelarr, '?');
		array_push($valuearr, $neworderid);
		$sql = 'insert into tree_order_temp('.join(',' , $keyarr).') values('.join(',' , $modelarr).')';
		$result1 = $db->prepare_exec( $sql, $valuearr);
	}
	echo $neworderid;

	unset($db);
























 ?>