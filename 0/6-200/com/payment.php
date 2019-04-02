<?php 

include 'db2.php';
include 'user2.php';
require '../wechat/message.audit1.php'; 
require '../wechat/wechat.class.all.php'; 

    $Wechat = new Wechat();
    $db = new db();

    $tree_order_id = $_GET['tree_order_id'];
    $bid_userid = $_GET['bid_userid'];
    $tender_userid = $_GET['tender_userid'];

    $user = user::getUserByUserId($tender_userid);

    $sql = 'select money,serial_number from orders where tender_userid=? and bid_userid=? and tree_order_id=?';
    $result = $db->prepare_query($sql,array($tender_userid,$bid_userid,$tree_order_id))[0];

    $openid = $user['wechatid'];  
    $trade_no = $result['serial_number'];
    $IP=$_SERVER["REMOTE_ADDR"];
    $money = $result['money'];

    $res = $Wechat->pay($openid,$trade_no,$money,'苗木款',$IP);  

    unset($db);
    unset($Wechat);
    if($res['payment_no']){
        echo 1;
    }
        

