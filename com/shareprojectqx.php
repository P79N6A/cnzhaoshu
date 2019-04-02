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
<title>找树网--建立交易监管</title>
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
    .box2{
        width: 92%;
        margin: 0 2% 5px;
        border-radius: 4px;
        padding: 5px 2%;
        float: left;
        font-size: 17px;
        background: #fff;
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
    .title{
        width:96%;
        line-height: 25px;
        font-size: 18px;
        text-align: center;
        float: left;
        padding: 10px 2%;
    }
    .backhome{
        width:96%;
        line-height: 25px;
        font-size: 18px;
        text-align: left;
        float: left;
        padding: 10px 2% 0;
        color:#3CC51F;
    }
    .head_row{
        width:100%;
        float: left;
        padding: 5px 0;
    }
    #choosetreeinfo{
        float: left;
        color:#999;
    }
    .head1{
        width:85px;
        float: left;
    }
    .head2{
        float: left;
        color:#999;
    }
    #name,#number,#price,#unit{
        float: left;
        color:#444;
        border: 0;
        height: 20px;
        font-size: 17px;
        border-radius: 4px;
    }
    a{
        text-decoration: none;
        color:#3CC51F;
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
    .createnewtree{
        width:96%;
        margin:20px 2%;
        padding:7px 0;
        float: left;
        border-radius: 4px;
        background: #3CC51F;
        text-align: center;
        color:#fff;
    }
    .head4{
        float: left;
        color:#3CC51F;
        width:150px;
    }
    .open{
        display: block;
    }
    .close,.close1{
        display: none;
    }
    .toplist{
        width:100%;
        background-color: rgba(0,0,0,.3);
        z-index: 10;
        position: fixed;
        display: none;
    }
    .treeinfo{
        width:88%;
        margin:6px 3% 0;
        padding:3px 3%;
        float: left;
        border-radius: 4px;
        background-color: #fff;
    }
    #treeinfolist{
        background-color: #eee;
        border-radius: 5px;
        overflow-y: scroll;
        position: absolute;
        width:88%;
        margin-left:6%;
        bottom: 10px;
        max-height: 70%;
        -webkit-overflow-scrolling: touch;
    }
    .backhome{

    }
</style>

</head>
<body>
    <div class="backhome"><a href="./map.php">监管首页</a></div>
    <div class="title">监管方信息</div>
    <div class="box1">
        <div class="head_row"><div class="head1">订单名称：</div><div id="ordername" class="head2"></div></div>
        <div class="head_row"><div class="head1">用苗地点：</div><div id="address" class="head2"></div></div>
        <div class="head_row"><div class="head1">用户名：</div><div id="username" class="head2"></div></div>
    </div>
    <div class="title">苗木信息</div>
    <div class="box2">
        <div class="head_row open"><div class="head1">苗木：</div><div class="head4">选择交易的苗木</div></div>
    </div>
    <div class="box3">
        <div class="head_row close1"><div class="head1">苗木信息：</div><div id="choosetreeinfo" class="head3"></div></div>
        <div class="head_row close"><div class="head1">苗木名称：</div><input id="name" class="head3" placeholder="请输入苗木名称" type="text" name=""></div>
        <div class="head_row open"><div class="head1">数量：</div><input id="number" class="head3" placeholder="请输入数量" type="number" name=""></div>
        <div class="head_row close"><div class="head1">单位：</div><input id="unit" class="head3" type="text" name="" value="株"></div>
        <div class="head_row close"><div class="head1">规格：</div><textarea id="attribute" placeholder="请输入规格" type="text" maxlength="250"></textarea></div>
    </div>
    <div class="agree">添加监管苗木信息</div>

    <div class="toplist">
        <div id="treeinfolist">
        </div>
    </div>
    <script id="dot_treeinfo" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="treeinfo" treeid="{{=it[i].id}}">{{=it[i].name}} <br>{{=it[i].attribute}}</div>
        {{ } }}
        <div class="createnewtree">新建交易苗木</div>
    </script>
    <script src="./js/doT.min.js"></script>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var dot_treeinfo = doT.template($('#dot_treeinfo').text());
        var width = $(window).width();
        var height = $(window).height();
        $('.head2').css('width',0.92*width-85+'px');
        $('.head3').css('width',0.92*width-90+'px');
        $('.toplist').css('height',height+'px');
        $('#attribute').css('width',0.92*width-110+'px');

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
            if(!$('#number').val()) return alert('数量必须填写！');
            var unit = $('#unit').val();
            var data = {};
            if(treeid){
                data.number = $('#number').val();
            }else{
                if(!$('#name').val()) return alert('苗木名称必须填写！');
                data.name = $('#name').val();
                data.number = $('#number').val();               
                data.attribute = $('#attribute').val();
            }
            $.post('/com/map_order_create.php',{data:JSON.stringify(data),treeid:treeid,treeuserid:user.userid,userid:userinfo.userid,mapid:userinfo.id,unit:unit},function(json){
                if(json){
                    window.location = '/map.php';
                }
            })
        })

        $('.head4').click(function(){
            $.getJSON('/com/search_ordertreeinfo.php',{orderid:userinfo.id},function(json){
                if(json){
                    $('#treeinfolist').html(dot_treeinfo(json));
                    $('.toplist').fadeIn();
                    ordertreeinfo = json;
                }else{
                    alert('此项目无苗木数据,请新建！');
                    $('.close').show();
                }
            })
        })

        $('.toplist').on('click','.treeinfo',function(){
            treeid = $(this).attr('treeid');
            $('.toplist').fadeOut();
            for (var i = 0; i < ordertreeinfo.length; i++) {
                if(ordertreeinfo[i].id == treeid){
                    $('#choosetreeinfo').html(ordertreeinfo[i].name+'<br>'+ordertreeinfo[i].attribute);
                }
            }
            $('.close1').show();
            $('.close').hide();
        })

        $('.toplist').on('click','.createnewtree',function(){
            $('.toplist').fadeOut();
            $('.close1').hide();
            $('.close').show();
            treeid = '';
        })
	</script>

</body>