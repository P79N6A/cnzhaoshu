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
<link rel="stylesheet" href="css/weui.min.css"/>
<title>招投标</title>
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
        width: 96%;
        padding: 5px 0;
        margin: 5px 2% 0;
        background: #fff;
        border-radius: 5px;
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
    .alertuserphone{
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
    .alertordername{
        z-index:100;
        position:fixed;
        bottom:0;
        left:0%;
        width:100%;
        height:300px;
        border-radius:5px;
        border-top:solid 2px #aaa;
        background-color:#fff;
        display:none;
        box-shadow: 0 0 10px #666;
    }
    .inputinfo{
        width:96%;
        height:100%;
        overflow-y: auto;
        float: left;
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
        border: 2px solid #ddd;
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
    	border-left:2px solid #ddd;
    	width:50%;
    	left:50%;
    	position: absolute;
    	height:60%;
    	top:20%
    }
    .lines{
    	border-bottom:2px solid #ddd;
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
    	width:15%;
    	float: left;
        padding-left: 10%;
    	font-size: 35px;
        text-align: center;
        height:44px;
        line-height: 44px;
        color:#1AAD19;
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
        display: none;
    }
    .bids{
        width:100%;
        float:left;
        padding:4px 0 4px;
        border-top:1px dashed #eee;
    }
    .image{
        width:55%;
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
        width:41%;
        margin:0 1%;
        float:left;
    }
    .bidinfo_phone{
        width:100%;
        line-height: 30px;
        float:left;
    }
    .button{
        width:100%;
        float:left;
    }
    .bidinfo_name{
        width:100%;
        line-height: 20px;
        float:left;
        font-size: 15px;
    }
    .supplier,.paydeposit,.payfullamount,.receipt,.refund,.bid,.notreceipt,.over,.consult,.overreceipt,.delete,.agree,.disagree,.bid_content_evaluate{
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
    .title{
        width: 40%;
        padding: 10px 5% 2px;
        text-align: center;
        font-size: 18px;
        height: 25px;
        line-height: 25px;
        float: left;
        margin-left: 25%;
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
    .evaluate_content{
        height:370px;
        width:96%; 
        margin:0 auto;
        z-index: 1100;
        top:0;
        left: 0;
        background: #fff;
        position: fixed;
        display: none;
        padding: 10px 2%;
    }
    .evaluate_content h3{
        line-height: 40px;
        height: 40px;
        text-align: center;
        background: #f8f8f8;
        font-size: 20px;
        color: #666;
    }
    .evaluate_contents{
        padding-top:10px;
        height:220px;
    }
    .evaluate_row1_stars{
        width:100%;
        float: left;
    }
    #evaluate_upload{
        width: 25%;
        height: 40px;
        border-radius: 5px;
        background: #1AAD19;
        text-align: center;
        line-height: 40px;
        float: left;
        margin-left: 14%;
        color: #fff;
    }
    #evaluate_reset{
        width: 25%;
        height: 40px;
        border-radius: 5px;
        background: #1AAD19;
        text-align: center;
        line-height: 40px;
        float: left;
        margin-left: 18%;
        color: #fff;
    }
    .star_l{
        float:left;
        width:25%;
    }
    .evaluate_row1_starsshow{
        float:left;
        width:60%;
        min-width: 130px;
    }
    #evaluate_text{
        resize: none;
        border: solid 1px #ccc;
        height:130px;
        width:90%;
        padding: 10px 4%;
        font-size: 15px;
        margin: 10px 0;
        border-radius: 5px;
        float: left;
    }
    .showstar{
        width:24px;
        height:24px;
        float: left;
        background-image:url(./img/star.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .starover{
        width:24px;
        height:24px;
        float: left;
        background-image:url(./img/overstar.gif);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    #homeindex{
        z-index: 10;
        position: fixed;
        left: 5px;
        top: 1px;
        width: 38px;
        height: 38px;
        background-image:url(./img/fanhui.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 38px;
        border:2px solid #fff;
    }
    #mark{
        width:70%;
        height:60px;
        margin:2px 20% 2px 10%;
        padding: 4px;
        border-radius: 3px;
        float: left;
        font-size: 16px;
        line-height: 1.3;
        border: 1px solid #888;
        resize: none;
    }
    #uploading{
        display: none; 
        position: fixed; 
        top: 0; 
        width: 100%;
        height: 55px; 
        background-color: red;
        color: #fff; 
        line-height: 55px; 
        text-align: center;
        z-index: 1000;
    }
    .weui-uploader__input-box, .weui-uploader__file{
        float: none;
        display: inline-block;
    }
    #images li{
        float: left;
        margin-right: 9px;
        margin-bottom: 9px;
        width: 79px;
        height: 79px;
        background: no-repeat center center;
        background-size: cover;
    }
</style>

</head>
<body>
    <div class="evaluate_content">
        <h3>我要评论</h3>
        <div class="evaluate_contents">
            <div class="evaluate_row1_stars">
                <span class="star_l">满意度：</span>
                <div class="evaluate_row1_starsshow">
                    <div class="showstar star1" state="1"></div>
                    <div class="showstar star2" state="2"></div>
                    <div class="showstar star3" state="3"></div>
                    <div class="showstar star4" state="4"></div>
                    <div class="showstar star5" state="5"></div>
                </div>
            </div>                        
            <textarea id="evaluate_text" placeholder="填写您的评价(不得超过250字)" type="text" maxlength="250"></textarea>
        </div>
        <div id="evaluate_reset">取消</div>       
        <div id="evaluate_upload">提交</div>       
    </div>
    <div class="head">
       <div id="homeindex">
       </div>
	   <div class="title"></div>
	   <div id="getexcel">导出</div>
       <div id="title"></div>
    </div>
	<div id="show"></div>
	<div class="alertordername">
        <div class="inputinfo">
            <div class="alertrow1"><div class="alert_head">填写报价信息</div><div class="closealert" style="">×</div></div>
            <div class="alertinput">
                <div id="username"></div>
                <div class="alerttitle">数量:</div><input type="number" id="alert_number" class="alertcontent" placeholder="请输入数量">
                <div class="alerttitle">价格:</div><input type="number" id="alert_price" class="alertcontent" placeholder="请输入价格">
            </div>
            <textarea id="mark" placeholder="可填写备注" type="text" maxlength="250"></textarea>
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
                            <div class="weui_uploader_input js_file uploadphoto"></div>
                        </div>
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
    <div id="uploading">正在上传，请勿退出！</div>

    <div class="weui-gallery" id="gallery">
        <span class="weui-gallery__img" id="galleryImg"></span>
        <div class="weui-gallery__opr">
            <a href="javascript:;" class="weui-gallery__del">
                <i class="weui-icon-delete weui-icon_gallery-delete"></i>
            </a>
        </div>
    </div>

    <div class="js_dialog" id="iosDialog1" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">删除确认</strong></div>
            <div class="weui-dialog__bd"></div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
            </div>
        </div>
    </div>

	<script id="dot_show" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="onedata" id="{{=it[i].id}}">
                <div class="onedatainfo">
	        		<div class="row0" style="{{=hastreeid(it[i].id)}}">编号: {{=it[i].id}}</div>
                    <div class="row1">
                        <div class="numberorder">{{=addone(i)}}</div>
                        <div class="onedatainfo_name">{{=it[i].name}}</div>
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
			<li class="weui_uploader_file" id="{{=it[i]}}" style="background-image:url('tenderphoto/m/{{=it[i]}}.jpg')";
			</li>
	    {{ } }}
	</script>
    <script id="dot_bids" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="bids" data-userid="{{=it[i].userid}}">
                <div class="image" data-image="{{=it[i].image}}" style="background-image: url('tenderphoto/m/{{=firstimage(it[i].image)}}.jpg')"></div>
                <div class="bidinfo">
                    <div class="bidinfo_name">{{=it[i].city ? it[i].username+'('+it[i].city+')' : it[i].username}}</div>
                    <a href="tel:{{=it[i].phone}}" class="bidinfo_phone">{{=it[i].phone}}</a>   
                </div>
                <div class="button">
                    <div class="bidinfo_name">备注：{{=(it[i].mark) ? it[i].mark : ''}}</div>
                    <div class="bidinfo_name">单价：{{=(it[i].price/100)}}元&nbsp;&nbsp;&nbsp;&nbsp;数量：{{=it[i].number}}{{=it[i].unit}}</div>
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
                    {{= (it[i].state == 4) ? '<div class="refund">申请退定金</div>' : ''}}
                    {{= (it[i].state == 6) ? '<div class="over">等待买方确认</div>' : ''}}
                    {{= (it[i].state == 8) ? '<div class="agree">同意</div><div class="disagree">不同意</div>' : ''}}
                    {{= ((it[i].state == 9) || (it[i].state == 2)) ? '<div class="payfullamount">付全款</div>' : ''}}
                    {{= (it[i].state == 10) ? '<div class="over">等待发货</div>' : ''}}
                    {{= (it[i].state == 12) ? '<div class="receipt">收货</div><div class="notreceipt">拒收货</div>' : ''}}
                    {{= (it[i].state == 16) ? '<div class="over">正在协商</div>' : ''}}
                    {{= (it[i].state == 18) ? '<div class="over">交易完成</div>' : ''}}
                    {{=(it[i].is_evaluate) ? '' : '<div class="bid_content_evaluate">评论</div>'}}
                </div>
            </div>
        {{ } }}
    </script>

	<script src="./js/jquery-3.1.0.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
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
        var evaluatebutton;
        var starnumber;
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }

        $('#homeindex').click(function(){
            window.location = './yusuanphone.php#tender';
        })

        $('.evaluate_content').css('height',height+'px');
        $('#bigimages').css('height',height+'px');
        
		function urlRequest(name) {
	        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
	        return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
	    }

        var qrcodeid = urlRequest("id");
	    var sendtreeid = urlRequest("treeid");

        function hastreeid(treeid){
            if(sendtreeid == treeid){
                return 'color:#bb3d00';
            }
        }

		$.getJSON('/com/search_qrcodeorder.php',{qrcodeid:qrcodeid,userid:user.userid},function(json){

            if(json['orderinfo']){
                orderid=json['orderinfo'][0].orderid;
                ismyorder = json['ismyorder'];
                ismygrouporder = json['ismygrouporder'];
                if(json['orderinfo'][0].orderid){
                    $('#show').html(dot_show(json['orderinfo']));
                    if(ismyorder){
                        $('#show').css('height',(height-90)+'px');
                        $('#show').css('top','43px');
                        $('.title').html('选标');
                        $('#title').css('font-size','20px');
                        $('.bid_number').show();
                        $('#getexcel').show();
                    }else if(ismygrouporder){
                        orderuserid = json['orderuserid'];
                        $('#show').css('height',(height-90)+'px');
                        $('#show').css('top','43px');
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
            var n = $('#images li').length;
		    var data = {};
            var price = $('#alert_price').val();
            var number = $('#alert_number').val();
            var mark = $('#mark').val();
            if(price && number && n){
        	    data.price = price*100;
        	    data.number = number;
                data.id = chooseid;
        	    data.mark = mark;
    		    $.getJSON('/com/input_bidinfo.php',{orderid:orderid,data:JSON.stringify(data),userid:user.userid},function(result){
                    $('.alertordername').hide();
                    $('.footinfo').show();
                    if(result){
                        thisbutton.html('已报价');
                        thisbutton.attr('class','onedatainfo_button button1');
                    }else{
                        alert('已停止报价!');
                    }
    		    })
            }else{
                alert('数量，价格，图片为必填项!');
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
    			$('#mark').val('');
    			$('#images').html('');
    		    thisbutton = $(this);
    			chooseid = $(this).parents('.onedata').attr('id');
    			$.getJSON('/com/search_mybid_orderinfo.php',{orderid:orderid,id:chooseid,userid:user.userid},function(json){
    				if(json){
    					if(json.price) $('#alert_price').val(json.price/100);
                        if(json.number) $('#alert_number').val(json.number);
    					if(json.mark) $('#mark').val(json.mark);
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
                    $('#show .row4').hide();
                    $('#show .row4').hide();
                }else{
                    var bidorder = that.parent().find('.bids').length;
                    var workingid = that.parent().attr('id');
                    that.siblings().find('.row4').hide();
                    $('#show .row4').hide();
                    $('#show .onedata').removeClass('on');
                    that.parent().addClass('on');
                    if(bidorder){
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
                    that.parent().find('.row4').show();
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

        $('#show').on('click','.bid_content_evaluate',function(){
            if(ismygrouporder) return;
            $('.evaluate_content').show();
            evaluatebutton = $(this);
        })

        $('.showstar').click(function(){
            var starsn = $(this).attr('state');
            $('.starover').removeClass('starover');
            starsn = parseInt(starsn);
            starnumber = 0;
            for (var i = 0; i < starsn; i++) {
                starnumber = 1+i;
                $('.star'+starnumber).addClass('starover');
            }
        })

        $('#evaluate_upload').click(function(){
            if(starnumber > 0){
                var evaluate_text = $('#evaluate_text').val();
                var userid = evaluatebutton.parents('.bids').data('userid');
                var id = evaluatebutton.parents('.onedata').attr('id');
                $.getJSON('/com/shop_evaluate.php',{evaluate:evaluate_text,treeuserid:userid,userid:user.userid,starnumber:starnumber,id:id},function(result){
                    if(result){
                        $('#evaluate_text').val('');
                        starnumber = 0;
                        $('.evaluate_content').hide();
                        $('.starover').removeClass('starover');
                        evaluatebutton.remove();
                        alert('评价成功！');
                    }else{
                        alert('评价失败！');
                    }
                })
            }else{
                alert('请选择您的满意度！');
            }
        })

        $('#evaluate_reset').click(function(){
            $('#evaluate_text').val('');
            starnumber = 0;
            $('.evaluate_content').hide();
            $('.starover').removeClass('starover');
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
                $.getJSON('/wxpay/example/orders_payfull.php',{bid_userid:supplierid,tree_order_id:id,userid:user.userid,qrcodeid:qrcodeid},function(result){
                    if(result){                            
                        that.html('交易完成');
                        that.addClass('over');
                        that.removeClass('receipt');
                        that.siblings('.notreceipt').remove();
                    }
                })
            }
        })

        $('#show').on('click','.agree',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            var topay = confirm('确定支付定金！');
            if(topay){
                $.get('/wxpay/example/orders_agreepaydesite.php',{userid:user.userid,bid_userid:supplierid,tree_order_id:id},function(result){
                    if(result){                            
                        that.html('付全款');
                        that.addClass('payfullamount');
                        that.removeClass('agree');                         
                        that.siblings('.disagree').remove();
                    }
                })
            }
        })

        $('#show').on('click','.disagree',function(){
            if(ismygrouporder) return;
            var that = $(this);
            var supplierid = that.parents('.bids').data('userid');
            var id = that.parents('.onedata').attr('id');
            var topay = confirm('您确定不支付卖方定金，终止订单？');
            if(topay){
                $.get('/com/orders_disagreerefund.php',{userid:supplierid,id:id},function(result){
                    if(result){                            
                        that.html('正在协商');
                        that.addClass('over');
                        that.removeClass('disagree');                         
                        that.siblings('.agree').remove();
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
                        refund.html('正在协商');
                        refund.addClass('over');
                        refund.removeClass('refund');                            
                    }
                    refund = '';
                })
            }else if(notreceipt){
                var supplierid = notreceipt.parents('.bids').data('userid');
                var id = notreceipt.parents('.onedata').attr('id');  
                var remark = $('#remark').val();

                $.getJSON('/com/notreceipttree.php',{bid_userid:supplierid,tree_order_id:id,remark:remark},function(result){
                    if(result){                            
                        notreceipt.html('正在协商');
                        notreceipt.addClass('over');
                        notreceipt.removeClass('notreceipt'); 
                        notreceipt.siblings('.receipt').remove();                          
                    }
                    notreceipt = '';
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
                        $('<img>').addClass('bigimage').attr('src','tenderphoto/o/'+imagestring[i]+'.jpg').appendTo('#bigimages');
                    }
                }else{
                    $('<img>').addClass('bigimage').attr('src','tenderphoto/o/'+imagestring+'.jpg').appendTo('#bigimages');
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

        $('.uploadphoto').on('click', function () {
            uploadIndex = 0;
            // 选择图片
            wx.chooseImage({
                sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'],// 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    $('#uploading').show();
                    localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    // 预览图片
                    for(var i in localIds){
                        $images.append($(tmpl.replace('#id#',i).replace('#url#', localIds[i])));                
                    }
                    // 逐一上传图片
                    uploadImage(0);                
                }
            });
        });

        // 微信上传
        function uploadImage(i) {
            wx.uploadImage({
                localId: localIds[i],
                isShowProgressTips: 1,
                success: function (res) {
                    // 服务器端处理
                    $.post('com/uploadbid_images.php',{id:chooseid,userid:user.userid,orderid:orderid,mediaId: res.serverId,index: i},function (result){
                            result = result.split('-');
                            $('#upload'+parseInt(result[0])).html('').css('background-image', 'url(tenderphoto/m/'+result[1]+'.jpg)').attr('id',result[1]);
                    });
                    uploadIndex++;
                    if (uploadIndex < localIds.length) {
                        uploadImage(uploadIndex);
                    } else {
                        $('#uploading').hide();
                    }
                }
            });
        }

        // 延迟加载
        setTimeout(function() {
            if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
                function setWechatJSSDK(res){
                    wx.config({
                        debug: false,
                        appId: res.appId,
                        timestamp: res.timestamp,
                        nonceStr: res.nonceStr,
                        signature: res.signature,
                        jsApiList: [
                            'hideMenuItems',
                            'chooseImage',
                            'uploadImage',
                            'scanQRCode'
                        ]
                    });
                    wx.ready(function () {
                        wx.hideMenuItems({
                            menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                        });
                    });
                }
                function loadWechatJSSDK() {
                    $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
                        setWechatJSSDK(res);
                    });
                }
                loadWechatJSSDK();
            } 
        },10);

        var uploadIndex, uploadData,localIds;

        var tmpl2 = '<li id="#id#" class="weui-uploader__file" style="background-image:url(#url#)"></li>',
            tmpl = '<li id="upload#id#" class="weui-uploader__file"><img style="width:100%;height:100%;opacity:0.6" src="#url#"></li>',
            tmpl1 = '<li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(#url#)"><div id="progress#id#" class="weui-uploader__file-content" style="display:none">1%</div></li>',
            $gallery = $("#gallery"), 
            $galleryImg = $("#galleryImg"),
            $images = $("#images");

        $images.on("click", "li", function(){
            $('#iosDialog1 .weui-dialog__bd').html('您确定要删除当前照片？');
            $('#iosDialog1 .weui-dialog__btn_primary').attr('href', 'javascript:deletePhoto()');

            var img = this.getAttribute("style");
            if (img.length<100) {
                img = img.replace('/m/', '/o/');
            }
            $galleryImg.attr("style", img);
            $gallery.data('id', this.id).fadeIn(100);
        });

        $('#iosDialog1').on("click", '.weui-dialog__btn_default', function(){
            $('#iosDialog1').fadeOut(100);
        });

        $gallery.on("click", '.weui-gallery__del', function(){
            $('#iosDialog1').fadeIn(200);
        });

        $gallery.on("click", 'span', function(){
            $gallery.fadeOut(100);
            $galleryImg.attr("style", '');
        });

        function deletePhoto() {
            var id = $gallery.fadeOut(100).data('id');
            $('#'+id).remove();
            $.post('/com/uploadbid_images_delete.php', {imageid: id,id:chooseid,userid:user.userid,orderid:orderid}, function(result){
                $gallery.fadeOut(100);
                $galleryImg.attr("style", '');
                $('#iosDialog1').fadeOut(200);
            });
        } 
	</script>
</body>
