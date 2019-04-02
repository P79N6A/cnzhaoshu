<!DOCTYPE html>
<html lang="en">
<?php
	include 'com/wechat_login.php';
	wechatLogin();
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="./css/weui.min.css"/>
	<link rel="stylesheet" href="./css/example.css"/>
	<link rel="stylesheet" href="./css/basics_m.css?t=20170907"/>
	<title>交易监管</title>
	<style>
		body{
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}
		.header{
			width:100%;
			height:40px;
			position: relative;
			background-color: #fff;
			top:0;
		}
		.allproject{
			width:43%;
			float: left;
			line-height: 40px;
			color:#666;
			padding-left:7%;
		}
		.isbuy,.issell{
			width:25%;
			float: left;
			line-height: 40px;
			color:#999;
			text-align: center;
		}
		.identity{
			color:#09BB07;
		}
		.qrcodeimages{
			background: #eee;
			width:100%;
			left:0;
			top:0;
			z-index: 3000;
			position: fixed;
			display: none;
		}
		.qrcodeimage{
		    width:100%;
		}
		.qrcodeimage_font{
			width:100%;
			padding: 40px 0;
			text-align: center;
		}
		#projects{
			width:100%;
			background-color: #eee;
			float: left;
			-webkit-overflow-scrolling: touch;
		}
		.showprojects{
			width:100%;
			float: left;
		}
		#mangerself{
			width:100%;
			background-color: #eee;
			float: left;
		}
		.relogin{
			width: 90%;
			background-color: #09bb07;
			border-radius: 4px;
			color: #fff;
			height: 37px;
			line-height: 37px;
			text-align: center;
			margin: 15px 5%;
			float: left;
		}
		.create_project{
			width: 96%;
			background-color: #fff;
			border-radius: 4px;
			color: #09bb07;
			height: 37px;
			line-height: 37px;
			text-align: center;
			margin: 5px 2% 15px;
			float: left;
		}
		.sharelookpower{
			width: 96%;
			background-color: #09bb07;
			border-radius: 4px;
			color: #fff;
			height: 37px;
			line-height: 37px;
			text-align: center;
			margin: 15px 2% 15px;
			float: left;
		}
		.myprojectname_name{
			float: left;
			width: 100%;
		}
		.myprojectname_share{
			float: left;
			width:38%;
			text-align: center;
			color:#3CC51F;
			font-size: 15px;
			line-height: 21px;
			padding: 7px 0;
		}
		.myprojectname_image{
			float: left;
			width:38%;
			text-align: center;
			color:#3CC51F;
			font-size: 15px;
			line-height: 21px;
			padding: 7px 0;
		}
		.myprojectname_stop{
			float: left;
			width:24%;
			text-align: center;
			color:#3CC51F;
			font-size: 15px;
			line-height: 21px;
			padding: 7px 0;
		}
		.myprojectname{
			width: 92%;
		    margin: 0 2%;
		    padding: 7px 2% 2px;
		    float: left;
		    background: #fff;
		    margin-bottom: 10px;
		    border-radius: 4px;
		}
		.create_newproject_title{
			background: #eee;
			width:100%;
			left:0;
			top:0;
			position: fixed;
		}
		.center_title{
			width: 100%;
			height: 50px;
			line-height: 50px;
			text-align: center;
			font-size: 20px;
			color: #555;
		}
		.create_newproject_row1{
			width:92%;
			height:30px;
			margin:15px 4%;
			border-bottom: 1px dashed #ddd;
		}
		.create_newproject_low1{
			height: 30px;
			line-height: 30px;
			min-width: 90px;
			float: left;
			font-size: 17px;
			color:#111;
		}
		#create_newproject_low2{
			width: 60%;
			height: 25px;
			line-height: 25px;
			float: left;
			border:0;
			font-size: 17px;
			color:#444;
			background-color: #eee;
		}
		.create_newproject_low3{
			min-width:70px;
			height:30px;
			line-height: 30px;
			float: left;
			color:#3CC51F;
			font-size: 17px;
		}
		#create_newproject_address{
			float: left;
			width: 92%;
			margin-left:4%;
			color:#999;
		}
		.map_reset,.map_submit{
			width:20%;
			height:30px;
			line-height: 30px;
			float: left;
			margin-left: 20%;
			border-radius: 3px;
			margin-top: 50px;
			color:#fff;
			font-size: 15px;
			background-color: #3CC51F;
			text-align: center;
		}
		#map_address{
			width:100%;
			z-index: 400;
			position: fixed;
			top:0px;
			left:0px;
			display: none;
			background-color: #eee;
		}
		.input_address{
			width:100%;
			z-index: 500;
			position: fixed;
			height:50px;
			background-color: #fff;
		}
		.input_address_box{
			width: 65%;
		    float: left;
		    border: 1px solid #aaa;
		    margin-left: 3%;
		    border-radius: 20px;
		    line-height: 35px;
		    height: 35px;
		    margin-top: 5px;
		}
		#input_address{
			width: 70%;
			height: 34px;
			border: 0;
			border-radius: 21px;
			float: left;
			padding: 0 5%;
			overflow: hidden;
			font-size: 15px;
		}
		.input_addresss{
			float: left;
			color:#3CC51F;
		}
		.input_address_submit{
			width: 20%;
			float: left;
			margin-left: 5%;
			margin-top: 5px;
			border-radius: 17px;
			line-height: 33px;
			height: 33px;
			border: 1px solid #aaa;
			text-align: center;
			color: #999;
		}
		#address_map{
			width:100%;
			position: relative;
		}
		.now_address{
			width:100%;
			height:25px;
			color:red;
			background-color: #fff;
		}
		.middleControl{
		    position: relative;
		    left: 50%;
		    top: 50%;
		    margin: -16px 0 0 -16px;
		    width:32px;
		    height:32px;
		    z-index:500;
		}
		.projectlists{
			width:100%;
			float: left;
		}
		.left{
			width:50%;
			float: left;
			background: #ddd;
		}
		.right{
			width:50%;
			background: #eee;
			float: left;
		}
		.projectrightbox{
			width:100%;
			float: left;
			overflow-y: scroll;
			background: #eee;
			-webkit-overflow-scrolling: touch;
		}
		.projectleftbox{
			width:100%;
			float: left;
			overflow-y: scroll;
			background: #ddd;
			-webkit-overflow-scrolling: touch;
		}
		.projectname{
			width: 96%;
			padding: 8px 2%;
			background: #ddd;
			float: left;
		}
		.treelist{
			width: 96%;
			padding: 2px 0;
			float: left;
			margin:0 2%;
			border-bottom: 1px dashed #fff;
		}
		.plon{
			background: #eee;
			box-shadow: -30px 0 15px rgba(0,0,0,.3);
		}
		#listimage ul {
		    float: left;
		    text-align: center;
		    width: 94%;
		    padding: 2px 3%;
		    background-color: #ccc;
		    color: #fff;
		}
		#listimage li {
		    float: left;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
		    width: 44%;
		    margin: 1% 3%;
		    height: 120px;
		}
		li {
		    list-style: none outside none;
		}
		#listimage li p {
		    margin-top: 100px;
		    width: 100%;
		    color: #fff;
		    font-size: 13px;
		    line-height: 20px;
		    height:20px;
		    overflow: hidden;
		    text-align: center;
		    background-color: rgba(0,0,0,.3);
		}
		#listimage{
			width: 100%;
			float: left;
			overflow-y: scroll;
			margin:1px 0 2px;
			-webkit-overflow-scrolling: touch;
		}
		#listimage2{
			width: 100%;
			float: left;
			overflow-y: scroll;
			margin:1px 0 2px;
			-webkit-overflow-scrolling: touch;
		}
		#listimage1{
			width: 100%;
			float: left;
			overflow-y: scroll;
			margin:2px 0 2px;
			-webkit-overflow-scrolling: touch;
		}
		.projectinfo{
			width: 96%;
		    float: left;
		    border-radius: 3px;
		    background: #fff;
		    margin: 6px 2% 0;
		}
		.projectinfo_jcimage{
			width:100%;
			background: #fff;
			display: none;
			float: left;
		}
		.projectinfo_name{
			width: 96%;
			padding: 10px 2%;
			float: left;
			border-bottom: 1px solid #eee;
		}
		.looking{
			display: block;
		}
		.foot{
			width:100%;
			height:100px;
		    background: #fff;
		    position: relative;
		    top: 0;
		}
		.treeimagebox{
		    margin: 4px 10px;
		    height: 92px;
		    background-color: #fff;
		    float: left;
		    overflow: scroll;
		    position: relative;
		}
		#treeimagebox{
		    height: 92px;
	        list-style: none;
	        position: absolute;
	        left: 0px;
		}
		li {
		    display: list-item;
		    text-align: -webkit-match-parent;
		    list-style: none outside none;
		}
		#treeimagebox div div {
		    width: 100%;
		    bottom: 0;
		    color: #fff;
		    font-size: 13px;
		    position: absolute;
		    height: 40px;
		    overflow: hidden;
		    background-color: rgba(0,0,0,.6);
		}
		.projectimg{
			height:100px;
			width:150px;
			float: left;
			margin-right: 10px;
			position: relative;
			border: 2px solid #eee;
		}
		.active{
			border: 2px solid red;
		}
		ul {
		    display: block;
		    -webkit-margin-before: 0px;
		    -webkit-margin-after: 0px;
		    -webkit-margin-start: 0px;
		    -webkit-margin-end: 0px;
		    -webkit-padding-start: 0px;
		}
		.img_box{
			height:100px;
			width:150px;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			text-align: center;
		}
		#boy{
			width:100%;
		}
		#userlist{
			width:100%;
			float: left;
			overflow-y:scroll;
			margin: 1px 0 2px;
			-webkit-overflow-scrolling: touch;
		}
		.userinfo{
			float: left;
			width: 31%;
			margin: 5px 1%;
			text-align: center;
			font-size: 13px;
		}
		.userinfo img{
			width: 70px;
			height: 70px;
			border-radius: 50%;
			border: 2px solid #fff;
		}
		.userinfo_name{
			width: 100%;
		    max-height: 40px;
		    overflow: hidden;
		    line-height: 20px;
		}
		.projectname_row1{
			width:100%;
			float: left;
			font-size: 13px;
			color:#999;
		}
		.projectname_row2{
			width:100%;
			float: left;
			font-size: 16px;
			margin:0;
		}
		.projectname_row3{
			width:100%;
			float: left;
			font-size: 13px;
			color:#999;
		}
		.projectname_row1 span:nth-child(1){
			float: left;
		}
		.projectname_row1 span:nth-child(2){
			float: right;
		}
		.treelist_row1{
			width:100%;
			float: left;
			font-size: 13px;
			color:#999
		}
		.treelist_row2{
			width:100%;
			float: left;
			font-size: 16px;
			margin:0;
			height: 24px;
			line-height: 24px;
		}
		.treelist_row3,.treelist_row6{
			width:50%;
			float: right;
			text-align: center;
			font-size: 16px;
			color:#09BB07;
			height: 24px;
			line-height: 24px;
		}
		.treelist_row5{
			display: none;
		}
		.treelist_row4{
			width:100%;
			float: left;
			font-size: 13px;
			color:#999
		}
		.projectuser{
			width: 96%;
			margin: 2px 2% 3px;
			background-color: #fff;
			float: left;
			border-radius: 5px;
		}
		.projectuser_title{
			width:100%;
			text-align: center;
			height:35px;
			line-height: 35px;
			border-bottom: 1px solid #eee
		}
		.selfinfobox{
			width: 94%;
		    background: #fff;
		    border-radius: 5px;
		    float: left;
		    padding: 15px 0;
		    margin: 10px 3%;
		}
		#selfinfo_headimg{
			width: 80px;
			height: 80px;
			float: left;
			margin: 0 5px;
			border-radius: 50%;
			border: 4px solid #eee;
		}
		#selfinfo_name{
			float: left;
			margin: 0 5px;
		}
		.mangerlist{
			width: 88%;
		    background: #fff;
		    border-radius: 5px;
		    float: left;
		    padding: 10px 3%;
		    margin: 0 3% 10px;
		}
		#statisticsbox{
			width:100%;
			float: left;
			overflow-y: scroll;
			margin:1px 0 2px;
			-webkit-overflow-scrolling: touch;
		}
		.onestatistics{
			box-sizing: border-box;
			margin: 2px 1% 3px;
			background-color: #fff;
			border-radius: 5px;
			width: 98%;
			float: left;
		}
		.onestatistics_title{
			text-align: center;
			height: 39px;
			line-height: 39px;
			border-bottom: 1px solid #eee;
			float: left;
			width:100%
		}
		.photo_title{
			height: 25px;
			line-height: 25px;
			float: left;
			width: 94%;
			background: #09BB07;
			padding: 0 3%;
			color: #fff;
		}
		.onestatistics_info{
			width:94%;
			margin:2px 3%;
			float: left
		}
		.onestatistics_info div:nth-child(1){
			float: left;
			width:50%;
		}
		.onestatistics_info div:nth-child(2){
			float: left;
			color:#999;
			width:20%;
			text-align: center;
		}
		.onestatistics_info div:nth-child(3){
			float: right;
			color:#999;
			width:30%;
			text-align: right;
		}
		.onestatistics_info div:nth-child(4){
			float: left;
			width:100%;
			font-size: 13px;
			color:#999
		}
		.findalltree{
			width: 100%;
			height: 33px;
			float: left;
			text-align: center;
			line-height: 33px;
			color: #fff;
			background: #ddd;
		}
		.createnew{
			width: 100%;
			height: 35px;
			line-height: 35px;
			float: left;
			text-align: center;
			color: #fff;
			font-size: 35px;
			background: #aaa;
		}
		.createnewtree{
			width: 99.6%;
			height: 35px;
			line-height: 35px;
			float: right;
			text-align: center;
			color: #fff;
			font-size: 35px;
			background: #ddd;
		}
		.photobox{
			width:48%;
			float: left;
			margin:2px 1%;
		}
		.treephoto{
			width:100%;
			height:130px;
			position: relative;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.treephoto p{
			width: 100%;
			color: #fff;
			font-size: 12px;
			background-color: rgba(0,0,0,.3);
			position: absolute;
			bottom: 0;
		}
		#imagetip {
		    height: 100px;
		    white-space: nowrap;
		}
		.imagetip li {
		    display: inline-block;
		    height: 100%;
		    width: 150px;
		    margin-right: 10px;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
		}
		.tooltip {
		    position: absolute;
		    margin-left: -30px;
		    padding: 4px 5px;
		    box-shadow: 0 0 0 1px rgba(0,0,0,.3);
		    background-color: #fff;
		    border-radius: 2px;
		    opacity: .9;
		    font-size: 14px;
		    line-height: 14px;
		    font-weight: 700;
		}
		.tooltipt{
			position: absolute;
			margin-left: -30px;
			padding: 4px 5px;
			box-shadow: 0 0 0 1px rgba(0,0,0,.3);
			border-radius: 2px;
			opacity: .9;
			font-size: 14px;
			line-height: 14px;
			font-weight: 700;
			background-color: #ffa042;
			color:#fff
		}
		.tooltipt:before {
		    position: absolute;
		    content: "";
		    bottom: -8px;
		    left: 22px;
		    border: 8px solid transparent;
		    border-bottom: 0;
		    border-top-color: #ffa042;
		}
		.tooltip.active {
		    color: #fff;
		    background-color: red;
		    z-index: 10;
		}
		.tooltip:before {
		    position: absolute;
		    content: "";
		    bottom: -8px;
		    left: 22px;
		    border: 8px solid transparent;
		    border-bottom: 0;
		    border-top-color: rgba(0,0,0,.3);
		}
		.tooltip.active:after {
		    position: absolute;
		    content: "";
		    bottom: -7px;
		    left: 23px;
		    border: 7px solid transparent;
		    border-bottom: 0;
		    border-top-color: red;
		}

		.tooltip:after {
		    position: absolute;
		    content: "";
		    bottom: -7px;
		    left: 23px;
		    border: 7px solid transparent;
		    border-bottom: 0;
		    border-top-color: #fff;
		}
		.imagetip li * {
		    position: absolute;
		    line-height: 12px;
		    color: #fff;
		    text-shadow: 1px 1px 1px #000;
		    text-align: center;
		    width: 150px;
		    opacity: .8;
		}
		.imagetip p {
		    bottom: 0;
		    font-size: 10px;
		}
		.imagetip h4 {
		    bottom: 12px;
		    font-size: 14px;
		    overflow: hidden;
		    font-weight: 400;
		}
		.imagetip li i {
		    top: 0;
		    display: block;
		    height: 5px;
		    background-color: red;
		}
		#photoinfo{
			width: 100%;
			float: left;
		}
		.record_info {
		    width: 96%;
		    float: left;
		    padding: 10px 1%;
		    margin: 5px 1%;
		    background: #fff;
		    border-radius: 2px;
		}
		.recordview{
			width:98%;
			padding: 2px 1%;
			float: left;
		}
		.recordview_row{
			width:33%;
			float: left;
		}
		.recordview_row1{
			width:67%;
			float: left;
		}
		#photoinfo img{
			width: 98%;
			float: left;
			margin: 5px 1%;
			border-radius: 2px;
		}
		.tooltip i {
		    position: absolute;
		    left: 10px;
		    bottom: -28px;
		    width: 40px;
		    height: 40px;
		    box-shadow: 0 0 0 5px #fff;
		    background-color: red;
		    border-radius: 100%;
		    -webkit-animation: sk-pulseScaleOut 1s infinite ease-in-out;
		    animation: sk-pulseScaleOut 1s infinite ease-in-out;
		}
		.select_name{
			width: 96%;
			padding: 0 2%;
			position: relative;
			height: 35px;
			float: left;
			text-align: center;
			background-color: #fff;
			border-bottom: 1px dashed #bbb;
		}
		.select_jdname{
			width: 96%;
			padding: 0 2%;
			position: relative;
			height: 35px;
			float: left;
			text-align: center;
			background-color: #fff;
		}
		.selectbox{
			height:35px;
			width:33%;
			float: left;
			background-color: #fff;
			text-align: center;
			color:#666;
		}
		.select_time{
			width: 100%;
			position: relative;
			float: left;
			text-align: center;
			background-color: #fff;
		}
		.select_timeinput{
			width:43%;
			padding-left:7%;
			float: left;
			height:35px;
			text-align: center;
		}
		.weui-select {
		    color: #666;
		    -webkit-appearance: none;
		    border: 0;
		    outline: 0;
		    background-color: transparent;
		    font-size: inherit;
		    line-height: 39px;
		    height: 39px;
		    width: 77%;
		    position: relative;
		}
		.addresspng{
			width: 38px;
			position: absolute;
			bottom: 10px;
			background-image: url(./img/poi.png);
			height: 50px;
			margin-left: 47%;
			background-repeat: no-repeat;
		}
		.bgimg{
			width:100%;
			position:relative;
			float: left;
		}
		.bgimg img{
			width:100%;
			position:relative;
		}
		@keyframes sk-pulseScaleOut{0%{-webkit-transform:scale(0);transform:scale(0);}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0;}
	</style>
</head>
<body>
<div class="container" id="container">        
</div>
<div id="tabbar" class="tabbar">
    <a data-id="home" class="on" id="gohome">
        <i class="iconfont icon-home"></i>
        <p>项目</p>
    </a>
    <a data-id="projectimage" class="">
        <i class="iconfont icon-xinzaolindi"></i>
        <p>进度</p>
    </a>
    <a data-id="statistics" class="">
        <i class="iconfont icon-mingdanshuju"></i>
        <p>统计</p>
    </a>
    <a data-id="member" class="">
        <i class="iconfont icon-renyuan"></i>
        <p>人员</p>
    </a>
    <a data-id="profile" class="head">
        <img id="headImage" src="">
        <p>我</p>
    </a>
</div>
<script id="dot_myproject" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="myprojectname" mapid="{{=it[i].id}}">
	        <div class="myprojectname_name">{{=it[i].name}}</div>
	        <div class="myprojectname_share" image="{{=it[i].qrcode}}">分享查看权限</div>
	        <div class="myprojectname_image" image="{{=it[i].qrcode}}">让供应商扫码</div>
	        <div class="myprojectname_stop">完成</div>
        </div>
    {{ } }}
</script>
<script id="dot_projectname" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="projectname {{=(i == 0) ? 'plon' : ''}}" mapid="{{=it[i].id}}" qrcode="{{=it[i].qrcode}}">
        	<div class="projectname_row1">
        		<span>{{=datetime(it[i].create_time)}}</span>
        		<span>{{=(it[i].switch == 1) ? '未完成' : '完成'}}</span>
        	</div>
        	<div class="projectname_row2">{{=it[i].name}}</div>
        	<div class="projectname_row3">{{=it[i].address}}</div>
        </div>
    {{ } }}
</script>
<script id="dot_treelistinfo" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="treelist" mapid="{{=it[i].mapid}}" treeid="{{=it[i].tree_id}}" orderid="{{=it[i].id}}" qxqrcode="{{=it[i].qxqrcode}}">
	        <div class="treelist_row2 looktreelist">{{=it[i].tree_name}}</div>
	        <div class="treelist_row4 looktreelist">{{=it[i].active ? it[i].active : '暂无'}}  {{=it[i].number}}{{=it[i].unit}} {{=it[i].attribute}}</div>
	        <div class="treelist_row1 looktreelist">{{=it[i].username}}</div>
	        <div class="{{=(it[i].switch == 1) ? 'treelist_row3' : 'treelist_row5'}}">上传图片</div>
	        <div class="{{=(it[i].treeuserid) ? 'treelist_row6' : 'treelist_row5'}}">授权上传</div>
        </div>
    {{ } }}
</script>
<script id="dot_treelistinfobuy" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="treelist" mapid="{{=it[i].mapid}}" treeid="{{=it[i].tree_id}}" orderid="{{=it[i].id}}">
	        <div class="treelist_row2 looktreelist">{{=it[i].tree_name}}</div>
	        <div class="treelist_row4 looktreelist">{{=it[i].active ? it[i].active : '暂无'}}  {{=it[i].number}}{{=it[i].unit}} {{=it[i].attribute}}</div>
	        <div class="treelist_row1 looktreelist">{{=it[i].username}}</div>
	        <div class="{{=(it[i].switch == 1) ? 'treelist_row3' : 'treelist_row5'}}">上传图片</div>
        </div>
    {{ } }}
</script>
<script id="dot_statistics_info" type="text/x-dot-template">
    {{ for(var i in it) { }}
		<div class="onestatistics">
			<div class="onestatistics_title">{{=it[i].name}}</div>
			{{ for(var j in it[i].data) { }}
				<div class="onestatistics_info">
					<div>{{=it[i].data[j].tree_name}}</div>
					<div>{{=it[i].data[j].active ? it[i].data[j].active : '暂无'}}</div>
					<div>{{=it[i].data[j].number}}{{=it[i].data[j].unit}}</div>
					<div>{{=it[i].data[j].attribute}}</div>
				</div>
			{{ } }}
		</div>
    {{ } }}
</script>
<script id="dot_imagetip" type="text/x-dot-template">
    <li data-id="{{=it.id}}" style="background-image:url({{=it.tip.image}})" data-maporder="{{=it.maporderid}}">
        <h4>{{=it.active}}</h4>
        <p>{{=it.tip.time?ms2shortTime(it.tip.time):''}}</p>
    </li>
</script>
<script id="dot_tooltip" type="text/x-dot-template">
    <div class="tooltip liveing" style="width:{{=it.tip.width}}px" onclick="activeTip({{=it.id}})">
        {{=it.tree_name}}
        {{?in24hours(it.tip.time)}}<i></i>{{?}}
    </div>
</script>
<script id="dot_projecttooltip" type="text/x-dot-template">
    <div class="tooltipt liveing" style="width:{{=it.tip.width}}px;" onclick="chooseproject({{=it.id}})">
        {{=it.name}}
    </div>
</script>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script src="./js/doT.min.js"></script>
<script src="./js/zepto.min.js"></script>
<script type="text/javascript" src="./js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	var dot_myproject = doT.template($('#dot_myproject').text());
	var dot_projectname = doT.template($('#dot_projectname').text());
	var dot_treelistinfo = doT.template($('#dot_treelistinfo').text());
	var dot_treelistinfobuy = doT.template($('#dot_treelistinfobuy').text());
	var dot_statistics_info = doT.template($('#dot_statistics_info').text());
	var dot_imagetip = doT.template($('#dot_imagetip').text());
	var dot_tooltip = doT.template($('#dot_tooltip').text());
	var dot_projecttooltip = doT.template($('#dot_projecttooltip').text());
	var height = $(window).height();
	var width = $(window).width();
	// 采购数据
	var projectlistbuy = [];
	var treelistbuy = {};
	var photolistbuy = {};
	// 供应数据
	var projectlistsell = [];
	var treelistsell = {};
	var photolistsell = {};
	// 图片
	var photoallbuy = [];
	var photoallsell = [];
	// 瀑布
	var loadingorder_index = false;
	var loadendorder_index = false;
	// 身份
	var ispurchaser = true;
	// 地图
	var mymap;
	// 进度页数据
	var photoindex;
	// 地图上的点
	var overlay = {};
	var imagetip = {};
	// 进度页数据
	var projectimagedata;
	// 统计页数据
	var statisticsprojectdata;
	var statisticstreedata;
	// 筛选页数据
	var selecttreedata;
	// 进度
	var selectimagedata;

	function loadthismap(way){
		$.getJSON('/com/search_thismapinfo.php', {mapid: user.mapid}, function(result) {
			if(result.photo){
				photolistbuy = result.photo;
			}else{
				photolistbuy = null;
			}
			if(result.project){
				var lengths = 0;
				json = result.project;
				for (var i in json) {
					var nothas = true;
					for (var j in projectlistbuy) {
						if(projectlistbuy[j].id == json[i].mapid){
							nothas = false;
						}
					}
					if(nothas){
						projectlistbuy[lengths] = {};
						projectlistbuy[lengths].id = json[i].mapid;
						projectlistbuy[lengths].userid = json[i].userid;
						projectlistbuy[lengths].qrcode = json[i].qrcode;
						projectlistbuy[lengths].x = json[i].x;
						projectlistbuy[lengths].y = json[i].y;
						projectlistbuy[lengths].address = json[i].address;
						projectlistbuy[lengths].name = json[i].projectname;
						projectlistbuy[lengths].switch = json[i].switch;
						projectlistbuy[lengths].create_time = json[i].create_time;
						lengths++;
					}
					if(json[i].id){
						var mapid = json[i].mapid;
						var orderid = json[i].id;
						if(treelistbuy[mapid]){
							treelistbuy[mapid][orderid] = {};
						}else{
							treelistbuy[mapid] = {};
							treelistbuy[mapid][orderid] = {};
						}
						treelistbuy[mapid][orderid].id = json[i].id;
						treelistbuy[mapid][orderid].attribute = json[i].attribute;
						treelistbuy[mapid][orderid].mapid = json[i].mapid;
						treelistbuy[mapid][orderid].number = json[i].number;
						treelistbuy[mapid][orderid].state = json[i].state;
						treelistbuy[mapid][orderid].tree_id = json[i].tree_id;
						treelistbuy[mapid][orderid].tree_name = json[i].tree_name;
						treelistbuy[mapid][orderid].treeuserid = json[i].treeuserid;
						treelistbuy[mapid][orderid].unit = json[i].unit;
						treelistbuy[mapid][orderid].userid = json[i].userid;
						treelistbuy[mapid][orderid].username = json[i].username;
						treelistbuy[mapid][orderid].userphone = json[i].userphone;
						treelistbuy[mapid][orderid].active = json[i].active;
						treelistbuy[mapid][orderid].switch = json[i].switch;
						treelistbuy[mapid][orderid].qxqrcode = json[i].qxqrcode;
						if(json[i].time){
							treelistbuy[mapid][orderid].time = datetime(json[i].time);
						}else{
							treelistbuy[mapid][orderid].time = null;
						}
					}
				}
			}else{
				projectlistbuy = null;
				treelistbuy = null;
			}

			if(way) changeover(way);
		});
	}
	function urlRequest(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
        return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
    }
	function getcookie(name){
	    var arrStr = document.cookie.split("; ");
	    for(var i = 0;i < arrStr.length;i ++){
	        var temp = arrStr[i].split("=");
	        if(temp[0] == name) return unescape(temp[1]);
	    } 
	}
	function ms2shortTime(ms) {
	    var now = new Date().getTime();
	    var t = now-ms; //ms

	    if (t<3600000) {
	        t = Math.floor(t/60000);
	        return t==0 ? '刚刚' : t+'分钟前';
	    } else if (t<86400000) {
	        return Math.floor(t/3600000)+'小时前';
	    } else if (t<2592000000) {
	        return Math.floor(t/86400000)+'天前';
	    } else if (t<31104000000) {
	        return Math.floor(t/2592000000)+'月前';
	    } else {
	        return '1年前';
	    }
	}
	function projectstate(state){
		switch(state){
			case 1:
			state = '号树';
			break;
			case 3:
			state = '挖树';
			break;
			case 5:
			state = '上车';
			break;
			case 7:
			state = '运输';
			break;
			case 9:
			state = '卸车';
			break;
			case 11:
			state = '栽种';
			break;
			default:
			state = '其他';
			break;
		}
		return state;
	}
	function datetime(time){
		time = time.substring(0,10);
		return time;
	}
	function isObject(obj){
	    for(var n in obj){return true} 
	    return false; 
	}
	function loadphotobuy(way){
		$.getJSON('/com/search_map_orderphotobuy.php',{userid:user.userid},function(result){
			if(result.photo){
				photolistbuy = result.photo;
			}else{
				photolistbuy = null;
			}

			if(result.project){
				var lengths = 0;
				json = result.project;
				for (var i in json) {
					var nothas = true;
					for (var j in projectlistbuy) {
						if(projectlistbuy[j].id == json[i].mapid){
							nothas = false;
						}
					}
					if(nothas){
						projectlistbuy[lengths] = {};
						projectlistbuy[lengths].id = json[i].mapid;
						projectlistbuy[lengths].userid = json[i].userid;
						projectlistbuy[lengths].qrcode = json[i].qrcode;
						projectlistbuy[lengths].x = json[i].x;
						projectlistbuy[lengths].y = json[i].y;
						projectlistbuy[lengths].address = json[i].address;
						projectlistbuy[lengths].name = json[i].projectname;
						projectlistbuy[lengths].switch = json[i].switch;
						projectlistbuy[lengths].create_time = json[i].create_time;
						lengths++;
					}
					if(json[i].id){
						var mapid = json[i].mapid;
						var orderid = json[i].id;
						if(treelistbuy[mapid]){
							treelistbuy[mapid][orderid] = {};
						}else{
							treelistbuy[mapid] = {};
							treelistbuy[mapid][orderid] = {};
						}
						treelistbuy[mapid][orderid].id = json[i].id;
						treelistbuy[mapid][orderid].attribute = json[i].attribute;
						treelistbuy[mapid][orderid].mapid = json[i].mapid;
						treelistbuy[mapid][orderid].number = json[i].number;
						treelistbuy[mapid][orderid].state = json[i].state;
						treelistbuy[mapid][orderid].tree_id = json[i].tree_id;
						treelistbuy[mapid][orderid].tree_name = json[i].tree_name;
						treelistbuy[mapid][orderid].treeuserid = json[i].treeuserid;
						treelistbuy[mapid][orderid].unit = json[i].unit;
						treelistbuy[mapid][orderid].userid = json[i].userid;
						treelistbuy[mapid][orderid].username = json[i].username;
						treelistbuy[mapid][orderid].userphone = json[i].userphone;
						treelistbuy[mapid][orderid].active = json[i].active;
						treelistbuy[mapid][orderid].switch = json[i].switch;
						treelistbuy[mapid][orderid].qxqrcode = json[i].qxqrcode;
						if(json[i].time){
							treelistbuy[mapid][orderid].time = datetime(json[i].time);
						}else{
							treelistbuy[mapid][orderid].time = null;
						}
					}
				}
			}else{
				projectlistbuy = null;
				treelistbuy = null;
			}

			if(way) changeover(way);
		})
	}
	function loadphotosell(way){
		$.getJSON('/com/search_map_orderphotosell.php',{userid:user.userid},function(result){
			if(result.photo){
				photolistsell = result.photo;		
			}else{
				photolistsell = null;
			}

			if(result.project){
				json = result.project;
				var lengths = 0;
				for (var i in json) {
					var nothas = true;
					for (var j in projectlistsell) {
						if(projectlistsell[j].id == json[i].mapid){
							nothas = false;
						}
					}
					if(nothas){
						projectlistsell[lengths] = {};
						projectlistsell[lengths].id = json[i].mapid;
						projectlistsell[lengths].userid = json[i].userid;
						projectlistsell[lengths].qrcode = json[i].qrcode;
						projectlistsell[lengths].x = json[i].x;
						projectlistsell[lengths].y = json[i].y;
						projectlistsell[lengths].address = json[i].address;
						projectlistsell[lengths].name = json[i].projectname;
						projectlistsell[lengths].switch = json[i].switch;
						projectlistsell[lengths].create_time = json[i].create_time;
						lengths++;
					}
					var mapid = json[i].mapid;
					var orderid = json[i].id;
					if(treelistsell[mapid]){
						treelistsell[mapid][orderid] = {};
					}else{
						treelistsell[mapid] = {};
						treelistsell[mapid][orderid] = {};
					}
					treelistsell[mapid][orderid].id = json[i].id;
					treelistsell[mapid][orderid].attribute = json[i].attribute;
					treelistsell[mapid][orderid].mapid = json[i].mapid;
					treelistsell[mapid][orderid].number = json[i].number;
					treelistsell[mapid][orderid].state = json[i].state;
					treelistsell[mapid][orderid].tree_id = json[i].tree_id;
					treelistsell[mapid][orderid].tree_name = json[i].tree_name;
					treelistsell[mapid][orderid].treeuserid = json[i].treeuserid;
					treelistsell[mapid][orderid].unit = json[i].unit;
					treelistsell[mapid][orderid].userid = json[i].userid;
					treelistsell[mapid][orderid].username = json[i].username;
					treelistsell[mapid][orderid].userphone = json[i].userphone;
					treelistsell[mapid][orderid].active = json[i].active;
					treelistsell[mapid][orderid].switch = json[i].switch;
					treelistsell[mapid][orderid].qxqrcode = json[i].qxqrcode;
					if(json[i].time){
						treelistsell[mapid][orderid].time = datetime(json[i].time);
					}else{
						treelistsell[mapid][orderid].time = null;
					}
				}
			}else{
				projectlistsell = null;
				treelistsell = null;
			}
			if(way) changeover(way);
		})
	}
	function loadphotoallbuy(way){
		if(loadingorder_index) return false;
		loadingorder_index = true;
		var limit = photoallbuy.length+',20';
		$.getJSON('/com/search_map_photobuy.php',{userid:user.userid,limit:limit},function(json){
			if(json){
				for (var i = 0; i < json.length; i++) {
					photoallbuy[photoallbuy.length] = json[i];
				}
			}else{
				photoallbuy = null;
				loadendorder_index = true;
			}
            loadingorder_index = false;
			if(way){
				changeover(way);
			}else{
				$('#listimage').append(loadstatisticphoto(json));
			}
		})
	}
	function loadphotoallsell(way){
		if(loadingorder_index) return false;
		loadingorder_index = true;
		var limit = photoallsell.length+',20';
		$.getJSON('/com/search_map_photosell.php',{userid:user.userid,limit:limit},function(json){	
			if(json){
				for (var i = 0; i < json.length; i++) {
					photoallsell[photoallsell.length] = json[i];
				}
			}else{
				photoallsell = null;
				loadendorder_index = true;
			}
			loadingorder_index = false;
			if(way){
				changeover(way);
			}else{
				$('#listimage').append(loadstatisticphoto(json));
			}	
		})
	}
	function loadstatistics(projectlist,treelist){
		if(projectlist && treelist){
			var newstatistics = {};
	    	var str = '';
	    	for (var i = 0; i < projectlist.length; i++) {
	    		if(treelist[projectlist[i].id]){
	    			newstatistics[projectlist[i].id] = {};
	    			newstatistics[projectlist[i].id].name = projectlist[i].name;
		    		var projectuser = treelist[projectlist[i].id];
		    		var datas = [];
		    		for(var j in projectuser){
		    			var hastree = true;
		    			if(datas.length){
			    			for (var m = 0; m < datas.length; m++) {
			    				if((projectuser[j].tree_id == datas[m].tree_id) && (projectuser[j].state == datas[m].state)){
			    					hastree = false;
			    				}
			    			}
			    			if(hastree){
			    				var length = datas.length;
			    				datas[length] = {};
			    				datas[length].tree_id = projectuser[j].tree_id;
			    				datas[length].state = projectuser[j].state;
			    				datas[length].attribute = projectuser[j].attribute;
			    				datas[length].number = projectuser[j].number;
			    				datas[length].tree_name = projectuser[j].tree_name;
			    				datas[length].unit = projectuser[j].unit;
			    				datas[length].active = projectuser[j].active;
			    			}
		    			}else{
		    				var length = datas.length;
		    				datas[length] = {};
		    				datas[length].tree_id = projectuser[j].tree_id;
		    				datas[length].state = projectuser[j].state;
		    				datas[length].attribute = projectuser[j].attribute;
		    				datas[length].number = projectuser[j].number;
		    				datas[length].tree_name = projectuser[j].tree_name;
		    				datas[length].unit = projectuser[j].unit;
		    				datas[length].active = projectuser[j].active;
		    			}
		    		}
		    		newstatistics[projectlist[i].id].data = datas;
	    		}
	    	}
			return newstatistics;
		}else{
			return '';
		}
	}
	function loadprojectuser(projectlist,treelist){
    	var str = '';
    	if(projectlist == null){
    		return '<div class="weui-loadmore">没有数据！</div>';
    	}else{
	    	for (var i = 0; i < projectlist.length; i++) {
	    		if(treelist[projectlist[i].id]){
	    			str += '<div class="projectuser"><div class="projectuser_title">'+projectlist[i].name+'</div>';
		    		var projectuser = treelist[projectlist[i].id];
		    		var thisuser = [];
		    		for(var j in projectuser){
		    			var has = true;
		    			if(thisuser.length){
		    				for (var m = 0; m < thisuser.length; m++) {
		    					if(thisuser[m] == projectuser[j].treeuserid) has = false;
		    				}
		    			}
		    			if(has){
		    				str += '<div class="userinfo" userid="'+projectuser[j].treeuserid+'"><img src="headimg/96/'+projectuser[j].treeuserid+'.jpg"  onclick="searchmyimg('+projectuser[j].treeuserid+')"><div class="userinfo_name">'+projectuser[j].username+'</div><div class="userinfo_phone"><a href="tel:'+projectuser[j].userphone+'">'+projectuser[j].userphone+'</a></div></div>';
		    				thisuser[thisuser.length] = projectuser[j].treeuserid;
		    			}
		    		}
		    		str += '</div>';
	    		}
	    	}
	    	return str;    		
    	}
	}
	function loadprojectsuppler(projectlist,treelist){
    	var str = '';
    	if(projectlist){
	    	for (var i = 0; i < projectlist.length; i++) {
	    		if(treelist[projectlist[i].id]){
	    			str += '<div class="projectuser"><div class="projectuser_title">'+projectlist[i].name+'</div>';
		    		var projectuser = treelist[projectlist[i].id];
		    		var thisuser = [];
		    		for(var j in projectuser){
		    			var has = true;
		    			if(thisuser.length){
		    				for (var m = 0; m < thisuser.length; m++) {
		    					if(thisuser[m] == projectuser[j].userid) has = false;
		    				}
		    			}
		    			if(has){
		    				str += '<div class="userinfo" userid="'+projectuser[j].userid+'"><img src="headimg/96/'+projectuser[j].userid+'.jpg"  onclick="searchmyimg('+projectuser[j].userid+')"><div class="userinfo_name">'+projectuser[j].username+'</div><div class="userinfo_phone"><a href="tel:'+projectuser[j].userphone+'">'+projectuser[j].userphone+'</a></div></div>';
		    				thisuser[thisuser.length] = projectuser[j].userid;
		    			}
		    		}

		    		str += '</div>';
	    		}
	    	}
    	}else{
    		str = '<div class="weui-loadmore">没有数据！</div>';
    	}
    	return str;
	}
	function searchmyimg(info_userid){
		$.getJSON('/com/search_map_photouser.php',{userid:user.userid,treeuserid:info_userid,ispurchaser:ispurchaser},function(json){
			projectimagedata = json;
			$('#listimage').html(loadstatisticphoto(projectimagedata));
			window.pageManager.go('projectimage');
		})
	}
	function loadstatisticphoto(photo){
		var time = '';
		var str = '';
		for (var i in photo) {
			var photos= photo[i].photo.split(';')[0];
			if(datetime(photo[i].time) == time){
				str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].projectname+' '+photo[i].active+'<br>'+photo[i].tree_name+photo[i].number+photo[i].unit+photo[i].attribute+'<br>'+photo[i].username+'</p></div></div>';
			}else{
				time = datetime(photo[i].time);
				str += '<div class="photo_title">'+time+'</div>';
				str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].projectname+' '+photo[i].active+'<br>'+photo[i].tree_name+photo[i].number+photo[i].unit+photo[i].attribute+'<br>'+photo[i].username+'</p></div></div>';
			}
		}
		return str ? str : '<div class="weui-loadmore">没有数据！</div>';
	}
	function selectProjectNameByID(projectid){
	    var project = getPorjectByID(projectid);
	    selectProjectName(project.name);
	}
	function getPorjectByID(id) {
	    for (var i = photolistbuy.length - 1; i >= 0; i--) {
	        if (photolistbuy[i].id==id) {
	            return photolistbuy[i];
	        }
	    }
	    return null;
	}
	function getObjectByID(id, object) {
	    for (var i = object.length - 1; i >= 0; i--) {
	        if (object[i].id==id) {
	            return object[i];
	        }
	    }
	    return null;    
	}
	function addlistering(data){
		overlayOnMap(data);
    	// qq.maps.event.addListener(mymap, 'bounds_changed', function() {
    	//     // centerDiv.innerHTML = "latlng:" + map.getCenter();
    	//     // 如果当前激活的项目没有在窗口内，将窗口内的 第一个overlay激活，如果当前窗口没有overlay，全部不激活
    	//     var mapbounds = mymap.getBounds();
    	//     if (mapbounds) {
    	//         // if (!mapContains(mapbounds, getDataByID(activeTipid))) {
    	//             for (var i = 0, len = data.length; i < len; i++) {
    	//                 var mapdata = data[i];
    	//                 if (mapContains(mapbounds, mapdata)) {
    	//                     activeTip(mapdata.id);
    	//                     break;
    	//                 }
    	//             }
    	//         // }
    	//     }
    	// });
	}
	function removeMapVersion(mapid) {
	    var map = $('#'+mapid).children().children();
	    if (map.length>1) {
	        for (var i = map.length - 1; i >= 0; i--) {
	            var $dom = $(map[i]);
	            if ( parseInt($dom.css('z-index'))>100000 ) 
	                $dom.hide();
	        }
	    } else {
	        setTimeout(function(){
	            removeMapVersion(mapid)
	        }, 50);
	    }
	}
	function initTooltipOverlay() {
	    TooltipOverlay.prototype = new qq.maps.Overlay();

	    //定义construct,实现这个接口来初始化自定义的Dom元素
	    TooltipOverlay.prototype.construct = function() {
	        this.div.appendTo(this.getPanes().overlayMouseTarget);
	    }

	    //实现draw接口来绘制和更新自定义的dom元素
	    TooltipOverlay.prototype.draw = function() {
	        var position = new qq.maps.LatLng(this.x, this.y);

	        //返回覆盖物容器的相对像素坐标
	        var overlayProjection = this.getProjection();
	        var pixel = overlayProjection.fromLatLngToDivPixel(position);

	        this.div.css({"left":pixel.x + "px", "top": pixel.y -  this.div.height() + "px"});
	    }
	     //实现destroy接口来删除自定义的Dom元素，此方法会在setMap(null)后被调用
	    TooltipOverlay.prototype.destroy = function() {
	        this.div.remove();
	        this.div = null;
	    }
	}
	function TooltipOverlay(html, x, y) {
	        this.div = $(html);
	        this.x = x;
	        this.y = y;
	}
	function getMapBounds(datas) {
		if(isObject(datas)){
		    var minLat=1000, minLng=1000, maxLat=0, maxLng=0;
			for(var i in datas){
		        var data = datas[i];
		        if (data.x && data.y) {
		            if (data.x<minLat) minLat=data.x;
		            if (data.x>maxLat) maxLat = data.x;

		            if (data.y<minLng) minLng=data.y;
		            if (data.y>maxLng) maxLng = data.y;
		        }    			
			}    	    
		}else{
			var minLat=37, minLng=110, maxLat=40, maxLng=120;
		}
	    var sw = new qq.maps.LatLng(maxLat, maxLng); //西南角坐标
	    var ne = new qq.maps.LatLng(minLat, minLng); //东北角坐标
	    return new qq.maps.LatLngBounds(ne, sw); //矩形的地理坐标范围
	}
	function in24hours(ms) {
	    var now = new Date().getTime();
	    return now-ms<86400000;
	}
	function overlayOnMap(mapdata) {
		if(ispurchaser){
		    var newdatas = [];
		    if(projectlistbuy != null){
			    for (var i = 0; i < projectlistbuy.length; i++) {
			    	for (var j = 0; j < mapdata.length; j++) {
			    		if(projectlistbuy[i].id == mapdata[j].mapid){
			    			var nothas = true;
			    			for (var k = 0; k < newdatas.length; k++) {
			    				if(newdatas[k].id == projectlistbuy[i].id){
			    					nothas = false;
			    				}
			    			}
			    			if(nothas){
				    			newdatas[newdatas.length] = projectlistbuy[i];
				    			continue;
			    			}
			    		}
			    	}
			    }
			    var newdatass = [];
			    for (var i = 0; i < mapdata.length; i++) {
			    	newdatass[newdatass.length] = mapdata[i];
			    }
			    for (var i = 0; i < newdatas.length; i++) {
			    	newdatass[newdatass.length] = newdatas[i];
			    }
			}else{
				var newdatass = newdatas;
			}
	    }else{
	    	var newdatass = mapdata;
	    }
    	mymap.fitBounds(getMapBounds(newdatass));

	    // 添加新的
	    if(mapdata){
		    for (var i = 0; i<newdatass.length; i++) {
		        var data = newdatass[i];
		        data.tip = getTooltip(data);
		        if (data.photo && !imagetip[data.id]) {
	    	        if (!imagetip[data.id]) {
	    	            $('#imagetip').append(dot_imagetip(data)); 
	    	            imagetip[data.id] = 1;
	    	        }
	    	        if (data.x && !overlay[data.id]) {
	    	            var overlaies = new TooltipOverlay(dot_tooltip(data), data.x, data.y);
		                overlaies.setMap(mymap);
	    	            overlay[data.id] = overlaies;
	    	        }
	    	        delete data.tip;
	    	    }else{
	    	    	var overlaies = new TooltipOverlay(dot_projecttooltip(data), data.x, data.y);
	                overlaies.setMap(mymap);
    	            overlay[data.id] = overlaies;
	    	    }

	    	    imagetipX = 0;
	    	    $('#imagetip').css({"transform":"translateX(0)","-webkit-transform":"translateX(0)"});
	    	    if ((typeof activeTipid != 'undefined') && (activeTipid != mapdata[0].id)) {
	    	        if (overlay[activeTipid]) {
	    	            $(overlay[activeTipid].div).removeClass('active');
	    	        }
	    	    }
	    	}
		    imageActiveTip = $('<i></i>');
		    var id = $('#imagetip').children().first().append(imageActiveTip).data('id');
		    activeTipid = id;
		    if (overlay[id]) $(overlay[id].div).addClass('active');
	    }
	}
	function getTooltip(data) {
	    if(data.tree_name){
	    	var result = {width: GetCurrentStringWidth(data.tree_name,14)};
	    }else{
	    	var result = {width: GetCurrentStringWidth(data.name,14)};
	    }
	    if (data.photo) {
	        var photos = data.photo.split(';');
	        photo = photos[0];
	        result.image = 'photos/m/'+photo+'.jpg';
	        result.time = getPhotoTime(photo);
	    }
	    return result;
	}
	function GetCurrentStringWidth(text,fontsize){
		var currentObj = $('<span></span>').html(text).css({"font-size":fontsize+'px', "visibility":"hidden"}).appendTo(document.body);
		var width = currentObj.width();
		currentObj.remove();
		return width+2;
	}
	function activeTip(id, imagetipIndex) {
	    if (activeTipid == id) {
	        var translateX = 'translateX(' + imagetipX + 'px)';
	        $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
	        return;
	    }
	    activeTipid = id;

	    if (overlay[id]) {
	        $(overlay[id].div).addClass('active').siblings('.active').removeClass('active');
	    }

	    $imagetip = $('#imagetip [data-id="' + id + '"]');

	    if ($imagetip.length) {
	        if (imagetipIndex || imagetipIndex==0) {
	            // imagetip激活，如果不在当前视图，移到中心
	            var data = getDataByID(id);

	            if (!mapContains(mymap.getBounds(), data)) {
	                mymap.panTo(new qq.maps.LatLng(data.x, data.y));
	            }
	        } else {
	            imagetipIndex = getImagetipIndexByID(id);
	        }

	        $imagetip.append(imageActiveTip.show());
	        imagetipX = -( imagetipIndex * ($('#imagetip li').width()+10) - 30);
	        if (imagetipX>0) imagetipX = 0;
	        // 滚动
	        var translateX = 'translateX(' + imagetipX + 'px)';
	        $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
	    } else {
	        imageActiveTip.hide();
	    }
	}
	function getImagetipIndexByID(id) {
	    id = id.toString();
	    var $imagetips = $('#imagetip').children();
	    for (var i = 0, len = $imagetips.length; i < len; i++) {
	        if ($imagetips.eq(i).data('id') == id) {
	            return i;
	        } 
	    }
	}
	function onImagetipTouchstart(event) {
	    var touch = event.targetTouches[0];
	    touchX = touch.clientX;
	    touchTime = new Date().getTime();

	    $('#imagetip').on('touchmove', onImagetipTouchmove);
	    $('#imagetip').on('touchend', onImagetipTouchend);
	}
	function onImagetipTouchmove(event) {
	    var touch = event.targetTouches[0];
	    var deltaX = touchX - touch.clientX;

	    var translateX = 'translateX(' + (imagetipX-deltaX) + 'px)';
	    $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
	}
	function onImagetipTouchend(event) {
	    var touch = event.changedTouches[0];
	    var deltaX = touchX - touch.clientX;

	    if (deltaX>50) {
	        // 向后找
	        var n = Math.round(deltaX/($('#imagetip li').width()+10));
	        if (n==0) n = 1;

	        var $imagetips = $('#imagetip').children();
	        var index = getImagetipIndexByID(activeTipid) + n;
	        var maxIndex = $imagetips.length - 1;
	        if (index>maxIndex) index = maxIndex;

	        activeTip($imagetips.eq(index).data('id'), index);
	    } else if (deltaX<-50) {
	        // 向前找
	        var n = Math.round(deltaX/($('#imagetip li').width()+10));
	        if (n==0) n = -1;

	        var index = getImagetipIndexByID(activeTipid) + n;
	        if (index<0) index = 0;
	        
	        activeTip($('#imagetip').children().eq(index).data('id'), index);
	    }

	    $('#imagetip').off('touchmove', onImagetipTouchmove);
	    $('#imagetip').off('touchend', onImagetipTouchend);
	}
	function getDataByID(id) {
		if(ispurchaser){
			data = photolistbuy;
		}else{
			data = photolistsell;
		}
	    for (var i = data.length - 1; i >= 0; i--) {
	        mapdata = data[i];
	        if (mapdata.id == id) return mapdata;
	    }
	}
	function mapContains(mapbounds, data) {
	    if (data.x && data.y) {
	        return mapbounds.contains(new qq.maps.LatLng(data.x, data.y));
	    } else {
	        return false;
	    }
	}
	function deletealldom(){
    	for (var id in imagetip) {
	        $('#imagetip [data-id="' + id + '"]').remove();
	        delete imagetip[id];
	        if(overlay[id]){
		        overlay[id].setMap(null);
		        delete overlay[id];
	        }
    	}
    	$('.liveing').remove();
    	for (var id in overlay) {
	        overlay[id].setMap(null);
	        delete overlay[id];
    	}
	}
	function lookphotoinfo(data){
		for (var i = 0; i < projectimagedata.length; i++) {
			if(projectimagedata[i].id == data){
				photoindex = projectimagedata[i];
			}
		}
		$('#photoinfo').html(writeinfo(photoindex));
		window.pageManager.go('recordview');
	}
	function writeinfo(data){
		var photos= data.photo.split(';');
		var str = '<div class="record_info"><div class="recordview"><div class="recordview_row">项目名称：</div><div class="recordview_row1">'+data.projectname+'</div></div><div class="recordview"><div class="recordview_row">用苗地址：</div><div class="recordview_row1">'+data.address+'</div></div><div class="recordview"><div class="recordview_row">苗木信息：</div><div class="recordview_row1">'+data.tree_name+' '+data.number+data.unit+' '+data.attribute+'</div></div><div class="recordview"><div class="recordview_row">供&nbsp;&nbsp;应&nbsp;商：</div><div class="recordview_row1">'+data.username+' '+'<a href="tel:'+data.phone+'">'+data.phone+'</a>'+'</div></div><div class="recordview"><div class="recordview_row">进&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;度：</div><div class="recordview_row1">'+data.active+'</div></div><div class="recordview"><div class="recordview_row">时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;间：</div><div class="recordview_row1">'+data.time+'</div></div><div class="recordview"><div class="recordview_row">照片数量：</div><div class="recordview_row1">'+photos.length+'</div></div></div>';
		for (var i = 0; i < photos.length; i++) {
			str += '<div class="bgimg" class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="window.pageManager.back()"><div class="addresspng"></div></div>';
		}
		return str;
	}
	function loadselect(){
		inputselect1(statisticstreedata);
		inputselect2(statisticstreedata);
		inputselect3(statisticstreedata);
		selecttreedata = statisticstreedata;
	}
	function inputselect1(data){
		var str = '<option value="0">全部苗木</option>';
		var hasarray = [];
		for(var i in data){
			for(var j in data[i]){
				var notin = true;
				for (var k = 0; k < hasarray.length; k++) {
					if(hasarray[k] == data[i][j].tree_id){
						notin = false;
					}
				}
				if(notin){
					str += '<option value="'+data[i][j].tree_id+'">'+data[i][j].tree_name+'</option>';
					hasarray[hasarray.length] = data[i][j].tree_id;
				}
			}
		}
		$('#selectbox_treename').html(str);
	}
	function inputselect2(data){
		var str = '<option value="0">所有进度</option>';
		var hasarray = [];
		for(var i in data){
			for(var j in data[i]){
				var notin = true;
				for (var k = 0; k < hasarray.length; k++) {
					if(hasarray[k] == data[i][j].state){
						notin = false;
					}
				}
				if(notin){
					str += '<option value="'+data[i][j].state+'">'+projectstate(data[i][j].state)+'</option>';
					hasarray[hasarray.length] = data[i][j].state;
				}
			}
		}
		$('#selectbox_statistics').html(str);
	}
	function inputselect3(data){
		var str = '<option value="0">所有人员</option>';
		var hasarray = [];
		for(var i in data){
			for(var j in data[i]){
				var notin = true;
				if(ispurchaser){
					for (var k = 0; k < hasarray.length; k++) {
						if(hasarray[k] == data[i][j].treeuserid){
							notin = false;
						}
					}
					if(notin){
						str += '<option value="'+data[i][j].treeuserid+'">'+data[i][j].username+'</option>';
						hasarray[hasarray.length] = data[i][j].treeuserid;
					}
				}else{
					for (var k = 0; k < hasarray.length; k++) {
						if(hasarray[k] == data[i][j].userid){
							notin = false;
						}
					}
					if(notin){
						str += '<option value="'+data[i][j].userid+'">'+data[i][j].username+'</option>';
						hasarray[hasarray.length] = data[i][j].userid;
					}
				}
			}
		}
		$('#selectbox_supplier').html(str);
	}
	function loadimgselect(){
		imageselect1(projectimagedata);
		imageselect2(projectimagedata);
		imageselect3(projectimagedata);
		selectimagedata = projectimagedata;
	}
	function imageselect1(data){
		var str = '<option value="0">全部苗木</option>';
		var hasarray = [];
		for(var i in data){
			var notin = true;
			for (var k = 0; k < hasarray.length; k++) {
				if(hasarray[k] == data[i].tree_id){
					notin = false;
				}
			}
			if(notin){
				str += '<option value="'+data[i].tree_id+'">'+data[i].tree_name+'</option>';
				hasarray[hasarray.length] = data[i].tree_id;
			}
		}
		$('#projectselectbox_treename').html(str);
	}
	function imageselect2(data){
		var str = '<option value="0">所有进度</option>';
		var hasarray = [];
		for(var i in data){
			var notin = true;
			for (var k = 0; k < hasarray.length; k++) {
				if(hasarray[k] == data[i].state){
					notin = false;
				}
			}
			if(notin){
				str += '<option value="'+data[i].state+'">'+projectstate(data[i].state)+'</option>';
				hasarray[hasarray.length] = data[i].state;
			}
		}
		$('#projectselectbox_statistics').html(str);
	}
	function imageselect3(data){
		var str = '<option value="0">所有人员</option>';
		var hasarray = [];
		for(var i in data){
			var notin = true;
			for (var k = 0; k < hasarray.length; k++) {
				if(hasarray[k] == data[i].userid){
					notin = false;
				}
			}
			if(notin){
				str += '<option value="'+data[i].userid+'">'+data[i].username+'</option>';
				hasarray[hasarray.length] = data[i].userid;
			}
		}
		$('#projectselectbox_supplier').html(str);
	}
	function initMap(){
	    mymap = new qq.maps.Map(document.getElementById('boy'), {disableDefaultUI: true});
	    initTooltipOverlay();
	    removeMapVersion('boy');    
	    // 缩放事件
	    qq.maps.event.addListener(mymap,'zoom_changed',function() {
	        var zoomLevel = mymap.getZoom();
	        if (zoomLevel>=16){
	        	// 显示一种照相地图。
	            mymap.setMapTypeId(qq.maps.MapTypeId.SATELLITE);  
	        } else {
	        	// 显示一种标准的，默认是 2D 的地图。
	            mymap.setMapTypeId(qq.maps.MapTypeId.ROADMAP);
	        }
	    });
	}
	function chooseproject(map_id){
	    if(mymap){
	    	var newdata = [];
	    	if(ispurchaser){
	    		if(photolistbuy){
			    	for (var i = 0; i < photolistbuy.length; i++) {
			    		if(photolistbuy[i].mapid == map_id){
			    			newdata[newdata.length] = photolistbuy[i];
			    		}
			    	}
	    		}
	    	}else{
	    		if(photolistsell){
		    		for (var i = 0; i < photolistsell.length; i++) {
		    			if(photolistsell[i].mapid == map_id){
		    				newdata[newdata.length] = photolistsell[i];
		    			}
		    		}
	    		}
	    	}
	    	if(newdata.length){
	    		$('#boy').css('height',(height-196)+'px');
	    		$('#imagetip').show();
	    	}else{
	    		$('#boy').css('height',(height-96)+'px');
	    		$('#imagetip').hide();
	    	}   
	    	deletealldom();		
			addlistering(newdata);
	    }
    }
	$('#container').on('click','.searchallproject',function(){
		if(ispurchaser){
			if((projectlistbuy == null) || (projectlistbuy.length)){
				$('.identity').removeClass('identity');
				$('.isbuy').addClass('identity');
				if(projectlistbuy){
					$('#left_project').html(dot_projectname(projectlistbuy));
					console.log(treelistbuy);
					$('#right_tree').html(dot_treelistinfobuy(treelistbuy[projectlistbuy[0].id]));
					$('.treelist_row6').css('display','none');
				}else{
					$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
				window.pageManager.go('showallproject');
			}else{
				loadphotobuy('showallproject');
			}
		}else{
			if((projectlistsell == null) || (projectlistsell.length)){
				$('.identity').removeClass('identity');
				$('.issell').addClass('identity');
				if(projectlistsell){
					$('#left_project').html(dot_projectname(projectlistsell));
					console.log(treelistsell);
					$('#right_tree').html(dot_treelistinfo(treelistsell[projectlistsell[0].id]));
				}else{
					$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
				window.pageManager.go('showallproject');
			}else{
				loadphotosell('showallproject');
			}
		}
	})
	$('#container').on('click','.mysearch',function(){
		if(ispurchaser){
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
		}else{
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
		}
		changeover(getActiveMenu());
	})
	function selectProjectName(name) {
	    $('#selectProject').children().first().html(name);
	}
	function getPhotoTime(photoname) {
	    return parseInt(photoname.substr(3,10))*1000; 
	}
	function getTitle () {
	    return '找树网交易监管平台';
	}
	function getImageUrl(){
	    return 'http://cnzhaoshu.com/img/hall.jpg';
	}
	function getLink(){
	    return 'http://cnzhaoshu.com/map.php';
	} 
	function getDescription () {
	    return '为每一株苗木建立一份交易档案，从此无忧！';                     
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
</script>

<!-- 主页 -->
<script type="text/html" id="tpl_home">
    <div id="home" class="page">
    	<div class="header">
    		<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
    		<div class="isbuy">采购</div>
    		<div class="issell">供应</div>
    	</div>
	    <div id="boy">
	    </div>
	    <div id="imagetip" class="imagetip"></div>
    </div>
    <script type="text/javascript">
		initMap();
    	if((photolistbuy == null) || isObject(photolistbuy)){
    		changeover('home');
    	}else{
    		if(user.mapid){
    			loadthismap('home');

    		}else{
	    		loadphotobuy('home');
				loadphotosell();
    		}
    	}
    	ispurchaser?changetobuy():changetosell();
    	function changetobuy(){
    		$('.identity').removeClass('identity');
    		$('.isbuy').addClass('identity');
    	}
    	function changetosell(){
    		$('.identity').removeClass('identity');
    		$('.issell').addClass('identity');
    	}
    	$('#home').on('click','.isbuy',function(){
    		ispurchaser = true;
    		$('.identity').removeClass('identity');
    		$('.isbuy').addClass('identity');
    		deletealldom();
    		if(photolistbuy){
    			$('#boy').css('height',(height-196)+'px');
    			$('#imagetip').show();
    		}else{
    			$('#boy').css('height',(height-96)+'px');
    			$('#imagetip').hide();
    		}
    		addlistering(photolistbuy);
    	})
    	$('#home').on('click','.issell',function(){
    		ispurchaser = false;
    		$('.identity').removeClass('identity');
    		$('.issell').addClass('identity');
	    	if((photolistsell == null) || isObject(photolistsell)){
	    		deletealldom();
	    		if(photolistsell){
	    			$('#boy').css('height',(height-196)+'px');
	    			$('#imagetip').show();
	    		}else{
	    			$('#boy').css('height',(height-96)+'px');
	    			$('#imagetip').hide();
	    		}
	    		addlistering(photolistsell);
	    	}else{
	    		loadphotosell('home');
	    	}
    	})
    	$('#imagetip').on('touchstart', onImagetipTouchstart);
    	$('#imagetip').on('click','li',function(){
    		var id = $(this).data('maporder');
    		var data;
    		ispurchaser?(data = photolistbuy):(data = photolistsell);
    		for (var i = 0; i < data.length; i++) {
    			if(data[i].maporderid == id){
					$.getJSON('/com/search_map_orderphoto.php',{id:id,ispurchaser:ispurchaser},function(json){
						if(json){
    						projectimagedata = json;
    						$('#listimage').html(loadstatisticphoto(json));
    						window.pageManager.go('projectimage');	
						}
					})
    			}
    		}
    		for (var id in imagetip) {
		        $('#imagetip [data-id="' + id + '"]').remove();
		        delete imagetip[id];
		        overlay[id].setMap(null);
		        delete overlay[id];
    		}
    	})
    </script>
</script>

<!-- 进度详情 -->
<script id="tpl_recordview" type="text/html">
	<div id="recordview" class="page fullpage">
		<div id="photoinfo"></div>
	</div>
	<script type="text/javascript">
		$('#photoinfo').html(writeinfo(photoindex));
		$('#photoinfo').on('click','.addresspng',function(){
			window.location = 'http://apis.map.qq.com/uri/v1/marker?marker=coord:'+photoindex.x+','+photoindex.y+';title:'+photoindex.tree_name+photoindex.username+'&amp;key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&amp;referer=zhaoshu';
		})
	</script>
</script>

<!-- 全部项目 -->
<script type="text/html" id="tpl_showallproject">
    <div class="page" id="mysearch">
    	<div class="header">
    		<div class="allproject mysearch">全部项目<i class="iconfont icon-select"></i></div>
    		<div class="isbuy">采购</div>
    		<div class="issell">供应</div>
    	</div>
	    <div class="projectlists">
		    <div class="left">
		    	<div class="projectleftbox" id="left_project">
		    	</div>
		    	<div class="createnew" onclick="window.pageManager.go('createnew')">+</div>
		    </div>
		    <div class="right">
		    	<div class="findalltree">全部</div>
    	    	<div class="projectrightbox" id="right_tree">
    	    	</div>
    	    	<div class="createnewtree">+</div>
		    </div>
	    </div>
		<div class="qrcodeimages">
			<p class="qrcodeimage_font"></p>
			<img src="" class="qrcodeimage" id="qrcodeimages3">
		</div>
    </div>
    <script type="text/javascript">
    	$('.projectlists').css('height',(height-96)+'px');
    	$('.projectleftbox').css('height',(height-129)+'px');
    	$('.projectrightbox').css('height',(height-162)+'px');
    	$('.qrcodeimages').css('height',(height-50)+'px');
    	ispurchaser?changetobuy():changetosell();
    	function changetobuy(){
    		$('.identity').removeClass('identity');
    		$('.isbuy').addClass('identity');
    		if((projectlistbuy == null) || (projectlistbuy.length)){
    			if(projectlistbuy){
    				$('#left_project').html(dot_projectname(projectlistbuy));
    				$('#right_tree').html(dot_treelistinfobuy(treelistbuy[projectlistbuy[0].id]));
    			}else{
    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    			}
    		}else{
    			loadphotobuy('showallproject');
    		}
    	}
    	function changetosell(){
    		$('.identity').removeClass('identity');
    		$('.issell').addClass('identity');
    		if((projectlistsell == null) || (projectlistsell.length)){
    			if(projectlistsell){
    				$('#left_project').html(dot_projectname(projectlistsell));
    				$('#right_tree').html(dot_treelistinfo(treelistsell[projectlistsell[0].id]));
    			}else{
    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    			}
    		}else{
    			loadphotosell('showallproject');
    		}
    	}
		$('#left_project').on('click','.projectname',function(){
			var mapid = $(this).attr('mapid');
			$(this).siblings().removeClass('plon');
			$(this).addClass('plon');
			if(ispurchaser){
				$('#right_tree').html(dot_treelistinfobuy(treelistbuy[mapid]));
			}else{
				$('#right_tree').html(dot_treelistinfo(treelistsell[mapid]));
			}
		})	
		$('#right_tree').on('click','.treelist_row3',function(){
			var orderid = $(this).parent().attr('orderid');
			window.location.href = './imagegps.php?maporderid='+orderid;
		})
		$('#right_tree').on('click','.treelist_row6',function(){
			var mapid = $(this).parent().attr('mapid');
			var orderid = $(this).parent().attr('orderid');
			for(var i in projectlistsell){
				if(projectlistsell[i].id == mapid){
					var name = projectlistsell[i].name;
				}
			}
			$('#qrcodeimages3').attr('src','./maporderqxqrcode/'+treelistsell[mapid][orderid].qxqrcode+'.png');
			$('.qrcodeimage_font').html('给授权上传的用户扫描<br>('+name+' '+treelistsell[mapid][orderid].tree_name+')');
			$('#mysearch .qrcodeimages').fadeIn(200);
		})
		$('#mysearch .qrcodeimages').click(function() {
			$('#mysearch .qrcodeimages').fadeOut(100);
		});
		$('#mysearch').on('click','.createnewtree',function(){
			if(ispurchaser){
				if(projectlistbuy){
					var qrcode = $('#left_project .plon').attr('qrcode');
					window.location.href = './createrelationship.php?id='+qrcode;
				}else{
					alert('请点击左侧 + 号创建项目！');
				}
			}else{
				if(projectlistsell){
					var qrcode = $('#left_project .plon').attr('qrcode');
					window.location.href = './createrelationship.php?id='+qrcode;
				}else{
					alert('无项目，不可创建！');
				}
			}
		})

		// 看单个苗木
		$('#right_tree').on('click','.looktreelist',function(){
			var mapid = $(this).parent().attr('mapid');
			var treeid = $(this).parent().attr('treeid');
			var orderid = $(this).parent().attr('orderid');
			switch (getActiveMenu())
			{
			    case 'home':
			    	if(mymap){
				    	var newdata = [];
				    	if(ispurchaser){
				    		if(photolistbuy){
						    	for (var i = 0; i < photolistbuy.length; i++) {
						    		if(photolistbuy[i].maporderid == orderid){
						    			newdata[newdata.length] = photolistbuy[i];
						    		}
						    	}
				    		}
				    	}else{
				    		if(photolistsell){
					    		for (var i = 0; i < photolistsell.length; i++) {
					    			if(photolistsell[i].maporderid == orderid){
					    				newdata[newdata.length] = photolistsell[i];
					    			}
					    		}
				    		}
				    	}		
				    	if(newdata.length){
				    		$('#boy').css('height',(height-196)+'px');
				    		$('#imagetip').show();
				    	}else{
				    		$('#boy').css('height',(height-96)+'px');
				    		$('#imagetip').hide();
				    	} 
				    	deletealldom();  		
		    			addlistering(newdata);
			    	}
			    break;
			    case 'projectimage':
    		    	var newphotolistbuy = [];
    		    	if(ispurchaser){
    		    		for (var i = 0; i < photoallbuy.length; i++) {
    		    			if((photoallbuy[i].mapid == mapid) && (photoallbuy[i].tree_id == treeid)) newphotolistbuy[newphotolistbuy.length] = photoallbuy[i];
    		    		}
    		    	}else{
    		    		for (var i = 0; i < photoallsell.length; i++) {
    		    			if((photoallsell[i].mapid == mapid) && (photoallsell[i].tree_id == treeid)) newphotolistbuy[newphotolistbuy.length] = photoallsell[i];
    		    		}
    		    	}	
    	    		$('#listimage').html(loadstatisticphoto(newphotolistbuy));
			    break;
			    case 'statistics':
			    	statisticsprojectdata = [];
			    	statisticstreedata = {};
			    	if(ispurchaser){
			    		for (var i = 0; i < projectlistbuy.length; i++) {
			    			if(projectlistbuy[i].id == mapid)statisticsprojectdata[statisticsprojectdata.length] = projectlistbuy[i];
			    		}
			    		for(var i in treelistbuy){
			    			if(i == mapid){
			    				for (var j in treelistbuy[i]) {
			    					if(j == orderid){
			    						statisticstreedata[mapid] = {};
			    						statisticstreedata[mapid][j] = treelistbuy[i][j];
			    					}
			    				}
			    			}
			    		}
			    	}else{
			    		for (var i = 0; i < projectlistsell.length; i++) {
			    			if(projectlistsell[i].id == mapid)statisticsprojectdata[statisticsprojectdata.length] = projectlistsell[i];
			    		}
			    		for(var i in treelistsell){
			    			if(i == mapid){
			    				for (var j in treelistsell[i]) {
			    					if(j == orderid){
			    						statisticstreedata[mapid] = {};
			    						statisticstreedata[mapid][j] = treelistsell[i][j];
			    					}
			    				}
			    			}
			    		}
			    	}	
			    	loadselect();
			        $('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));			        
			    break;
			    case 'member':
			        projectdata = [];
			        treedata = {};
			        if(ispurchaser){
			        	for (var i = 0; i < projectlistbuy.length; i++) {
			        		if(projectlistbuy[i].id == mapid)projectdata[projectdata.length] = projectlistbuy[i];
			        	}
			        	for(var i in treelistbuy){
			        		if(i == mapid){
			        			for (var j in treelistbuy[i]) {
			        				if(j == orderid){
			        					treedata[mapid] = {};
			        					treedata[mapid][j] = treelistbuy[i][j];
			        				}
			        			}
			        		}
			        	}
			        	$('#listimage2').html(loadprojectuser(projectdata,treedata));
			        }else{
			        	for (var i = 0; i < projectlistsell.length; i++) {
			        		if(projectlistsell[i].id == mapid)projectdata[projectdata.length] = projectlistsell[i];
			        	}
			        	for(var i in treelistsell){
			        		if(i == mapid){
			        			for (var j in treelistsell[i]) {
			        				if(j == orderid){
			        					treedata[mapid] = {};
			        					treedata[mapid][j] = treelistsell[i][j];
			        				}
			        			}
			        		}
			        	}
			        	$('#listimage2').html(loadprojectsuppler(projectdata,treedata));
			        }
			    break;
			}
			window.pageManager.go(getActiveMenu());
		})

		// 看订单下的所有苗木
		$('.findalltree').click(function(){
			var mapid = $('#left_project .plon').attr('mapid');
			switch (getActiveMenu())
			{
			    case 'home':
				    chooseproject(mapid);
			    break;
			    case 'projectimage':
			    	var newphotolistbuy = [];
			    	if(ispurchaser){
			    		for (var i = 0; i < photoallbuy.length; i++) {
			    			if(photoallbuy[i].mapid == mapid) newphotolistbuy[newphotolistbuy.length] = photoallbuy[i];
			    		}
			    	}else{
			    		for (var i = 0; i < photoallsell.length; i++) {
			    			if(photoallsell[i].mapid == mapid) newphotolistbuy[newphotolistbuy.length] = photoallsell[i];
			    		}
			    	}	
		    		$('#listimage').html(loadstatisticphoto(newphotolistbuy));
			    break;
			    case 'statistics':
			    	statisticsprojectdata = [];
			    	statisticstreedata = {};
			    	if(ispurchaser){
			    		if(isObject(treelistbuy)){
				    		for (var i = 0; i < projectlistbuy.length; i++) {
				    			if(projectlistbuy[i].id == mapid)statisticsprojectdata[statisticsprojectdata.length] = projectlistbuy[i];
				    		}
				    		for(var i in treelistbuy){
				    			if(i == mapid){
				    				statisticstreedata[mapid] = treelistbuy[i];
				    			}
				    		}
			    		}
			    	}else{
			    		for (var i = 0; i < projectlistsell.length; i++) {
			    			if(projectlistsell[i].id == mapid)statisticsprojectdata[statisticsprojectdata.length] = projectlistsell[i];
			    		}
			    		for(var i in treelistsell){
			    			if(i == mapid){
			    				statisticstreedata[mapid] = treelistsell[i];
			    			}
			    		}
			    	}		
			    	loadselect();	        
			        $('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));
			    break;
			    case 'member':
			        projectdata = [];
			        treedata = {};
			        if(ispurchaser){
			        	for (var i = 0; i < projectlistbuy.length; i++) {
			        		if(projectlistbuy[i].id == mapid)projectdata[projectdata.length] = projectlistbuy[i];
			        	}
			        	for(var i in treelistbuy){
			        		if(i == mapid){
			        			treedata[mapid] = treelistbuy[i];
			        		}
			        	}
			        	$('#listimage2').html(loadprojectuser(projectdata,treedata));
			        }else{
			        	for (var i = 0; i < projectlistsell.length; i++) {
			        		if(projectlistsell[i].id == mapid)projectdata[projectdata.length] = projectlistsell[i];
			        	}
			        	for(var i in treelistsell){
			        		if(i == mapid){
			        			treedata[mapid] = treelistsell[i];
			        		}
			        	}
			        	$('#listimage2').html(loadprojectsuppler(projectdata,treedata));
			        }
			    break;
			}
	        window.pageManager.go(getActiveMenu());
		})

		function getActiveMenu() {
		    return $('#tabbar .on').data('id');
		}

		$('#mysearch').on('click','.isbuy',function(){
			ispurchaser = true;
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			if((projectlistbuy == null) || (projectlistbuy.length)){
				if(projectlistbuy){
					$('#left_project').html(dot_projectname(projectlistbuy));
					$('#right_tree').html(dot_treelistinfobuy(treelistbuy[projectlistbuy[0].id]));
				}else{
					$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
			}else{
				loadphotobuy('showallproject');
			}
		})

		$('#mysearch').on('click','.issell',function(){
			ispurchaser = false;
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			if((projectlistsell == null) || (projectlistsell.length)){
				if(projectlistsell){
					$('#left_project').html(dot_projectname(projectlistsell));
					$('#right_tree').html(dot_treelistinfo(treelistsell[projectlistsell[0].id]));
				}else{
					$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
			}else{
				loadphotosell('showallproject');
			}
		})
    </script>
</script>

<!-- 进度 -->
<script type="text/html" id="tpl_projectimage">
    <div id="projectimage" class="page">
		<div class="header">
			<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
			<div class="isbuy">采购</div>
			<div class="issell">供应</div>
		</div>
		<div class="select_jdname">
			<div class="selectbox">
				<select id="projectselectbox_treename" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="projectselectbox_statistics" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="projectselectbox_supplier" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
		</div>
		<div id="listimage">
		</div>
    </div>
    <script type="text/javascript">
    	$('#listimage').css('height',(height-132)+'px');
		ispurchaser?changetobuy():changetosell();
		loadimgselect();
		function changetobuy(){
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			tenderprojectimage();
		}
		function changetosell(){
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			supplierprojectimage();
		}

		function tenderprojectimage(){
			$('#listimage').html(loadstatisticphoto(projectimagedata));
			loadimgselect();
		}

		function supplierprojectimage(){
			$('#listimage').html(loadstatisticphoto(projectimagedata));
			loadimgselect()
		}

		$('#projectimage').on('click','.isbuy',function(){
			ispurchaser = true;
			loadingorder_index = false;
			loadendorder_index = false;
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			if((photoallbuy == null) || (photoallbuy.length)){
				projectimagedata = photoallbuy;
				tenderprojectimage();
			}else{
				loadphotoallbuy('projectimage');
			}
		})

		$('#projectimage').on('click','.issell',function(){
			ispurchaser = false;
			loadingorder_index = false;
			loadendorder_index = false;
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			if((photoallsell == null) || (photoallsell.length)){
    			projectimagedata = photoallsell;
				supplierprojectimage();
    		}else{
    			loadphotoallsell('projectimage');
    		}
		})

		$('#listimage').scroll(function () {
		    if (loadingorder_index || loadendorder_index) return;
		    var scrollHeight = $(this)[0].scrollHeight;
		    var scrollTop = $(this)[0].scrollTop;
		    var elementHight = $(this).height();
		    if(scrollTop + elementHight >= scrollHeight-300) {
		    	if(ispurchaser){
		        	loadphotoallbuy();
		    	}else{
		    		loadphotoallsell();
		    	}
		    } 
		});

		var changedata1 = {};
		var changedata2 = {};
		$('#projectselectbox_treename').on('change', function () {
		    var treeid = $('#projectselectbox_treename').val();
		    if(treeid == 0){
		    	var newdata = selectimagedata;
		    }else{
			    var newdata = [];
			    for(var i in selectimagedata){
			    	if(selectimagedata[i].tree_id == treeid){
			    		newdata[newdata.length] = selectimagedata[i];
			    	}
			    }
		    }
		    changedata1 = newdata;
		    changedata2 = newdata;
		    $('#listimage').html(loadstatisticphoto(newdata));
		    imageselect2(changedata1);
		    imageselect3(changedata1);
		});

		$('#projectselectbox_statistics').on('change', function () {
		    var state = $('#projectselectbox_statistics').val();
		    if(!isObject(changedata1)){
		    	changedata1 = selectimagedata;
		    }
		    if(state == 0){
		    	var newdata = changedata1;
		    }else{
			    var newdata = [];
			    for(var i in changedata1){
			    	if(changedata1[i].state == state){
			    		newdata[newdata.length] = changedata1[i];
			    	}
			    }
		    }
		    changedata2 = newdata;
		    $('#listimage').html(loadstatisticphoto(newdata));
		    imageselect3(changedata2);
		});

		$('#projectselectbox_supplier').on('change', function () {
		    var userid = $('#projectselectbox_supplier').val();
		    if(!isObject(changedata2)){
		    	changedata2 = selectimagedata;
		    }
		    if(userid == 0){
		    	var newdata = changedata2;
		    }else{
			    var newdata = [];
			    for(var i in changedata2){
			    	if(changedata2[i].userid == userid){
			    		newdata[newdata.length] = changedata2[i];
			    	}
			    }
		    }
		    $('#listimage').html(loadstatisticphoto(newdata));
		});
    </script>
</script>

<!-- 统计 -->
<script type="text/html" id="tpl_statistics">
    <div id="statistics" class="page">
		<div class="header">
			<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
			<div class="isbuy">采购</div>
			<div class="issell">供应</div>
		</div>
		<div class="select_name">
			<div class="selectbox">
				<select id="selectbox_treename" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="selectbox_statistics" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="selectbox_supplier" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
		</div>
		<div class="select_time">
        	<input id="begindate2" class="weui-input select_timeinput" type="date">
        	<input id="enddate2" class="weui-input select_timeinput" type="date">
		</div>
		<div id="listimage1">
		</div>
    </div>
    <script type="text/javascript">
		var ymdtime = new Date();
		var y = ymdtime.getFullYear();
		var m = ymdtime.getMonth()+1;
		m = (m < 10)? '0'+m : m;
		var d = ymdtime.getDate();
		d = (d < 10)? '0'+d : d;

		loadselect();
		
    	$('#listimage1').css('height',(height-167)+'px');
		if (!$('#begindate2').val()) $('#begindate2').val('2016-01-01');
		if (!$('#enddate2').val()) $('#enddate2').val(y+'-'+m+'-'+d);

		ispurchaser?changetobuy():changetosell();

		function changetobuy(){
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			tenderstatistics();
		}

		function changetosell(){
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			supplierstatistics();
		}

		function tenderstatistics(){
			if((projectlistbuy == null) || (projectlistbuy.length)){
				statisticsprojectdata = projectlistbuy;
				statisticstreedata = treelistbuy;
				if(isObject(treelistbuy)){
					$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));
				}else{
					$('#listimage1').html('<div class="weui-loadmore">没有数据！</div>');
				}
				loadselect();
			}else{
				loadphotobuy('statistics');
			}
		}

		function supplierstatistics(){
			if((projectlistsell == null) || (projectlistsell.length)){
				statisticsprojectdata = projectlistsell;
				statisticstreedata = treelistsell;
				if(isObject(treelistsell)){
					$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));
				}else{
					$('#listimage1').html('<div class="weui-loadmore">没有数据！</div>');
				}
				loadselect();
			}else{
				loadphotosell('statistics');
			}
		}

		$('#statistics').on('click','.isbuy',function(){
			ispurchaser = true;
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			tenderstatistics();
		})

		$('#statistics').on('click','.issell',function(){
			ispurchaser = false;
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			supplierstatistics();
		})

		var changedata1 = {};
		var changedata2 = {};
		$('#selectbox_treename').on('change', function () {
		    var treeid = $('#selectbox_treename').val();
		    if(treeid == 0){
		    	var newdata = statisticstreedata;
		    }else{
			    var newdata = {};
			    for (var i in statisticstreedata) {
			    	dataselect = {};
			    	for (var j in statisticstreedata[i]){
			    		if(statisticstreedata[i][j].tree_id == treeid){
			    			dataselect[j] = statisticstreedata[i][j];
			    		}
			    	}
			    	if(isObject(dataselect)){
			    		newdata[i] = dataselect;
			    	}
			    }
		    }
		    changedata1 = newdata;
		    changedata2 = newdata;
		    $('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,newdata)));
		    inputselect2(changedata1);
		    inputselect3(changedata1);
		});

		$('#selectbox_statistics').on('change', function () {
		    var state = $('#selectbox_statistics').val();
		    if(!isObject(changedata1)){
		    	changedata1 = statisticstreedata;
		    }
		    if(state == 0){
		    	var newdata = changedata1;
		    }else{
			    var newdata = {};
			    for (var i in changedata1) {
			    	dataselect = {};
			    	for (var j in changedata1[i]){
			    		if(changedata1[i][j].state == state){
			    			dataselect[j] = changedata1[i][j];
			    		}
			    	}
			    	if(isObject(dataselect)){
			    		newdata[i] = dataselect;
			    	}
			    }
		    }
		    changedata2 = newdata;
		    $('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,newdata)));
		    inputselect3(changedata2);
		});

		$('#selectbox_supplier').on('change', function () {
		    var userid = $('#selectbox_supplier').val();
		    if(!isObject(changedata2)){
		    	changedata2 = statisticstreedata;
		    }
		    if(userid == 0){
		    	var newdata = changedata2;
		    }else{
			    var newdata = {};
			    for (var i in changedata2) {
			    	dataselect = {};
			    	for (var j in changedata2[i]){
			    		if(ispurchaser){
				    		if(changedata2[i][j].treeuserid == userid){
				    			dataselect[j] = changedata2[i][j];
				    		}
			    		}else{
			    			if(changedata2[i][j].userid == userid){
			    				dataselect[j] = changedata2[i][j];
			    			}
			    		}
			    	}
			    	if(isObject(dataselect)){
			    		newdata[i] = dataselect;
			    	}
			    }
		    }
		    $('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,newdata)));
		});


		$('#begindate2').change(function(){
			var begindate2 = $('#begindate2').val();
			var newdata = {};

		    for (var i in statisticstreedata) {
		    	dataselect = {};
		    	for (var j in statisticstreedata[i]){
		    		if(statisticstreedata[i][j].time >= begindate2){
	    				dataselect[j] = statisticstreedata[i][j];
	    			}
		    	}
		    	if(isObject(dataselect)){
		    		newdata[i] = dataselect;
		    	}
		    }
			$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,newdata)));
		})

		$('#enddate2').change(function(){
			var enddate2 = $('#enddate2').val();
			var newdata = {};

		    for (var i in statisticstreedata) {
		    	dataselect = {};
		    	for (var j in statisticstreedata[i]){
		    		if(statisticstreedata[i][j].time <= enddate2){
	    				dataselect[j] = statisticstreedata[i][j];
	    			}
		    	}
		    	if(isObject(dataselect)){
		    		newdata[i] = dataselect;
		    	}
		    }
			$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,newdata)));
		})
    </script>
</script>

<!-- 人员 -->
<script type="text/html" id="tpl_member">
    <div id="member" class="page">
		<div class="header">
			<div class="allproject searchallproject" >全部项目<i class="iconfont icon-select"></i></div>
			<div class="isbuy">采购</div>
			<div class="issell">供应</div>
		</div>
		<div id="listimage2">
		</div>
    </div>
    <script type="text/javascript">
    	$('#listimage2').css('height',(height-96)+'px');
		ispurchaser?changetobuy():changetosell();

		function changetobuy(){
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			tendermember();
		}

		function changetosell(){
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			supplermember();
		}

		function tendermember(){
			if((projectlistbuy == null) || (projectlistbuy.length)){
				if(isObject(treelistbuy)){
					$('#listimage2').html(loadprojectuser(projectlistbuy,treelistbuy));
				}else{
					$('#listimage2').html('<div class="weui-loadmore">没有数据！</div>');
				}
			}else{
				loadphotobuy('member');
			}
		}

		function supplermember(){
			if((projectlistsell == null) || (projectlistsell.length)){
				if(isObject(treelistsell)){
					$('#listimage2').html(loadprojectsuppler(projectlistsell,treelistsell));
				}else{
					$('#listimage2').html('<div class="weui-loadmore">没有数据！</div>');
				}
			}else{
				loadphotosell('member');
			}
		}

		$('#member').on('click','.isbuy',function(){
			ispurchaser = true;
			$('.identity').removeClass('identity');
			$('.isbuy').addClass('identity');
			tendermember();
		})

		$('#member').on('click','.issell',function(){
			ispurchaser = false;
			$('.identity').removeClass('identity');
			$('.issell').addClass('identity');
			supplermember();
		})
    </script>
</script>

<!-- 我的管理 -->
<script type="text/html" id="tpl_profile">
    <div class="page">
	    <div id="mangerself">
	    	<div class="selfinfobox">
		    	<img id="selfinfo_headimg" src="">
	    		<div id="selfinfo_name"></div>
	    	</div>
	        <div class="mangerlist" onclick="window.pageManager.go('mangerproject')">
		        <span>交易监管</span>
	        </div>
	        <div class="relogin">重新登录</div>
	    </div>
    </div>
    <script type="text/javascript">
    	$('#mangerself').css('height',(height-50)+'px');
    	$('#selfinfo_name').css('width',(0.94*width-110)+'px');
  
    	$('#selfinfo_headimg').attr('src','headimg/96/'+user.userid+'.jpg');
    	$('#selfinfo_name').html(user.name+'<br>'+user.phone);

    	$('.relogin').click(function() {
    		reLogin();
    	});
    </script>
</script>

<!-- 我的项目管理 -->
<script type="text/html" id="tpl_mangerproject">
    <div class="page" id="mangerprojectbox">
    	<div class="showprojects">
    		<div class="sharelookpower">授权所有项目</div>
		    <div id="projects">
		    </div>
	    	<div class="create_project" onclick="window.pageManager.go('createnew')">新建项目</div>
    	</div>
	    <div class="qrcodeimages">
	    	<div class="qrcodeimage_font"></div>
	    	<img src="" class="qrcodeimage" id="qrcodeimages1">
	    </div>
    </div>
    <script type="text/javascript">
    	$('.showprojects').css('height',(height-50)+'px');
    	var showdata = [];
    	if((projectlistbuy != null) && (projectlistbuy.length)){
	    	for (var i = 0; i < projectlistbuy.length; i++) {
	    		if(projectlistbuy[i].switch == 1){
	    			showdata[showdata.length] = projectlistbuy[i];
	    		}
	    	}
    	}

    	$('#projects').append(dot_myproject(showdata));
    	$('.qrcodeimages').css('height',(height-50)+'px');
    	// 点击获取二维码
    	$('#projects').on('click','.myprojectname_image',function(){
    		qrcodeimg = $(this).attr('image');
    		var name = $(this).parent().find('.myprojectname_name').html();
    		$('#qrcodeimages1').attr('src','./mapqrcode/'+qrcodeimg+'.png');
    		$('.qrcodeimage_font').html('将二维码发送给卖家即可生成苗木监管<br>('+name+')');
    		$('#mangerprojectbox .qrcodeimages').show();
    	})

    	$('#projects').on('click','.myprojectname_share',function(){
    		qrcodeimg = $(this).attr('image');
    		var name = $(this).parent().find('.myprojectname_name').html();
    		$('#qrcodeimages1').attr('src','./shareprojectqx/'+qrcodeimg+'.png');
    		$('.qrcodeimage_font').html('扫描二维码加入项目监管<br>('+name+')');
    		$('#mangerprojectbox .qrcodeimages').show();
    	})

    	// 隐藏二维码
    	$('#mangerprojectbox .qrcodeimages').click(function(){
    		$('.qrcodeimages').hide();
    	})
    	// 点击停止项目
    	$('#projects').on('click','.myprojectname_stop',function(){
    		var edite = confirm('您确定要停止此项目？');
    		if(!edite) return;
    		var that = $(this);
    		var mapid = that.parent().attr('mapid');
    		$.get('/com/map_user_stop.php',{userid:user.userid,id:mapid},function(result){
    			if(result){
    				that.parent().remove();
    				var newbuy = [];
    				for (var i = 0; i < projectlistbuy.length; i++) {
    					if(projectlistbuy[i].id != mapid){
    						newbuy[newbuy.length] = projectlistbuy[i];
    					}
    				}
    				projectlistbuy = newbuy;
    			}
    		})	
    	})

    	$('.sharelookpower').click(function(){
    		$('#qrcodeimages1').attr('src','./mapgroupqrcode/'+user.userid+'.png');
    		$('.qrcodeimage_font').html('将二维码发送给授权的用户');
    		$('#mangerprojectbox .qrcodeimages').show();
    	})
    </script>
</script>

<!-- 新建项目 -->
<script type="text/html" id="tpl_createnew">
    <div class="page" id="createnewbox">
		<div class="create_newproject_title">
			<div class="center_title">创建新订单</div>
			<div class="create_newproject_row1">
				<div class="create_newproject_low1">订单名称：</div>
				<input id="create_newproject_low2" placeholder="请输入订单名称" type="text" name="">
			</div>
			<div class="create_newproject_row1">
				<div class="create_newproject_low1">用苗地：</div>
				<div class="create_newproject_low3">选择地址</div>
			</div>
			<div id="create_newproject_address"></div>
			<div class="map_reset" onclick="window.pageManager.back()">返回</div>
			<div class="map_submit">创建</div>
		</div>
		<div id="map_address">
			<div class="input_address">
				<div class="input_address_box">
					<input id="input_address" type="" name="">
					<span class="input_addresss">搜索</span>
				</div>
				<div class="input_address_submit">确定</div>
			</div>
			<div id="address_map"></div>
			<div class="now_address"></div>
		</div>
		<div class="qrcodeimages">
			<div class="qrcodeimage_font">将此二维码发送给卖家即可生成苗木监管</div>
			<img src="" class="qrcodeimage" id="qrcodeimages2">
		</div>
    </div>
    <script type="text/javascript">
    	$('.create_newproject_title').css('height',(height-50)+'px');
    	$('#map_address').css('height',(height-90)+'px');
    	$('#address_map').css('height',(height-75)+'px');
    	var topmap;
    	var addressdeteil = '';
    	// 搜索地址
    	$('.input_addresss').click(function () {
    		var keyword = $('#input_address').val();
    		keyword = $.trim(keyword);
    		if (keyword=='') return;
    	    searchaddresss(keyword);
    	});
    	// 搜索地址
    	function searchaddresss(address){
    	    var url = 'http://apis.map.qq.com/ws/place/v1/suggestion/?'
    	    var data={
    	        keyword: address,
    	        key: 'QXTBZ-QVTWP-LFADO-LBM67-HA4RH-VRFWT',
    	        output: "jsonp"
    	    };
    	    $.ajax({
    	            type:'get',
    	            dataType:'jsonp',
    	            data:data,
    	            url:url,
    	            success:function(json){
    	                if (json.status==0 && json.count>0) {
    	                    // 移动中心点, 不要重新创建地图
    	                    var location = json.data[0].location;
    	                    nowlat = location.lat;
    	                    nowlag = location.lng;
    	                    topmap.panTo(new qq.maps.LatLng( location.lat, location.lng ));
    	                    $('.now_address').html(address);
    	                } else {
    	                    alert('没找到，您可以拖动地图定位');
    	                }
    	            },
    	            error : function(err){alert("服务端错误，请刷新浏览器后重试")}
    	    }); 
    	}
    	// 加载地图
    	function openmap(){
    		if(!topmap){
    			var center = new qq.maps.LatLng(39.916527,116.397128);
    			topmap = new qq.maps.Map($('#address_map')[0], {
    				disableDefaultUI: true,
    				center: center,
    				zoom: 13
    			});
    			removeMapVersion('address_map');  
    			//创建自定义控件
    			$('<img>').addClass('middleControl')
    			          .attr('src','http://www.yangshuwang.com/img/poi.png')
    			          .appendTo('#address_map'); 

    			var keyword = $('#create_newproject_low2').val();
    			keyword = $.trim(keyword);
    			if (keyword) searchaddresss(keyword); 
    		}
    		
    		  //当地图中心属性更改时触发事件
    		qq.maps.event.addListener(topmap, 'center_changed', function() {
    		    nowlat = topmap.getCenter().lat;
    		    nowlag = topmap.getCenter().lng;
    		    var location = nowlat+','+nowlag;
    		    var url = 'http://apis.map.qq.com/ws/geocoder/v1/?';
    		    var data={
    		            location: location,
    		            key: 'QXTBZ-QVTWP-LFADO-LBM67-HA4RH-VRFWT',
    		            output: "jsonp"
    		        };
    		    $.ajax({
    		        type:'get',
    		        dataType:'jsonp',
    		        data:data,
    		        url:url,
    		        success:function(json){
    		            if(json.status == 0){
    		                var address = '位置：'+json.result.address;
    		                $('.now_address').html(address);
    		            }
    		        },
    		        error : function(err){alert("服务端错误，请刷新浏览器后重试")}
    		    }); 
    		});
    	}
    	// 点击选择地图
    	$('.create_newproject_low3').click(function(){
    		$('#map_address').show();
    		openmap();
    	})

    	// 创建新项目
    	$('.map_submit').click(function () {
    	    var projectname = $('#create_newproject_low2').val();
    	    if(nowlat){
    		    $.get('/com/map_user_insert.php',{userid:user.userid,name:projectname,x:nowlat,y:nowlag,address:addressdeteil},function(image){
    		    	if(image){
    			    	loadphotobuy();
    			    	$('.create_newproject').hide();
    			    	$('#qrcodeimages2').attr('src','./mapqrcode/'+image+'.png');
    			    	$('#createnewbox .qrcodeimages').show();
    		    	}else{
    		    		alert('创建失败！');
    		    	}
    		    })	    	
    	    }
    	});
    	// 确认用苗地
    	$('.input_address_submit').click(function(){
    		var location = nowlat+','+nowlag;
    		var url = 'http://apis.map.qq.com/ws/geocoder/v1/?';
    		var data={
    		        location: location,
    		        key: 'QXTBZ-QVTWP-LFADO-LBM67-HA4RH-VRFWT',
    		        output: "jsonp"
    		    };
    		$.ajax({
    		    type:'get',
    		    dataType:'jsonp',
    		    data:data,
    		    url:url,
    		    success:function(json){
    		        if(json.status == 0){
    		            var address = '用苗位置：'+json.result.address;
    		            $('#map_address').hide();
    		            $('#create_newproject_address').html(address);
    		            addressdeteil = json.result.address_component.province+json.result.address_component.city+json.result.address_component.district;
    		        }
    		    },
    		    error : function(err){alert("服务端错误，请刷新浏览器后重试")}
    		}); 
    	})

    	$('#createnewbox .qrcodeimages').click(function(){
    		$('#createnewbox .qrcodeimages').hide();
    		$('#projects .myprojectname').remove();
    		$('#projects').append(dot_myproject(projectlistbuy));
    		if(ispurchaser){
    			if(projectlistbuy){
    				$('#left_project').html(dot_projectname(projectlistbuy));
    				$('#right_tree').html(dot_treelistinfobuy(treelistbuy[projectlistbuy[0].id]));
    			}else{
    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    			}
    		}else{
    			if(projectlistsell){
    				$('#left_project').html(dot_projectname(projectlistsell));
    				$('#right_tree').html(dot_treelistinfo(treelistsell[projectlistsell[0].id]));
    			}else{
    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    			}
    		}
    		$('#tabbar a').removeClass('on');
    		$('#tabbar a:first-child').addClass('on');
    		window.pageManager.go('showallproject');
    	})
    </script>
</script>

<!-- 框架js -->
<script type="text/javascript">
 	var pageManager = {
 	    $container: $('#container'),
 	    _pageStack: [],
 	    _configs: [],
 	    _defaultPage: null,
 	    frontPage: null,
 	    setDefault: function (defaultPage) {
 	        this._defaultPage = this._find('name', defaultPage);
 	        return this;
 	    },
 	    init: function () {
 	        var self = this;

 	        $(window).on('hashchange', function () {
 	            var url = location.hash.indexOf('#') === 0 ? location.hash : '#';
 	            self.frontPage = url.replace('#','');

 	            var stack = self._findInStack(url);
 	            if (stack){
 	                $(stack.dom[0]).addClass('js_show').siblings('.js_show').removeClass('js_show');
 	            } else {
 	                var page = self._find('url', url) || self._defaultPage;
 	                self._go(page);
 	            }

 	            self._autoremove(self.frontPage);
 	            self._activeMenu(self.frontPage);
 	        });

 	        
 	        var url = location.hash.indexOf('#') === 0 ? location.hash : '#';
 	        self.frontPage = url.replace('#','');

 	        var page = self._find('url', url) || self._defaultPage;
 	        this._go(page);

 	        self._activeMenu(self.frontPage);

 	        return this;
 	    },
 	    _autoremove:function (name) {
 	        for(var i = 0, len = this._pageStack.length; i < len; i++){
 	            var stack = this._pageStack[i];
 	            if (stack && stack.config && stack.config.autoremove && stack.config.name != name) {
 	                stack.dom.remove();
 	                this._pageStack.splice(i,1);

 	                if (stack.config.js) $('#js_'+stack.config.name).remove();
 	            }
 	        }            
 	    },
 	    _activeMenu: function (id) {
 	        // 底部菜单项 响应
 	        $('#tabbar [data-id="' + (id||'home') + '"]').addClass('on').siblings('.on').removeClass('on');
 	        if (id=='member') {
 	            $('#header').addClass('member_search');
 	        } else {                        
 	            $('#header').removeClass('member_search');
 	        }
 	    },
 	    push: function (config) {
 	        this._configs.push(config);
 	        return this;
 	    },
 	    remove: function (name) {
 	        for(var i = 0, len = this._pageStack.length; i < len; i++){
 	            var stack = this._pageStack[i];
 	            if (stack.config.name === name) {
 	                stack.dom.remove();
 	                this._pageStack.splice(i,1);
 	                break;
 	            }
 	        }
 	    },
 	    find: function (name) {
 	        for(var i = 0, len = this._pageStack.length; i < len; i++){
 	            var stack = this._pageStack[i];
 	            if (stack.config.name === name) {
 	                return true;
 	            }
 	        }
 	        return false;
 	    },
 	    pop: function () {
 	        this.remove(this.frontPage);
 	        history.back();
 	    },
 	    go: function (to) {
 	        var config = this._find('name', to);
 	        if (!config) {
 	            return;
 	        }
 	        location.hash = config.url;
 	    },
 	    _go: function (config) {
 	        var html = $(config.template).html();
 	        var $html = $(html).addClass('slideIn');
 	        $html.on('animationend webkitAnimationEnd', function(){
 	            $html.removeClass('slideIn').addClass('js_show');
 	        });
 	        this.$container.append($html);
 	        this._pageStack.push({
 	            config: config,
 	            dom: $html
 	        });

 	        if (!config.isBind) {
 	            this._bind(config);
 	        }
 	        if (config.js) loadJS(config.js, 'js_'+config.name);

 	        return this;
 	    },
 	    back: function () {
 	        history.back();
 	    },
 	    _findInStack: function (url) {
 	        var found = null;
 	        for(var i = 0, len = this._pageStack.length; i < len; i++){
 	            var stack = this._pageStack[i];
 	            if (stack.config.url === url) {
 	                found = stack;
 	                break;
 	            }
 	        }
 	        return found;
 	    },
 	    _find: function (key, value) {
 	        var page = null;
 	        for (var i = 0, len = this._configs.length; i < len; i++) {
 	            if (this._configs[i][key] === value) {
 	                page = this._configs[i];
 	                break;
 	            }
 	        }
 	        return page;
 	    },
 	    _bind: function (page) {
 	        var events = page.events || {};
 	        for (var t in events) {
 	            for (var type in events[t]) {
 	                this.$container.on(type, t, events[t][type]);
 	            }
 	        }
 	        page.isBind = true;
 	    }
 	};

 	$('#tabbar a').on('click', function(){
 		$(this).siblings().removeClass('on');
 		$(this).addClass('on');
	    var id = $(this).data('id');
	    changeover(id);
	});

	function changeover(id){
		switch (id)
		{
		    case 'home':
		    	if(mymap){
			    	if((photolistbuy == null) || isObject(photolistbuy)){
				    	if(ispurchaser){
				    		if(photolistbuy){
				    			$('#boy').css('height',(height-196)+'px');
				    			$('#imagetip').show();
				    		}else{
				    			$('#boy').css('height',(height-96)+'px');
				    			$('#imagetip').hide();
				    		}
				    		deletealldom();
				    		addlistering(photolistbuy);
				    	}else{
				    		if(loadphotosell){
				    			$('#boy').css('height',(height-196)+'px');
				    			$('#imagetip').show();
				    		}else{
				    			$('#boy').css('height',(height-96)+'px');
				    			$('#imagetip').hide();
				    		}
				    		deletealldom();
				    		addlistering(photolistsell);
				    	}
			    	}
		    	}
	    		window.pageManager.go(id);	
		    break;
		    case 'projectimage':
		    	if(ispurchaser){
					if((photoallbuy == null) || (photoallbuy.length)){
						projectimagedata = photoallbuy;
						$('#listimage').html(loadstatisticphoto(projectimagedata));
						loadimgselect();
						window.pageManager.go(id);	
					}else{
						loadphotoallbuy('projectimage');
					}
		    	}else{
		    		if((photoallsell == null) || (photoallsell.length)){
		    			projectimagedata = photoallsell;
		    			$('#listimage').html(loadstatisticphoto(projectimagedata));
		    			loadimgselect();
		    			window.pageManager.go(id);	
		    		}else{
		    			loadphotoallsell('projectimage');
		    		}
		    	}	
		    break;
		    case 'statistics':
		    	if(ispurchaser){
	    			statisticsprojectdata = projectlistbuy;
	    			statisticstreedata = treelistbuy;
	    			if(isObject(treelistbuy)){
	    				$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));
	    			}else{
	    				$('#listimage1').html('<div class="weui-loadmore">没有数据！</div>');
	    			}
	    			loadselect();
	    			window.pageManager.go(id);	
		    	}else{
	    			statisticsprojectdata = projectlistsell;
	    			statisticstreedata = treelistsell;
	    			if(isObject(treelistsell)){
	    				$('#listimage1').html(dot_statistics_info(loadstatistics(statisticsprojectdata,statisticstreedata)));
	    			}else{
	    				$('#listimage1').html('<div class="weui-loadmore">没有数据！</div>');
	    			}
	    			loadselect();
	    			window.pageManager.go(id);	
		    	}		    		        
		    break;
		    case 'member':
		        if(ispurchaser){
	        		if(isObject(treelistbuy)){
	        			$('#listimage2').html(loadprojectuser(projectlistbuy,treelistbuy));
	        		}else{
	        			$('#listimage2').html('<div class="weui-loadmore">没有数据！</div>');
	        		}
	        		window.pageManager.go(id);	
		        }else{
	        		if(isObject(treelistsell)){
	        			$('#listimage2').html(loadprojectsuppler(projectlistsell,treelistsell));
	        		}else{
	        			$('#listimage2').html('<div class="weui-loadmore">没有数据！</div>');
	        		}
	        		window.pageManager.go(id);	
		        }
		    break;
		    case 'showallproject':
		    	if(ispurchaser){
	    			if(projectlistbuy){
	    				$('#left_project').html(dot_projectname(projectlistbuy));
	    				$('#right_tree').html(dot_treelistinfobuy(treelistbuy[projectlistbuy[0].id]));
	    			}else{
	    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
	    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
	    			}
	    			window.pageManager.go('showallproject');
		    	}else{
	    			if(projectlistsell){
	    				$('#left_project').html(dot_projectname(projectlistsell));
	    				$('#right_tree').html(dot_treelistinfo(treelistsell[projectlistsell[0].id]));
	    			}else{
	    				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
	    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
	    			}
	    			window.pageManager.go('showallproject');
		    	}
		    break;
		    case 'profile':
	    		$('#projects .myprojectname').remove();
	    		$('#projects').append(dot_myproject(projectlistbuy));
	    		window.pageManager.go(id);	
		    break;
		}
	}

    function setPageManager(){
        var pages = {}, tpls = $('script[type="text/html"]');
        for (var i = 0, len = tpls.length; i < len; ++i) {
            var tpl = tpls[i], name = tpl.id.replace(/tpl_/, '');
            pages[name] = {
                name: name,
                url: '#' + name,
                template: '#' + tpl.id,
                js:  $(tpl).data('js'),
                autoremove: $(tpl).data('id') ? true : false
            };
            pageManager.push(pages[name]);
        }
        pages.home.url = '#';
        pageManager.setDefault('home').init();
    }

    function clearcookie(){ 
        var keys=document.cookie.match(/[^ =;]+(?=\=)/g); 
        if (keys) { 
            for (var i = keys.length; i--;) 
            document.cookie=keys[i] + '=0;expires=' + new Date(0).toUTCString() + ";path=/;domain=cnzhaoshu.com";
        } 
    } 

    function reLogin() {
        clearcookie();
        location.reload(true);
    }

    var user = getcookie('user2');
    user = user ? JSON.parse(user) : null;
    var url = window.location.href.split('?');
    if(url[1]){
    	var shenfen = url[1].split('#');
    	if(shenfen[0] == 1){
    		ispurchaser = false;
    	}
    }
	$.post('/com/search_map_group.php', {userid: user.userid}, function(result) {
		if(result){
			user.userid = result;
		}else if(user.qxuserid){
	    	user.userid= user.qxuserid;
	    	projectlistsell = null;
	    	treelistsell = null;
	    	photolistsell = null;
	    	photoallsell = null;
	    }
		$('#headImage').attr('src','./headimg/96/'+user.userid+'.jpg');
		setPageManager();
	});

</script>
</body>