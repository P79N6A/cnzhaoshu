<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>购买信息</title>
    <style type="text/css">
        body{
            margin: 0;  
            padding:0;  
            border: 0;  
            font: inherit;  
            font-size: 100%;  
            vertical-align: baseline;  
        }
        .zhaoshuinfo{
            width:98%;
            margin: 2% 1%;
        }
        .treeimg{
            width:60%;
            padding: 20px 20% 5px;
        }
        img{
            width:100%;
            text-align: center;
            vertical-align: middle;
            overflow: hidden;
        }
        .infomation{
            width:86%;
            float: left;
            padding: 5px 7%;
            margin-bottom: 50px;
        }
        .title{
            width:30%;
            float: left;
            font-size: 17px;
            line-height: 1.5;
            color:red
        }
        #name,#price,#attribute,#address,#phone{
            width:70%;
            float: left;
            font-size: 17px;
            line-height: 1.5;
        }
        .number{
            width:30%;
            float: left;
            font-size: 17px;
            line-height: 1.7;
            color:red
        }
        #number,#phone,#address{
            width:70%;
            float: left;
            border: 0;
            outline: 0;
            -webkit-appearance: none;
            background-color: transparent;
            font-size: 17px;
            line-height: 1.7;
        }
        #mark{
            margin-top: 5px;
            width:96%;
            padding: 5px 3%;
            float: left;
            font-size: 16px;
            line-height: 1.3;
            height:100px;
            border: 1px solid #888;
            resize: none;
        }
        .paydeposit,.payfull{
            width:44%;
            margin:5px 3%;
            padding: 5px 0;
            float: left;
            font-size: 16px;
            background: #1AAD19;
            border-radius: 3px;
            text-align: center;
            color: #fff;
        }
        .contract{
            width:100%;
            float: left;
            margin-top: 10px;
        }
        #agreen{
            width:10%;
            float: left;
            line-height: 25px;
        }
        .neirong{
            width:80%;
            float: left;
            line-height: 23px;
        }
        a{
            text-decoration:none
        }
        .alert{
            position: fixed;
            z-index: 20;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background:rgba(0, 0, 0, 0.6);
            display: none;
        }
        #alert{
            position: fixed;
            z-index: 30;
            width: 60%;
            height:20%;
            left:15%;
            top:35%;
            background-color: #fff;
            padding: 5%;
            text-align: left;
            border-radius: 4px;
            color:#000;
            font-size: 17px;
        }
    </style>    
</head>
<body>
    <div class="zhaoshuinfo">
        <div class="treeimg"><img id="img" src=""></div>
        <div class="infomation">
            <div class="title">名称：</div><div id="name"></div>
            <div class="title">单价：</div><div id="price"></div>
            <div class="title">规格：</div><div id="attribute"></div>
            <!-- <div class="title">苗源：</div><div id="address"></div> -->
            <div class="number">数量：</div><input type="number" id="number" onkeyup="checknumber()" placeholder="请输入数量">
            <div class="number">手机号：</div><input type="number" id="phone" onkeyup="checkphone()" placeholder="请输入手机号">
            <div class="number">用苗地：</div><input type="text" id="address" maxlength="250" placeholder="请输入用苗地">
            <textarea id="mark" placeholder="可填写备注" type="text" maxlength="250"></textarea>
            <div class="contract">
                <input type="checkbox" id="agreen"><div class="neirong">本人同意<a href="">《找树网交易》</a><a href="">《找树网交易》</a></div>
            </div>
            <div class="paydeposit">付定金</div>
            <div class="payfull">付全款</div>
        </div>
        <div class="alert"><div id="alert"></div></div>
    </div>
    <script src="../js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        var allinfo;

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
        
        function loadtree(){
            $.getJSON('/com/search_thistreeinfo.php',{treeid:treeid},function(json){
                $('#img').attr('src','./img/1.jpg');
                $('#name').html(json.name);
                $('#price').html(json.price+'元');
                $('#attribute').html(attribute(json));
                $('#address').html(json.address);
                allinfo = json;
            })            
        }

        function attribute(info){
            var attr = '';
            for( var key in info){
                if(key == 'dbh'){
                    if(info['dbh_type'] == '5') attr += '胸径 '+info[key] +'公分';
                    if(info['dbh_type'] == '6') attr += '地径 '+info[key] +'公分';
                    if(info['dbh_type'] == '7') attr += '盆径 '+info[key] +'公分';
                }
                if(key == 'height'){
                    if(info['height_type'] == '10') attr += '株高 '+info[key] +'米';
                    if(info['height_type'] == '11') attr += '条长 '+info[key] +'米';
                    if(info['height_type'] == '12') attr += '主枝长 '+info[key] +'米';
                }
                if((key == 'age') && info[key]) attr += '苗龄 '+info[key] +'年';
                if((key == 'branch_bough_number') && info[key]) attr += '分枝数 '+info[key] +'个';
                if((key == 'branch_point_height') && info[key]) attr += '分枝点高 '+info[key] +'米';
                if((key == 'crownwidth') && info[key]) attr += '冠幅 '+info[key] +'米';
                if((key == 'substrate') && info[key]) attr += '基质 '+info[key];
            }
            return attr;
        }

        function checkphone(){
            var phone = $('#phone').val();
            if(phone.length > 10){
                $('#phone').val(phone.substr(0,11));
            }
        }

        function checknumber(){
            var number = $('#number').val();
            if(number.length > 10){
                $('#number').val(number.substr(0,10));
            }
        }

        $('.paydeposit').click(function(){
            if($('#phone').val().length > 11){
                $('.alert').fadeIn();
                $('#alert').html('联系号码不正确！');
                return;
            }
            if($('#number').val() && $('#address').val()){
                var agreen = $('#agreen').is(':checked');
                if(agreen){
                    var topay = confirm('确定要付定金吗？');
                    if(topay){
                        var data = {
                            number:$('#number').val(),
                            mark:$('#mark').val(),
                            phone:$('#phone').val(),
                            address:$('#address').val(),
                            userid:user.userid,
                            treeuserid:allinfo.userid,
                            treeid:treeid
                        }
                        $.getJSON('/com/index_createorder.php',{data:JSON.stringify(data)},function(result){
                            if(result){
                                window.location = "./onetreepay.php?order_oneid="+result+"&userid="+user.userid+"&treeuserid="+allinfo.userid+"&name="+allinfo.name+"&way=1";
                            }
                        })                
                    }
                }else{
                    $('.alert').fadeIn();
                    $('#alert').html('请阅读交易规则！');
                } 
            }else{
                $('.alert').fadeIn();
                $('#alert').html('请完善数量、用苗地信息！');
            }
        })



        $('.payfull').click(function(){
            if($('#phone').val().length > 11){
                $('.alert').fadeIn();
                $('#alert').html('联系号码不正确！');
                return;
            }
            if($('#number').val() && $('#address').val()){
                var agreen = $('#agreen').is(':checked');            
                if(agreen){
                    var topay = confirm('确定要付全款吗？');
                    if(topay){
                        var data = {
                            number:$('#number').val(),
                            mark:$('#mark').val(),
                            phone:$('#phone').val(),
                            address:$('#address').val(),
                            userid:user.userid,
                            treeuserid:allinfo.userid,
                            treeid:treeid
                        }
                        $.getJSON('/com/index_createorder.php',{data:JSON.stringify(data)},function(result){
                            if(result){
                                window.location = "./onetreepay.php?order_oneid="+result+"&userid="+user.userid+"&treeuserid="+allinfo.userid+"&name="+allinfo.name+"&way=2";
                            }
                        })                 
                    }
                }else{
                    $('.alert').fadeIn();
                    $('#alert').html('请阅读交易规则！');
                }   
            }else{
                $('.alert').fadeIn();
                $('#alert').html('请完善数量、用苗地信息！');
            }
        })

        $('.alert').click(function(){
            $('.alert').fadeOut();
        })

        var treeid = urlRequest("treeid");
        loadtree();
    </script>
</body>
</html>

