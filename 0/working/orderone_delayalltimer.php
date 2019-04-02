<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';


// ignore_user_abort();
$oldtime=3;
$url="http://test.cnzhaoshu.com/wxpay/example/orderone_delayalltimer.php";

$run = include '../../com/orderpay_timer.php';

if(!$run) die;

  	$db = new db();
	// $time = date('Y-m-d H:i:s',strtotime('-5 day'));
	$time = date('Y-m-d H:i:s',time());
	
	$sql = 'select treeuserid,fullamount,id,serial_number from order_one where state=3 and receipt_time < \''.$time.'\'';
	$unfinshed = $db->query($sql);
	
	if(count($unfinshed)){
	  	for ($i=0; $i < count($unfinshed); $i++) {
	  		$data = $unfinshed[$i];
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
				$serial_number = $order['partner_trade_no'];
				$sql = 'update order_one set payment_no=? , payment_time=? , payment_mount=? , state=4 where id=?';
				$result = $db->prepare_exec( $sql, array($payment_no,$time,$money,$data['id']) );
				var_dump($result,$payment_no,$time,$money,$data['id']);
				$weObj = new Wechat();
				
				$title = '苗木款到账(编号：'.$data['serial_number'].')';
				$name = $user['name'];
				$money = $money/100;
				$money = $money.'元';
				$way = '微信';
				$desc = '感谢您使用找树网';
				$url = '';
				takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
			}else{
				$time = date('Y-m-d H:i:s',time());
				$myfile = fopen("./log.log", "a+");
				fwrite($myfile, '单品全款--时间：'.$time.',交易号'.$data['serial_number'].',交易金额'.$data['fullamount'].',状态：失败'."\r\n");
				fclose($myfile);	
			}
	  	}		
	}

sleep($oldtime);
file_get_contents($url);




