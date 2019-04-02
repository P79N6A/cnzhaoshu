<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';


ignore_user_abort();
$oldtime=60;
$turl="http://cnzhaoshu.com/wxpay/example/order_one_returndeposit.php";

$run = include '../../com/order_returndeposit_timer.php';

if(!$run) die;

    $db = new db();
    $time = date('Y-m-d H:i:s',strtotime('-1 day'));
    
    $sql = 'select id,serial_number,treeuserid,userid,deposit from order_one where deposit_switch=1 and order_switch=3 and order_switch_time < \''.$time.'\'';

    $unfinshed = $db->query($sql);
    if(count($unfinshed)){
        for($i=0; $i < count($unfinshed); $i++) {       
            $userid = $unfinshed[$i]['userid'];
            $treeuserid = $unfinshed[$i]['treeuserid'];
            $serial_number = $unfinshed[$i]['serial_number'];
            $deposit = $unfinshed[$i]['deposit'];
            $id = $unfinshed[$i]['id'];
            $money = (int)$deposit;
            $user = user::getUserByUserId($userid);

            $desc = '定金退还(编号：'.$serial_number.')';
            $input = new WxPayCompanypay();
            $input->Setpartner_trade_no($serial_number);
            $input->Setopenid($user['wechatid']);
            $input->Setcheck_name('NO_CHECK');
            $input->Setamount($money);
            $input->Setdesc($desc);
            $order = WxPayApi::companyPay($input);

            if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){
                $payment_time = $order['payment_time'];
                $payment_no = $order['payment_no'];
                $sql = 'update order_one set refund_time=?,refund_no=?,refund_mount=?,payment_time=?,deposit_switch=2,state=10,order_switch=10 where id=?';
                $result = $db->prepare_exec( $sql, array($payment_time,$payment_no,$money,$payment_time,$id) );

                $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
                $result = $db->prepare_exec( $sql, array($userid,$money) );
                        
                $weObj = new Wechat();
                $title = '定金退还(编号：'.$serial_number.')';
                $name = $user['name'];
                $money = $money/100;
                $money = $money.'元';
                $way = '微信';
                $desc = '感谢您使用找树网';
                $url = './yusuanphone.php#managerbuy';
                takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
            }else{
                $time = date('Y-m-d H:i:s',time());
                $myfile = fopen("./log.log", "a+");
                fwrite($myfile, '单品退定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
                fclose($myfile);    
            }
        }       
    }

sleep($oldtime);
file_get_contents($turl);




