<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';


$serial_number = $_GET['serial'];
$db = new db();
$sql = 'select tender_userid,bid_userid,deposit,tree_order_id from orders where serial_number=?';

$data = $db->prepare_query($sql,array($serial_number))[0];
$info = user::getUserByUserId($data['tender_userid']);
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
        $serial_number = $order['partner_trade_no'];
        $sql = 'update orders set refund_time=? , refund_mount=? , order_switch=4 , state=4 , deposit_switch=2 where serial_number=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$money,$serial_number) );

        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_insert( $sql, array($data['tender_userid'],$money) );

        $sql = 'update bid_order set state=8 where id=? and userid=?';
        $result = $db->prepare_exec( $sql, array($data['tree_order_id'],$data['bid_userid']) );
        if($result){
            $json = array();
            $json['refund_time'] = $payment_time;
            $json['refund_mount'] = $money;
        	echo json_encode($json);            
        }
    }
}
unset($db);

