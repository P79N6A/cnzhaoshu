<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <meta charset="UTF-8">
    <title>钱包</title>
    <style type="text/css">
        .operation{
            width: 60%;
            height: 230px;
            margin: 40% 20% 0 20%;  
            text-align: center;     
        }
        #money{
            font-size: 80px;
            line-height: 150px;
        }
        .desc{
            font-size: 50px;
            line-height: 80px;
        }
        .button{
            width:100%;
            position: fixed;
            z-index: 10;
            bottom: 90px;
            left: 0px;
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
            margin: 0 5%;
            width:90%;
        }
        .detail{
            width: 17%;
            height: 60px;
            margin: 20px 3% 0 80%;
            color: #1AAD19;
            font-size: 50px;
            text-align: right;
        }
        #bigbackground{
            width:100%;
            position: fixed;
            z-index: 100;
            bottom: 0px;
            left: 0px;
            display: none;
            background-color: #fff;
            overflow-y: auto;
            -webkit-overflow-scrolling:touch;
        }
        .onedata{
            width:95%;
            height: 150px;
            float: left;
            padding-left: 5%;
            border-bottom: 1px solid #eee;
        }
        .time{
            line-height: 50px;
            font-size: 40px;
            width:100%;
            height: 50px;
            float: left;
        }
        .money{
            line-height: 90px;
            font-size: 45px;
            width:100%;
            height: 90px;
            float: left;
        }
        .row1{
            width:70%;
            float: left;
            text-align: left;
        }
        .row2{
            color: red;
            width:25%;
            float: left;
            text-align: right;
        }
    </style>    
</head>
<body>  
        <div class="detail">明细</div>
        <div class="operation">
            <div id="money"></div>
            <div class="desc">余额(元)</div>
        </div>
        <div class="button">
            <div class="submit">充值</div>            
        </div>
        <div id="bigbackground">          
        </div>
        <script id="dot_info" type="text/x-dot-template">
            {{ for(var i in it) { }}
                <div class="onedata">
                    <div class="money">
                        <div class="row1">付款成功</div>
                        <div class="row2">{{=it[i].money/100}}元</div>
                    </div>
                    <div class="time">{{=it[i].time}}</div>
                </div>
            {{ } }}
        </script>
    <script src="./js/jquery-3.1.0.min.js"></script>
    <script src="./js/doT.min.js"></script>
    <script type="text/javascript">
        var loading = false;
        var loadend = false;
        var dot_info = doT.template($("#dot_info").text());
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }

        var windowheight = $(window).height();
        $('#bigbackground').css('height',windowheight+'px');

        $.getJSON('/com/search_myrecharge.php', {userid:user.userid}, function(json) {
            $('#money').html(json/100);
        });

        $('.submit').click(function(){
            window.location = "./recharge.php";
        })

        $('.detail').click(function(){
            $('#bigbackground').show();
            var lengths = $('#bigbackground .onedata').length;
            if(!lengths) loadrecharge();
        })
        
        $('#bigbackground').click(function(){
            $('#bigbackground').hide();
        })

        function loadrecharge(){
            if(loading) return false;
            loading = true;
            var limit = $('#bigbackground .onedata').length + ',' + 20;
            $.getJSON('/com/search_rechargehistory.php',{userid:user.userid,limit:limit},function(json){
                if(json){
                    $('#bigbackground').append(dot_info(json));
                }else{
                    loadend = true;
                }
                loading = false;
            })
        }


        $('#bigbackground').scroll(function () {
            if (loading || loadend) return;
            var scrollHeight = $(this)[0].scrollHeight;
            var scrollTop = $(this)[0].scrollTop;
            var elementHight = $(this).height();
            if(scrollTop + elementHight >= scrollHeight-150) {
                loadrecharge();
            } 
        });
    </script>
</body>
</html>