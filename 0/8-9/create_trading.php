<?php



function create_trading($tree_order_id,$tender_userid,$bid_userid){	
	$db = new db();
	$sql = 'select serial_number from orders where tree_order_id=? and bid_userid=?';
	$data = $db->prepare_query($sql,array($tree_order_id,$bid_userid))[0];
	if(!$data){
		$serial_number = get_total_millisecond();
		$sql = 'insert into orders(serial_number, tree_order_id, tender_userid, bid_userid) values (?,?,?,?)';
		$result = $db->prepare_insert($sql,array($serial_number,$tree_order_id,$tender_userid,$bid_userid));
	}else{
		$serial_number = $data['serial_number'];
	}
	return $serial_number;
	unset($db);
}

function get_total_millisecond(){  
	$date = date('ymdHis',time());;
    $time = explode (" ", microtime () );   
    $time = 1000000 + (int)($time [0] * 1000000);
    $rand = rand(100001,999999);
    return ($date . $time . $rand); 
}
