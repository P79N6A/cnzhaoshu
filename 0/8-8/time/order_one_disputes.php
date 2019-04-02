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
$treeid = $info['treeid'];
$userid = $info['userid'];
$userid_mount = $info['userid_mount'];
$treeuserid = $info['treeuserid'];
$treeuserid_mount = $info['treeuserid_mount'];
$state = $info['state'];

$tender_info = user::getUserByUserId($userid);
$bid_info = user::getUserByUserId($treeuserid);

$desc = '协商结果';

if($userid_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($tender_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($userid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_time = $order['payment_time'];
        $payment_no = $order['payment_no'];
        $sql = 'update order_one set refund_time=? ,refund_no=?, refund_mount=? where serial_number=?';
        $tender_result = $db->prepare_exec( $sql, array($payment_time,$payment_no,$userid_mount,$serial_number) );
        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($userid,$userid_mount) );
        if($tender_result){
            $weObj = new Wechat();
            $title = '退款 (编号：'.$serial_number.')';
            $name = $tender_info['name'];
            $money = $userid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '感谢您使用找树网';
            $url = './yusuanphone.php#bidhistory';
            takemoney($tender_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);  
        }        
    }else{
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$userid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile); 
    }
    unset($input);
}
if($treeuserid_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($bid_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($treeuserid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_time = $order['payment_time'];
        $payment_no = $order['payment_no'];
        $sql = 'update order_one set payment_no=?, payment_mount=? where serial_number=?';
        $bid_result = $db->prepare_exec( $sql, array($payment_no,$treeuserid_mount,$serial_number) );
        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($treeuserid_userid,$treeuserid_mount) );
        if($bid_result){
            $weObj = new Wechat();
            $title = '退款 (编号：'.$serial_number.')';
            $name = $bid_info['name'];
            $money = $treeuserid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '感谢您使用找树网';
            $url = './yusuanphone.php#bidhistory';
            takemoney($bid_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj); 
        }        
    }else{
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$treeuserid_userid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile);    
    }
    unset($input);
}


if($state == 1){
    $sql = 'update order_one set payment_time=? ,order_switch=4 , state=4 , deposit_switch=2 where serial_number=?';
    $result = $db->prepare_exec( $sql, array($payment_time,$serial_number) );        
}else{
    $sql = 'update order_one set order_switch=4 , state=4 where serial_number=?';
    $result = $db->prepare_exec( $sql, array($serial_number) ); 
}

echo '1';
unset($db);

