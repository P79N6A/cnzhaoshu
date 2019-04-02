<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <meta charset="UTF-8">
    <title id="titlename">付款</title>
    <style type="text/css">
        body{
            background-color: #eee;
        }
        .contain{
            width:92%;
            margin: 4%;
            background-color: #fff;
            border-radius: 8px;
        }
        .zhaoshuinfo{
            width:100%;
            background-color: #fbfbfb;
            padding: 40px 0;
            text-align: center;
        }
        .infoimg{
            width:18%;
            padding: 0 41%;
        }
        .infoimg img{
            width:100%;
            border-radius: 20px; 
        }
        .describe{
            width: 100%;
            font-size: 40px;
            color: #999;
            padding: 20px 0 10px;
        }
        .operation{
            width:80%;
            padding: 40px 10%;            
        }
        .title{
            width:100%;
            text-align: left;
            font-size: 40px;
        }
        .inputmoney{
            padding: 10px 0;
            position: relative;
            height:150px;
            border-bottom: 3px solid #ccc;
        }
        .inputhead{
            position: absolute;
            left: 0px;
            width: 10%;
            font-size: 80px;
            line-height: 150px;
        }
        .inputbody{
            position: absolute;
            width: 80%;
            left:10%;
        }
        #money{
            width: 100%;
            border: 0;
            line-height: 120px;
            font-size: 120px;
            outline: 0;
            color:#000;
        }
        .button{
            width:80%;
            padding: 20px 10% 130px;            
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
    </style>    
</head>
<body>
    <div class="contain">
        <div class="zhaoshuinfo">
            <div class="infoimg">
                <img src="./img/logo0.jpg">
            </div>
            <div class="describe">向"北京找树网科技股份有限公司"转账</div>
        </div>
        <div class="operation">
            <div class="title">转账金额</div>
            <div class="inputmoney">
                <span class="inputhead">¥</span>
                <div class="inputbody">
                    <input id="money" type="number" pattern="[0-9]*">
                </div>
            </div>
        </div>
        <div class="button">
            <div class="submit">确定</div>            
        </div>
    </div>
    <script src="./js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">
        $('#money').focus();
        var user = getcookie('user2');
        user = JSON.parse(user);
        function getcookie(name){
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

        var tree_order_id = urlRequest("tree_order_id");
        var tender_userid = urlRequest("tender_userid");
        var bid_userid = urlRequest("bid_userid");

        $('.submit').click(function(){
            var money = $('#money').val();
            if(money) window.location = "./wxpay/example/topay.php?tree_order_id="+tree_order_id+"&tender_userid="+user.userid+"&bid_userid="+bid_userid+"&money="+money;
        })
    </script>
</body>
</html>