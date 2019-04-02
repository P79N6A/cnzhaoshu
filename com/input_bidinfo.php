<?php
require 'checkhost.php';
include 'db2.php';

$orderid = $_GET['orderid'];
$userid = $_GET['userid'];
$data = $_GET['data'];
$data = json_decode($data,true);
$db = new db();

if ($data['id']) {
	$sql = 'select * from bid_order where id=? and orderid=? and userid=?';
	$result = $db->prepare_query($sql,array($data['id'],$orderid,$userid));
	$keys = array();
	$values = array();
	if($result){
		foreach ($data as $key => $value) {
			if($key != 'id'){
				array_push($keys, $key.'=?');
				array_push($values, $value);
			}
		}
		array_push($keys, 'state=?');
		array_push($values, 1);
		array_push($values, $data['id']);
		array_push($values, $orderid);
		array_push($values, $userid);
		if(($result['state'] == 0) || ($result['state'] == 1)){
			$sql = 'update bid_order set '.join(',',$keys).' where id=? and orderid=? and userid=?';
			$result1 = $db->prepare_exec($sql,$values);
		}
	}else{
		$valuefalse = array();
		foreach ($data as $key => $value) {
			array_push($keys, $key);
			array_push($valuefalse, '?');
			array_push($values, $value);
		}
		array_push($keys, 'state');
		array_push($valuefalse, '?');
		array_push($values, 1);
		array_push($keys, 'userid');
		array_push($valuefalse, '?');
		array_push($values, $userid);
		array_push($keys, 'orderid');
		array_push($valuefalse, '?');
		array_push($values, $orderid);

		$sql = 'insert into bid_order ('.join(',',$keys).') values('.join(',',$valuefalse).')';
		$result1 = $db->prepare_exec($sql,$values);
	}
} else {
	for ($a=0; $a < count($data); $a++) { 
		$dataes = $data[$a];
		$sql = 'select * from bid_order where id=? and orderid=? and userid=?';
		$result = $db->prepare_query($sql,array($dataes['id'],$orderid,$userid));
		$result = $result[0];
		$keys = array();
		$values = array();
		if($result){
			foreach ($dataes as $key => $value) {
				if($key != 'id'){
					array_push($keys, $key.'=?');
					array_push($values, $value);
				}
			}
			array_push($keys, 'state=?');
			array_push($values, 1);
			array_push($values, $dataes['id']);
			array_push($values, $orderid);
			array_push($values, $userid);
			if(($result['state'] == 0) || ($result['state'] == 1)){
				$sql = 'update bid_order set '.join(',',$keys).' where id=? and orderid=? and userid=?';
				$result1 = $db->prepare_exec($sql,$values);
			}
		}else{
			$valuefalse = array();
			foreach ($dataes as $key => $value) {
				array_push($keys, $key);
				array_push($valuefalse, '?');
				array_push($values, $value);
			}
			array_push($keys, 'state');
			array_push($valuefalse, '?');
			array_push($values, 1);
			array_push($keys, 'userid');
			array_push($valuefalse, '?');
			array_push($values, $userid);
			array_push($keys, 'orderid');
			array_push($valuefalse, '?');
			array_push($values, $orderid);

			$sql = 'insert into bid_order ('.join(',',$keys).') values('.join(',',$valuefalse).')';
			$result1 = $db->prepare_exec($sql,$values);
		}
	}
}
	unset($db);
	echo $result1;


		

	







