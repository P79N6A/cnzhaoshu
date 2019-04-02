<?php 

require '../wechat/wechat.class.all.php';  

    $Wechat = new Wechat();

    $openid = 'oM-qJjt89n6XLD8Tm8KSi3sI6qh8';  
    $trade_no = date('YmdHis').mt_rand(1000,9999);
    $IP=$_SERVER["REMOTE_ADDR"];
 
    $res = $Wechat->pay($openid,$trade_no,1,'提现',$IP);  

    var_dump($res);