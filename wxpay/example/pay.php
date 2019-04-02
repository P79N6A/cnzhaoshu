<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';


$tender_userid = $_GET['tender_userid'];
$bid_userid = $_GET['bid_userid'];
$tree_order_id = $_GET['tree_order_id'];

$info = user::getUserByUserId($bid_userid);
$wechatid = $info['wechatid'];
$db = new db();

$sql = 'select money,serial_number from orders where tender_userid=? and bid_userid=? and tree_order_id=?';
$data = $db->prepare_query($sql,array($tender_userid,$bid_userid,$tree_order_id))[0];


if($data && $wechatid){
    $money = (int)$data['money'];
    $desc = '苗木款(编号：'.$tree_order_id.')';
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
        $sql = 'update orders set payment_no=? , payment_time=? where serial_number=?';
        $result = $db->prepare_exec( $sql, array($payment_no,$payment_time,$serial_number) );

        $sql = 'update bid_order set state=5 where userid=? and id=?';
        $result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );
    }
    echo json_encode($order);
}
unset($db);

