<?php

include 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php';
require '../wechat/wechat.class.php';


// $allcompany = $_GET['companyid'];
// $orderid = $_GET['orderid'];
// $userid = $_GET['userid'];
// $to_tender = $_GET['to_tender'];

$allcompany = [80104];
$orderid = 1172;
$userid = 29908;

$to_tender = [['userid'=>29908,'id'=>'20170721164256839','orderid'=>1172],['userid'=>80104,'id'=>'20170721164256839','orderid'=>1172]];


// $allcompany = json_decode($allcompany,true);
// $to_tender = json_decode($to_tender,true);
echo '<pre>';
$db = new db();


	$sql = 'select a.ordername,b.name,a.send_msg from (select ordername,userid,send_msg from tree_order_index where id = ?) a left join (select name,userid from user where userid=?) b on a.userid=b.userid';
	$info = $db->prepare_query($sql,array($orderid,$userid))[0];


	if(!$info['send_msg']){
		$weObj = new Wechat();

		$userarray = array();
		for ($i=0; $i < count($allcompany); $i++) { 
			$sql = 'select get_msg from user where userid=?';
			$get_msg = $db->prepare_query($sql,array($allcompany[$i]))[0]['get_msg'];
			if($get_msg){
				$sql = 'select stateb,state from supplier where supplier_id=? and userid=?';
				$state = $db->prepare_query($sql,array($allcompany[$i],$userid))[0];
				if(($state['stateb'] == 2) || ($state['state'] == 2)){
					array_push($userarray, $allcompany[$i]);
				}
			}
		}

		$sendmsg = array();

		for ($i=0; $i < count($to_tender); $i++) { 
			if($to_tender[$i]['userid']){
				if(in_array($to_tender[$i]['userid'], $userarray)) continue;
			}
			$sendmsg[count($sendmsg)] = $to_tender[$i]['userid'];
			$keys = array();
			$values = array();
			$truevalues = array();
			foreach ($to_tender[$i] as $key => $value) {
				array_push($keys, $key);
				array_push($values, '?');
				array_push($truevalues, $value);
			}
			$sql = 'insert into bid_order('.join(',',$keys).') values('.join(',',$values).')';
			// $result = $db->prepare_exec($sql,$truevalues);
		}

		// var_dump($sendmsg);

		for ($i=0; $i < count($sendmsg); $i++) { 
			$user = user::getUserByUserId($sendmsg[$i]);
			$first = '您的苗木已被比中 , 欢迎报价!';
			$remark = '找树网';
			$url = 'quote.php?orderid='.$orderid;
			$keyword1 = $info['ordername'] ? $info['ordername'] : '暂无';
			$keyword2 = $info['name'] ? $info['name'] : '暂无';
			sendselectedMessage($user['wechatid'], $first, $keyword1, $keyword2, $remark, $url,$weObj);
		}	
		// $sql = 'update tree_order_index set send_msg=1 where id=?';
		// $result = $db->prepare_exec($sql,array($orderid));

	}else{
		$result = '-1';
	}

// 	echo $result;

// unset($db);



