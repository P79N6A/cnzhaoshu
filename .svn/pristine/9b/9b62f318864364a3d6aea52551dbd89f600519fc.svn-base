<?php 
require 'checkhost.php';
	require 'db2.php';
	
	// 获取参数
	$limit = $_GET['limit'];
	$userid = $_GET['userid'];
	$role = $_GET['role'];
	$name = $_GET['name'];
	if($name) $name = '%'.$name.'%';
	$limit = explode(',', $limit);
	$db = new db();
	if($userid){
		if($name){
			if($role == 9 || $role == 8){
				$sql = 'select b.*,c.price ismy from (select a.*,user.name username,user.phone from (select n.*,d.time,d.address from (select * from tree_order where name like ?) n left join (select * from tree_order_index) d on n.orderid=d.id where d.tendering=1) a left join user on a.userid=user.userid) b left join (select * from bid_order where userid=?) c on b.orderid=c.orderid and b.id=c.id order by b.time desc limit ?,?';
			}else{				
				$sql = 'select b.*,c.price ismy from (select a.*,user.name username from (select n.*,d.time,d.address from (select * from tree_order where name like ?) n left join (select * from tree_order_index) d on n.orderid=d.id where d.tendering=1) a left join user on a.userid=user.userid) b left join (select * from bid_order where userid=?) c on b.orderid=c.orderid and b.id=c.id order by b.time desc limit ?,?';
			}

			$result = $db->prepare_query($sql,array($name,$userid,$limit[0],$limit[1]));
		}else{

			if($role == 9 || $role == 8){
				$sql = 'select b.*,c.price ismy from (select a.*,user.name username,user.phone from (select tree_order.*,d.time,d.address from tree_order left join (select * from tree_order_index) d on tree_order.orderid=d.id where d.tendering=1) a left join user on a.userid=user.userid) b left join (select * from bid_order where userid=?) c on b.orderid=c.orderid and b.id=c.id order by b.time desc limit ?,?';
			}else{				
				$sql = 'select b.*,c.price ismy from (select a.*,user.name username from (select tree_order.*,d.time,d.address from tree_order left join (select * from tree_order_index) d on tree_order.orderid=d.id where d.tendering=1) a left join user on a.userid=user.userid) b left join (select * from bid_order where userid=?) c on b.orderid=c.orderid and b.id=c.id order by b.time desc limit ?,?';
			}

			$result = $db->prepare_query($sql,array($userid,$limit[0],$limit[1]));
		}

		echo json_encode($result);
	}

	unset($db);




















 ?>