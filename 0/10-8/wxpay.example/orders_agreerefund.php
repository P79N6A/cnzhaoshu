<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';


$serial_number = $_GET['serial'];
$db = new db();


$sql = 'select tender_userid,bid_userid,deposit,tree_order_id from orders where serial_number=?';

$data = $db->prepare_query($sql,array($serial_number))[0];
$info = user::getUserByUserId($data['tender_userid']);
$wechatid = $info['wechatid'];
$desc = '定金退还';
if($data && $wechatid){
    $money = (int)$data['deposit'];
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no($serial_number);
    $input->Setopenid($wechatid);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($money);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $payment_time = date('Y-m-d H:i:s',time());
        $sql = 'update orders set refund_no=?, refund_time=? ,payment_time=? , refund_mount=? , order_switch=10 , state=10 , deposit_switch=2 where serial_number=?';
        $result = $db->prepare_exec( $sql, array($payment_no,$payment_time,$payment_time,$money,$serial_number) );

        $sql = 'update bid_order set state=18 where id=? and userid=?';
        $result = $db->prepare_exec( $sql, array($data['tree_order_id'],$data['bid_userid']) );

        $sql = 'insert into recharge_bill(userid,money,way) values(?,?,?)';
        $result = $db->prepare_insert($sql,array($data['tender_userid'],$money,4));

        if($result){
            $json = array();
            $json['refund_time'] = $payment_time;
            $json['refund_mount'] = $money;

            $Messageattrbute = new Messageattrbute();
            $sql = 'select b.* from (select id,orderid from tree_order where id=? and userid=?) a left join (select * from tree_order where id=?) b on a.orderid=b.orderid';
            $orderinfo = $db->prepare_query($sql,array($data['tree_order_id'],$data['bid_userid'],$data['tree_order_id']))[0];   
            $title = $Messageattrbute->Ordersattribute($orderinfo);
            
            $weObj = new Wechat();
            $desc = '定金退还('.$serial_number.')';
            $name = $info['name'];
            $money = $money/100;
            $money = $money.'元';
            $way = '微信';
            $url = './yusuanphone.php?bhway=1&bhid='.$serial_number.'#bidhistory';
            takemoney($info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
        	echo json_encode($json);            
        }
    }else{
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '招标定金 时间：'.$time.',交易号'.$serial_number.',交易金额'.$money.',状态：失败'."\r\n");
        fclose($myfile);
        echo '-1';    
    }
}
unset($db);

