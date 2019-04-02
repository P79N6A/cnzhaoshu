<?php 
	
	require 'db.php';
	$db = new db();

	$userid = $_GET['userid'];
	$limit = $_GET['limit'];
	if ($userid) {
		$sql = 'select treeid,name from tree where userid = ?';
		$result = $db->prepare_query($sql,array($userid));

		$mine = [];
		$date = [];
		$date = [];
		for ($i=0; $i < count($result); $i++) { 
			$date[$i] = [];
			$result1 = $result[$i];
			$date[$i]['groupname'] = $result1['name'];
			$date[$i]['id'] = $result1['treeid'];
			$date[$i]['avatar'] = '/treeimg/'.$result1['treeid'].'.jpg';
		}

		$sql = 'select name,shopname from user where userid=?';
		$result2 = $db->prepare_query($sql ,array($userid))[0];
		$mine = ["username"=>$result2['name'],"id"=>$userid,"status"=>"online","sign"=>$result2['shopname'],"avatar"=>'/shop/photo/m/'.$userid.'.jpg'];
		
	}
	
	$dates = [];
	$dates['code'] = 0;
	$dates['msg'] = '';
	$dates['data'] = [];
	$dates['data']['mine'] = $mine;
	$dates['data']['group'] = $date;
	unset($db);
	
	echo json_encode($dates);

?>