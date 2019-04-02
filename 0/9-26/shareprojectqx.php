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
<title>找树网--授权监管</title>
<style type="text/css">
    .title{
        width:96%;
        line-height: 25px;
        font-size: 18px;
        text-align: center;
        float: left;
        padding: 10px 2%;
    }
    body{
        margin: 0;  
        padding:0;  
        border: 0;  
        font: inherit;  
        font-size: 100%;  
        vertical-align: baseline;
        background-color: #eee;
    }
    .box1{
        width: 92%;
        margin: 0 2%;
        border-radius: 4px;
        background: #fff;
        padding: 5px 2%;
        float: left;
    }
    .head_row{
        width:100%;
        float: left;
        padding: 5px 0;
    }
    .head1{
        width:85px;
        float: left;
    }
    .head2{
        float: left;
        color:#999;
    }
    .agree{
        width: 86%;
        margin: 20px 7%;
        height: 40px;
        line-height: 40px;
        border-radius: 4px;
        background: #3CC51F;
        text-align: center;
        color:#fff;
        float: left;
    }
    a{
        text-decoration: none;
        color:#3CC51F;
    }
</style>

</head>
<body>
    <div class="title">项目信息</div>
    <div class="box1">
        <div class="head_row"><div class="head1">订单名称：</div><div id="ordername" class="head2"></div></div>
        <div class="head_row"><div class="head1">用苗地点：</div><div id="address" class="head2"></div></div>
        <div class="head_row"><div class="head1">用户名：</div><div id="username" class="head2"></div></div>
    </div>
    <div class="agree">确认此项目授权</div>


    <script src="./js/doT.min.js"></script>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var dot_treeinfo = doT.template($('#dot_treeinfo').text());
        var width = $(window).width();
        var height = $(window).height();
        $('.head2').css('width',0.92*width-85+'px');

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        var qrcodeid = urlRequest("id");
        var treeid = '';
        var userinfo;
        var ordertreeinfo;
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

        $.getJSON('/com/search_maporderinfo.php',{qrcodeid:qrcodeid},function(json){
            if(json){
                userinfo = json;
                $('#ordername').html(json.name);
                $('#username').html(json.username+' <a href="tel:'+json.phone+'">'+json.phone+'</a>');
                $('#address').html(json.address);
            }
        })


        $('.agree').click(function(){
            delcookie('user2');
            user.qxuserid = userinfo.userid;
            user.name = userinfo.username;
            user.phone = userinfo.phone;
            user.mapid = userinfo.id;
            addcookie('user2', JSON.stringify(user));
            window.location.href = './map.php';
        })

        function delcookie(name){
            document.cookie = name + "=a;expires=" + new Date(0).toUTCString()+ ";path=/;domain=cnzhaoshu.com";
        }

        function addcookie(name, value){
            var date = new Date();
            date.setTime(date.getTime() + 30*24*3600*1000);
            document.cookie = name + "=" + escape(value) + ";expires=" + date.toGMTString() + ";path=/;domain=cnzhaoshu.com";
        }

	</script>

</body>