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
<title>招投标</title>
<style type="text/css">
    body{
    	margin: 0;  
		padding:0;  
		border: 0;  
		font: inherit;  
		font-size: 100%;  
		vertical-align: baseline;  
    }
    
	#show{
		float: left;
		width: 100%;
        position: absolute;
        top:50px;
        overflow-y: auto;
        -webkit-overflow-scrolling:touch;
	}
	.onedata{
    	float: left;
    	width:100%;
    	border-bottom: 1px dashed #eee;
    	padding:5px 0;
    }
	.onedatainfo{
		width:100%;
		float: left;
	}
	.row1{
    	float: left;
    	width:100%;
    }
    .numberorder{
    	width:8%;
    	margin-left: 2%;
    	float: left;
    	line-height: 30px;
    }
    .onedatainfo_name{
    	width:40%;
    	float: left;
    	line-height: 30px;
        font-size: 18px;
    }
    .onedatainfo_number{
    	width:20%;
    	float: left;
    	line-height: 30px;
        font-size: 14px;
    }
    .row2{
    	float: left;
    	width:90%;
    	margin-left: 10%;
    	line-height: 18px;
    	font-size: 14px;
    }
    .button2{
    	width:25%;
    	float:left;
    	padding:5px 3px;
    	font-size: 15px;
    	border-radius:4px;
    	background:#1AAD19;
    	color:#fff;
        display: none;
    	text-align: center;
    }
    .button1{
    	width:25%;
    	float:left;
    	padding:5px 3px;
    	font-size: 15px;
    	border-radius:4px;
    	background:#aaa;
    	color:#fff;
        display: none;
    	text-align: center;
    }
    .bid_number{
        min-width:20px;
        height:20px;
        float:right;
        border-radius: 18px;
        background:#bb3d00;
        color:#fff;
        line-height: 20px;
        text-align: center;
        margin-right: 10%;
    }
    .alertordername ,.alertuserphone{
        z-index:100;
        position:fixed;
        bottom:0;
        left:0%;
        width:99%;
        border-radius:5px;
        border:solid 2px #aaa;
        background-color:#eee;
        display:none;
        box-shadow: 0 0 10px #666;
    }
    .form_control_alert{
        border: 1px solid #e2e2e4;
        box-shadow: none;
        color: #c2c2c2;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        display: block;
        font-size: 16px;
        height: 23px;
        line-height: 1.3;
        padding: 6px 8px;
        vertical-align: middle;
        margin:10px auto;
        width:90%;
    }
    .order_name_button_reset,.phone_button_reset {
        -moz-user-select: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background:#1AAD19;
        color:#fff;
        width:20%;
        float: left;
        margin-left:25%;
        margin-top:15px;
        margin-bottom:15px;
    }
    #order_name_button,#phone_button{
        -moz-user-select: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background:#1AAD19;
        color:#fff;
        width:20%;
        float: right;
        margin-right:25%;
        margin-top:15px;
        margin-bottom:15px;
    }
    .alerttitle{
        width:30%;
        float: left;
        padding-left: 10%;
        font-size: 18px;
        line-height: 1.4;
    }
    .alertcontent{
        width:50%;
        float: left;
        border: 0;
        outline: 0;
        -webkit-appearance: none;
        background-color: transparent;
        font-size: 18px;
        line-height: 1.4;
    }
    .weui_cell {
        padding: 0px 2px;
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .weui_cell_primary {
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }
    .weui_uploader_files {
        list-style: none;
    }
    .weui_uploader_bd {
        margin-bottom: -4px;
        margin-right: -9px;
        overflow: hidden;
    }
    .weui_uploader_input_wrp {
        float: left;
        position: relative;
        margin-right: 9px;
        margin-bottom: 9px;
        width: 77px;
        height: 77px;
        border: 1px solid #D9D9D9;
    }
    .weui_uploader_input {
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    ul{
        display: block;
        list-style-type: disc;
        -webkit-margin-before: 1em;
        -webkit-margin-after: 1em;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-padding-start: 0px;
    }
    .weui_uploader_file {
        float: left;
        margin-right: 9px;
        margin-bottom: 9px;
        width: 79px;
        height: 79px;
        background: no-repeat center center;
        background-size: cover;
    }
    #topimage{
    	background:#fff;
    	width:100%;
    	height:100%;
    	z-index: 1000;
    	position: fixed;
    	display: none;
    }
    
    .topimage{
    	width:100%;
    	height:auto;
    	position: absolute;
    }
    .deletes{
    	width:94%;
    	position: absolute;
    	margin: 0 3%;
    	bottom: 5px;
    	height:40px;
    	border-radius: 5px;
    	float: left;
    	text-align: center;
    	background:#E64340;
    	color:#fff;
    	z-index: 1001;
        line-height: 40px;
        font-size: 20px;
    }
    .footinfo{
        width:100%;
        bottom: 0px;
        height:50px;
        float: left;
        background:#fff;
        z-index: 300;
        position: absolute;
        border-top: 1px solid #eee;
        display: none;
    }
    .lineh{
    	border-left:1px solid #ddd;
    	width:50%;
    	left:50%;
    	position: absolute;
    	height:60%;
    	top:20%
    }
    .lines{
    	border-bottom:1px solid #ddd;
    	width:60%;
    	left:20%;
    	position: absolute;
    	top:50%
    }
    .alert_head{
    	width:50%;
    	float: left;
    	height:35px;
    	line-height: 35px;
    	font-size: 20px;
    	padding-left:25%;
    	text-align: center;
    	margin: 5px 0px;
    }
    .closealert,.closealertphone{
    	width:10%;
    	float: left;
        padding-left: 15%;
    	font-size: 25px;
    }
    .container{
    	float:left;
    	margin-left:10%;
    	width:90%
    }
    .weui_cells_form,.alertrow1{
    	float:left;
    	width:100%
    }
    .showone{
        float: left;
        width:100%;
        border-top: 1px solid #eee;
        padding:5px 0;
    }
    .order{
        width:8%;
        margin-left: 2%;
        float: left;
        line-height: 27px;
    }
    .name{
        width:40%;
        float: left;
        line-height: 27px;
    }
    .number{
        width:15%;
        float: left;
        line-height: 27px;
    }
    .biduser{
        float: left;
    }
    .row2{
        float: left;
        width:90%;
        margin-left: 10%;
        line-height: 18px;
        font-size: 15px;
    }
    .row0{
        float: left;
        width:90%;
        margin-left: 10%;
        line-height: 18px;
        font-size: 14px;
        color: #999;
    }
    .row3{
        float: left;
        width:90%;
        margin-left: 10%;
        font-size: 15px;
    }
    .row4{
        float: left;
        margin-top: 2px;
        width:88%;
        margin-left: 10%;
        border-top:1px solid #eee;
        display: none;
        font-size: 14px;
    }
    .bids{
        width:100%;
        float:left;
        padding:4px 0 4px;
        border-bottom:1px solid #eee;
    }
    .image{
        width:25%;
        height:100px;
        margin: 0 1%;
        border-radius: 5px;
        float:left;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
    }
    .bidinfo{
        width:71%;
        margin:0 1%;
        height:45px;
        float:left;
    }
    .button{
        width:73%;
        height:55px;
        float:left;
    }
    .bidinfo_name{
        width:60%;
        line-height: 20px;
        float:left;
        overflow-x: hidden;
    }
    .bidinfo_phone{
        width:60%;
        line-height: 20px;
        float:left;
    }
    .bidinfo_price,.bidinfo_count{
        width:40%;
        line-height: 20px;
        float:left;
        text-align: right;
    }
    .supplier,.paydeposit,.payfullamount,.receipt,.refund,.bid,.notreceipt,.over,.consult,.overreceipt,.delete{
        float: right;
        display: inline-block;
        padding: .15em .4em;
        min-width: 8px;
        border-radius: 29px;
        background-color: #fff;
        color: #000;
        line-height: 1.2;
        text-align: center;
        border: 1px solid #bbb;
        font-size: 15px;
        margin-right: 2%;
        margin-top: 3px;
        vertical-align: middle;
    }
    #bigimages{
        width:100%;
        z-index: 500;
        background: #fff;
        display: none;
        float: left;
        position: absolute;
        overflow-y: auto;
    }
    .bigimage{
        width:98%;
        float: left;
        margin: 10px 1%;
    }
    .biglogo{
        width:100%;
        float: left;
        position: absolute;
        bottom: 100px;
    }
    .head{
        position: fixed;
        z-index: 20;
        width: 100%;
        background: #fff;        
        border-bottom: 1px solid #eee;
        min-height: 40px;
    }
    .alertinput{
        float: left;
        width: 100%;
    }
    .alertinput2{
        float: left;
        width: 100%;
        margin: 20px 0;
    }
    .buttonbottom{
        float: left;
        width: 100%;
    }
    a{text-decoration:none}
    .on .onedatainfo{
        background-color: #eee;
    }
    .tenderhead{
        width: 21%;
        margin: 10px 2% 2px;
        text-align: center;
        font-size: 18px;
        line-height: 25px;
        height: 25px;
        float: left;
        color: #1AAD19;
    }
    .title{
        width: 40%;
        padding: 10px 5% 2px;
        text-align: center;
        font-size: 18px;
        height: 25px;
        line-height: 25px;
        float: left;
        background: #fff;
        color: #777;
    }
    #getexcel{
        width: 21%;
        margin: 10px 2% 2px;
        text-align: center;
        font-size: 18px;
        line-height: 25px;
        height: 25px;
        float: left;
        color: #1AAD19;
        display: none;
    }
    #title{
        width: 90%;
        padding: 1px 5% 5px;
        text-align: center;
        font-size: 13px;
        float: left;
        background: #fff;
        color: #777;
    }
    .addwexin{
        float:left;
        width: 20%;
        height:35px;
        font-size: 13px;
        margin-left: 7%;
        margin-top: 5px;
        padding: 2px 2%;
        text-align: center;
        background: #1AAD19;
        color:#fff;
        border-radius: 3px;
    }
    .uploadtenderimage{
        float:left;
        width: 20%;
        background: #1AAD19;
        border-radius: 3px;
        height:35px;
        font-size: 13px;
        text-align:center;
        padding: 2px 2%;
        color:#fff;
        margin-left: 7%;
        margin-top: 5px;
    }
    .xkshirley{
        float:left;
        width: 20%;
        background: #1AAD19;
        border-radius: 3px;
        height:35px;
        font-size: 13px;
        text-align:center;
        padding: 2px 2%;
        color:#fff;
        margin-left: 7%;
        margin-top: 5px;
    }
    .hide{
        display: none;
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
    .resets,.uploads{
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
</style>

</head>
<body>
    <div class="head">
       <a class="tenderhead" href="/yusuanphone.php">首页</a>
	   <div class="title"></div>
	   <div id="getexcel">导出</div>
       <div id="title"></div>
    </div>
	<div id="show"></div>
	<div class="alertordername">
        <div class="alertrow1"><div class="alert_head">填写报价信息</div><div class="closealert" style="">×</div></div>
        <div class="alertinput">
            <div id="username"></div>
            <div class="alerttitle">数量:</div><input type="number" id="alert_number" class="alertcontent" placeholder="请输入数量">
            <div class="alerttitle">价格:</div><input type="number" id="alert_price" class="alertcontent" placeholder="请输入价格">
        </div>
        <div class="container">
          <div class="weui_cells_title">图片上传(最多可上传5张)</div>
          <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
              <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                  <div class="weui_uploader_bd">
                    <ul class="weui_uploader_files" id="images">
                    </ul>
                    <div class="weui_uploader_input_wrp">
                    <div class="lineh"></div>
                    <div class="lines"></div>
                      <input class="weui_uploader_input js_file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple=""></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="buttonbottom">
            <button type="button" class="order_name_button_reset">清空</button>
            <button type="button" id="order_name_button">提交</button>
        </div>
    </div> 
    <div class="alertuserphone">
        <div class="alertrow1"><div class="alert_head">请填写手机号</div><div class="closealertphone" style="">×</div></div>
        <div class="alertinput2">
            <div class="alerttitle">手机号:</div><input type="number" id="alert_phone" class="alertcontent" placeholder="请输入您的手机号">
        </div>
        <div class="buttonbottom">
            <button type="button" class="phone_button_reset">清空</button>
            <button type="button" id="phone_button">提交</button>
        </div>
    </div> 
	<div id="topimage">
		<div class="deletes">删除</div>
	</div>
    <div id="bigimages"></div>
    <div class="footinfo">
        <div class="addwexin">加微信发批量采购</div>
        <div class="uploadtenderimage">制作二维码采购</div>
        <div class="xkshirley">分享选标权限</div>
    </div>

    <div class="alertstop">
        <div id="alertinfo">
            <textarea id="remark" placeholder="填写您的退款理由"></textarea>
            <div class="resets">取消</div>
            <div class="uploads">提交</div>
        </div>
    </div>

	<script id="dot_show" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="onedata" id="{{=it[i].id}}">
                <div class="onedatainfo">
	        		<div class="row0">编号: {{=it[i].id}}</div>
                    <div class="row1">
                        <div class="numberorder">{{=addone(i)}}</div>
                        <div class="onedatainfo_name" style="{{=it[i].successnum ? 'color:#bb3d00' : ''}}">{{=it[i].name}}</div>
                        <div class="onedatainfo_number">{{=it[i].count ? it[i].count+'('+it[i].unit+')' : ''}}</div>
                        <div class="{{=it[i].bid_state ? 'onedatainfo_button button1' : 'onedatainfo_button button2'}}">{{=it[i].bid_state ? '已报价' : '报价'}}</div>
                        <div class="bid_number" style="{{=it[i].num ? '' : 'opacity:0'}}">{{=it[i].num ? it[i].num : ''}}</div>
                    </div>
                    <div class="row2">{{=guige(it[i])}}</div>
                    <div class="row3">{{= (it[i].mark) ? '备注：'+it[i].mark : ''}}</div>
	        	</div>
                <div class="row4"></div>
	        </div>
	    {{ } }}
	</script>
	<script id="dot_image" type="text/x-dot-template">
	    {{ for(var i in it) { }}
			<li class="weui_uploader_file" id="{{=it[i]}}" style="background-image:url('../bidimage/{{=it[i]}}.jpg')";
			</li>
	    {{ } }}
	</script>
    <script id="dot_bids" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="bids" data-userid="{{=it[i].userid}}">
                <div class="image" data-image="{{=it[i].image}}" style="background-image: url('../bidimage/{{=firstimage(it[i].image)}}.jpg')"></div>
                <div class="bidinfo">
                    <div class="bidinfo_name">{{=it[i].city ? it[i].username+'('+it[i].city+')' : it[i].username}}</div>
                    <div class="bidinfo_count">{{=it[i].number}}{{=it[i].unit}}</div>
                    <a href="tel:{{=it[i].phone}}" class="bidinfo_phone">{{=it[i].phone}}</a>   
                    <div class="bidinfo_price">{{=(it[i].price/100)}}元/{{=it[i].unit}}</div>
                </div>
                <div class="button" state="{{=it[i].state}}">
                    {{? ((it[i].state == 1) && (it[i].relationshipstate == 1))}}
                        <div class="bid">中标</div>
                    {{?? it[i].state == 1}}
                        <div class="supplier">成为供应商</div>
                    {{??}}
                    {{?}}
                    {{= (it[i].state == 1) ? '<div class="delete">删除</div>' : ''}}
                    {{= (it[i].state == 2) ? '<div class="paydeposit">付定金</div>' : ''}}
                    {{= ((it[i].state > 1) && (it[i].state < 4)) ? '<div class="payfullamount">付全款</div>' : ''}}
                    {{= ((it[i].ispay == 0) && (it[i].state == 3)) ? '<div class="refund">申请退款</div>' : ''}}
                    {{= (it[i].state == 4) ? '<div class="receipt">收货</div>' : ''}}
                    {{= (it[i].state == 4) ? '<div class="notreceipt">拒收货</div>' : ''}}
                    {{= (it[i].state == 5) ? '<div class="overreceipt">已收货</div>' : ''}}
                    {{= (it[i].state == 6) ? '<div class="consult">正在协商</div>' : ''}}
                    {{= (it[i].state == 7) ? '<div class="consult">退定金中</div>' : ''}}
                    {{= (it[i].state == 8) ? '<div class="over">交易完成</div>' : ''}}
                </div>
            </div>
        {{ } }}
    </script>

	<script src="./js/jquery-3.1.0.min.js"></script>
    <script src="./js/doT.min.js"></script>
	<script type="text/javascript">
		var dot_show = doT.template($("#dot_show").text());
		var dot_image = doT.template($("#dot_image").text());
        var dot_bids = doT.template($("#dot_bids").text());
		var height = $(window).height();
		var width = $(window).width();
		var orderid;
		var chooseid;
		var thisbutton;
        var ismyorder;
        var ismygrouporder;
        var orderuserid;
        var refund;
        var notreceipt;
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }


        $('#bigimages').css('height',height+'px');
        
		function urlRequest(name) {
	        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
	        return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
	    }

	    var qrcodeid = urlRequest("id");

		$.getJSON('/com/search_qrcodeorder.php',{qrcodeid:qrcodeid,userid:user.userid},function(json){

            if(json['orderinfo']){
                orderid=json['orderinfo'][0].orderid;
                ismyorder = json['ismyorder'];
                ismygrouporder = json['ismygrouporder'];
                if(json['orderinfo'][0].orderid){
                    $('#show').html(dot_show(json['orderinfo']));
                    if(ismyorder){
                        $('#show').css('height',(height-90)+'px');
                        $('#show').css('top','40px');
                        $('.title').html('选标');
                        $('#title').css('font-size','20px');
                        $('.bid_number').show();
                        $('#getexcel').show();
                    }else if(ismygrouporder){
                        orderuserid = json['orderuserid'];
                        $('#show').css('height',(height-90)+'px');
                        $('#show').css('top','40px');
                        $('.title').html('选标');
                        $('#title').css('font-size','20px');
                        $('.bid_number').show();
                        $('#getexcel').show(); 
                        $('.xkshirley').remove();                   
                        $('.footinfo div').css('width','36%');
                        $('.footinfo div').css('line-height','35px');
                    }else{
                        $('.button1').show();
                        $('.button2').show();
                        $('#show').css('height',(height-110)+'px');
                        $('.title').html('采购单');
                        $('#title').html(json['username']);
                        $('.bid_number').remove();
                        $('#show').css('top','61px');
                        $('.xkshirley').remove(); 
                        $('.footinfo div').css('width','36%');
                        $('.footinfo div').css('line-height','35px');
                    }
                    $('.footinfo').show(); 
                }else{
                    alert('此订单数据不合理! 已被删除');
                }
			}else{
                alert('此订单已停止招标!');
            }
		})

		function guige(data_attribute){
		    var attr = '';
            if(data_attribute.trunk_diameter){
                var at = data_attribute.trunk_diameter.replace(',','-');
                attr += '胸径:'+at+'公分 ';
            }
            if(data_attribute.ground_diameter){
                var at = data_attribute.ground_diameter.replace(',','-');
                attr += '地径:'+at+'公分 ';
            }
            if(data_attribute.pot_diameter){
                var at = data_attribute.pot_diameter.replace(',','-');
                attr += '盆径:'+at+'公分 ';
            }
            if(data_attribute.plant_height){
                var at = data_attribute.plant_height.replace(',','-');
                attr += '株高:'+at+'米 ';
            }
            if(data_attribute.plant_height_cm){
                var at = data_attribute.plant_height_cm.replace(',','-');
                attr += '株高:'+at+'公分 ';
            }
            if(data_attribute.crown){
                var at = data_attribute.crown.replace(',','-');
                attr += '冠幅:'+at+'米 ';
            }
            if(data_attribute.crown_cm){
                var at = data_attribute.crown_cm.replace(',','-');
                attr += '冠幅:'+at+'公分 ';
            }
            if(data_attribute.branch_number){
                var at = data_attribute.branch_number.replace(',','-');
                attr += '分枝数:'+at+'个 ';
            }
            if(data_attribute.bough_number){
                var at = data_attribute.bough_number.replace(',','-');
                attr += '主枝数:'+at+'个 ';
            }
            if(data_attribute.age){
                var at = data_attribute.age.replace(',','-');
                attr += '苗龄:'+at+'年 ';
            }
            if(data_attribute.branch_length){
                var at = data_attribute.branch_length.replace(',','-');
                attr += '条长:'+at+'米 ';
            }
            if(data_attribute.bough_length){
                var at = data_attribute.bough_length.replace(',','-');
                attr += '主蔓(枝)长:'+at+'米 ';
            }
            if(data_attribute.branch_point_height){
                var at = data_attribute.branch_point_height.replace(',','-');
                attr += '分枝点高:'+at+'米 ';
            }
            if(data_attribute.substrate){
                var at = data_attribute.substrate;
                attr += '基质:'+at;
            }

            return attr;
		}

		function addone(one){
			var a = 1+parseInt(one);
			return a+'.';
		}

		$('#order_name_button').click(function(){
		    $('.alertordername').hide();
            $('.footinfo').show();
		    var data = [];
            data[0]={};
            var price = $('#alert_price').val();
            var number = $('#alert_number').val();
            if(price && number){
        	    data[0].price = price*100;
        	    data[0].number = number;
        	    data[0].id = chooseid;
    		    $.getJSON('/com/input_bidinfo.php',{orderid:orderid,data:JSON.stringify(data),userid:user.userid},function(result){
    		    	if(result){
    		    		thisbutton.html('已报价');
    		    		thisbutton.attr('class','onedatainfo_button button1');
    		    	}else{
    		    		alert('已停止报价!');
    		    	}
    		    })
            }
		})

         
        $('#phone_button').click(function(){
            var phone = $('#alert_phone').val();
            if(phone){
                $.getJSON('/com/update_userphone.php',{phone:phone,userid:user.userid},function(result){
                    if(result){
                        $('.alertuserphone').hide();
                        $('.alertordername').show();
                    } 
                })
            }else{
                alert('请填写您的手机号!');
            }
        })

        $('#getexcel').click(function(){
            if(ismygrouporder){
                window.location = '/com/getbidexcel.php?userid='+orderuserid+'&orderid='+orderid;
            }else{
                window.location = '/com/getbidexcel.php?userid='+user.userid+'&orderid='+orderid;
            }                
        })

		$('#show').on('click','.onedatainfo_button',function(){
            if(user.phone){
    			$('.alertordername').show();
                $('.footinfo').hide();
    			$('#alert_price').val('');
    			$('#alert_number').val('');
    			$('#images').html('');
    		    thisbutton = $(this);
    			chooseid = $(this).parents('.onedata').attr('id');
    			$.getJSON('/com/search_mybid_orderinfo.php',{orderid:orderid,id:chooseid,userid:user.userid},function(json){
    				if(json){
    					if(json.price) $('#alert_price').val(json.price);
    					if(json.number) $('#alert_number').val(json.number);
    					if(json.image){
    						var images = json.image.split(',');
    						$('#images').html(dot_image(images));
    					}
    				}
    			})
            }else{
                $('.alertuserphone').show();
                $('.footinfo').hide();
            }
		})

		$.weui = {};  
		$.weui.alert = function(options){  
		  	options = $.extend({title: '警告', text: '警告内容'}, options);  
		  	var $alert = $('.weui_dialog_alert');  
		  	$alert.find('.weui_dialog_title').text(options.title);  
		  	$alert.find('.weui_dialog_bd').text(options.text);  
		  	$alert.on('touchend click', '.weui_btn_dialog', function(){  
		    	$alert.hide();  
		  	});  
		  	$alert.show();  
		};  
		
		$(function () {  
			// 允许上传的图片类型  
			var allowTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];  
			// 图片最大宽度  
			var maxWidth = 300;  
			// 最大上传图片数量  
			var maxCount = 5;  
			$('.alertordername').on('change','.js_file', function (event) {  
			    var files = event.target.files;  
			               
			      // 如果没有选中文件，直接返回  
			      if (files.length === 0) {  
			        return;  
			      }  
			      
			    for (var i = 0, len = files.length; i < len; i++) {  
			        var file = files[i];  
			        var reader = new FileReader();  
			        // 如果类型不在允许的类型范围内  
			        if (allowTypes.indexOf(file.type) === -1) {  
			            $.weui.alert({text: '请上传图片'});  
			            continue;  
			        }  
			          
			        if (file.size > 10485760) {  
			            $.weui.alert({text: '图片太大，不允许上传'});  
			            continue;  
			        }  
			          
			        if ($('.weui_uploader_file').length >= maxCount) {   
			            return;  
			        }  

			        
			        reader.onload = function (e) {  
			            var img = new Image(); 
			            img.onload = function () {
			                // 不要超出最大宽度  
			                var w = Math.min(maxWidth, img.width);  
			                // 高度按比例计算  
			                var h = img.height * (w / img.width);  
			                var canvas = document.createElement('canvas');  
			                var ctx = canvas.getContext('2d');  
			                // 设置 canvas 的宽度和高度  
			                canvas.width = w;  
			                canvas.height = h;  
			                ctx.drawImage(img, 0, 0, w, h);  
			                var base64 = canvas.toDataURL('image/png');  
			                
			                $.post('/com/uploadbid_images.php', {image: base64,id:chooseid,userid:user.userid,orderid:orderid}, function(data) {
			                	if(data){
					                // 插入到预览区   
					                var $preview = $('<li class="weui_uploader_file" id="onloaded" style="background-image:url(' + base64 + ')"></li>');
					                $('.weui_uploader_files').append($preview);   
			                		$('#onloaded').attr('id',data);
			                	}else{
			                		alert('已停止报价!');
			                	}
			                });

	                    };  
			                    
	                    img.src = e.target.result; 
	                };  

	                reader.readAsDataURL(file);  
	            }  
			});  
		});  

		$('.closealert').click(function(){
            $('.alertordername').hide();
			$('.footinfo').show();
		})

        $('.closealertphone').click(function(){
            $('.alertuserphone').hide();
            $('.footinfo').show();
        })

        

		$('.alertordername').on("click", "li", function(){
		    imageid = this.id;
		    $('<img>').addClass('topimage').attr('src', './bidimage/'+imageid+'.jpg').appendTo('#topimage');
		    
		    $("#topimage img").on('load', function(){
		        $('#topimage').fadeIn(100);
		        loadcss();
		    });
		});

		$('#topimage').on('click','.deletes',function(){
            var edit = confirm('确定要删除吗？');
            if(edit){
    			$('#topimage').fadeOut(100);
    			$('.topimage').remove();
    			$.post('/com/deletebid_image.php', {imageid: imageid,id:chooseid,userid:user.userid,orderid:orderid}, function(data) {
    				if(data){
    					$('#'+imageid).remove();
    				}
    			});
            }
		})

		function loadcss(){
		    var imagewidth = $('#topimage img').width();
		    var imageheight = $('#topimage img').height();
		
		    var i = imagewidth/imageheight;
		    var j = width/height;
		    var w,h;
		    if(imagewidth>imageheight){
		        if(i>j){
		            w = width;
		            h = imageheight*(width/imagewidth);
		        }else{
		            w = imagewidth*(height/imageheight);
		            h = height;
		        }
		    }else{
		        if(i>j){
		            w = width;
		            h = imageheight*(imagewidth/width);
		        }else{
		            w = imagewidth*(height/imageheight);
		            h = height;
		        }
		    }
		    $('#topimage img').css({"height":h+'px',"width":w+'px',"margin-top": -(h/2)+'px',"margin-left": -(w/2)+'px',"top": "50%", "left": "50%"});
		}

		// 清空
		$('.order_name_button_reset').click(function(){
		    $('#alert_price').val('');
		    $('#alert_number').val('');
		})

        $('.phone_button_reset').click(function(){
            $('#alert_phone').val('');
        })

        

		$('#topimage').on('click','.topimage',function(){
			$('#topimage').hide();
			$('.topimage').remove();
		})


        function firstimage(imageid){
            if(imageid){
                var a = imageid.split(',');
                return a[0];
            }else{
                return '0';
            }
        }

        $('#show').on('click','.onedatainfo',function(){
            if(ismyorder || ismygrouporder){
                var that = $(this);
                that.find('.bid_number').hide();
                if(that.parent().hasClass('on')){
                    that.parent().removeClass('on');
                    $('#show .row4').css('height','0');
                    $('#show .row4').hide();
                }else{
                    var bidorder = that.parent().find('.bids').length;
                    var workingid = that.parent().attr('id');
                    that.siblings().find('.row4').css('height','0');
                    $('#show .row4').hide();
                    $('#show .onedata').removeClass('on');
                    that.parent().addClass('on');
                    if(bidorder){
                        that.parent().find('.row4').animate({'height':bidorder*110});
                        that.parent().find('.row4').show();
                    }else{
                        loadbidorder(workingid,that);
                    }
                }
            }
        })

        function loadbidorder(bidorderid,that){
            $.getJSON('/com/search_upbidorder.php',{id:bidorderid,userid:user.userid,orderid:orderid},function(json){
                if(json){
                    that.parent().find('.row4').animate({'height':json.length*110});
                    $('.on .row4').html(dot_bids(json));
                    that.parent().find('.row4').show();
                }
            })
        }


        $('#show').on('click','.bid',function(){
            var edit = confirm('确定中标此单？');
            if(!edit) return;
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            $.getJSON('/com/bid_order_deal.php',{id:id,orderid:orderid,supplierid:supplierid},function(data){
                if(data){
                    that.html('付定金');
                    that.parent().attr('state','2');
                    that.addClass('paydeposit');
                    that.removeClass('bid');
                    that.next().removeClass('delete');
                    that.next().addClass('payfullamount');
                    that.next().html('付全款');
                    that.parents('.onedata').find('.onedatainfo_name').css('color','#bb3d00');
                }
            })
        })

        $('#show').on('click','.paydeposit',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            var name = that.parents('.onedata').find('.onedatainfo_name').html();
            var topay = confirm('确定要付定金吗？');
            if(topay) window.location = "./goodspay.php?tree_order_id="+id+"&tender_userid="+user.userid+"&bid_userid="+supplierid+"&name="+name+"&way=1";
        })

        $('#show').on('click','.payfullamount',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            var name = that.parents('.onedata').find('.onedatainfo_name').html();
            var topay = confirm('确定要付全款吗？');
            if(topay) window.location = "./goodspay.php?tree_order_id="+id+"&tender_userid="+user.userid+"&bid_userid="+supplierid+"&name="+name+"&way=2";
        })

        $('#show').on('click','.receipt',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            var topay = confirm('您的苗木款将支付给乙方，确定要收货？');
            if(topay){
                $.getJSON('/com/receipttree.php',{bid_userid:supplierid,tree_order_id:id},function(result){
                    if(result){                            
                        that.html('交易完成');
                        that.parent().attr('state','5');
                        that.addClass('over');
                        that.removeClass('receipt');                         
                        that.next().remove();
                        alert('收货成功！苗款将转给乙方');  
                    }
                })
            }
        })

        $('#show').on('click','.consult',function(){
            if(ismygrouporder) return;
            alert('请耐心等待处理结果！'); 
        })

        
        $('#show').on('click','.refund',function(){
            if(ismygrouporder) return;
            var topay = confirm('您将终止交易，退还定金需经过投标人同意，您确定要退定金？');
            if(topay){
                refund = $(this);                
                $('.footinfo').hide();
                $('.alertstop').fadeIn();
                $('#remark').focus();
            }
        })

        $('#show').on('click','.notreceipt',function(){
            if(ismygrouporder) return;
            var topay = confirm('您将拒绝收货？');
            if(topay){
                notreceipt = $(this);
                $('.footinfo').hide();
                $('.alertstop').fadeIn();
                $('#remark').focus();
            }
        })

        $('.resets').click(function(){
            refund = '';
            notreceipt = '';
            $('#remark').val('');
            $('.alertstop').fadeOut();
            $('.footinfo').show();
        })

        $('.uploads').click(function(){
            if(refund){
                var supplierid = refund.parents('.bids').data('userid');
                var id = refund.parents('.onedata').attr('id');  
                var remark = $('#remark').val();

                $.getJSON('/com/orders_stop.php',{bid_userid:supplierid,tree_order_id:id,remark:remark},function(result){
                    if(result){                            
                        refund.html('退定金中');
                        refund.parent().attr('state','7');
                        refund.addClass('consult');
                        refund.removeClass('notreceipt'); 
                        refund.prev().remove();
                        refund = '';
                        alert('请耐心等待处理结果！');                            
                    }
                })
            }else{
                var supplierid = notreceipt.parents('.bids').data('userid');
                var id = notreceipt.parents('.onedata').attr('id');  
                var remark = $('#remark').val();

                $.getJSON('/com/notreceipttree.php',{bid_userid:supplierid,tree_order_id:id,remark:remark},function(result){
                    if(result){                            
                        notreceipt.html('正在协商');
                        notreceipt.parent().attr('state','6');
                        notreceipt.addClass('consult');
                        notreceipt.removeClass('notreceipt'); 
                        notreceipt.prev().remove();
                        notreceipt = '';
                        alert('请耐心等待处理结果！');                            
                    }
                })
            }
            $('.alertstop').hide();
            $('#remark').val('');
            $('.footinfo').show();
                
        })

        // 成为供应商
        $('#show').on('click','.supplier',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var state = that.parent().attr('state');
            var supplierid = that.parents('.bids').data('userid');

            $.getJSON('/com/tobe_mysupplier.php',{userid:user.userid,supplierid:supplierid,state:'null'},function(data){
                if(data){
                    $('.bids').each(function() {
                        if($(this).data('userid') == supplierid){
                            $(this).find('.supplier').html('中标');
                            $(this).find('.supplier').parent().attr('state','1');
                            $(this).find('.supplier').addClass('bid');
                            $(this).find('.supplier').removeClass('supplier');
                        }
                    });
                }
            })
        })

        // 删除
        $('#show').on('click','.delete',function(){
            var edit = confirm('确定要删除吗？');
            if(edit){
                if(ismygrouporder) return false;
                var that = $(this);
                var deleteid = that.parents('.bids').data('userid');
                var id = that.parents('.onedata').attr('id');
                $.getJSON('/com/bid_order_delete.php',{userid:deleteid,id:id,orderid:orderid},function(data){
                    if(data){
                        var bidorder = that.parents('.row4').find('.bids').length-1;
                        if(bidorder){
                            that.parents('.row4').animate({'height':bidorder*110});
                        }else{
                            that.parents('.row4').remove();
                        } 
                        that.parents('.bids').remove();
                        
                    }
                })
            }
        })

        $('#show').on('click','.image',function(){
            var imagestring = $(this).data('image');
            if(imagestring){
                if(imagestring.length > 15){
                    imagestring = imagestring.split(',');
                    for (var i = 0; i < imagestring.length; i++) {
                        $('<img>').addClass('bigimage').attr('src','./bidimage/'+imagestring[i]+'.jpg').appendTo('#bigimages');
                    }
                }else{
                    $('<img>').addClass('bigimage').attr('src','./bidimage/'+imagestring+'.jpg').appendTo('#bigimages');
                }
                $('#bigimages').show();
            }
        })

        $('#bigimages').click(function(){
            $('#bigimages').hide();
            $('#bigimages').html('');
        })

        $('.uploadtenderimage').click(function(){
            if(user.subscribe != 1){
                var edit = confirm('请先关注找树网');
                if(edit == true){
                    $('<img>').addClass('biglogo').attr('src','./img/wx8.jpg').appendTo('#bigimages');
                    $('#bigimages').show();
                }
            }else{
                window.location = "/yusuanphone.php#current_order";
            }
        })

        $('.addwexin').click(function(){
            $('<img>').addClass('biglogo').attr('src','./img/w3r.jpg').appendTo('#bigimages');
            $('#bigimages').show();
        })

        $('.xkshirley').click(function(){
            $('<img>').addClass('biglogo').attr('src','./permissionqrcode/'+qrcodeid+'.jpg').appendTo('#bigimages');
            $('#bigimages').show();
        })



	</script>

</body>