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
            padding: 2% 1%;
        }
        .treeimg{
            width:60%;
            padding: 20px 20% 5px;
            float: left;
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
            color:red;
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
            color:red;
            height:29px;
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
            height:29px;
        }
        #mark{
            margin-top: 5px;
            width:93%;
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
            margin: 10px 0;
        }
        #agreen{
            width:10%;
            float: left;
            line-height: 25px;
        }
        .neirong{
            float: left;
            line-height: 23px;
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
        .contracthref{
            color:blue;
        }
        #contract{
            position: fixed;
            z-index: 300;
            width: 96%;
            left:0;
            top:0;
            padding: 5px 2%;
            background-color: #fff;
            text-align: left;
            color:#000;
            font-size: 15px;
            overflow-y: auto;
            display: none;
        }
        #jianame,#yiname,.bingname{
            text-decoration:underline;
            color:red;
            padding: 0 5px;
        }
        .contract-title{
            text-align: center;
            font-size: 19px;
            margin: 5px 0
        }
        #contract-treename,#contract-treeattribute,#contract-tree-number,#contract-treeprice,#contract-totalprice,#year,#mounth,#day{
            color: blue;
        }
        #contract-name,#contract-number,#contract-total-price{
            color: blue;
            margin:0 3px;
        }
        .contract-h1{
            font-size: 15px;
            margin: 3px 0;
        }
        .contract-h2{
            font-size: 13px;
        }
        .row{
            width:100%;
            float: left;
        }
    </style>    
</head>
<body>
    <div class="zhaoshuinfo">
        <div class="infomation">
            <div class="row">
                <div class="title">名称：</div><div id="name"></div>            
            </div>
            <div class="row">
                <div class="title">单价：</div><div id="price"></div>
            </div>
            <div class="row">
                <div class="title">规格：</div><div id="attribute"></div>
            </div>
            <div class="row">
                <div class="number">数量：</div><input type="number" id="number" onkeyup="checknumber()" placeholder="请输入数量">
            </div>
            <div class="row">
                <div class="number">手机号：</div><input type="number" id="phone" onkeyup="checkphone()" placeholder="请输入手机号">
            </div>
            <div class="row">
                <div class="number">用苗地：</div><input type="text" id="address" maxlength="250" placeholder="请输入用苗地">
            </div>
            <textarea id="mark" placeholder="可填写备注" type="text" maxlength="250"></textarea>
            <div class="contract">
                <input type="checkbox" id="agreen"><label class="neirong" for="agreen">本人同意</label><span class="contracthref">《找树网交易规则》</span>
            </div>
            <div class="paydeposit">付定金</div>
            <div class="payfull">付全款</div>
        </div>
        <div class="alert"><div id="alert"></div></div>
        <div id="contract">
            <div class="contract-title">互联网苗木买卖协议</div>
            <div class="contract-h2">本协议由以下三方于<span id="year"></span>年<span id="mounth"></span>月<span id="day"></span>日签署：</div>
            <div class="contract-h2">甲方：<span id="jianame"></span>（以下简称甲方）</div>
            <div class="contract-h2">乙方：<span id="yiname"></span>（以下简称乙方）</div>
            <div class="contract-h2">丙方：<span class="bingname">北京找树网科技股份有限公司</span>（以下简称丙方）</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;根据《中华人民共和国合同法》及相关法律法规的规定，三方遵循平等、自愿、互利和诚实信用原则，经友好协商，丙方为甲方发布苗木求购信息，丙方为乙方提供苗木出售信息发布等服务，促成甲、乙双方苗木交易达成如下协议：</div>
            <div class="contract-h1">第一条、转让标的物及价格</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;1、甲方通过丙方的找树网平台向乙方采购苗木<span id="contract-name"></span>，数量<span id="contract-number"></span>株，金额为人民币<span id="contract-total-price"></span>元。苗木其他详细信息见下：</div>
            <div style="font-size: 13px;padding-left:3%;width:94%">
                <table width="100%" border="1" cellspacing="0">
                    <tr>
                        <td>名称</td>
                        <td id="contract-treename"></td>
                    </tr>
                    <tr>
                        <td>规格</td>
                        <td id="contract-treeattribute"></td>
                    </tr>
                    <tr>
                        <td>数量(苗)</td>
                        <td id="contract-tree-number"></td>
                    </tr>
                    <tr>
                        <td>单价(元/苗)</td>
                        <td id="contract-treeprice"></td>
                    </tr>
                    <tr>
                        <td>合价(元)</td>
                        <td id="contract-totalprice"></td>
                    </tr>
                </table>
            </div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;2、乙方愿意将发布于丙方找树网平台上的苗木出售给甲方。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;3、在甲乙双方完成交易后，甲方须向丙方支付交易服务费。</div>
            <div class="contract-h1">第二条、付款方式</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;甲乙双方通过丙方的找树网平台达成交易意向后，甲方支付定金至丙方在北京银行开立的定金专用账户，定金金额为甲乙双方交易金额的30%。乙方在收到丙方确认定金到账通知后两日内将所售苗木起树装车。交易苗木抵达甲方指定地点，经甲方验收后通知丙方支付乙方定金款，同时甲方将尾款直接支付给乙方。</div>
            <div class="contract-h1">第三条、双方权利义务</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;1、甲方承诺在丙方的找树网平台发布苗木求购信息时，向丙方提供的注册信息合法、真实、有效，不存在欺诈信息，否则甲方愿意承担一切法律责任和由此给丙方、乙方带来的一切经济损失。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;2、乙方承诺在丙方的找树网平台发布的苗木信息是合法的、产权清晰，没有权属和任何经济纠纷，乙方拥有对苗木处置的绝对权。否则乙方愿意承担一切法律责任和由此给丙方、甲方带来的一切经济损失。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;3、协议签订后，甲方单方面撤销苗木采购信息的，定金不予返还，丙方有权扣除定金金额的5%后将剩余定金支付给乙方。乙方将交易苗木送达甲方指定地点，经甲方验收合格后，需在一个工作日内将尾款支付给乙方；经乙方违反协议约定导致甲方验收不合格的，甲方有权立即退货并拒绝支付尾款，同时可要求乙方双倍返还定金，乙方须同时向丙方支付定金金额的10%作为违约赔偿金。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;4、协议签订后，乙方保证该批苗木是完整的，不存在人为的破坏和偷挖苗木的情况发生，保证送达甲方指定地点的苗木与在丙方找树网平台发布的苗木信息一致或者通过丙方找树网平台以图片、视频等其他方式传达给甲方的苗木信息一致。乙方将交易苗木送达甲方指定地点，经甲方验收合格后，可要求甲方在一个工作日内支付尾款；因甲方违反协议约定导致验收不合格的，乙方有权要求甲方立即支付尾款，并承担交易金额的10%作为违约赔偿金。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;5、协议签订后，甲方自行采挖和运输树苗的，所产生的费用由甲方自行承担，在乙方提供相关树苗采挖及运输的相关合法手续之日起3个月内完成所有苗木的移栽。</div>
            <div class="contract-h1">第四条、争议解决</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;苗木买卖协议在履行过程中发生争议，甲乙双方应首先协商解决，协商不成的受诉法院为苗木所在地人民法院。</div>
            <div class="contract-h1">第五条、合同效力</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;1、甲、乙双方按丙方找树网平台的规则通过在找树网上点击确认本协议即视为甲方与乙方、丙方达成协议并同意接受本协议的全部约定内容以及丙方的找树网所包含的其他与本协议项下各项条款有关的各项规定，协议即生效。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;2、甲乙丙三方协商一致，可以解除本协议。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;3、本协议的修改或补充，以找树网上发布的电子文本形式作出。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;4、本协议中的部分条款的无效或无法履行，不影响本协议其他条款的效力。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;5、本合同自订立之日起生效，甲乙丙三方各执一份。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;6、本合同终止期限为甲乙双方货、款两清之日。</div>
            <div class="contract-h1">第六条、违约责任</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;1、乙方若所供苗木未达到甲方的质量要求，按所余款项的10%支付违约金。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;2、甲方若未按时支付苗木款，每日按需付金额的万分之一支付违约金。</div>
            <div class="contract-h2">&nbsp;&nbsp;&nbsp;&nbsp;（以下无正文）</div>
        </div>
    </div>
    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="/js/crypt.js?t=20160930"></script>
    
    <script type="text/javascript">
        var height = $(window).height();
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;

        $('#contract').css('height',(height-10)+'px');
        var allinfo;

        $('.contracthref').click(function(){
            if($('#number').val()){
                $('#contract').show();
            }else{
                $('.alert').fadeIn();
                $('#alert').html('请先填写购买基本信息！');
            }
        })

        $('#contract').click(function(){
            $('#contract').hide();
        })

        var mydate = new Date();
        $('#year').html(mydate.getFullYear());
        $('#mounth').html(mydate.getMonth()+1);
        $('#day').html(mydate.getDate());
        $('#jianame').html(user.name);

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
                allinfo = json;
                $('#img').attr('src','trees/s2/'+decodeImgpath(json.imgpath));
                $('#name').html(json.name);
                $('#price').html(json.price+'元');
                $('#attribute').html(attribute(json));
                $('#address').html(json.address);
                $('#yiname').html(json.username);
                $('#contract-treename').html(json.name);
                $('#contract-treeattribute').html(attribute(json));
                $('#contract-treeprice').html(json.price);
                $('#contract-name').html(json.name);
            })            
        }

        function decodeImgpath(imgpath) {
            var imgpaths = imgpath.split(';');
            imgpaths[0] = decode(imgpaths[0]) + '.jpg';
            return imgpaths[0];
        }

        function attribute(info){
            var attr = '';
            for( var key in info){
                if((key == 'age') && info[key]) attr += '苗龄 '+info[key] +'年 ';
                if((key == 'branch_bough_number') && info[key]) attr += '分枝数 '+info[key] +'个 ';
                if((key == 'substrate') && info[key]) info[key] += '基质 '+info[key];
                if(key == 'dbh'){
                    if(info['dbh_type'] == '5') attr += '胸径 '+parseInt(10*info[key])/10 +'公分 ';
                    if(info['dbh_type'] == '6') attr += '地径 '+parseInt(10*info[key])/10 +'公分 ';
                    if(info['dbh_type'] == '7') attr += '盆径 '+parseInt(10*info[key])/10 +'公分 ';
                }
                if(key == 'height'){
                    if(info['height_type'] == '10') attr += '株高 '+parseInt(10*info[key])/10 +'米 ';
                    if(info['height_type'] == '11') attr += '条长 '+parseInt(10*info[key])/10 +'米 ';
                    if(info['height_type'] == '12') attr += '主枝长 '+parseInt(10*info[key])/10 +'米 ';
                }
                if((key == 'branch_point_height') && info[key]){
                   attr += '分枝点高 '+parseInt(10*info[key])/10 +'米 '; 
                } 
                if((key == 'crownwidth') && info[key]){
                    attr += '冠幅 '+parseInt(10*info[key])/10 +'米 ';
                }
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

        $('#number').blur(function() {
            var number = $('#number').val();
            $('#contract-number').html(number);
            $('#contract-total-price').html(number*allinfo.price);
            $('#contract-tree-number').html(number);
            $('#contract-totalprice').html(number*allinfo.price);
        });

        $('.paydeposit').click(function(){
            if(!checkPhone()){
                $('.alert').fadeIn();
                $('#alert').html('手机号码有误，请重填！');
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
                        var money = Math.ceil(100*allinfo.price*data.number*0.3*1.008);
                        $.getJSON('/com/index_createorder.php',{data:JSON.stringify(data)},function(result){
                            if(result){
                                window.location = "./wxpay/example/onetree_pay.php?order_oneid="+result+"&userid="+user.userid+"&treeuserid="+allinfo.userid+"&money="+money/100+"&name="+allinfo.name+"&way=1";
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

        function checkPhone(){ 
            var phone = $('#phone').val();
            if(!(/^1[34578]\d{9}$/.test(phone))){ 
                return false; 
            }else{
                return true; 
            }
        }

        $('.payfull').click(function(){
            if(!checkPhone()){
                $('.alert').fadeIn();
                $('#alert').html('手机号码有误，请重填！');
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
                        var money = Math.ceil(100*allinfo.price*data.number*1.008);
                        $.getJSON('/com/index_createorder.php',{data:JSON.stringify(data)},function(result){
                            if(result){
                                window.location = "./wxpay/example/onetree_pay.php?order_oneid="+result+"&userid="+user.userid+"&treeuserid="+allinfo.userid+"&money="+money/100+"&name="+allinfo.name+"&way=2";
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

