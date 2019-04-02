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
<title>找树网--上传授权</title>
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
    .title{
        width:96%;
        line-height: 25px;
        font-size: 18px;
        text-align: center;
        float: left;
        padding: 10px 2%;
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
    .box2{
        width: 92%;
        margin: 0 2% 5px;
        border-radius: 4px;
        padding: 5px 2%;
        float: left;
        font-size: 17px;
        background: #fff;
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
    <style type="text/css">

    </style>

</head>
<body>

    <div class="title">监管方信息</div>
    <div class="box1">
        <div class="head_row"><div class="head1">订单名称：</div><div id="ordername" class="head2"></div></div>
        <div class="head_row"><div class="head1">用苗地点：</div><div id="address" class="head2"></div></div>
        <div class="head_row"><div class="head1">用户名：</div><div id="username" class="head2"></div></div>
    </div>
    <div class="title">授权苗木信息</div>
    <div class="box2">
        <div class="head_row"><div class="head1">苗木名称：</div><div id="treename" class="head2"></div></div>
        <div class="head_row"><div class="head1">苗木信息：</div><div id="treeinfo" class="head2"></div></div>
        <div class="head_row"><div class="head1">用户名：</div><div id="treeusername" class="head2"></div></div>
    </div>
    <div class="agree">接受上传权限</div>

    <script src="./js/doT.min.js"></script>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var width = $(window).width();
        var height = $(window).height();
        var id;
        $('.head2').css('width',0.92*width-85+'px');

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        var qxqrcodeid = urlRequest("id");

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

        $.getJSON('/com/search_map_orderqrcodeinfo.php',{qrcodeid:qxqrcodeid},function(json){
            if(json){
                id = json.id;
                $('#ordername').html(json.projectname);
                $('#username').html(json.username+' <a href="tel:'+json.userphone+'">'+json.userphone+'</a>');
                $('#address').html(json.address);
                $('#treename').html(json.treename);
                $('#treeinfo').html(json.number+json.unit+json.attribute);
                $('#treeusername').html(json.treeusername+json.treeuserphone);
            }
        })

        $('.agree').click(function(){
            $.post('/com/map_order_joinuser.php',{id:id,userid:user.userid},function(json){
                if(json == '-1'){
                    $('.agree').remove();
                    alert('您已经被授权！');
                }else{
                    if(json){
                        $('.agree').remove();
                        alert('授权成功！');
                    }else{
                        alert('授权失败！');
                    }
                }
            })
        })

	</script>

</body>