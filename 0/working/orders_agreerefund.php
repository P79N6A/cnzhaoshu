<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';


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

        $sql = 'update orders set refund_time=? , refund_mount=? , order_switch=4 , state=4 , deposit_switch=2 where serial_number=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$money,$serial_number) );

        $sql = 'update bid_order set state=8 where id=? and userid=?';
        $result = $db->prepare_exec( $sql, array($data['tree_order_id'],$data['bid_userid']) );
        if($result){
            $json = array();
            $json['refund_time'] = $payment_time;
            $json['refund_mount'] = $money;

            $weObj = new Wechat();
            $title = '订金退还(编号：'.$serial_number.')';
            $name = $info['name'];
            $money = $money/100;
            $money = $money.'元';
            $way = '微信';
            $desc = '感谢您使用找树网';
            $url = './yusuanphone.php#bidhistory';
            takemoney($info['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
            
        	echo json_encode($json);            
        }
    }
}
unset($db);

