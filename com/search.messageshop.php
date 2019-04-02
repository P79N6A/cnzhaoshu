<?php 
	
require 'db.php';
$db = new db();

$id = $_GET['id'];
if ($id) {
	$sql = 'select * from evaluation where treeid=? order by time desc';
	$result = $db->prepare_query($sql,array($id));
	if(count($result)){
		$date = [];
		for ($i=0; $i < count($result); $i++) { 
			$one = $result[$i];
			$date[$i] = [];
			$sql = 'select name from user where userid=?';
			$result1 = $db->prepare_query($sql, array($one['userid']))[0]['name'];
	
			$date[$i]['username'] = $result1;
			$date[$i]['id'] = $one['userid'];
			$date[$i]['content'] = $one['text'];
			$date[$i]['timestamp'] = strtotime($one['time']);
			$date[$i]['avatar'] = '/headimg/0/'.$one['userid'].'.jpg';
		}

		$dates['code'] = 0;
		$dates['msg'] = '';
		$dates['data'] = $date;
		echo json_encode($dates);
	}
}
