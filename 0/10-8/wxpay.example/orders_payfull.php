<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];
$tender_userid = $_GET['userid'];
$qrcodeid = $_GET['qrcodeid'];

$db = new db();
$sql = 'select serial_number,fullamount from orders where bid_userid=? and tree_order_id=? and tender_userid=?';
$unfinshed = $db->prepare_query($sql,array($bid_userid,$tree_order_id,$tender_userid))[0];

	if(count($unfinshed)){
			$serial_number = $unfinshed['serial_number'];
			$fullamount = $unfinshed['fullamount'];
			$money = (int)$fullamount;
			$user = user::getUserByUserId($bid_userid);

			$desc = '苗木款(编号：'.$serial_number.')';
			$input = new WxPayCompanypay();
			$input->Setpartner_trade_no('q'.$serial_number);
			$input->Setopenid($user['wechatid']);
			$input->Setcheck_name('NO_CHECK');
			$input->Setamount($money);
			$input->Setdesc($desc);
			$order = WxPayApi::companyPay($input);

			if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
				$payment_no = $order['payment_no'];
				$payment_time = $order['payment_time'];
				$payment_time = date('Y-m-d H:i:s',time());
				$sql = 'update orders set payment_no=? , payment_time=? , payment_mount=? , state=10 where serial_number=?';
				$result = $db->prepare_exec( $sql, array($payment_no,$payment_time,$money,$serial_number) );
				$sql = 'update bid_order set state=18 where id=? and userid=?';
				$result = $db->prepare_exec( $sql, array($tree_order_id,$bid_userid) );

				$dianmi = ceil($money/100);
				$sql = 'update user set dianmi=dianmi+? where userid=? or userid=?';
				$result = $db->prepare_exec( $sql, array($dianmi,$bid_userid,$tender_userid));
				
				$Messageattrbute = new Messageattrbute();
				$sql = 'select b.* from (select id,orderid from tree_order where id=? and userid=?) a left join (select * from tree_order where id=?) b on a.orderid=b.orderid';
				$orderinfo = $db->prepare_query($sql,array($tree_order_id,$bid_userid,$tree_order_id))[0];   
				$title = $Messageattrbute->Ordersattribute($orderinfo);
				$weObj = new Wechat();
				$desc = '苗木款('.$serial_number.')';
				$name = $user['name'].$user['phone'];
				$money = $money/100;
				$money = $money.'元';
				$way = '微信';
				$url = './yusuanphone.php?bhway=1&bhid='.$serial_number.'#bidhistory';
				takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
				echo $result;
			}else{
				$time = date('Y-m-d H:i:s',time());
				$myfile = fopen("./log.log", "a+");
				fwrite($myfile, '招标全款 时间：'.$time.',交易号'.$serial_number.',交易金额'.$money.',状态：失败'."\r\n");
				fclose($myfile);
				echo '-1';	
			}
	}
unset($db);
