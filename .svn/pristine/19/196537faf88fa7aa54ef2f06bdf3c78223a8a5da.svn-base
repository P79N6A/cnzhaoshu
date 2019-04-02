<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
include '../../com/db2.php';
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

if(!$_COOKIE['user2']) exit;
$user2 = $_COOKIE['user2'];

$user2 = json_decode($user2,true);
$openId = $user2['wechatid'];
$money = $_GET['money']*100;

$name = $_GET['name'];


//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//①、获取用户openid
$tools = new JsApiPay();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($name);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($money);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付-找树网</title>
    
	<script type="text/javascript">

		window.onload = function(){
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', editAddress); 
			        document.attachEvent('onWeixinJSBridgeReady', editAddress);
			    }
			}else{
				editAddress();
			}
		};

		//获取共享地址
		function editAddress(){
			WeixinJSBridge.invoke(
				'editAddress',
				<?php echo $editAddress; ?>,
				function(res){
					var value1 = res.proviceFirstStageName;
					var value2 = res.addressCitySecondStageName;
					var value3 = res.addressCountiesThirdStageName;
					var value4 = res.addressDetailInfo;
					var tel = res.telNumber;
				}
			);
		}
	
	</script>
</head>
<body>
	<div style="width:60%;padding: 20px 20% 10px;text-align: center;font-size: 25px;">订单详情</div>
    <div style="width:90%;padding: 5px 5%;">
	   	<span>收款方：</span>
	   	<span>北京找树网科技股份有限公司</span>
    </div>
    <div style="width:90%;padding: 5px 5%;">
	   	<span>商品名称：</span>
	   	<span id="goodsinfo"></span>
    </div>
    <div style="width:90%;padding: 5px 5%;">
	    <span>付款金额：</span>
	    <span id="money"></span>
	    <span>元</span>
    </div>
	<div align="center" style="width:80%;padding: 50px 10% 10px;">
		<button style="width:100%; height:45px; border-radius: 6px;background-color:#1AAD19; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:17px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
	<script src="../../js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">
    	var user = getcookie('user2');
    	user = JSON.parse(user);
    	function getcookie(name){//获取指定名称的cookie的值
    	    var arrStr = document.cookie.split("; ");
    	    for(var i = 0;i < arrStr.length;i ++){
    	        var temp = arrStr[i].split("=");
    	        if(temp[0] == name) return unescape(temp[1]);
    	    } 
    	}
    	
		function urlRequest(name) {
	        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
	        return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
	    }

	    var order_oneid = urlRequest("order_oneid");
	    var userid = urlRequest("userid");
	    var treeuserid = urlRequest("treeuserid");
	    var name = urlRequest("name");
	    var money = urlRequest("money");
	    var way = urlRequest("way");
	    $("#money").html(money);
	    $('#goodsinfo').html(name);

		//调用微信JS api 支付
		function jsApiCall(){
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					//网页内支付接口err_msg返回结果值说明(ok,cancel,fail)
					if(res.err_msg == 'get_brand_wcpay_request:ok'){
						// alert('支付成功');
						deal();
					}else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
						// alert('取消支付');
					}else{
						alert('支付失败');
					}

				}
			);
		}

		function deal(){
			$.getJSON('/com/onetree_paydeposit.php',{order_oneid:order_oneid,money:money,userid:userid,treeuserid,treeuserid,name:name,way:way},function(json) {
					if(json){ 
						window.location = "./yusuanphone.php#managerbuy";
					}
			});
		}

		function callpay(){	
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</body>
</html>