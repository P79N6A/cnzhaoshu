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
$time = date('Y-m-d H:i:s',time());

$treeuseridover = true;
$useridover = true;

$Messageattrbute = new Messageattrbute();
$sql = 'select b.* from (select id,orderid from tree_order where id=? and userid=?) a left join (select * from tree_order where id=?) b on a.orderid=b.orderid';
$orderinfo = $db->prepare_query($sql,array($tree_order_id,$bid_userid,$tree_order_id))[0];   
$title = $Messageattrbute->Ordersattribute($orderinfo);

if($tender_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($tender_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($tender_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];

        $sql = 'update orders set refund_mount=?,refund_no=? where serial_number=?';
        $tender_result = $db->prepare_exec( $sql, array($tender_mount,$payment_no,$serial_number) );

        if($tender_result){
            $weObj = new Wechat();
            $desc = '协商结果退款('.$serial_number.')';
            $name = $tender_info['name'];
            $money = $tender_mount/100;
            $money = $money.'元';
            $way = '微信';
            $url = './yusuanphone.php?bhway=1&bhid='.$serial_number.'#bidhistory';
            takemoney($tender_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);  
        }        
    }else{
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$treeuserid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile);   
        $useridover = false; 
    }
    unset($input);
}
if($bid_mount){
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($bid_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($bid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $sql = 'update orders set payment_no=? , payment_mount=? where serial_number=?';
        $bid_result = $db->prepare_exec( $sql, array($payment_no,$bid_mount,$serial_number) );

        $dianmi = ceil($bid_mount/100);
        $sql = 'update user set dianmi=dianmi+? where userid=? or userid=?';
        $result = $db->prepare_exec( $sql, array($dianmi,$bid_userid,$tender_userid));

        if($bid_result){
            $weObj = new Wechat();
            $desc = '协商结果退款('.$serial_number.')';
            $name = $bid_info['name'];
            $money = $bid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $url = './yusuanphone.php?bhway=1&bhid='.$serial_number.'#bidhistory';
            takemoney($bid_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj); 
        }        
    }else{
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$userid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile); 
        $treeuseridover = false; 
    }
    unset($input);
}

if(!$treeuseridover && !$useridover){
    echo false;
}else{
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
}
unset($db);

