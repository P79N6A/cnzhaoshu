<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$userid = $_GET['userid'];
$id = $_GET['id'];
$db = new db();


$sql = 'select userid,deposit,serial_number from order_one where id=?';

$data = $db->prepare_query($sql,array($id))[0];
$info = user::getUserByUserId($data['userid']);
$wechatid = $info['wechatid'];
$desc = '定金退还';
if($data && $wechatid){
    $money = (int)$data['deposit'];
    // $input = new WxPayCompanypay();
    // $input->Setpartner_trade_no($data['serial_number']);
    // $input->Setopenid($wechatid);
    // $input->Setcheck_name('NO_CHECK');
    // $input->Setamount($money);
    // $input->Setdesc($desc);
    // $order = WxPayApi::companyPay($input);

    // if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
    //     $payment_no = $order['payment_no'];
    //     $payment_time = $order['payment_time'];

        $payment_no = '5464456516514';
        $payment_time = '2017-08-11 19:03:05';
        $sql = 'update order_one set refund_time=? , refund_mount=? , refund_no=? , payment_time=?, order_switch=10 , state=10 , deposit_switch=2 where id=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$money,$payment_no,$payment_time,$id) );

        $weObj = new Wechat();
        $title = '定金退还(编号：'.$data['serial_number'].')';
        $name = $user['name'];
        $money = $money/100;
        $money = $money.'元';
        $way = '微信';
        $desc = '感谢您使用找树网';
        $url = './yusuanphone.php#managersell';
        takemoney($wechatid, $title, $name, $money, $way, $desc, $url, $weObj);
        
        $json = array();
        $json['refund_time'] = $payment_time;
        $json['refund_mount'] = $money;
        $json['refund_no'] = $payment_no;
    	echo json_encode($json);
    // }
}
unset($db);

