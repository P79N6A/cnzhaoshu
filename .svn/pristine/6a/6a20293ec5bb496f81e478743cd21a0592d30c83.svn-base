<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';
$db = new db();

$info = $_GET['info'];
$info = json_decode($info,true);
$serial_number = $info['serial_number'];
$tree_order_id = $info['tree_order_id'];
$tender_userid = $info['tender_userid'];
$tender_mount = $info['tender_mount'];
$bid_userid = $info['bid_userid'];
$bid_mount = $info['bid_mount'];
$state = $info['state'];

$tender_info = user::getUserByUserId($tender_userid);
$bid_info = user::getUserByUserId($bid_userid);

$desc = '协商结果';


if($tender_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no('z'.$serial_number);
    $input->Setopenid($tender_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($tender_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];

        $sql = 'update orders set refund_mount=?,refund_no=? where serial_number=?';
        $tender_result = $db->prepare_exec( $sql, array($tender_mount,$payment_no,$serial_number) );

        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($tender_userid,$tender_mount) );

        if($tender_result){
            $weObj = new Wechat();
            $title = '退款 (编号：'.$serial_number.')';
            $name = $tender_info['name'];
            $money = $tender_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '感谢您使用找树网';
            $url = './yusuanphone.php#bidhistory';
            takemoney($tender_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);  
        }        
    }
    unset($input);
}
if($bid_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no('z'.$serial_number);
    $input->Setopenid($bid_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($bid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $sql = 'update orders set payment_no=? , payment_mount=? where serial_number=?';
        $bid_result = $db->prepare_exec( $sql, array($payment_no,$bid_mount,$serial_number) );

        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($bid_userid,$bid_mount) );
        
        if($bid_result){
            $weObj = new Wechat();
            $title = '退款 (编号：'.$serial_number.')';
            $name = $bid_info['name'];
            $money = $bid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '感谢您使用找树网';
            $url = './yusuanphone.php#bidhistory';
            takemoney($bid_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj); 
        }        
    }
    unset($input);
}

$time = date('Y-m-d H:i:s',time());
if($state == 1){
    $sql = 'update orders set order_switch=10 , state=10 ,refund_time=?,payment_time=?, deposit_switch=2 where serial_number=?';
    $result = $db->prepare_exec( $sql, array($time,$time,$serial_number) );        
}else{
    $sql = 'update orders set order_switch=10 ,refund_time=?,payment_time=?, state=10 where serial_number=?';
    $result = $db->prepare_exec( $sql, array($time,$time,$serial_number) ); 
}

$sql = 'update bid_order set state=18 where id=? and userid=?';
$result = $db->prepare_exec( $sql, array($tree_order_id,$bid_userid) );

echo $result;
unset($db);

