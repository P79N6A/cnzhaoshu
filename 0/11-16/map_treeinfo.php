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
<title>找树网--苗木监管</title>
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
    .box1{
        width: 92%;
        margin: 0 2%;
        border-radius: 4px;
        background: #fff;
        padding: 5px 2%;
        float: left;
    }
    .title{
        width:96%;
        line-height: 25px;
        font-size: 18px;
        text-align: center;
        float: left;
        padding: 10px 2%;
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
    .box3{
        width: 92%;
        margin: 0 2%;
        border-radius: 4px;
        padding: 5px 2%;
        float: left;
        font-size: 17px;
        background: #fff;
    }
    #attribute{
        float: left;
        font-size: 17px;
        line-height: 1.3;
        height: 100px;
        border: 1px solid #888;
        padding: 5px;
        resize: none;
        border-radius: 4px;
    }
    a{
        text-decoration: none;
        color:#3CC51F;
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
    #name{
        float: left;
        color:#444;
        border: 0;
        height: 20px;
        font-size: 17px;
        border-radius: 4px;
    }
</style>

</head>
<body>
    <div class="title">监管方信息</div>
    <div class="box1">
        <div class="head_row"><div class="head1">用户名：</div><div id="username" class="head2"></div></div>
    </div>
    <div class="title">苗木信息</div>
    <div class="box3">
        <div class="head_row open"><div class="head1">苗木名称：</div><input id="name" class="head3" placeholder="请输入苗木名称" type="text" name=""></div>
        <div class="head_row open"><div class="head1">规格：</div><textarea id="attribute" placeholder="请输入规格" type="text" maxlength="250"></textarea></div>
    </div>
    <div class="agree">提交</div>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var width = $(window).width();
        var height = $(window).height();

        $('.head2').css('width',0.92*width-100+'px');
        $('.head3').css('width',0.92*width-100+'px');
        $('#attribute').css('width',0.92*width-110+'px');

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        var id = urlRequest("id");

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

        $.getJSON('/com/search_map_supervision_info.php',{id:id},function(json){
            if(json){
                $('#username').html(json.name+' <a href="tel:'+json.phone+'">'+json.phone+'</a>');
            }
        })

        $('.agree').click(function(){
            if(!$('#name').val()) return alert('苗木名称必须填写！');
            var name = $('#name').val();
            var attribute = $('#attribute').val();

            $.post('/com/insert_map_supervision_info.php',{name:name,attribute:attribute,id:id},function(json){
                if(json){
                    window.location = '/imagegps.php?id='+id;
                }
            })
        })
	</script>

</body>