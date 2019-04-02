<?php  

ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require '../../com/db2.php';
include '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

$id = $_GET['id'];
$db = new db();
$Messageattrbute = new Messageattrbute();
$sql = 'select a.treeuserid,a.userid buyuserid,a.serial_number,a.deposit,b.* from (select * from order_one where id=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
$unfinshed = $db->prepare_query($sql,array($id))[0];

    if($unfinshed){
            $userid = $unfinshed['buyuserid'];
            $treeuserid = $unfinshed['treeuserid'];
            $serial_number = $unfinshed['serial_number'];
            $deposit = $unfinshed['deposit'];
            $money = (int)$deposit;
            $user = user::getUserByUserId($treeuserid);

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
                $sql = 'update order_one set deposit_refund_time=?,deposit_switch=2,order_switch=1,order_switch_time=null where id=?';
                $result = $db->prepare_exec( $sql, array($payment_time,$id) );

                $sql = 'insert into recharge_bill(userid,money,way) values(?,?,4)';
                $result = $db->prepare_exec( $sql, array($treeuserid,$deposit) );

                $dianmi = ceil($money/100);
                $sql = 'update user set dianmi=dianmi+?,accumulate=accumulate+?,quarter=quarter+?,month=month+? where userid=? and userid=?';
                $result = $db->prepare_exec( $sql, array($dianmi,$dianmi,$dianmi,$dianmi,$treeuserid,$userid));

                $uname = mb_substr($user['name'],0,3);
                $sql = 'insert into order_dynamic(content) values(?)';
                $content = $uname.'**  收定金  '.$dianmi.'元';
                $result = $db->prepare_insert($sql,array($content));
                        
                $weObj = new Wechat();

                $title1 = $Messageattrbute->Order_oneattribute($unfinshed);
                $title = '定金到账('.$title1.')';
                $name = $user['name'].' '.$user['phone'];
                $money = $money/100;
                $money = $money.'元';
                $way = '微信';
                $desc = '感谢您使用找树网';
                $url = './yusuanphone.php?msway=2&msid='.$serial_number.'#managersell';
                takemoney($user['wechatid'], $title, $name, $money, $way, $desc, $url, $weObj);
                echo $payment_time;
            }else{
                $time = date('Y-m-d H:i:s',time());
                $myfile = fopen("./log.log", "a+");
                fwrite($myfile, '单品定金 时间：'.$time.',交易号：'.$serial_number.',交易金额：'.$money.'元,状态：失败'."\r\n");
                fclose($myfile); 
                echo '-1';   
            }
     
    }

