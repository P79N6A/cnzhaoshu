<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/checkhost.php';
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$id = $_GET['id'];

  	$db = new db();
	
	$Messageattrbute = new Messageattrbute();
	$sql = 'select a.treeuserid,a.userid buyuserid,a.serial_number,a.fullamount,b.* from (select * from order_one where id=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
	$data = $db->prepare_query($sql,array($id))[0];

	if(count($data)){
	  		$user = user::getUserByUserId($data['treeuserid']);
			$money = (int)$data['fullamount'];
			$desc = '苗木款(编号：'.$data['serial_number'].')';
			$input = new WxPayCompanypay();
			$input->Setpartner_trade_no($data['serial_number']);
			$input->Setopenid($user['wechatid']);
			$input->Setcheck_name('NO_CHECK');
			$input->Setamount($money);
			$input->Setdesc($desc);
			$order = WxPayApi::companyPay($input);

			if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
				$payment_no = $order['payment_no'];
				$payment_time = $order['payment_time'];

				$sql = 'update order_one set payment_no=? ,payment_time=? ,payment_mount=? ,state=10 ,order_switch=1 where id=?';
				$result = $db->prepare_exec( $sql, array($payment_no,$payment_time,$money,$id) );

				$dianmi = ceil($money/100);
				$sql = 'update user set dianmi=dianmi+? where userid=? or userid=?';
				$result = $db->prepare_exec( $sql, array($dianmi,$data['treeuserid'],$data['buyuserid']));

				$uname = mb_substr($user['name'],0,3);
				$sql = 'insert into order_dynamic(content) values(?)';
				$content = $uname.'**  收全款  '.$dianmi.'元';
				$result = $db->prepare_insert($sql,array($content));
				
				$json = array();
				$json['payment_time'] = $payment_time;
				$json['payment_mount'] = $money;
				$title = $Messageattrbute->Order_oneattribute($data);
				$weObj = new Wechat();
				$name = $user['name'].$user['phone'];
				$money = $money/100;
				$money = $money.'元';
				$way = '微信';
				$desc = '感谢您使用找树网';
				$url = './yusuanphone.php?msway=1&msid='.$data['serial_number'].'#managersell';
				takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
				echo json_encode($json);
			}else{
				$time = date('Y-m-d H:i:s',time());
				$myfile = fopen("./log.log", "a+");
				fwrite($myfile, '单品--时间：'.$time.',交易号'.$data['serial_number'].',交易金额'.$data['fullamount'].',状态：失败'."\r\n");
				fclose($myfile);	
				echo '-1';
			}	
	}

unset($Messageattrbute);
unset($db);




