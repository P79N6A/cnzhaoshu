<?php 
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

    $openid = 'oM-qJjt89n6XLD8Tm8KSi3sI6qh8';  
    $trade_no = date('YmdHis').mt_rand(1000,9999);
    $money = 110;
    $desc = '提现';

	$input = new WxPayCompanypay();
	$input->Setpartner_trade_no($trade_no);
	$input->Setopenid($openid);
	$input->Setcheck_name('NO_CHECK');
	$input->Setamount($money);
	$input->Setdesc($desc);
    $order = WxPayApi::companyPay($input);
    var_dump($order);

