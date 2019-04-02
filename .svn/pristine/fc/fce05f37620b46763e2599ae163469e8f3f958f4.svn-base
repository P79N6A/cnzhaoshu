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

$userid = $_GET['userid'];
$id = $_GET['id'];
$db = new db();

$sql = 'select a.treeuserid,a.userid buyuserid,a.serial_number,a.deposit,b.* from (select * from order_one where id=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';

$data = $db->prepare_query($sql,array($id))[0];
$info = user::getUserByUserId($data['buyuserid']);
$wechatid = $info['wechatid'];
$desc = '定金退还';
if($data && $wechatid){
    $money = (int)$data['deposit'];
    $input = new WxPayCompanypay();
    $input->Setpartner_trade_no('d'.$data['serial_number']);
    $input->Setopenid($wechatid);
    $input->Setcheck_name('NO_CHECK');
    $input->Setamount($money);
    $input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);

    if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
        $payment_no = $order['payment_no'];
        $payment_time = $order['payment_time'];
        $sql = 'update order_one set refund_time=? , refund_mount=? , refund_no=? , payment_time=?, order_switch=10 , state=10 , deposit_switch=2 where id=?';
        $result = $db->prepare_exec( $sql, array($payment_time,$money,$payment_no,$payment_time,$id) );
        $Messageattrbute = new Messageattrbute();
        $weObj = new Wechat();
        $title = $Messageattrbute->Order_oneattribute($data);
        $name = $info['name'];
        $money = $money/100;
        $money = $money.'元';
        $way = '微信';
        $desc = '感谢您使用找树网';
        $url = './yusuanphone.php?msway=1&msid='.$data['serial_number'].'#managersell';
        takemoney($wechatid, $title, $name, $money, $way, $desc, $url, $weObj);
        
        $json = array();
        $json['refund_time'] = $payment_time;
        $json['refund_mount'] = $money;
        $json['refund_no'] = $payment_no;
    	echo json_encode($json);
        unset($weObj);
        unset($Messageattrbute);
    }else{
        $time = date('Y-m-d H:i:s',time());
        $myfile = fopen("./log.log", "a+");
        fwrite($myfile, '定金退还 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
        fclose($myfile); 
        echo '-1';   
    }

}
unset($db);

