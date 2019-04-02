<?php 
	require 'db2.php';
	require 'qrcode.create.php';
	require 'create.tenderimage.php';
	require 'create.orderqrcodeimage.php';
	require 'create.oneqrcodeimage.php';
	require '../wechat/wechat.class.php';
	require '../wechat/message.audit1.php';
	require 'Curl.class.php';
	
	// 获取参数
	$userid = $_POST['uid'];

	$orderid = $_POST['orderid'];

	$addressprices = $_POST['addressprices'];

	$db = new db();

	$sql = 'select * from tree_order_temp where orderid=?';
	$datas = $db->prepare_query($sql,array($orderid));


	
	if ($datas) {
		for ($i=0; $i < count($datas); $i++) { 
			$arraykey = array();
			$arraya = array();
			$arrayvalue = array();
			foreach ($datas[$i] as $key => $value) {
				if($value){
					array_push($arraykey, $key);
					array_push($arraya, '?');
					array_push($arrayvalue, $value);					
				}
			}
			$sql = 'insert into tree_order ('.join(',',$arraykey).') values ('.join(',',$arraya).')';
			$result = $db->prepare_exec( $sql, $arrayvalue);

		}

		
		if($result){
			$sql = 'delete from tree_order_temp where orderid=?';
			$result1 = $db->prepare_exec( $sql, array($orderid) );

			$expiration_date = date("Y-m-d",strtotime("$date1 +30 day"));

			$sql = 'update tree_order_index set state=1 , expiration_date=? ,review_state=1,tendering=1 where id=?';
			$result2 = $db->prepare_exec( $sql, array($expiration_date,$orderid) );

			$weObj = new Wechat();
			if(count($datas) == 1){
				$imagename = Createoneimage::create($orderid);
			}else{
				$imagename = Createimage::create($orderid);
			}


			$sql = 'select wechatid from user where userid=?';
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

			$qrcodeid = $imagename;
			$qrcodeimg = QRcodeCreate::permission($qrcodeid);
			imagejpeg($qrcodeimg, '../permissionqrcode/'.$qrcodeid.'.jpg');
			echo $imagename;
			unset($weObj);

		}
		
	}
	unset($db);