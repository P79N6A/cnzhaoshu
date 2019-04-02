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
$turl="http://cnzhaoshu.com/wxpay/example/order_one_applydeposit.php";

$run = include '../../com/order_applydeposit_timer.php';

if(!$run) die;

    $db = new db();
    $time = date('Y-m-d H:i:s',strtotime('-1 day'));
    
    $sql = 'select id,serial_number,treeuserid,userid,deposit from order_one where deposit_switch=1 and order_switch=5 and order_switch_time < \''.$time.'\'';

    $unfinshed = $db->query($sql);
    if(count($unfinshed)){
        for($i=0; $i < count($unfinshed); $i++) {       
            $userid = $unfinshed[$i]['userid'];
            $treeuserid = $unfinshed[$i]['treeuserid'];
            $serial_number = $unfinshed[$i]['serial_number'];
            $deposit = $unfinshed[$i]['deposit'];
            $id = $unfinshed[$i]['id'];
            $money = (int)$deposit;
            $user = user::getUserByUserId($treeuserid);

            $desc = '收到定金(编号：'.$serial_number.')';
            $input = new WxPayCompanypay();
            $input->Setpartner_trade_no($serial_number);
            $input->Setopenid($user['wechatid']);
            $input->Setcheck_name('NO_CHECK');
            $input->Setamount($money);
            $input->Setdesc($desc);
            $order = WxPayApi::companyPay($input);

            $time = date('Y-m-d H:i:s',time());
            if($order['return_code'] == "SUCCESS" && $order['result_code'] == "SUCCESS"){

                $sql = 'update order_one set deposit_refund_time=?,deposit_switch=2,order_switch_time=null,order_switch=1 where id=?';
                $result = $db->prepare_exec( $sql, array($time,$id) );

                $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
                $result = $db->prepare_exec( $sql, array($treeuserid,$money) );
                        
                $weObj = new Wechat();
                $title = '收到定金(编号：'.$serial_number.')';
                $name = $user['name'];
                $money = $money/100;
                $money = $money.'元';
                $way = '微信';
                $desc = '感谢您使用找树网';
                $url = './yusuanphone.php#managersell';
                takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
            }else{
                
                $myfile = fopen("./log.log", "a+");
                fwrite($myfile, '单品定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
                fclose($myfile);    
            }
        }       
    }

sleep($oldtime);
file_get_contents($turl);




