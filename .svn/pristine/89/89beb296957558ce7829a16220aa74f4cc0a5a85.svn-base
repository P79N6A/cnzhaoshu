<?php 
	require 'checkhost.php';
	require('db2.php');
	
	$userid = $_GET['userid'];
	$area = $_GET['area'];
	$name = $_GET['name'];
	$time1 = $_GET['time1'];
	$time2 = $_GET['time2'];
	
	if($time1 > $time2){
		$time3 = $time2;
		$time2 = $time1;
		$time1 = $time3;
	}
	$searchkey = array();
	!$userid && exit;
	$search = '';
	if($area || $name || $time1 || $time2){
		array_push($searchkey,$userid);
	}
	if($area != null){
		$search .= 'and address like ? ';
		array_push($searchkey,'%'.$area.'%');
	}
	if($name != null){
		$search .= 'and ordername like ? ';
		array_push($searchkey,'%'.$name.'%');
	}
	if($time1 != null && $time2 != null){
		$time1 = $time1.' 00:00:01';
		$time2 = $time2.' 23:59:59';
		$search .= 'and time>=? and time<=? ';
		array_push($searchkey,$time1);
		array_push($searchkey,$time2);
	}

	$db = new db();

	if($search){
		$sql = 'select id,ordername,address,time from tree_order_index where state = 1 and userid=? '.$search.'order by time desc';
		
		$result = $db->prepare_query($sql, $searchkey);
		echo json_encode($result);
	}else{
		$sql = 'select id,ordername,address,time from tree_order_index where state = 1 and userid=? order by time desc';
		$result = $db->prepare_query($sql, array($userid));
		echo json_encode($result);
	}
	
	unset($db);


























 ?>