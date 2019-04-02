<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';


$userid = $_GET['userid'];
$id = $_GET['id'];
$db = new db();


$sql = 'select userid,deposit,serial_number from order_one where id=?';

$data = $db->prepare_query($sql,array($id))[0];
$info = user::getUserByUserId($data['userid']);
$wechatid = $info['wechatid'];
$desc = '订金退还';
if($data && $wechatid){
    $money = (int)$data['deposit'];
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($data['serial_number']);
    $input->Setopenid($wechatid);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($money);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);

    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $payment_time = $order['payment_time'];
        $sql = 'update order_one set refund_time=? , refund_mount=? , refund_no=?,payment_time=?, order_switch=4 , state=4 , deposit_switch=2 where id=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$money,$payment_no,$payment_time,$id) );
        $json = array();
        $json['refund_time'] = $payment_time;
        $json['refund_mount'] = $money;
        $json['refund_no'] = $payment_no;
    	echo json_encode($json);
    }else{
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '招标定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile);
    }
}
unset($db);

