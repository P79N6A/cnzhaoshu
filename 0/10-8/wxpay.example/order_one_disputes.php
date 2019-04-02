<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
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

$treeuseridover = true;
$useridover = true;

$sql = 'select a.treeuserid,a.userid,a.serial_number,a.deposit,b.* from (select * from order_one where serial_number=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
$attrbuteinfo = $db->prepare_query($sql,array($serial_number))[0];
$Messageattrbute = new Messageattrbute();
$title = $Messageattrbute->Order_oneattribute($attrbuteinfo);

$desc = '协商结果';

$time = date('Y-m-d H:i:s',time());

if($treeuserid_mount){
    $bid_info = user::getUserByUserId($treeuserid);
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($bid_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($treeuserid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){

        $payment_no = $order['payment_no'];
        $sql = 'update order_one set payment_no=?, payment_mount=? where serial_number=?';
        $bid_result = $db->prepare_exec( $sql, array($payment_no,$treeuserid_mount,$serial_number) );
        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($treeuserid,$treeuserid_mount) );

        $dianmi = ceil($treeuserid_mount/100);
        $sql = 'update user set dianmi=dianmi+? where userid=? or userid=?';
        $result = $db->prepare_exec( $sql, array($dianmi,$treeuserid,$userid));

        if($result){
            $weObj = new Wechat();
            $name = $bid_info['name'];
            $money = $treeuserid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '协商结果退款('.$serial_number.')';
            $url = './yusuanphone.php?mbway=2&mbid='.$serial_number.'#managersell';
            takemoney($bid_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj); 
        }        
    }else{
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$treeuserid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile);   
        $treeuseridover = false; 
    }
    unset($input);
}

if($userid_mount){
    $tender_info = user::getUserByUserId($userid);
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($tender_info['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($userid_mount);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $sql = 'update order_one set refund_no=?, refund_mount=? where serial_number=?';
        $tender_result = $db->prepare_exec( $sql, array($payment_no,$userid_mount,$serial_number) );
        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($userid,$userid_mount) );
        if($result){
            $weObj = new Wechat();
            
            $name = $tender_info['name'];
            $money = $userid_mount/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '协商结果退款('.$serial_number.')';
            $url = './yusuanphone.php?mbway=2&mbid='.$serial_number.'#managerbuy';
            takemoney($tender_info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);  
        }        
    }else{
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品纠纷 用户id：'.$userid.' 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile); 
        $useridover = false; 
    }
    unset($input);
}

if(!$treeuseridover && !$useridover){
    echo false;
}else{
    $sql = 'update order_one set payment_time=? ,refund_time=? ,order_switch=10 , state=10 , deposit_switch=2 where serial_number=?';
    $result = $db->prepare_exec( $sql, array($payment_time,$payment_time,$serial_number) );
    echo $result;  
}
   
unset($db);

