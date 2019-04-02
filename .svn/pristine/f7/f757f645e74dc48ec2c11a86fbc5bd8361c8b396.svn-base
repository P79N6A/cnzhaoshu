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
<title>找树网--认证审核</title>
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
    .agree,.disagree{
        width: 40%;
        margin: 6px 5%;
        height: 35px;
        line-height: 35px;
        border-radius: 4px;
        background: #3CC51F;
        text-align: center;
        color:#fff;
        float: left;
    }
    .box{
        width: 92%;
        float: left;
        padding: 5px 2%;
        margin:10px 2%;
        background: #fff;
        border-radius: 3px;
    }
    .title{
        width:96%;
        font-size: 25px;
        text-align: center;
        float: left;
        padding: 10px 2% 5px;
    }
    a{
        text-decoration: none;
        color:#3CC51F;
    }
    .bigbox{
        width:100%;
    }
</style>
</head>
<body>
    <div class="title">认证服务</div>
    <div id="bigbox"></div>
    <script id="dot_userinfo" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="box" userid="{{=it[i].userid}}" isrenzheng="{{=it[i].isrenzheng}}">
                <div>公司名称：{{=it[i].name}}</div>
                <div>申请业务：{{=(it[i].isrenzheng == 3) ? '认证店' : '旗舰店'}}</div>
                <div>申请时间：{{=it[i].rz_time}}</div>
                <div>联系电话：<a href="tel:{{=it[i].phone}}">{{=it[i].phone}}</a></div>
                <div><div class="disagree">退款</div><div class="agree">通过</div></div>
            </div>
        {{ } }}
    </script>
    <script src="./js/doT.min.js"></script>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var dot_userinfo = doT.template($('#dot_userinfo').text());
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;

        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }
        $.getJSON('/com/search_certificationinfo.php',{userid:user.userid},function(json){
            if(json){
                $('#bigbox').html(dot_userinfo(json));
            }
        })

        $('#bigbox').on('click','.agree',function(){
            var that = $(this);
            var edit = confirm('您确定通过？');
            if(!edit) return;
            var userid = that.parents('.box').attr('userid');
            var isrenzheng = that.parents('.box').attr('isrenzheng');
            $.getJSON('/com/user_changeisrenzheng.php',{userid:userid,isrenzheng:isrenzheng},function(json){
                if(json){
                    that.parents('.box').remove();
                }else{
                    alert('认证失败！');
                }
            })
        })

        $('#bigbox').on('click','.disagree',function(){
            var edit = confirm('您确定退款？');
            if(!edit) return;
            var userid = $(this).parents('.box').attr('userid');
            var isrenzheng = $(this).parents('.box').attr('isrenzheng');
            $.getJSON('/wxpay/example/disagreerz.php',{userid:userid,isrenzheng:isrenzheng},function(json){
                if(json){
                    that.parents('.box').remove();
                }else{
                    alert('退款失败！请查询余额');
                }
            })
        })

	</script>

</body>