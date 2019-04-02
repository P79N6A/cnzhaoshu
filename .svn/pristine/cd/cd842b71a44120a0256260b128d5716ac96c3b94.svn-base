<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$id = $_GET['id'];

$db = new db();

$sql = 'select treeuserid,fullamount,serial_number from order_one where id=?';
$data = $db->prepare_query($sql,array($id))[0];
$json;
if(count($data)){
  		$user = user::getUserByUserId($data['treeuserid']);
		$money = (int)$data['fullamount'];
		$desc = '苗木款(编号：'.$data['serial_number'].')';
		$input = new WxPayCompanypay();
		$input->Setpartner_trade_no('z'.$data['serial_number']);
		$input->Setopenid($user['wechatid']);
		$input->Setcheck_name('NO_CHECK');
		$input->Setamount($money);
		$input->Setdesc($desc);
		$order = WxPayApi::companyPay($input);

		if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
			$payment_no = $order['payment_no'];
			$payment_time = $order['payment_time'];

			$sql = 'update order_one set payment_no=? , payment_time=? , payment_mount=? , state=10 , order_switch=1 where id=?';
			$result = $db->prepare_exec( $sql, array($payment_no,$payment_time,$money,$id) );

			$sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
			$result = $db->prepare_exec( $sql, array($data['treeuserid'],$money) );

			$json = array();
			$json['payment_time'] = $payment_time;
			$json['payment_mount'] = $money;
			
			$weObj = new Wechat();
			$title = '苗木款到账(编号：'.$data['serial_number'].')';
			$name = $user['name'];
			$money = $money/100;
			$money = $money.'元';
			$way = '微信';
			$desc = '感谢您使用找树网';
			$url = './yusuanphone.php#managersell';
			takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
		}else{
			$time = date('Y-m-d H:i:s',time());
			$myfile = fopen("./log.log", "a+");
			fwrite($myfile, '单品--时间：'.$time.',交易号'.$data['serial_number'].',交易金额'.$data['fullamount'].',状态：失败'."\r\n");
			fclose($myfile);	
		}	
}
echo json_encode($json);




