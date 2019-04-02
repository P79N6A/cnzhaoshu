<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$tree_order_id = $_GET['tree_order_id'];
$bid_userid = $_GET['bid_userid'];
$tenderuserid = $_GET['userid'];


$db = new db();
$sql = 'select id,serial_number,deposit from orders where tree_order_id=? and bid_userid=? and tender_userid=?';
$unfinshed = $db->prepare_query($sql ,array($tree_order_id,$bid_userid,$tenderuserid))[0];

if($unfinshed){
    $serial_number = $unfinshed['serial_number'];
    $deposit = $unfinshed['deposit'];
    $money = (int)$deposit;
    $user = user::getUserByUserId($bid_userid);

    $desc = '定金到账(编号：'.$serial_number.')';
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no('d'.$serial_number);
    $input->Setopenid($user['wechatid']);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($money);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);

    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){

        $payment_time = date('Y-m-d H:i:s',time());

        $sql = 'update orders set deposit_refund_time=?,deposit_switch=2,order_switch=1,order_switch_time=null where id=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$unfinshed['id']) );

        $sql = 'update bid_order set state=9 where userid=? and id=?';
        $result = $db->prepare_exec( $sql, array($bid_userid,$tree_order_id) );

        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
        $result = $db->prepare_exec( $sql, array($bid_userid,$money) );

        $dianmi = ceil($money/100);
        $sql = 'update user set dianmi=dianmi+? where userid=? or userid=?';
        $result = $db->prepare_exec( $sql, array($dianmi,$bid_userid,$tenderuserid));


        $Messageattrbute = new Messageattrbute();

        $sql = 'select b.* from (select id,orderid from tree_order where id=? and userid=?) a left join (select * from tree_order where id=?) b on a.orderid=b.orderid';
        $orderinfo = $db->prepare_query($sql,array($tree_order_id,$bid_userid,$tree_order_id))[0];   
         
        $title = $Messageattrbute->Ordersattribute($orderinfo);

        $weObj = new Wechat();
        $desc = '定金到账('.$serial_number.')';
        $name = $user['name'].$user['phone'];
        $money = $money/100;
        $money = $money.'元';
        $way = '微信';

        $url = './yusuanphone.php?bhway=2&bhid='.$serial_number.'#bidhistory';
        takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
        echo true;
    }else{
        echo '-1';    
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '单品定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile);
    }
}

