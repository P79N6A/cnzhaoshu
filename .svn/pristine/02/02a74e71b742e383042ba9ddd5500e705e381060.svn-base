<?php 

require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';


    $openid = 'oM-qJjt89n6XLD8Tm8KSi3sI6qh8';  
    $trade_no = date('YmdHis').mt_rand(1000,9999);
 
    $order = WxPayApi::companyPay($openid,$trade_no,1,'提现');
    var_dump($order);

