<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$userid = $_GET['userid'];
$isrenzheng = $_GET['isrenzheng']-2;

$db = new db();

if($isrenzheng == 1){
    $name = '开通认证店';
    $money = 150000;
}else{
    $name = '开通旗舰店';
    $money = 190000;
}

$user = user::getUserByUserId($userid);


$time = date('YmdHis',time());
$desc = $name.'--驳回退款';
$input = new WxPayCompanypay();
$input->Setpartner_trade_no($time);
$input->Setopenid($user['wechatid']);
$input->Setcheck_name('NO_CHECK');
$input->Setamount($money);
$input->Setdesc($desc);
$order = WxPayApi::companyPay($input);

if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
    $sql = 'update user set isrenzheng = ?,rz_time = ? where userid=?';
    $result = $db->prepare_exec($sql,array(0,null,$userid));

    $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
    $result = $db->prepare_exec( $sql, array($userid,$money) );
            
    $weObj = new Wechat();
    $money = $money/100;
    $first = '很抱歉您的审核未通过了！资金将返还给您的账户';
    $remark = '---找树网';
    $url = '';
    sendonetreepay($user['wechatid'], $first, $money, $name, $remark, $url, $weObj);
    echo true;
}else{
    $time = date('Y-m-d H:i:s',time());
    $myfile = fopen("./log.log", "a+");
    fwrite($myfile, '认证退款 时间：'.$time.',金额：'.$money.'元,状态：失败'."\r\n");
    fclose($myfile);   
    echo false; 
}













