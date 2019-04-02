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
        .paydown,.payfull,.applyrefund,.detail,.evaluate,.receipt,.refunding,.notreceipt,.heading,.over{
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
        #alertinfo{
            position: fixed;
            z-index: 30;
            width: 76%;
            height:200px;
            left:10%;
            bottom:15px;
            background-color: #fff;
            padding: 2%;
            text-align: left;
            border-radius: 4px;
            color:#000;
            font-size: 17px;
        }
        #remark{
            width:94%;
            padding: 3%;
            font-size: 16px;
            line-height: 1.3;
            height:70%;
            border: 0;
            resize: none;
        }
        .reset,.upload{
            width:30%;
            margin:5px 10%;
            padding: 5px 0;
            float: left;
            font-size: 16px;
            background: #1AAD19;
            border-radius: 3px;
            text-align: center;
            color: #fff;
        }
        .info_phone{
            text-decoration: none;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
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

    <div class="alertstop">
        <div id="alertinfo">
            <textarea id="remark" placeholder="填写您的理由"></textarea>
            <div class="reset">取消</div>
            <div class="upload">提交</div>
        </div>
    </div>
    
    <script id="dot_onedata" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="onedatainfo" treeuserid="{{=it[i].treeuserid}}" order_oneid="{{=it[i].id}}">
                <div>
                    <div class="info">
                        <div>订单编号：{{=it[i].serial_number}}</div>
                        <div><span>商品名称：</span><span class="treename">{{=it[i].name}}</span></div>
                        <div>规格：{{=attribute(it[i])}}</div>
                        <div class="{{=(it[i].address) ? '' : 'hide'}}">用苗地 ：{{=it[i].address}}</div>
                        <div class="{{=(it[i].mark) ? '' : 'hide'}}">备注 ：{{=it[i].mark}}</div>
                    </div>
                    <div>联系电话 ：<a href="tel:{{=it[i].userphone}}" class="info_phone">{{=it[i].userphone}}</a> </div>

                    <div class="{{=(it[i].order_switch_time) ? '' : 'hide'}}">退款理由 ：{{=it[i].order_switch_remark}}</div>
                </div>
                <div>
                    <div class="detail">查看进程</div>
                    <div class="over {{=(it[i].state == 4) ? '' : 'hide'}}">交易完成</div>
                    <div class="receipt {{=((it[i].state == 2) && (it[i].order_switch == 1)) ? '' : 'hide'}}">确认收货</div>
                    <div class="notreceipt {{=((it[i].state == 2) && (it[i].order_switch == 1)) ? '' : 'hide'}}">拒收货</div>
                    <div class="heading {{=((it[i].order_switch == 3) || (it[i].order_switch == 2)) ? '' : 'hide'}}">正在协商处理</div>
                    <div class="applyrefund {{=((it[i].deposit_switch == 1) && (it[i].order_switch == 1) && (it[i].state == 1)) ? '' : 'hide'}}">申请退定金</div>
                    <div class="payfull {{=((it[i].state < 2) && (it[i].order_switch == 1)) ? '' : 'hide'}}">付全款</div>
                    <div class="paydown {{=(it[i].state < 1) ? '' : 'hide'}}">付定金</div>
                </div>
            </div>
        {{ } }}
    </script>

    <script src="./js/jquery-3.1.0.min.js"></script>
    <script src="./js/doT.min.js"></script>
    <script type="text/javascript">
        var timearray = ['payment_time','refund_time','order_switch_time','receipt_time','deposit_refund_time','fullamount_time','deposit_time','orderstart_time'];
        var timeimpact = ['payment_mount','refund_mount',' ',' ','deposit','fullamount','deposit',' '];
        var timename = ['已完成交易','退还资金','申请退还资金','已确认收货：资金五天后到账','收到定金','已付全款','已付定金','已下订单'];

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
            $.getJSON('/com/search_order_oneunfinshedbuy.php', {userid:user.userid,limit:limit}, function(json) {
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
            $.getJSON('/com/search_order_onefinshedbuy.php', {userid:user.userid,limit:limit}, function(json) {
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
                if(one[timearray[i]] && (one[timeimpact[i]] > 0)){
                    if(timearray[i] == 'deposit_refund_time'){
                        if((one['deposit_refund_time'] && one['fullamount_time']) && (one['fullamount_time'] > one['deposit_refund_time'])){
                            str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[1+i]+'：'+one[timeimpact[1+i]]/100+'元</div><div>'+one[timearray[1+i]]+'</div></div></div>';
                            str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'：'+one[timeimpact[i]]/100+'元</div><div>'+one[timearray[i]]+'</div></div></div>';
                            i++;
                        }else{
                           str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'：'+one[timeimpact[i]]/100+'元</div><div>'+one[timearray[i]]+'</div></div></div>'; 
                        }
                    }else if(timearray[i] == 'payment_time'){
                        if(one['payment_time']){
                           str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'</div><div>'+one[timearray[i]]+'</div></div></div>';
                        }
                    }else{
                        str += '<div class="box"><div class="line"><div class="yuan"></div></div><div class="boxinfo"><div>'+timename[i]+'：'+one[timeimpact[i]]/100+'元</div><div>'+one[timearray[i]]+'</div></div></div>';
                    }
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

        $('#orderinfo').on('click','.paydown',function(){
            var that = $(this);
            var treeuserid = that.parents('.onedatainfo').attr('treeuserid');
            var order_oneid = that.parents('.onedatainfo').attr('order_oneid');
            var name = that.parents('.onedatainfo').find('.treename').html();
            window.location = "./onetreepay.php?order_oneid="+order_oneid+"&userid="+user.userid+"&treeuserid="+treeuserid+"&name="+name+"&way=1";
        })

        $('#orderinfo').on('click','.payfull',function(){
            var that = $(this);
            var treeuserid = that.parents('.onedatainfo').attr('treeuserid');
            var order_oneid = that.parents('.onedatainfo').attr('order_oneid');
            var name = that.parents('.onedatainfo').find('.treename').html();
            window.location = "./onetreepay.php?order_oneid="+order_oneid+"&userid="+user.userid+"&treeuserid="+treeuserid+"&name="+name+"&way=2";
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

        $('#orderinfo').on('click','.receipt',function(){
            var that = $(this);
            var sure = confirm('确定要收货,苗款将转给商家！');
            if(!sure) return;
            var order_oneid = that.parents('.onedatainfo').attr('order_oneid');
            var userid = that.parents('.onedatainfo').attr('onedatainfo');
            $.get('/com/order_one_receipt.php',{id: order_oneid,userid:userid},function(result){
                if(result){
                    that.parents('.onedatainfo').remove();
                    unfinsheddata = [];
                    finsheddata = [];
                    for (var i = 0; i < alldata.length; i++) {
                        if(alldata[i].id == order_oneid){
                            alldata[i].receipt_time =  result;        
                            alldata[i].state =  3;
                        }
                        if(alldata[i].state <3){
                            unfinsheddata[unfinsheddata.length] = alldata[i];
                        }else{
                            finsheddata[finsheddata.length] = alldata[i];
                        }                
                    }
                }
            });
        })

        $('#orderinfo').on('click','.notreceipt',function(){
            var order_oneid = $(this).parents('.onedatainfo').attr('order_oneid');
            $('.upload').attr('order_oneid',order_oneid);
            $('.upload').addClass('nr');
            $('.alertstop').fadeIn();
            $('#remark').focus();

        })

        
        $('#orderinfo').on('click','.applyrefund',function(){
            var order_oneid = $(this).parents('.onedatainfo').attr('order_oneid');
            $('.upload').attr('order_oneid',order_oneid);
            $('.upload').addClass('ar');
            $('.alertstop').fadeIn();
            $('#remark').focus();
        })

        $('.reset').click(function(){
            $('#remark').val('');
            $('.alertstop').fadeOut();
        })

        $('.upload').click(function(){
            var order_oneid = $('.upload').attr('order_oneid');
            var remark = $('#remark').val();
            for (var i = 0; i < unfinsheddata.length; i++) {
                if(order_oneid == unfinsheddata[i].id){
                    var serial_number = unfinsheddata[i].serial_number;
                    var treeuserid = unfinsheddata[i].treeuserid;
                    var name = unfinsheddata[i].name;
                    var number = unfinsheddata[i].number;                    
                }                
            }
            $('.alertstop').hide();
            $('#remark').val('');
            if($('.upload').hasClass('ar')){
                $.get('/com/order_one_stop.php',{serial_number: serial_number,treeuserid:treeuserid,name:name,remark:remark,number:number},function(result){
                    if(result){
                        for (var i = 0; i < unfinsheddata.length; i++) {
                            if(order_oneid == unfinsheddata[i].id){
                                unfinsheddata[i].order_switch_time =  result;            
                                unfinsheddata[i].order_switch =  2;            
                                unfinsheddata[i].order_switch_remark =  remark;            
                            }                
                        }
                        $('#orderinfo').html(dot_onedata(unfinsheddata));
                        alert('商家同意后定金将退回您的账户！');
                    }
                });
                $('.upload').removeClass('ar');     
            }else{
                $.get('/com/order_one_freeze.php',{serial_number:serial_number,remark:remark},function(result){
                    if(result){
                        for (var i = 0; i < unfinsheddata.length; i++) {
                            if(order_oneid == unfinsheddata[i].id){           
                                unfinsheddata[i].order_switch =  3;            
                                unfinsheddata[i].order_switch_remark =  remark;
                                unfinsheddata[i].order_switch_time =  result;             
                            }                
                        }
                        $('#orderinfo').html(dot_onedata(unfinsheddata));
                        alert('平台将尽快处理！');
                    }
                });                
                $('.upload').removeClass('nr');
            }
        })


        $('#process').click(function(){
            $('#process').hide();  
        })

        loadunfinshed();
    </script>

</body>