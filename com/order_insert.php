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
		$sql = 'select virtual_money,real_money from user where userid=?';
		$moneys = $db->prepare_query($sql,array($userid))[0];

		$money = (int)$moneys['virtual_money'] + (int)$moneys['real_money'] - count($datas)*100;

		if($money > 0){

			$surplus = (int)$moneys['virtual_money'] - count($datas)*100;
			if($surplus >= 0){
				$sql = 'update user set virtual_money=? where userid=?';
				$result = $db->prepare_exec($sql,array($surplus ,$userid));
			}else{
				$sql = 'update user set real_money=?,virtual_money=0 where userid=?';
				$result = $db->prepare_exec($sql,array($money ,$userid));
			}
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

				$nowtime = date('Y-m-d H:i:s',time());
				$expiration_date = date('Y-m-d',strtotime('+30 day'));

				$sql = 'update tree_order_index set state=1 , expiration_date=?,time=? ,review_state=1,tendering=1 where id=?';
				$result2 = $db->prepare_exec( $sql, array($expiration_date,$nowtime,$orderid) );

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
		}else{
			echo '-1';
		}
	}

	unset($db);
