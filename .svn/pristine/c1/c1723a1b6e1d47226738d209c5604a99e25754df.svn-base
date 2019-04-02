<?php 

require 'db2.php';
require 'qrcode.create.php';
require 'create.tenderimage.php';
require 'create.orderqrcodeimage.php';
require 'create.oneqrcodeimage.php';
require '../wechat/wechat.class.php';
require '../wechat/message.audit1.php';
require 'Curl.class.php';

	$orderid = $_GET['orderid'];
	$userid = $_GET['userid'];
	$db = new db();

	$sql = 'update tree_order_index set review_state=1,tendering=1 where id=?';
	$result = $db->prepare_exec($sql,array($orderid));

	
	$weObj = new Wechat();
	$sql = 'select * from tree_order where orderid=?';
	$data = $db->prepare_query($sql,array($orderid));
	if(count($data) == 1){
		$imagename = Createoneimage::create($orderid,$qrcode);
	}else{
		$imagename = Createimage::create($orderid,$qrcode);
	}

	$sql = 'select wechatid,accesstime from user where userid=?';
	$user = $db->prepare_query($sql,array($userid))[0];


	$wechatid = $user['wechatid'];
	
	$name = $imagename.'.jpg';
	$data = array('media'=>'@../tenderimage/'.$name);
	$url = geturl($weObj);

	$res = post($url,$data);

	$arr = json_decode($res,true);
	$media_id = $arr['media_id'];

	$sql = 'update tree_order_index set media_id=? where id=?';
	$result = $db->prepare_exec($sql,array($media_id,$orderid));


	$accesstime = strtotime($user['accesstime']);
	$nowtime = time();

	$oldtonow = $nowtime - $accesstime;


	if($oldtonow >= 48*60*60){
	    $title = '审核信息';
	    $remark = '找树网';
	    $url = 'qrcodeimage.html?image='.$imagename;
	    $keyword = '您的清单开始招标了,点击获取招标图片!';
	    sendMessage($wechatid , $title, $keyword, $remark, $url,$weObj);
	}else{
	    sendImage($wechatid, $media_id,$weObj);
	}


	echo $result;

	unset($db);

