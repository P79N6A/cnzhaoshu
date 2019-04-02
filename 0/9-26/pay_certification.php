<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>找树网--认证</title>
<style type="text/css">
    body{
        margin: 0;  
        padding:0;  
        border: 0;  
        font: inherit;  
        font-size: 100%;  
        vertical-align: baseline;
        background-color: #eee;
    }
    .agree{
        width: 80%;
        margin: 6px 10%;
        height: 35px;
        line-height: 35px;
        border-radius: 4px;
        background: #3CC51F;
        text-align: center;
        color:#fff;
        float: left;
    }
    .box1{
        width: 94%;
        float: left;
        padding: 5px 1%;
        margin:10px 2%;
        background: #fff;
        text-align: center;
        border-radius: 3px;
    }
    .box2{
        width: 94%;
        float: left;
        padding: 8px 1%;
        margin:7px 2%;
        background: #fff;
        text-align: center;
        border-radius: 3px;
    }
    .title{
        width:96%;
        font-size: 25px;
        text-align: center;
        float: left;
        padding: 15px 2% 5px;
    }
    .row{
        width:100%;
        padding: 8px 0 3px;
        font-size: 18px;
    }
    .descipte{
        width:94%;
        padding: 5px 3%;
        font-size: 13px;
        color:#999;
        text-align: left;
    }
    .zhu{
        width:94%;
        padding: 10px 3%;
        font-size: 15px;
        color:#999;
    }
    a{
        text-decoration: none;
        color:#3CC51F;
    }
</style>
</head>
<body>
    <div class="title">认证服务</div>
    <div class="box1">
        <div class="row">旗舰店</div>
        <div class="descipte">1、拥有三大功能：官方网站+微信公众号图文信息+动态数据，所有模块均可自由编辑<br>2、搜索时旗舰店数据置顶，排名最靠前<br>3、旗舰店的苗木数据既可以作为企业管理使用，也可以在找树网主页面中展示，进行销售<br>4、费用 1900元/年</div>
        <div class="agree qj">开通旗舰店</div>
    </div>
    <div class="box2">
        <div class="row">认证店</div>
        <div class="descipte">1、找树网平台对您的苗店做出的信誉保证<br>2、搜索时已认证数据自动置顶，排名仅次于旗舰店<br>3、费用 1500元/年</div>
        <div class="agree rz">开通认证店</div>
    </div>
    <div class="zhu">
        注：找树网于7个工作日内完成审核，给予您答复；认证服务解释权归找树网所有，如有疑问请拨打<a href="tel:13810525928">☎：13810525928</a>
    </div>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;

        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }

    
        // $.getJSON('/com/search_userinfo.php',{userid:user.userid},function(json){
        //     if(json){

        //     }
        // })


        $('.qj').click(function(){
           window.location.href = './wxpay/example/certification_pay.php?money=1900&way=1';
        })

        $('.rz').click(function(){
           window.location.href = './wxpay/example/certification_pay.php?money=1500&way=2';
        })

	</script>

</body>