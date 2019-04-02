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
<title>我的订单</title>
    <style type="text/css">
        body{
            margin: 0;  
            padding:0;  
            border: 0;  
            font: inherit;  
            font-size: 100%;  
            vertical-align: baseline;  
        }
        .class{
            width:90%;
            margin: 3px 5%;
            height:30px;
        }
        #orderinfo{
            width: 100%;
            overflow-y: auto;
        }
        .unfinshed,.finshed{
            background-color:#fff;
            float: left;
            text-align: center;
            width:50%;
            margin-top: 7px;
            height:40px;
            font-size: 19px;
            line-height: 40px;
        }
        .retreat,.notretreat,.detail,.consult{
            float: right;
            display: inline-block;
            padding: .15em .4em;
            min-width: 8px;
            border-radius: 29px;
            background-color: #fff;
            color: #000;
            line-height: 1.2;
            text-align: center;
            border:1px solid #bbb;
            font-size: 15px;
            margin:2px 1.2%;
            vertical-align: middle;
        }
        .onedatainfo{
            width: 95%;
            margin:0 1% 6px;
            float: left;
            padding: 3px 1% 3px 2%;
            border-radius: 2px;
            background:#eee;
            -webkit-overflow-scrolling:touch;
        }
        .active{
            color:red;
        }
        .hide{
            display: none;
        }
        #process{
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
            width:96%;
            margin:10px 2% 10px;
            background-color: #fff;
            padding-bottom: 30px;
            position: fixed;
            bottom: 10px;
            border-radius: 3px;
        }
        .box{
            width:100%;
            height:60px;
            font-size: 15px;
        }
        .line{
            width:40px;
            height:60px;
            border-right:1px solid #999;
            position: relative;
            float: left;
        }
        .yuan{
            position: absolute;
            width: 10px;
            height: 10px;
            float: right;
            border-radius: 50%;
            margin-left: 35px;
            background-color: #1AAD19;
        }
        .alerttitle{
            width:100%;
            height:50px;
            text-align: center;
            font-size: 20px;
            color: #999;
            line-height: 50px;
        }
        .boxinfo{
            float: left;
            width:200px;
            margin-left: 10px;
            height:50px;
        }
        .alertstop{
            position: fixed;
            z-index: 20;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background:rgba(0, 0, 0, 0.6);
            display: none;
        }
    </style>
</head>
<body>
    
    <div class="head">
        <div class="unfinshed active">未完成</div>
        <div class="finshed">已完成</div>
    </div>
    <div id="orderinfo">
    </div>

    <div id="process">
        <div id="alert">
            <div class="alerttitle">订单进程</div>
        </div>
    </div>
    
    <script id="dot_onedata" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="onedatainfo" treeuserid="{{=it[i].treeuserid}}" order_oneid="{{=it[i].id}}">
                <div class="info">
                    <div>订单编号：{{=it[i].serial_number}}</div>
                    <div><span>商品名称：</span><span class="treename">{{=it[i].name}}</span></div>
                    <div>规格：{{=attribute(it[i])}}</div>
                    <div>联系电话 ：{{=it[i].phone}}</div>
                    <div class="{{=(it[i].address) ? '' : 'hide'}}">用苗地 ：{{=it[i].address}}</div>
                    <div class="{{=(it[i].mark) ? '' : 'hide'}}">备注 ：{{=it[i].mark}}</div>
                    <div class="{{=((it[i].order_switch == 2) || ((it[i].order_switch == 4) && (it[i].order_switch_remark))) ? '' : 'hide'}}">退款理由：{{=it[i].order_switch_remark}}</div>
                </div>
                <div>
                    <div class="detail">查看进程</div>
                    <div class="retreat {{=(it[i].order_switch == 2) ? '' : 'hide'}}">退定金</div>
                    <div class="notretreat {{=(it[i].order_switch == 2) ? '' : 'hide'}}">不退定金</div>
                    <div class="consult {{=(it[i].order_switch == 3) ? '' : 'hide'}}">正在协商</div>
                </div>
            </div>
        {{ } }}
    </script>

    <script src="./js/jquery-3.1.0.min.js"></script>
    <script src="./js/doT.min.js"></script>
    <script type="text/javascript">
        var timearray = ['refund_time','order_switch_time','payment_time','receipt_time','fullamount_time','deposit_time','orderstart_time'];
        var timeimpact = ['refund_mount',' ',' ',' ','fullamount','deposit',' '];
        var timename = ['退还定金','申请退还定金','完成交易','收货','付全款','付定金','下订单'];
        var dot_onedata = doT.template($("#dot_onedata").text());
        var height = $(window).height();
        var isloadunfinshed = false;
        var isendunfinshed = false;
        var isloadfinshed = false;
        var isendfinshed = false;
        var unfinsheddata = [];
        var finsheddata = [];
        var alldata = [];
        var user = getcookie('user2');

        user = user ? JSON.parse(user) : null;
        $('#orderinfo').css('height',(height-47)+'px');

        function getcookie(name){
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
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

        function loadunfinshed(){
            if (isloadunfinshed) return;
            isloadunfinshed = true;
            var limit = $('#orderinfo .onedatainfo').length + ',' + 10;
            $.getJSON('/com/search_order_oneunfinshedsell.php', {userid:user.userid,limit:limit}, function(json) {
                if(json){
                    for (var i = 0; i < json.length; i++) {
                        var mark =true;
                        for (var j = 0; j < unfinsheddata.length; j++) {
                            if(unfinsheddata[j].id == json[i].id){
                              mark = false;  
                            } 
                        }
                        if(mark){
                            unfinsheddata[unfinsheddata.length] = json[i];
                            alldata[alldata.length] = json[i];
                        } 
                        var news = [];
                        news[0] = json[i];
                        $('#orderinfo').append(dot_onedata(news));
                    }

                }else{
                    isendunfinshed = true;
                }
                isloadunfinshed = false;
            });
        }

        function loadfinshed(){
            if (isloadfinshed) return;
            isloadfinshed = true;
            var limit = $('#orderinfo .onedatainfo').length + ',' + 10;
            $.getJSON('/com/search_order_onefinshedsell.php', {userid:user.userid,limit:limit}, function(json) {
                if(json){
                        
                    for (var i = 0; i < json.length; i++) {
                        var mark =true;
                        for (var j = 0; j < finsheddata.length; j++) {
                            if(finsheddata[j].id == json[i].id){
                              mark = false;  
                            } 
                        }
                        if(mark){
                            finsheddata[finsheddata.length] = json[i];
                            alldata[alldata.length] = json[i];
                        } 
                        var news = [];
                        news[0] = json[i];
                        $('#orderinfo').append(dot_onedata(news));
                    }
                }else{
                    isendfinshed = true;
                }
                isloadfinshed = false;
                
            });
        }

        function makeprocess(one){
            var str = '';
            for (var i = 0; i < timearray.length; i++) {
                if(one[timearray[i]] && one[timeimpact[i]]){
                    str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'：'+one[timeimpact[i]]/100+'元</div><div>'+one[timearray[i]]+'</div></div></div>';
                }else if(one[timearray[i]]){
                    str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'</div><div>'+one[timearray[i]]+'</div></div></div>';
                }
            }
            return str;
        }

        $('#orderinfo').scroll(function() {
            var that = $(this);
            if($('.active').hasClass('unfinshed')){
                if (isendunfinshed || isloadunfinshed) return;
                var scrollHeight = that[0].scrollHeight;
                var scrollTop = that[0].scrollTop;
                var elementHight = that.height();
                if(scrollTop + elementHight >= scrollHeight-150) {
                    loadunfinshed();
                } 
            }else{
                if (isendfinshed || isloadfinshed) return;
                var scrollHeight = that[0].scrollHeight;
                var scrollTop = that[0].scrollTop;
                var elementHight = that.height();
                if(scrollTop + elementHight >= scrollHeight-150) {
                    loadfinshed();
                }
            } 
        })

        $('#orderinfo').on('click','.info',function(){
            window.location = 'http://cnzhaoshu.com';
        })

        $('.unfinshed').click(function(){
            $('#orderinfo').html('');
            $('.active').removeClass('active');
            $(this).addClass('active');
            if(unfinsheddata.length > 10){
                $('#orderinfo').html(dot_onedata(unfinsheddata));
            }else{
                loadunfinshed();
            }                
        })

        $('.finshed').click(function(){
            $('#orderinfo').html('');
            $('.active').removeClass('active');
            $(this).addClass('active');
            if(finsheddata.length > 10){
                $('#orderinfo').html(dot_onedata(finsheddata));
            }else{
                loadfinshed();
            }  
        })

        $('#orderinfo').on('click','.detail',function(){
            $('.box').remove();
            var order_oneid = $(this).parents('.onedatainfo').attr('order_oneid');
            for (var i = 0; i < alldata.length; i++) {
                if(alldata[i].id == order_oneid){
                    $('#alert').append(makeprocess(alldata[i]));           
                    $('#process').show();
                }                
            }
        })

        $('#orderinfo').on('click','.retreat',function(){
            var that = $(this);
            var sure = confirm('定金将退还给买家，您确定要退款！');
            if(!sure) return;
            var order_oneid = that.parents('.onedatainfo').attr('order_oneid');
            $.getJSON('/wxpay/example/search_order_oneretreat.php', {userid:user.userid,id:order_oneid,}, function(result) {
                if(result){
                    that.parents('.onedatainfo').remove();
                    unfinsheddata = [];
                    finsheddata = [];
                    for (var i = 0; i < alldata.length; i++) {
                        if(alldata[i].id == order_oneid){
                            alldata[i].refund_time =  result.refund_time;        
                            alldata[i].refund_mount =  result.refund_mount;
                            alldata[i].order_switch =  4;
                            alldata[i].state =  4;
                            alldata[i].deposit_switch =  2;
                        }
                        if(alldata[i].state <4){
                            unfinsheddata[unfinsheddata.length] = alldata[i];
                        }else{
                            finsheddata[finsheddata.length] = alldata[i];
                        }                
                    }
                    $('#orderinfo').html(dot_onedata(unfinsheddata));
                }                
            });
        })

        $('#orderinfo').on('click','.notretreat',function(){
            var sure = confirm('交由平台处理，您确定不退款！');
            if(!sure) return;
            var order_oneid = $(this).parents('.onedatainfo').attr('order_oneid');
            $.get('/com/search_order_onenotretreat.php', {userid:user.userid,id:order_oneid}, function(result) {
                if(result){
                    unfinsheddata = [];
                    finsheddata = [];
                    for (var i = 0; i < alldata.length; i++) {
                        if(alldata[i].id == order_oneid){
                            alldata[i].order_switch = 3;
                        }
                        if(alldata[i].state < 4){
                            unfinsheddata[unfinsheddata.length] = alldata[i];
                        }else{
                            finsheddata[finsheddata.length] = alldata[i];
                        }                
                    }
                    // alert('找树网平台将尽快处理！');
                    // console.log(unfinsheddata);
                    $('#orderinfo').html(dot_onedata(unfinsheddata));
                }                
            });
        })

        $('#process').click(function(){
            $('#process').hide();  
        })

        loadunfinshed();
    </script>

</body>