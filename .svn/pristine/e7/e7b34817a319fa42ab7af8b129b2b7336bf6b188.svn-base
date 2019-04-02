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
$turl="http://cnzhaoshu.com/wxpay/example/orders_returndeposit.php";

$run = include '../../com/order_returndeposit_timer.php';

if(!$run) die;

    $db = new db();
    $time = date('Y-m-d H:i:s',strtotime('-1 day'));
    
    $sql = 'select id,serial_number,bid_userid,tender_userid,tree_order_id,deposit from orders where deposit_switch=1 and order_switch=3 and order_switch_time < \''.$time.'\'';

    $unfinshed = $db->query($sql);
    if(count($unfinshed)){
        for($i=0; $i < count($unfinshed); $i++) {       
            $userid = $unfinshed[$i]['tender_userid'];
            $treeuserid = $unfinshed[$i]['bid_userid'];
            $serial_number = $unfinshed[$i]['serial_number'];
            $tree_order_id = $unfinshed[$i]['tree_order_id'];
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

                $sql = 'update orders set refund_time=?,refund_no=?,refund_mount=?,payment_time=?,deposit_switch=2,state=10,order_switch=10 where id=?';
                $result = $db->prepare_exec( $sql, array($payment_time,$payment_no,$money,$payment_time,$id) );

                $sql = 'update bid_order set state=18 where userid=? and id=?';
                $result = $db->prepare_exec( $sql, array($treeuserid,$tree_order_id) );

                $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
                $result = $db->prepare_exec( $sql, array($userid,$money) );
                        
                $weObj = new Wechat();
                $title = '定金退还(编号：'.$serial_number.')';
                $name = $user['name'];
                $money = $money/100;
                $money = $money.'元';
                $way = '微信';
                $desc = '感谢您使用找树网';
                $url = './yusuanphone.php';
                takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
            }else{
                $time = date('Y-m-d H:i:s',time());
                $myfile = fopen("./log.log", "a+");
                fwrite($myfile, '招标退定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
                fclose($myfile);    
            }
        }       
    }

sleep($oldtime);
file_get_contents($turl);




