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
<link rel="stylesheet" href="./css/weui.min.css"/>
<title>招标大厅</title>
<style type="text/css">
    body{
        margin: 0;  
        padding:0;  
        border: 0;  
        font: inherit;  
        font-size: 100%;  
        vertical-align: baseline;  
    }
    .head{
        position: fixed;
        z-index: 20;
        width: 100%;
        background: #fff;
        padding: 5px 0 5px;
    }
    #showallorders{
        float: left;
        width: 100%;
        position: absolute;
        top:53px;
        overflow-y: auto;
        -webkit-overflow-scrolling:touch;
    }
    .showone{
        float: left;
        width:96%;
        border-top: 1px solid #eee;
        padding:3px 2%;
    }
    .showone_title{
        width:100%;
        float: left;
    }
    .name{
        width:100%;
        float: left;
        line-height: 27px;
        overflow: hidden;
    }
    .time{
        width:100%;
        float: left;
        line-height: 17px;
    }
    .ordersinfo{
        float: left;
        margin-top: 5px;
        width:100%;
        font-size: 14px;
        max-height: 300px;
        overflow-y: auto;
    }
    .onedata{
        float: left;
        width:100%;
        border-bottom: 1px solid #eee;
        padding:5px 0;
    }
    .onedatainfo{
        width:100%;
        float: left;
    }
    .row1{
        float: left;
        width:94%;
        padding: 2px 2% 2px 4%;
    }
    .numberorder{
        width:8%;
        margin-left: 2%;
        float: left;
        line-height: 30px;
    }
    .onedatainfo_name{
        width:35%;
        float: left;
        line-height: 30px;
        font-size: 18px;
    }
    .onedatainfo_number{
        width:35%;
        float: left;
        line-height: 30px;
        font-size: 14px;
    }
    .row2{
        float: left;
        width:94%;
        padding: 0 2% 0 4%;
        line-height: 18px;
        font-size: 15px;
    }
    .row4{
        float: left;
        width:94%;
        padding: 0 2% 0 4%;
        line-height: 18px;
        font-size: 15px;
    }
    .row5{
        float: left;
        width:92%;
        margin: 2px 4%;
        padding: 3px 0;
        line-height: 15px;
        font-size: 13px;
        background-color:#eee;
        display: none;
    }
    .row51{
        width:96%;
        padding:0 2%;
        float: left;
    }
    .row52{
        width:58%;
        padding-left:2%;
        float: left;
    }
    .row53{
        width:40%;
        float: left;
        color:blue;
    }
    .row3{
        float: left;
        width:94%;
        padding: 0 2% 0 4%;
        font-size: 15px;
        color:#999;
    }
    .button2{
        width:25%;
        float:left;
        padding:4px 1%;
        font-size: 15px;
        border-radius:4px;
        background:#1AAD19;
        color:#fff;
        text-align: center;
    }
    .button1{
        width:25%;
        float:left;
        padding:4px 1%;
        font-size: 15px;
        border-radius:4px;
        background:#E64340;
        color:#fff;
        text-align: center;
    }
    .alertordername,#alertuserphone {
        z-index:1000;
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
        width:58%;
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
    .delete{
        width:94%;
        position: absolute;
        margin: 0 3%;
        bottom: 5px;
        height:40px;
        line-height: 40px;
        border-radius: 5px;
        float: left;
        text-align: center;
        background:#E64340;
        color:#fff;
        z-index: 1001;
        font-size: 20px;
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
        width:100%;
    }
    #username{
        float:left;
        width:85%;
        padding-left: 10%;
        overflow: hidden;
    }
    .row31{
        float: left;
        width: 70%;
        line-height: 30px;
    }
    .row32{
        float: left;
        width: 26%;
    }
    #titelinput{
        float: left;
        width: 70%;
        margin-left: 2%;
        height: 38px;
        font-size: 15px;
        padding: 1px 2%;
        border: 0;
        border-radius: 9px;
    }
    .titelsearch{
        float: right;
        width: 20%;
        height: 40px;
        line-height: 40px;
        background: #fff;
        color:#1AAD19;
        text-align: center;
        border-radius: 10px;
        font-size: 15px;
    }
    #subscribe{
        float: left;
        width: 23%;
        height: 39px;
        line-height: 39px;
        color: #999;
        text-align: center;
        border-radius: 9px;
        font-size: 11px;
        margin-left: 2%;      
    }
    .titel{
        float: right;
        border: 1px solid #999;
        width: 67%;
        margin-right: 4%;
        border-radius: 9px;
    }
    .alertinput{
        float: left;
        width: 100%;
    }
    .buttonbottom{
        float: left;
        width: 100%;
    }
    .pz_down {
        float: left;
        width: 100%;
    }
    .h_0100_1 {
        float: left;
        width: 100%;
        background: #fff;
        border-top: 1px solid #d4d4d4;
        position: fixed;
        left: 0;
        bottom: 0;
    }
    .h_0100_1 ul {
        float: left;
        width: 100%;
        padding: 8px 0;
    }
    ul {
        display: block;
        list-style-type: disc;
        -webkit-margin-before: 1em;
        -webkit-margin-after: 1em;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-padding-start: 0px;
    }
    a, p, ul, li {
        text-decoration: none;
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
    .h_0100_1 ul li {
        float: left;
        width: 20%;
        text-align: center;
    }
    .nav_1 {
        float: left;
        width: 100%;
        height: 20px;
        background: url(images/h_img1.png) center no-repeat;
        background-size: 20px 20px;
    }
    i, cite, em, var, address, dfn {
        font-style: italic;
    }
    .h_0100_1 ul li span {
        color: #666666;
        font-size: 14px;
    }
    a {
        text-decoration: none;
        color: #636363;
    }
    .nav_5 {
        float: left;
        width: 100%;
        height: 20px;
        background: url(images/h_img5.png) center no-repeat;
        background-size: 20px 20px;
    }
    .nav_3 {
        float: left;
        width: 100%;
        height: 20px;
        background: url(images/h_img3.png) center no-repeat;
        background-size: 20px 20px;
    }
    .nav_2 {
        float: left;
        width: 100%;
        height: 20px;
        background: url(images/h_img2.png) center no-repeat;
        background-size: 20px 20px;
    }
    .nav_4 {
        float: left;
        width: 100%;
        height: 20px;
        background: url(images/h_img4.png) center no-repeat;
        background-size: 20px 20px;
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
    .alertinput2{
        float: left;
        width: 100%;
        margin: 20px 0;
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
    .buttonbottom{
        float: left;
        width: 100%;
    }
    .allbidinfo .row5{
        display: block;
    }
    .row41{
        float: left;
        width: 70%;
        font-size: 15px;
    }
    .edit{
        width: 25%;
        float: left;
        padding: 5px 3px;
        font-size: 15px;
        border-radius: 4px;
        background: #1AAD19;
        color: #fff;
        text-align: center;
        display: none;
    }
    .ismanager{
        display: block;
    }
    .notmanager{
        display: none;   
    }
    #attributein{
        z-index:9999;
        position:fixed;
        bottom:0;  
        left: 0;
        right: 0;
        background-color: #eee;
        display: none;
        box-shadow: 0 0 8px;
        border-radius: 5px 5px 0 0;
    }
    #attributein .weui-cell{
        padding: 8px 15px;
    }
    .add,.reset{
        margin:5px 0 5px 23%;
    }
    .working{
        background-color: #ece;
    }
    .show{
        width: 91%;
        margin-left: 2%;
        float: left;
        border: 1px solid #d8d8d8;
        margin-bottom: 10px;
        border-radius: 4px;
        padding: 5px 2%;
        font-size: 16px;
    }
    .showorderdetails{
        z-index: 888;
        position:fixed;
        bottom:0;  
        left: 0;
        right: 0;
        background-color: #fff;
        display: none;
        width:100%;
        padding: 10px 0;
    }
    #hideshow{
        z-index: 889;
        position: fixed;
        left: 8px;
        top: 8px;
        width: 40px;
        height: 40px;
        display: none;
        background-image:url(./img/fanhui.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 40px;
        border:4px solid #fff;

    }
    #showorderdetails{
        width:98%;
        padding-left: 1%;
        overflow-y: auto;
    }
    #detailsordername{
        width: 70%;
        float: left;
        font-size: 20px;
        text-align: center;
        color:#888;
        padding: 5px 15%;
    }
    .showspan{
        font-size: 15px;
    }
    .showspanname{
        font-size: 15px;
        color:#31ad27;
    }
    .showspanaddress,.showspantime,.showspanrate{
        font-size: 14px;
    }
</style>

</head>
<body>
    
    <div class="head">
        <div id="subscribe"></div>
        <div class="titel">
            <input type="text" id="titelinput" placeholder="请输入苗木名称">
            <span class="titelsearch">搜索</span>
        </div>
    </div>
    <div id="showallorders">
        
    </div>
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
    <div id="topimage">
        <div class="delete">删除</div>
    </div>
    <div id="alertuserphone">
        <div class="alertrow1"><div class="alert_head">请填写手机号</div><div class="closealertphone" style="">×</div></div>
        <div class="alertinput2">
            <div class="alerttitle">手机号:</div><input type="number" id="alert_phone" class="alertcontent" placeholder="请输入您的手机号">
        </div>
        <div class="buttonbottom">
            <button type="button" class="phone_button_reset">清空</button>
            <button type="button" id="phone_button">提交</button>
        </div>
    </div> 
    <div class="pz_down">
        <div class="h_0100_1">
            <ul>
                <li>
                    <a href="m.php">
                        <i class="nav_1"></i>
                        <span>首页</span>
                    </a>
                </li>
                <li>
                    <a href="yusuanphone.php">
                        <i class="nav_5"></i>
                        <span>招投标</span>
                    </a>
                </li>               
                <li>
                    <a id="nav_cart" href="cart.php">
                        <i class="nav_3"></i>
                        <span>找树车</span>
                    </a>
                </li>              
                <li>
                    <a id="#" href="zsq.php">
                        <i class="nav_2"></i>
                        <span>找树圈</span>
                    </a>
                </li>              
                <li>
                    <a id="nav_shop" href="shop.php">
                        <i id="headImage" class="nav_4"></i>
                        <span>我的苗店</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="attributein">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">苗木名称:</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" id="name" placeholder="名称"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">数 量(株):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="count" placeholder="10"/>
            </div>
        </div>
        <div id="trunk_diameter1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">胸 径(公分):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="trunk_diameter" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="ground_diameter1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">地 径(公分):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="ground_diameter" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="pot_diameter1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">盆 径(公分):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue2(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="pot_diameter" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="plant_height1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">株 高(米):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="plant_height" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="plant_height_cm1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">株 高(公分):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue4(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="plant_height_cm" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="crown1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">冠 幅(米):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="crown" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="crown_cm1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">冠 幅(公分):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue4(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="crown_cm" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="branch_number1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">分 枝 数(个):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue3(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_number" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="bough_number1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">主 枝 数(个):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue3(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="bough_number" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="branch_length1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">条 长(米):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_length" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="bough_length1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">主蔓(枝)长(米):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="bough_length" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="branch_point_height1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">分枝点高(米):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onblur="value=checkistrue1(value)" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="branch_point_height" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="age1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">苗 龄(年):</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" onkeyup="value=value.replace(/[^\d\.\-\－]/g,'')" onpaste="return false" id="age" placeholder="6或6-8"/>
            </div>
        </div>
        <div id="substrate1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">基 质:</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" id="substrate" placeholder="基质名称"/>
            </div>
        </div>
        <div id="mark1" class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">备注:</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" id="mark" placeholder="备注"/>
            </div>
        </div>
        <div class="buttons">
            <div class="weui-btn weui-btn_mini weui-btn_primary reset">取消</div>
            <div class="weui-btn weui-btn_mini weui-btn_primary add">修改</div>
        </div>
    </div>
    <div class="showorderdetails">
        <div id="showorderdetails">
            <div id="detailsordername"></div>
        </div>
    </div>
    <div id="hideshow"></div>

    <script id="dot_orders" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="show" data-id="{{=it[i].id}}">
                <p><span class="showspan">订单名称：</span><span class="showspanname">{{=it[i].ordername}}</span></p>
                <p><span class="showspan">用苗地点：</span><span class="showspanaddress">{{=it[i].address}}</span></p>
                <p><span class="showspan">招标时间：</span><span class="showspantime">{{=(it[i].time).substr(0,10) +' 至 '+ it[i].expiration_date}}</span></p>
                <p><span class="showspan">用户评分：</span><span class="showspanrate">{{=(it[i].star ? it[i].star/10 : '暂无')}}</span></p>
            </div>
        {{ } }}
    </script>

    <script id="dot_onedata" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="onedata" data-id="{{=it[i].id}}" data-orderid="{{=it[i].orderid}}">
                <div class="row3"><div class="row31">编号: {{=it[i].id}}</div><div class="edit">修改</div></div>
                <div class="row1">
                    <div class="onedatainfo_name">{{=it[i].name}}</div>
                    <div class="onedatainfo_number">{{=it[i].count ? it[i].count : ''}}{{=it[i].unit ? '('+it[i].unit+')' : ''}}</div>
                    <div class="{{=buttonclass(it[i].state)}}">{{=buttonname(it[i].state)}}</div>
                </div>
                <div class="row2">{{=guige(it[i])}}</div>
                <div class="row4">{{= (it[i].mark) ? '备注：'+it[i].mark : ''}}</div>
            </div>
        {{ } }}
    </script>

    <script id="dot_thisdata" type="text/x-dot-template">
        <div class="onedata" data-id="{{=it.id}}" data-orderid="{{=it.orderid}}">
            <div class="row3"><div class="row31">编号: {{=it.id}}</div><div class="edit">修改</div></div>
            <div class="row1">
                <div class="onedatainfo_name">{{=it.name}}</div>
                <div class="onedatainfo_number">{{=it.count ? it.count : ''}}{{=it.unit ? '('+it.unit+')' : ''}}</div>
                <div class="{{=buttonclass(it.state)}}">{{=buttonname(it.state)}}</div>
            </div>
            <div class="row2">{{=guige(it)}}</div>
            <div class="row4">{{= (it.mark) ? '备注：'+it.mark : ''}}</div>
        </div>
        <div class="row4 {{= (it.phone) ? 'ismanager' : 'notmanager'}}">
            <div class="row41">{{= (it.phone) ? '手机号码：'+it.phone : ''}}</div>
        </div>
    </script>

    <script id="dot_image" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <li class="weui_uploader_file" id="{{=it[i]}}" style="background-image:url('../bidimage/{{=it[i]}}.jpg')";
            </li>
        {{ } }}
    </script>
    <script id="dot_allbidinfo" type="text/x-dot-template">
        {{ for(var i in it) { }}
            <div class="row5">
                <div class="row51">投标人： {{=it[i].name}}</div>
                <div class="row52">单价： {{=it[i].price/100}}元</div>
                <a href="tel:{{=it[i].phone}}" class="row53">{{=it[i].phone ? it[i].phone : ''}}</a> 
            </div>
        {{ } }}
    </script>
    <script src="./js/jquery-3.1.0.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="./js/doT.min.js"></script>
    <script type="text/javascript">
        var dot_orders = doT.template($("#dot_orders").text());
        var dot_onedata = doT.template($("#dot_onedata").text());
        var dot_image = doT.template($("#dot_image").text());
        var dot_thisdata = doT.template($("#dot_thisdata").text());
        var dot_allbidinfo = doT.template($("#dot_allbidinfo").text());
        var height = $(window).height();
        var width = $(window).width();
        var imageid;
        var thisbutton;
        var loadingorder_index = false;
        var loadendorder_index = false;
        var countorder;
        var alldate = [];
        var onedata;
        var dictionary = [];

        var tree_order = [];
        $('#showallorders').css('height',(height-110)+'px');
        $('#showorderdetails').css('height',(height-20)+'px');
        $('.showorderdetails').css('height',(height-20)+'px');
        

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        
        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }


        function checkistrue1(value){
            var value1 = value.split('-');
            var value2 = value.split('－');
            if((value1[0] > 20) || (value1[1] > 20)){
                alert('此规格不可超过20米！');
                return '';
            }
            if((value2[0] > 20) || (value2[1] > 20)){
                alert('此规格不可超过20米！');
                return '';
            }
            return value;
        }

        function checkistrue2(value){
            var value1 = value.split('-');
            var value2 = value.split('－');
            if((value1[0] > 100) || (value1[1] > 100)){
                alert('此规格不可超过100公分！');
                return '';
            }
            if((value2[0] > 100) || (value2[1] > 100)){
                alert('此规格不可超过100公分！');
                return '';
            }
            return value;
        }

        function checkistrue3(value){
            var value1 = value.split('-');
            var value2 = value.split('－');
            if((value1[0] > 10) || (value1[1] > 10)){
                alert('此规格不可超过10个！');
                return '';
            }
            if((value2[0] > 10) || (value2[1] > 10)){
                alert('此规格不可超过10个！');
                return '';
            }
            return value;
        }

        function checkistrue4(value){
            var value1 = value.split('-');
            var value2 = value.split('－');
            if((value1[0] > 500) || (value1[1] > 500)){
                alert('此规格不可超过500公分！');
                return '';
            }
            if((value2[0] > 500) || (value2[1] > 500)){
                alert('此规格不可超过500公分！');
                return '';
            }
            return value;
        }

        function loadorders(){
            if(loadingorder_index) return false;
            loadingorder_index = true;
            var limit = $('#showallorders .show').length + ',' + 6;
            $.getJSON('/com/search_tree_order_indexs.php', {limit:limit}, function(json) {
                if(json){
                    $('#showallorders').append(dot_orders(json));
                    for (var i = 0; i < json.length; i++) {
                        tree_order[tree_order.length] = json[i];
                    }
                }else{
                    loadendorder_index = true;
                }
                loadingorder_index = false;
            });
        }

        function buttonclass(name){
            if(user.role == 9 || user.role == 8){
                return 'onedatainfo_button button1';
            }else if(name){
                return 'onedatainfo_button button1';
            }else{
                return 'onedatainfo_button button2';
            }
        }

        function buttonname(name){
            if(user.role == 9 || user.role == 8){
                return '删除';
            }else if(name){
                return '已报价';
            }else{
                return '报价';
            }
        }

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

        function loaddictionary(){
            $.getJSON('/com/dictionary_attribute_search.php',function(json){
                if (json) {
                    dictionary = json;
                }
            });
        }

        function hideattribute(){
            var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate',20:'mark'};
            for (var i = 5; i < 21; i++) {
                $('#'+dictionary_attributes[i]+'1').hide();
            }
        }

        function findname(){
            var name = $('#name').val();
            if(name){
                var json;
                for (var i = 0; i < dictionary.length; i++) {
                    if(dictionary[i].name == name){
                        json = dictionary[i];
                    }
                } 
                var dictionary_attributes = {5:'trunk_diameter',6:'ground_diameter',7:'pot_diameter',8:'age',9:'crown',10:'plant_height',11:'branch_length',12:'bough_length',13:'branch_point_height',14:'branch_number',15:"bough_number",17:'plant_height_cm',18:'crown_cm',19:'substrate',20:'mark'};
                for (var i = 5; i < 21; i++) {
                  $('#'+dictionary_attributes[i]+'1').hide();
                }

                if(!json){
                    $('#name-id').val(name);
                    $('#trunk_diameter1').show();
                    $('#crown1').show();
                    $('#plant_height1').show();
                    $('#mark1').show();
                }else{
                    var attribute = json.attribute;
                    unit = json.unit;
                    typename = json.typename;
                    type = json.type;
                    var attributes = attribute.split(',');
                    for (var z = 0; z < attributes.length; z++) {
                        if(dictionary_attributes[ attributes[z] ]){
                            $('#'+dictionary_attributes[ attributes[z] ]+'1').show();
                        }
                    }
                    $('#mark1').show();
                }
            }
        }

        function join(req){
            if(req){
                var attributeinfo;
                attributeinfo = req.split(',');
                if(attributeinfo[1]){
                    return attributeinfo[0]+'-'+attributeinfo[1];
                }else{
                    return attributeinfo[0];
                }
            }else{
                return '';
            }
        }

        function checkPhone(phone){ 
            if(!(/^1[34578]\d{9}$/.test(phone))){ 
                alert("手机号码有误，请重填");  
                return false; 
            }else{
                return phone; 
            }
        }

        function loadisget_msg(){
            $.getJSON('/com/isget_msg.php',{userid:user.userid},function(json){
                if(json){
                    $('#subscribe').html('取消订阅');
                    $('#subscribe').attr('get_msg','0');
                    $('#subscribe').css('color','#999');
                    $('#subscribe').css('border','1px solid #999');
                }else{
                    $('#subscribe').html('订阅招标信息');
                    $('#subscribe').attr('get_msg','1');
                    $('#subscribe').css('color','#999');
                    $('#subscribe').css('border','1px solid #E64340');
                }
            })
        }

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

        function getnumber(){
            $.getJSON('/com/seach_alltendernumber.php',function(result){
                countorder = result;
            }) 
        }

        function sort(req){
            return req.replace('－',',').replace('。',',').replace('一',',').replace('_',',').replace('-',',');
        }

        function loadordernameoraddress(name){
            if(loadingorder_index) return false;
            loadingorder_index = true;
            var limit = $('#showallorders .show').length + ',' + 6;
            $.getJSON('/com/search_ordernameoraddress.php', {name: name,limit:limit}, function(json) {
                if(json){
                    $('#showallorders').append(dot_orders(json));
                    for (var i = 0; i < json.length; i++) {
                        tree_order[tree_order.length] = json[i];
                    }
                }else{
                    loadendorder_index = true;
                }
                loadingorder_index = false;
            });
        }

        $.weui = {};
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
                        alert('请上传图片');
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

                            var orderid = thisbutton.parents('.onedata').data('orderid');
                            var id = thisbutton.parents('.onedata').data('id');  
                            
                            $.post('/com/uploadbid_images.php', {image: base64,id:id,userid:user.userid,orderid:orderid}, function(data) {
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

        // 瀑布加载大厅订单
        $('#showallorders').scroll(function () {
            if (loadingorder_index || loadendorder_index) return;
            var scrollHeight = $(this)[0].scrollHeight;
            var scrollTop = $(this)[0].scrollTop;
            var elementHight = $(this).height();
            if(scrollTop + elementHight >= scrollHeight-300) {
                var name = $('#titelinput').val();
                if(name){
                    loadordernameoraddress(name);
                }else{
                    loadorders();
                }

            } 
        });

        // 显示详情
        $('#showallorders').on('click','.show',function(){
            var id = $(this).data('id');
            $.getJSON('/com/search_tree_order_indexinfo.php', {id:id,userid:user.userid}, function(json) {
                if(json){
                    alldate = json;
                    $('.showorderdetails').show();
                    $('#showorderdetails').attr('orderid',id);
                    $('#hideshow').show();
                    for (var i = 0; i < tree_order.length; i++) {
                        if(tree_order[i].id == id){
                            $('#detailsordername').html(tree_order[i].ordername);
                        }
                    }
                    $('#showorderdetails').append(dot_onedata(json));
                    if(user.role == 9 || user.role == 8){
                        $('.edit').show();
                    }
                }
            });
        })

        $('#hideshow').click(function(){
            $('.showorderdetails').hide();
            $('#hideshow').hide();
            $('.onedata').remove();
            $('#detailsordername').html('');
            $('#showorderdetails').attr('orderid','');
        })

        // 修改
        $('#showorderdetails').on('click','.edit',function(e){
            e.stopPropagation();            
            $('.allbidinfo').removeClass('allbidinfo');
            $('.working').removeClass('working');
            hideattribute();
            var that = $(this);
            var id = that.parents('.onedata').data('id');
            that.parents('.onedata').attr('id','working');
            var orderid = that.parents('.onedata').data('orderid');
            if(!dictionary.length) loaddictionary();
            var idtostr = String(id);
            for (var i = 0; i < alldate.length; i++) {
                if((idtostr == alldate[i].id)&&(orderid == alldate[i].orderid)){
                    json = alldate[i];
                    onedata = i;
                    $('#attributein').show();
                    $('#attributein input').val('');
                    $('.add').attr('data-userid',json.userid);
                    $('.add').attr('data-id',json.id);
                    var name = $('#name').val(json.name);
                    findname();
                    $('#count').val(json.count);
                    $('#count').focus();
                    if(json.trunk_diameter){
                        $('#trunk_diameter1').show();
                        $('#pot_diameter1').hide();
                        $('#ground_diameter1').hide();
                        $('#trunk_diameter').val(join(json.trunk_diameter));                    
                    }
                    if(json.plant_height){
                        $('#plant_height1').show();
                        $('#plant_height').val(join(json.plant_height));                    
                    }
                    if(json.crown){
                        $('#crown1').show();
                        $('#crown').val(join(json.crown));                    
                    }
                    if(json.branch_point_height){
                        $('#branch_point_height1').show();
                        $('#branch_point_height').val(join(json.branch_point_height));                    
                    }
                    if(json.branch_number){
                        $('#branch_number1').show();
                        $('#branch_number').val(join(json.branch_number));                    
                    }
                    if(json.ground_diameter){
                        $('#trunk_diameter1').hide();
                        $('#pot_diameter1').hide();
                        $('#ground_diameter1').show();
                        $('#ground_diameter').val(join(json.ground_diameter));                    
                    }
                    if(json.bough_number){
                        $('#bough_number1').show();
                        $('#bough_number').val(join(json.bough_number));                    
                    }
                    if(json.crown_cm){
                        $('#crown_cm1').show();
                        $('#crown_cm').val(join(json.crown_cm));                    
                    }
                    if(json.plant_height_cm){
                        $('#plant_height_cm1').show();
                        $('#plant_height_cm').val(join(json.plant_height_cm));                    
                    }
                    if(json.age){
                        $('#age1').show();
                        $('#age').val(join(json.age));                    
                    }
                    if(json.branch_length){
                        $('#branch_length1').show();
                        $('#branch_length').val(join(json.branch_length));                    
                    }
                    if(json.pot_diameter){
                        $('#trunk_diameter1').hide();
                        $('#pot_diameter1').show();
                        $('#ground_diameter1').hide();
                        $('#pot_diameter').val(join(json.pot_diameter));                    
                    }
                    if(json.bough_length){
                        $('#bough_length1').show();
                        $('#bough_length').val(join(json.bough_length));                    
                    }
                    if(json.mark){                   
                        $('#mark').val(json.mark);   
                    }
                }
            }
        })
        
        // 提交修改
        $('.add').click(function(){
            var content = {};
            content.name = $('#name').val();
            content.trunk_diameter = sort($('#trunk_diameter').val());
            content.plant_height = sort($('#plant_height').val());
            content.crown = sort($('#crown').val());
            content.branch_point_height = sort($('#branch_point_height').val());
            content.branch_number = sort($('#branch_number').val());
            content.ground_diameter = sort($('#ground_diameter').val());
            content.bough_number = sort($('#bough_number').val());
            content.plant_height_cm = sort($('#plant_height_cm').val());
            content.crown_cm = sort($('#crown_cm').val());
            content.age = sort($('#age').val());
            content.branch_length = sort($('#branch_length').val());
            content.pot_diameter = sort($('#pot_diameter').val());
            content.bough_length = sort($('#bough_length').val());
            content.substrate = $('#substrate').val();
            content.count = $('#count').val();
            content.mark = $('#mark').val();

            if((content.count != null) && (content.name != null)){
                var userid = $(this).attr('data-userid');
                var id = $(this).attr('data-id');
                $('#attributein input').val('');
                hideattribute();
                for(var key in content){
                    alldate[onedata][key] = content[key];
                }
                $.getJSON('/com/order_tree_update.php',{userid:userid,id:id, data:JSON.stringify(content)},function(result){
                    if(result){
                        $('#attributein').hide();
                        $('#working').html(dot_thisdata(alldate[onedata]));
                        $('#working').attr('id','');
                        if(user.role == 9 || user.role == 8){
                            $('.edit').show();
                        }
                    }else{
                        alert('修改失败');
                    }
                });                 
            }else{
                alert('名称或数量未填写');
            }
        })

        // 取消修改
        $('.reset').click(function(){
            $('#attributein input').val('');
            hideattribute();
            $('#attributein').hide();
        }) 

        // 报价
        $('#showorderdetails').on('click','.onedatainfo_button',function(e){
            e.stopPropagation();
            if(user.phone){
                if(user.role == 9 || user.role == 8){
                    var ed = confirm('确定要删除吗？');
                    if(ed){
                        thisbutton = $(this);
                        var orderid = thisbutton.parents('.onedata').data('orderid');
                        var id = thisbutton.parents('.onedata').data('id');
                        $.getJSON('/com/delete_unreasonableorder.php',{orderid:orderid,id:id},function(json){
                            if(json){
                                thisbutton.parents('.onedata').remove();
                            }
                        })                         
                    }
                }else{
                    $('.alertordername').show();
                    $('#alert_price').val('');
                    $('#alert_number').val('');
                    $('#images').html('');
                    thisbutton = $(this);
                    var orderid = thisbutton.parents('.onedata').data('orderid');
                    var username = thisbutton.parents('.onedata').data('username');
                    var id = thisbutton.parents('.onedata').data('id');
                    $('#username').html(username);
                    $.getJSON('/com/search_mybid_orderinfo.php',{orderid:orderid,id:id,userid:user.userid},function(json){
                        if(json){
                            if(json.price) $('#alert_price').val(json.price/100);
                            if(json.number) $('#alert_number').val(json.number);
                            if(json.image){
                                var images = json.image.split(',');
                                $('#images').html(dot_image(images));
                            }
                        }
                    })                    
                }
            }else{
                $('#alertuserphone').show();
            }
        })

        // 报价清空
        $('.order_name_button_reset').click(function(){
            $('#alert_price').val('');
            $('#alert_number').val('');
        })

        // 报价提交
        $('#order_name_button').click(function(){
            $('.alertordername').hide();
            var data = [];
            data[0]={};
            var price = $('#alert_price').val();
            var number = $('#alert_number').val();
            if($('.weui_uploader_file').length < 1){
                alert('请上传图片！');
                return;
            } 
            if(price && number){
                data[0].price = price*100;
                data[0].number = number;
                data[0].id = thisbutton.parents('.onedata').data('id');
                var orderid = thisbutton.parents('.onedata').data('orderid');
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

        $('.closealertphone').click(function(){
            $('#alertuserphone').hide();
        })

        $('.phone_button_reset').click(function(){
            $('#alert_phone').val('');
        })

        // 隐藏弹框
        $('.closealert').click(function(){
            $('.alertordername').hide();
        })

        // 上传手机号
        $('#phone_button').click(function(){
            var phone = $('#alert_phone').val();
            if(checkPhone(phone)){
                $.getJSON('/com/update_userphone.php',{phone:phone,userid:user.userid},function(result){
                    if(result){
                        $('#alertuserphone').hide(); 
                        user.phone = phone;                   } 
                })
            }
        })

        // 点击小图显示大图
        $('.alertordername').on("click", "li", function(){
            imageid = this.id;
            $('<img>').addClass('topimage').attr('src', './bidimage/'+imageid+'.jpg').appendTo('#topimage');
            
            $("#topimage img").on('load', function(){
                $('#topimage').fadeIn(100);
                loadcss();
            });
        });

        // 删除大图
        $('#topimage').on('click','.delete',function(){
            $('#topimage').fadeOut(100);
            $('.topimage').remove();

            var orderid = thisbutton.parents('.onedata').data('orderid');
            var id = thisbutton.parents('.onedata').data('id');

            $.post('/com/deletebid_image.php', {imageid: imageid,id:id,userid:user.userid,orderid:orderid}, function(data) {
                if(data){
                    $('#'+imageid).remove();
                }
            });
        })

        // 隐藏大图
        $('#topimage').on('click','.topimage',function(){
            $('#topimage').hide();
            $('.topimage').remove();
        })

        $('#subscribe').click(function(){
            var get_msg = $('#subscribe').attr('get_msg');
            $.getJSON('/com/get_msg.php',{get_msg:get_msg,userid:user.userid},function(json){
                if(json){
                    if(get_msg == 1){
                        $('#subscribe').html('已订阅');
                        $('#subscribe').attr('get_msg','0');
                        $('#subscribe').css('color','#999');
                        $('#subscribe').css('border','1px solid #999');
                    }else{
                        $('#subscribe').html('订阅招标信息');
                        $('#subscribe').attr('get_msg','1');
                        $('#subscribe').css('color','#999');
                        $('#subscribe').css('border','1px solid #E64340');
                    }
                }
            })
        })

        $('.titelsearch').click(function(){
            var name = $('#titelinput').val();
            $('#showallorders').html('');
            loadingorder_index = false;
            loadendorder_index = false;
            tree_order = [];
            if(name){
                loadordernameoraddress(name);
            }else{
                loadorders();
            }
        })

        $('#titelinput').on('keyup', function (e) {
            var key = e.keyCode;
            if ((key == 127) || (key == 8)) {
                var name = $('#titelinput').val();
                if(!name){
                    loadingorder_index = false;
                    loadendorder_index = false;
                    tree_order = [];
                    loadorders();
                }
            }
        });

        $('#showorderdetails').on('click','.onedata',function(){
            if(user.role == 9 || user.role == 8){
                var that = $(this);
                if(that.hasClass('allbidinfo')){
                    that.removeClass('allbidinfo');
                    that.removeClass('working');
                }else{
                    that.siblings().removeClass('allbidinfo');
                    that.addClass('allbidinfo');
                    $('.working').removeClass('working');
                    that.addClass('working');
                    if(!that.find('.row5').length){
                        var id = that.data('id');
                        var orderid = that.data('orderid');
                        $.getJSON('/com/seach_allbidinfo.php',{id:id,orderid:orderid},function(json){
                            that.append(dot_allbidinfo(json));
                        }) 
                    }
                }
            }
        })

        $('#showorderdetails').on('click','.row53',function(e){
            e.stopPropagation();
        })



        function getTitle () {
            return '找树网招标大厅';
        }
        function getImageUrl(){
            return 'http://cnzhaoshu.com/img/hall.jpg';
        }

        function getLink(){
            return 'http://cnzhaoshu.com/tenderall.php';
        } 
          

        function getDescription () {
            return '共有'+countorder+'条真实采购！';                     
        }

        function prepareShare () {
            // 在这里调用 API
            wx.onMenuShareAppMessage({
              title: getTitle(),
              desc: getDescription(),
              link: getLink(),
              imgUrl: getImageUrl()
            });

            wx.onMenuShareTimeline({
              title: getTitle() + "\n" +getDescription(),
              link: getLink(),
              imgUrl: getImageUrl()
            });

            wx.onMenuShareQQ({
              title: getTitle(),
              desc: getDescription(),
              link: getLink(),
              imgUrl: getImageUrl()
            });

            wx.onMenuShareWeibo({
              title: getTitle(),
              desc: getDescription(),
              link: getLink(),
              imgUrl: getImageUrl()
            });
        }

        function setWechatJSSDK(res){
            wx.config({
                debug: false,
                appId: res.appId,
                timestamp: res.timestamp,
                nonceStr: res.nonceStr,
                signature: res.signature,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareQZone',
                    'onMenuShareWeibo',
                    'hideMenuItems'
                ]
            });

            wx.ready(function () {
              wx.hideMenuItems({
                  menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
              });

              prepareShare();
            });
        }

        function loadWechatJSSDK() {
            $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
              setWechatJSSDK(res);
            });
        }
        setTimeout(loadWechatJSSDK, 500);

        loadisget_msg();
        loadorders();
        getnumber();
    </script>

</body>