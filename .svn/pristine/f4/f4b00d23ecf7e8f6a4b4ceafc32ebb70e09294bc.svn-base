<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <meta charset="UTF-8">
    <title>充值</title>
    <style type="text/css">
        .zhaoshuinfo{
            width:90%;
            background-color: #fbfbfb;
            margin: 20px 5% 20px;
            text-align: center;
        }
        .infoimg{
            width:18%;
            padding: 20px 41% 10px;
        }
        #headimg{
            width:100%;
            border-radius: 50%; 
        }
        #describe{
            width: 100%;
            font-size: 40px;
            color: #999;
            padding: 10px 0 10px;
        }
        .operation{
            width:90%;
            padding: 40px 5%;            
        }
        .title{
            width:98%;
            padding: 0 1%;
            text-align: left;
            font-size: 40px;
            color:#1AAD19;
        }
        .inputmoney{
            padding: 10px 0;
            height:270px;
        }
        .button{
            width:85%;
            padding: 20px 6% 130px;            
        }
        .submit{
            font-size: 45px;
            text-align: center;
            text-decoration: none;
            color: #FFFFFF;
            height: 115px;
            line-height: 115px;
            border-radius: 8px;
            background-color: #1AAD19;
        }
        .money{
            width:46%;
            float: left;
            font-size: 38px;
            height:100px;
            margin: 1%;
            text-align: center;
            line-height: 100px;
            border-radius: 10px;
            border:2px solid #1AAD19;
            background-color: #fff;
            color:#1AAD19;
        }
        .checked{
            background-color: #1AAD19;
            color:#fff;
        }
        #gift{
            width:98%;
            padding: 20px 1%;
            text-align: left;
            font-size: 35px;
            color:#FF3E5F;
            height:60px;
        }
    </style>    
</head>
<body>
        <div class="zhaoshuinfo">
            <div class="infoimg">
                <img id="headimg" src="">
            </div>
            <div id="describe"></div>
        </div>
        <div class="operation">
            <div class="title">充值金额</div>
            <div class="inputmoney">
                <div class="money" data-price="5" data-gift="1">5元</div>
                <div class="money" data-price="10" data-gift="2">10元</div>
                <div class="money" data-price="20" data-gift="5">20元</div>
                <div class="money" data-price="50" data-gift="20">50元</div>
                <div class="money" data-price="100" data-gift="50">100元</div>
                <div class="money" data-price="200" data-gift="150">200元</div>
            </div>
            <div id="gift"></div>
        </div>
        <div class="button">
            <div class="submit">确定</div>            
        </div>
    <script src="./js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }
        $('.money').click(function(){
            $(this).addClass('checked');
            $(this).siblings().removeClass('checked');
            var gift = $(this).data('gift');
            $('#gift').html('再送'+gift+'元');
        })

        $('#headimg').attr('src','/headimg/0/'+user.userid+'.jpg');
        $('#describe').html((user.name ? user.name : '无名'));

        $('.submit').click(function(){
            var money = $('.checked').data('price');
            var gift = $('.checked').data('gift');
            if(money) window.location = "http://cnzhaoshu.com/wxpay/example/cz_pay.php?money="+money+"&gift="+gift;
        })
    </script>
</body>
</html>