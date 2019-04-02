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
	<title>交易监管</title>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}
		.header{
			left: 10px;
			width: 380px;
			height: 40px;
			font-size: 18px;
			line-height: 40px;
			position: absolute;
		    top: 10px;
		    box-shadow: 0 2px 4px rgba(0,0,0,0.2), 0 -1px 0px rgba(0,0,0,0.02);
		    border-radius: 2px;
		    opacity: 0.8;
		    color: #fff;
		    background-color: #000;
		    z-index: 1000;
		}
		.allproject{
			width:90%;
			float: left;
			line-height: 40px;
			color:#fff;
			padding-left:5%;
		}
		#alerts{
            position: fixed;
            z-index: 1020;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background:rgba(0, 0, 0, 0.6);
            display: none;
        }
        #alert{
            position: fixed;
            z-index: 1030;
            width: 70%;
            height:70px;
            line-height: 70px;
            left:10%;
            top:35%;
            background-color: #fff;
            padding: 5%;
            text-align: left;
            border-radius: 4px;
            color:#09BB07;
            font-size: 17px;
        }
		/*全部项目*/
			.projectlists{
				width: 98%;
				float: left;
				padding: 2px 1%;
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
			.projectleftbox{
				width:100%;
				float: left;
				overflow-y: scroll;
				background: #ddd;
				-webkit-overflow-scrolling: touch;
			}
			.createnew{
				width: 91%;
				height: 35px;
				line-height: 35px;
				float: left;
				text-align: center;
				color: #fff;
				font-size: 18px;
				background: #aaa;
			}
			.findalltree{
				width: 91%;
				height: 33px;
				float: left;
				text-align: center;
				line-height: 33px;
				color: #fff;
				background: #ccc;
			}
			.findallproject{
				width: 91%;
				height: 33px;
				float: left;
				text-align: center;
				line-height: 33px;
				color: #fff;
				background: #aaa;
			}
			.projectrightbox{
				width:100%;
				float: left;
				overflow-y: scroll;
				background: #eee;
				-webkit-overflow-scrolling: touch;
			}
			.createnewtree{
				width: 91%;
				height: 35px;
				line-height: 35px;
				float: left;
				text-align: center;
				color: #fff;
				font-size: 18px;
				background: #ccc;
			}
			.projectname{
				width: 96%;
				padding: 8px 2%;
				background: #ddd;
				float: left;
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
			.plon{
				background: #eee;
				box-shadow: -30px 0 15px rgba(0,0,0,.3);
			}
			.treelist{
				width: 96%;
				padding: 5px 0;
				float: left;
				margin:0 2%;
				border-bottom: 1px dashed #fff;
			}
			.treelist_row1{
				width:70%;
				float: left;
				font-size: 16px;
				margin:0;
				height: 20px;
				line-height: 20px;
			}
			.treelist_row2{
				width:25%;
				float: left;
				text-align: right;
				font-size: 14px;
				margin:0;
				height: 20px;
				line-height: 20px;
			}
			.treelist_row3{
				width:100%;
				float: left;
				font-size: 13px;
				color:#999
			}
		/*新建项目*/
			.create_newproject_title{
				background: #eee;
				width:100%;
				left:0;
				top:0;
				height: 100%;
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
				position: absolute;
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
		/*主页*/
			#imagetip{
                display: none;
                position:absolute; 
                top:20px;
                width: 320px;
                height: 240px;
                margin-left: -5px;
                border: 2px #FF0000 solid;
                opacity: 0.9;
                box-shadow: 10px 10px 20px rgba(0,0,0,.6);
                -webkit-animation:b .5s forwards;animation:b .5s
            }
            @-webkit-keyframes b{0%{-webkit-transform:scale(0.1);transform:scale(0.1);opacity:0}to{-webkit-transform:scale(1);transform:scale(1);opacity:1}}
            @keyframes b{0%{-webkit-transform:scale(0.1);transform:scale(0.1);opacity:0}to{-webkit-transform:scale(1);transform:scale(1);opacity:1}}
			.imagetip li{
			    /*height: 360px;*/
			    height: 100%;
			    width: 100%;
			    background-position: center;
			    background-repeat: no-repeat;
			    background-size: cover;
			}
			.imagetip li p{
			    position: absolute;
			    background-color: #000;
			    text-shadow: 1px 1px 1px #000;
			    text-align: center;
			    opacity: 0.6;
			    width: 100%;
			    line-height: 20px;
			    /*margin-top: 340px;*/
			    margin-top: 220px;
			    font-weight: normal;
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
			#boy{
				width:100%;
				height:100%;
			}

		/*进度*/
			.photobox{
				width:46%;
				float: left;
				margin:2px 2%;
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
			.photo_title{
				height: 25px;
				line-height: 25px;
				float: left;
				width: 94%;
				background: #09BB07;
				padding: 0 3%;
				color: #fff;
			}
			.select_timeinput{
				width: 49%;
			    float: left;
			    height: 40px;
			    line-height: 40px;
			    text-align: center;
			    font-size: 13px;
			}
			.listimage,.listimage1{
				width: 100%;
				height:100%;
			}
			#listimage,#listimage1{
				width: 100%;
				overflow-y: auto;
			}
		/*详情*/
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
			    border-radius: 4px;
			}
			.recordview{
				width:98%;
				padding: 4px 1%;
				float: left;
			    border-bottom: 1px dashed #ddd;
			}
			.recordview_row{
				width:33%;
				float: left;
			}
			.recordview_row1{
				width:67%;
				float: left;
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
				width:98%;
				padding: 0 1%;
				border-radius: 6px;
			}
			.onestatistics{
				box-sizing: border-box;
				padding: 10px 1.5% 5px;
				background-color: #fff;
				width: 96%;
				float: left;
				margin: 10px 2%;
				border-radius: 4px;
			}
			.onestatistics_title{
				text-align: center;
				height: 40px;
				line-height: 40px;
				background-color: #ddd;
				float: left;
				width:100%;
				border-radius: 2px;
			}
			.onestatistics_info{
				width: 96%;
				margin: 3px 2%;
				float: left;
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
			#mangerself{
				width:380px;
				background-color: #eee;
				float: left;
				height:100%;
			}
			.selfinfobox{
				width: 360px;
			    background: #fff;
			    border-radius: 5px;
			    float: left;
			    padding: 15px 0;
			    margin: 10px 10px;
			}
			li{
			    list-style: none outside none;
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
			.btng{
				width: 350px;
				background-color: #09bb07;
				border-radius: 4px;
				color: #fff;
				height: 37px;
				line-height: 37px;
				text-align: center;
				margin: 15px 15px;
				float: left;
			}
			.qrcodeimages{
				background: #eee;
				width:380px;
				left:0;
				top:0;
				z-index: 3000;
				position: absolute;
				display: none;
			}
			.qrcodeimage_font{
				width:100%;
				padding: 40px 0;
				text-align: center;
			}
			.qrcodeimage{
			    width:100%;
			}
			.deleteproject{
				float: right;
				display: none;
				width: 40%;
				background-color: #eee;
				color: #09bb07;
				text-align: center;
				font-size: 15px;
				margin: 2px 0;
			}
			.plon .deleteproject{
				display: block;
			}
			.plon .qrcodecount{
				display: block;
			}
			.qrcodecount{
				float: left;
				display: none;
				width: 55%;
				background-color: #eee;
				color: #999;
				font-size: 13px;
				margin: 2px 0;
			}
			.projectshow{
				width:100%;
				float: left;
			}
			.tabbar{
			    position: absolute;
				top: 10px;
				right: 0;
				width: 40px;
				border-radius: 0;
				opacity: 0.8;
				color: #fff;
				background-color: #000;
				z-index: 1000;
				box-shadow: 0 2px 4px rgba(0,0,0,0.2), 0 -1px 0px rgba(0,0,0,0.02);
			}
			.tabbar a{
				display:block;
				-webkit-box-flex:1;
				-webkit-flex:1;
				flex:1;
				padding:7px 0 0;
				text-align:center
			}
			.tabbar i{
				font-size:24px
			}
			.tabbar p{
				font-size:12px
			}
			.tabbar .head{
				line-height:18px
			}
			.tabbar .head img{
				height:24px;
				width:24px;
				border-radius:50%;
				margin-top:-1px
			}
			.tabbar .on{
				color:#09BB07
			}
			#mysearch{
				position: absolute;
			    width: 380px;
		        top: 50px;
			    left:10px;
			}
			#projectimage,#recordview,#statistics,#mymanage,#createnewbox{
				width:380px;
				position: absolute;
				top: 10px;
			}
			#recordview,#statistics {
				position: absolute;
			    width: 380px;
			    right: 39px;
			    top: 10px;
			    box-shadow: 0 1px 5px rgba(0,0,0,.3);
			}
			.headselect{
				width:100%;
				float: left;
				height:40px;
			}
			#recordview{
			    z-index: 1001;
			}
			.imginfo_box img{
			    width:107px;
			    height:80px;
			    margin-left:-13px;
			    margin-top:0px;
			}
			.page{
			    width:100%;
			    height: 100%;
			}
			.current{
			    margin-right:0px;
			}
			
			#recordview2{
			    margin-left: 10px;
			    width:260px;
			    overflow-y: auto;
			    border:1px solid #aaa;
			    border-radius: 6px;
			    position: relative;
			    font-size: 11px;
			}
			
			h3,h4,p{
			    margin:0;padding:0
			}
			.jcope_lightbox .lb_prev {
			    left: 0;
			}
			.jcope_lightbox .lb_toggle {
			    display: block;
			    height: 60%;
			    position: absolute;
			    top: 20%;
			    width: 58px;
			    z-index: 3;
			}
			.jcope_lightbox .lb_next {
			    right: 0;
			}
			.jcope_lightbox .lb_imgbox {
			    left: 50%;
			    position: absolute;
			    top: 50%;
			    z-index: 2;
			}
			.jcope_lightbox .lb_body {
			    background: #fbfbfb;
			    overflow: hidden;
			    position: relative;
			    width: 100%;
			    z-index: 1;
			}
			.jcope_lightbox .lb_footer {
			    background: #f2f2f2;
			    height: 125px;
			    text-align: center;
			    width: 100%;
			}
			.jcope_lightbox .carousel {
			    display: inline-block;
			    margin: 1px auto 0;
			}
			.jcope_lightbox .carousel .carousel_arrow span {
			    cursor: pointer;
			    display: block;
			    height: 21px;
			    text-indent: -999em;
			    width: 11px;
			}
			.jcope_lightbox .carousel .carousel_arrow span, .jcope_lightbox .lb_toggle span {
			    background: url(./img/targe.gif) no-repeat;
			}
			.jcope_lightbox .carousel .carousel_wrapper {
			    float: left;
			    height: 126px;
			    margin: 0 6px;
			    overflow: hidden;
			    position: relative;
			    /*overflow-x: auto;*/
			}
			.jcope_lightbox .carousel .carousel_list {
			    height: 100px;
			    list-style: none;
			    position: absolute;
			    left:0px;
			}
			ul {
			    display: block;
			    list-style-type: disc;
			    -webkit-margin-before: 1em;
			    -webkit-margin-after: 1em;
			    -webkit-margin-start: 0px;
			    -webkit-margin-end: 0px;
			    -webkit-padding-start: 40px;
			}
			.jcope_lightbox .carousel .carousel_list li {
			    float: left;
			    height: 100px;
			    position: relative;
			    width: 95px;
			}
			li {
			    display: list-item;
			    text-align: -webkit-match-parent;
			}
			.jcope_lightbox .carousel .carousel_list .current .imginfo_box {
			    border: 2px solid #4eb51b;
			    margin: 0 0 0 8px;
			}
			.jcope_lightbox .carousel .carousel_list .imginfo_box {
			    background: #f2f2f2;
			    box-shadow: 0 0 2px rgba(0,0,0,0.3);
			    cursor: pointer;
			    display: block;
			    display: block;
			    height: 80px;
			    margin: 2px 0 0 10px;
			    overflow: hidden;
			    width: 80px;
			    background-position: center center;
			    background-repeat: no-repeat;
			    background-size: cover;
			}
			.jcope_lightbox .carousel .carousel_arrow {
			    border-radius: 2px;
			    float: left;
			    height: 23px;
			    margin-top: 13px;
			    overflow: hidden;
			    padding: 35px 7px;
			    width: 11px;
			}
			.testB #lbSidebar.lb_sidebar {
			    width: 280px;
			    position: absolute;
			}
			.jcope_lightbox .lb_sidebar {
			    background: #f2f2f2;
			    height: 100%;
			    position: absolute;
			    top: 0;
			    width: 280px;
			    z-index: 1;
			    color: #666;
			}
			.testB .lb_sidebar .con {
			    height: 180px;
			    overflow: auto\9;
			    overflow-x: hidden;
			    overflow-y: auto;
			    padding: 18px 15px 5px;
			    width: 260px;
			}
			.testB .lb_sidebar h3 {
			    color: #666;
			    font-size: 14px;
			    font-weight: 400;
			    line-height: 28px;
			}
			.jcope_lightbox .lb_toggle span {
			    border-radius: 2px 0 0 2px;
			    cursor: pointer;
			    display: block;
			    height: 35px;
			    left: 0;
			    margin-top: -37px;
			    overflow: hidden;
			    padding: 20px;
			    position: relative;
			    text-indent: -999em;
			    top: 50%;
			    width: 18px;
			    _zoom: 1;
			}
			.jcope_lightbox .lb_next span {
			    background-position: -30px -36px;
			}
			.jcope_lightbox .lb_prev span {
			    background-position: 20px -36px;
			}
			.jcope_lightbox .carousel .carousel_next span {
			    background-position: -45px -222px;
			}
			.jcope_lightbox .carousel .carousel_prev span {
			    background-position: -2px -222px;
			}
			.jcope_lightbox {
			    display: none;
			    left: 0;
			    margin: 0;
			    overflow: hidden;
			    padding: 0;
			    position: absolute;
			    top: 0;
			    z-index: 10000; 
			    display: block; 
			    visibility: visible;
			    width:100%;
			    height: 100%
			}
			.top{
			    z-index: 10000;
			}
			.tabbar2{
			    margin-left: 10px;
			    height: 60px;
			}
			.tabbar2 a{
			    flex: inherit;
			}
			.tabbar2 textarea{
			    box-sizing: border-box;
			    padding: 5px 8px;
			    height: 49px;
			    font-size: 14px;
			    -webkit-appearance: none;
			    -webkit-box-shadow: inset 0 0 10px #CCC;
			    box-shadow: inset 0 0 10px #CCC;
			    border-radius: 4px;
			}
			
			#recordview2 ul{
			    padding: 2px 8px;
			    background-color: #fff;
			    border-bottom: 1px solid #efefef;
			}
			#recordview2 li{
			    padding: 0 8px;
			}
			#recordview2 li img{
			    width: 100%;
			}
			.username{width:48px;text-align: center;}
			.myname{width:48px;text-align: center;}
			.chat-message{padding:5px 2px}
			.message-avatar{float:left;margin-right:10px;height:48px;width:48px;border:1px solid #e7eaec;border-radius:4px}
			
			.message{margin:0 55px;background-color:#fff;border:1px solid #e7eaec;display:block;padding:10px;position:relative;border-radius:4px}
			.message:before {
			    position: absolute;
			    content: "";
			    left: -7px;
			    top: 10px;
			    border: 7px solid transparent;
			    border-left: 0;
			    border-right-color: #fff;
			}
			.my-message .message-avatar{
			    float: right;margin-left:10px;margin-right:0;
			}
			.my-message .message{       
			    text-align: right;
			    color: #fff;
			    background-color: #A0E75B;
			}
			.my-message .message:before {
			    right: -7px;
			    left: inherit;
			    border-right: 0;
			    border-left: 7px solid #A0E75B;
			}
			#message{
			    width:220px;
			    height:50px;
			    float:left;
			    resize: none;
			}
			.sendMessage{
			    width:40px;
			    height:50px;
			    float:left;
			    text-align: center
			}
			.iconliu{
			    font-size:20px;
			    width:40px;
			    float:left;
			    text-align: center
			}
			#message .span{
			    font-size:12px;
			    width:40px;
			    float:left
			}
			.datetime{
			    text-align: center;
			    font-size: 9px;
			    margin-top:10px;
			}
			.infocontent{
			    float: left;
			    width:75%;
			}
			.infotitle{
			    float: left;
			    width:20%;
			}
			#imageinfo{
			    height:160px;
			}

			#image_in_map{
			    width:260px;
			    margin-left:10px;
			    height:250px;
			}
			.middleControl{
			    position: relative;
			    left: 50%;
			    top: 50%;
			    margin: -16px 0 0 -16px;
			    width:32px;
			    height:32px;
			    z-index:1000;
			}
			.closeimage {
			    position: absolute;
			    line-height: 30px;
			    color: #ccc;
			    font-size: 30px;
			    width: 30px;
			    height: 30px;
			    text-align: center;
			    top: 10px;
			    right: 10px;
			    text-decoration: none;
			    cursor: pointer;
			    z-index: 1003;
			}
			.none{
				display: none;
			}
			@-webkit-keyframes a{0%{-webkit-transform:translateY(-100%);transform:translateY(-100%);opacity:0}to{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}
			@keyframes a{0%{-webkit-transform:translateY(-100%);transform:translateY(-100%);opacity:0}to{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}
			.page.js_show {display: block; opacity:1;z-index: 1000}
			.page.slideIn{display: block;-webkit-animation:a .3s forwards;animation:a .3s forwards;z-index: 1001}
			@font-face{font-family:iconfont;src:url(../iconfont_phone/iconfont.ttf?t=1489121588115) format('truetype')}
				.iconfont{font-family:iconfont!important;font-size:16px;font-style:normal;-webkit-font-smoothing:antialiased;-webkit-text-stroke-width:.2px;-moz-osx-font-smoothing:grayscale}
				.icon-search:before{content:"\348d"}
				.icon-fanhui:before{content:"\e600"}
				.icon-select:before{content:"\e7dd"}
				.icon-iconfontshanchu:before{content:"\e614"}
				.icon-close:before{content:"\e619"}
				.icon-jiantou:before{content:"\e635"}
				.icon-xiao41:before{content:"\e88c"}
				.icon-xiao42:before{content:"\e88d"}
				.icon-ri:before{content:"\e657"}
				.icon-shezhi:before{content:"\e658"}
				.icon-xinzaolindi:before{content:"\e8f2"}
				.icon-loading:before{content:"\e611"}
				.icon-iconmingchengpaixu65-copy:before{content:"\e71d"}
				.icon-mingdanshuju:before{content:"\e62f"}
				.icon-renzheng:before{content:"\e6af"}
				.icon-timer:before{content:"\e601"}
				.icon-liuyan:before{content:"\e60a"}
				.icon-renyuan:before{content:"\e7e6"}
				.icon-home:before{content:"\e64c"}
				.icon-jin:before{content:"\e63e"}
				.icon-shanchu3:before{content:"\e67c"}
				.icon-shenpi:before{content:"\e67a"}
				.icon-yue-2:before{content:"\e602"}
				.icon-saoma1:before{content:"\e60f"}
				.icon-1:before{content:"\e603"}
				.icon-1{position:absolute;right:5px;top:50px;display:none;font-size:28px;color:green;line-height:33px;z-index:10000}
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
    <a data-id="profile" class="head">
        <img id="headImage" src="">
        <p>我</p>
    </a>
</div>
<div id="alerts"><div id="alert"></div></div>

<script id="dot_projectname" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="projectname {{=(i == 0) ? 'plon' : ''}}" mapid="{{=it[i].id}}">
        	<div class="projectshow">
	        	<div class="projectname_row1">{{=datetime(it[i].create_time)}}</div>
	        	<div class="projectname_row2">{{=it[i].name}}</div>
	        	<div class="projectname_row3">{{=it[i].address}}</div>
        	</div>
        	<div class="qrcodecount">数量：{{=it[i].num ? it[i].num : 0}}</div>
        	<div class="deleteproject">删除</div>
        </div>
    {{ } }}
</script>
<script id="dot_treelistinfobuy" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="treelist" mapid="{{=it[i].map_id}}" orderid="{{=it[i].id}}">
	        <div class="treelist_row1">{{=it[i].tree_name}}</div>
	        <div class="treelist_row2">{{=witchstate(it[i].state)}}</div>
	        <div class="treelist_row3">{{=it[i].tree_attribute}}</div>
        </div>
    {{ } }}
</script>
<script id="dot_imagetip" type="text/x-dot-template">
    <li data-id="{{=it.id}}" style="background-image:url({{=it.tip.image}})" onclick="clickImagetip({{=it.id}},{{=it.map_order_id}})" data-order_id="{{=it.map_order_id}}">
        <p>{{=it.active}} {{=it.tip.time?ms2shortTime(it.tip.time):''}}</p>
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
<script id="dot_statistics_info" type="text/x-dot-template">
    {{ for(var i in it) { }}
		<div class="onestatistics">
			<div class="onestatistics_title">{{=it[i].name}}</div>
			{{ for(var j in it[i].data) { }}
				{{ for(var k in it[i].data[j]) { }}
					<div class="onestatistics_info">
						<div>{{=j}}</div>
						<div>{{=witchstate(k)}}</div>
						<div>{{=it[i].data[j][k]}}项</div>
					</div>
				{{ } }}
			{{ } }}
		</div>
    {{ } }}
</script>
<script id="dot_smallimage" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <li data-index="{{=it[i].photo}}" data-id="{{=i}}">
            <div class="imginfo_box" style="background-image:url(../photos/m/{{=it[i].photo}}.jpg)">
            </div>
        </li>
    {{ } }}
</script>
<script id="dot_bigimage" type="text/x-dot-template">
    <div class="lb_imgbox">
        <img class="lb_mainimg" src="../photos/o/{{=it.photo}}.jpg">
    </div>
</script>
<script id="dot_imageinfo" type="text/x-dot-template">
        <div class="con" id="record2" data-id="{{=it.id}}" data-time="{{=it.time}}" data-userid="{{=it.userid}}">
            <div class="picMsg">
                <h3>
                    <div class="infotitle">节点</div>
                    <div class="infocontent">:&nbsp;{{=it.active}}</div>
                </h3>
                <h3>
                    <div class="infotitle">树名</div>
                    <div class="infocontent">:&nbsp;{{=it.tree_name}}</div>
                </h3>
                <h3>
                    <div class="infotitle">备注</div>
                    <div class="infocontent">:&nbsp;{{=it.tree_attribute}}</div>
                </h3>
                <h3>
                    <div class="infotitle">负责人</div>
                    <div class="infocontent">:&nbsp;{{=it.name}}</div>
                </h3>
                <h3>
                    <div class="infotitle">电话</div>
                    <div class="infocontent">:&nbsp;{{=it.phone}}</div>
                </h3>
                <h3>
                    <div class="infotitle">电话</div>
                    <div class="infocontent">:&nbsp;{{=it.phone}}</div>
                </h3>
            </div>
        </div>
</script>

<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script src="./js/doT.min.js"></script>
<script src="./js/zepto.min.js"></script>
<script type="text/javascript" src="./js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	var dot_projectname = doT.template($('#dot_projectname').text());
	var dot_treelistinfobuy = doT.template($('#dot_treelistinfobuy').text());
	var dot_imagetip = doT.template($('#dot_imagetip').text());
	var dot_tooltip = doT.template($('#dot_tooltip').text());
	var dot_projecttooltip = doT.template($('#dot_projecttooltip').text());
	var dot_statistics_info = doT.template($('#dot_statistics_info').text());
	var dot_smallimage = doT.template($("#dot_smallimage").text());
	var dot_imageinfo = doT.template($("#dot_imageinfo").text());
	var dot_bigimage = doT.template($("#dot_bigimage").text());

	var projectlist,mymap,treelist,map_data,thisrecord,allimagedata,photoindex,isloadrecords_id,statisticdata,photo_isloading = false,photo_isend = false,hasthisrecord = false,overlay = {},imagetip = {},targrphotoname,targemapid,activeTipid;

	var height = $(window).height();
	var width = $(window).width();
	var $width = width-420;
	var $imagetip = $('#imagetip');
	// 数据
		function witchstate(a){
			a = parseInt(a);
			switch(a)
			{	
				case 0:
					return '暂无';
					break;
			    case 1:
			    	return '号树';
			    	break;
			    case 2:
			    	return '起树';	
			    	break;
			    case 3:
			    	return '装车';	
			    	break;
			    case 4:
			    	return '物流';	
			    	break;
			    case 5:
			    	return '卸车';	
			    	break;
			    case 6:
			    	return '栽种';	
			    	break;
			    case 7:
			    	return '其他';	
			    	break;
			}
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
		function datetime(time){
			time = time.substring(0,10);
			return time;
		}
		function isObject(obj){
		    for(var n in obj){return true} 
		    return false; 
		}
		function loadprojectlist(way){
			$.getJSON('/com/search_map_list.php',{userid:user.userid},function(result){
				if(!projectlist) projectlist = [];
				if(result){
					projectlist = result;
					if(way){
						loadtreelist(projectlist[0]['id'],way);
					}else{
						overlayOnMap(map_data,projectlist);
					}
				}else{
					$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
			})
		}
		function findstaticdata(a){
			var newdata = [];
			for (var i = 0; i < statisticdata.length; i++) {
				if(statisticdata[i].id == a){
					newdata[newdata.length] = statisticdata[i];
				}
			}
			if(newdata.length){
				dealstatistics(newdata);
			}else{
				$('#listimage1').html('<div class="weui-loadmore">此项目暂无数据！</div>');
			}
		}
		function loadtreelist(a,way){
			$.getJSON('/com/search_map_treelist.php',{userid:user.userid,id:a},function(result){
				if(!treelist) treelist = {};
				if(!treelist[a]) treelist[a] = {};
				if(result){
					treelist[a] = result;
				}
				if(way){
					changeover(way);
				}else{
					if(result){
						$('#right_tree').html(dot_treelistinfobuy(treelist[a]));
					}else{
						$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
					}
				}
			})
		}
		function getActiveMenu() {
		    return $('#tabbar .on').data('id');
		}
		function deadltime(a){
			var y = a.getFullYear();
			var m = a.getMonth()+1;
			m = (m < 10)? '0'+m : m;
			var d = a.getDate();
			d = (d < 10)? '0'+d : d;
			return y+'-'+m+'-'+d;
		}

	// 进度
		function loadstatisticphoto(photo){
			var time = '';
			var str = '';
			for (var i in photo) {
				var photos= photo[i].photo.split(';')[0];
				if(datetime(photo[i].time) == time){
					str += '<div class="photobox" onclick="toviewbigimages(\''+photos+'\');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
				}else{
					time = datetime(photo[i].time);
					str += '<div class="photo_title">'+time+'</div>';
					str += '<div class="photobox" onclick="toviewbigimages(\''+photos+'\');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
				}
			}
			return str;
		}

		function toviewbigimages(photo){
			$('#tabbar').hide();
			targrphotoname = photo;
			window.pageManager.go('viewbigimages');
		}
		function lookthisrecord(id,a){
			hasthisrecord = true;
			photo_isend = true;
			$.getJSON('/com/search_map_order_record.php',{id:id},function(json){
				if(json){
					thisrecord = json;
					$('#listimage').html(loadstatisticphoto(json));
				}else{
					thisrecord = {};
					$('#listimage').html('<div class="weui-loadmore">没有数据！</div>');
				}
				if(a) window.pageManager.go('projectimage');	
			})
		}
		function lookthisrecords(id,a,b){
			if(photo_isloading) return;
			photo_isloading = true;
			var limit = $('#listimage .photobox').length + ',20';
			$.getJSON('/com/search_map_order_records.php',{id:id,limit:limit,begin:a,end:b,userid:user.userid},function(json){
				if(json){
					$('#listimage').append(loadstatisticphoto(json));
					photo_isloading = false;
				}else{
					$('#listimage').append('<div class="weui-loadmore">没有数据！</div>');
					photo_isend = true;
				}
			})
		}
		function loadallimage(state,a,b,c){
			if(photo_isloading) return;
			photo_isloading = true;
			var limit = $('#listimage .photobox').length + ',20';
			$.getJSON('/com/search_time_images.php', {userid: user.userid,limit:limit,begin:a,end:b,id:c}, function(json) {
				if(!allimagedata) allimagedata = [];
				if(json){
					for (var i = 0; i < json.length; i++) {
						allimagedata[allimagedata.length] = json[i];
					}
					photo_isloading = false;
					if(!state) $('#listimage').append(loadstatisticphoto(json));
				}else{
					photo_isend = true;
				}
				if(state){
					$('#listimage').html(loadstatisticphoto(allimagedata));
					changeover('projectimage');
				} 
			})
		}

	// 地图
		function initMap(){
		    mymap = new qq.maps.Map(document.getElementById("boy"), {
				//disableDefaultUI: true, 
				mapTypeId:qq.maps.MapTypeId.HYBRID,
				mapTypeControl: false,
				// 地图平移控件参数
				panControlOptions: {
					position: qq.maps.ControlPosition.BOTTOM_LEFT
				},
				//地图缩放控件参数
				zoomControlOptions: {
					position: qq.maps.ControlPosition.BOTTOM_LEFT,
					style: qq.maps.ZoomControlStyle.LARGE
				}
			});

		     initTooltipOverlay();
		     removeMapVersion('boy');
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
		function overlayOnMap(mapdata,projectdata) {
	    	mymap.fitBounds(getMapBounds(mapdata,projectdata));
		    // 添加新的
		    if(mapdata){
			    for (var i = 0; i<mapdata.length; i++) {
			        var data = mapdata[i];
			        data.tip = getTooltip(data);
	    	        
	    	        if (data.tip.x && !overlay[data.id]) {
	    	            var overlaies = new TooltipOverlay(dot_tooltip(data), data.tip.x, data.tip.y);
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
		    		overlay[data.id].id = data.id;
		    		overlay[data.id].tip = data.tip;
		    		overlay[data.id].active = data.active;
		    		overlay[data.id].map_order_id = data.map_order_id;
		    	}
		    	if(projectdata){
			    	for (var i = 0; i < projectdata.length; i++) {
			    		var a = projectdata[i];
			    		a.tip = getTooltip(a);
		    	    	var overlaies = new TooltipOverlay(dot_projecttooltip(a), a.x, a.y);
		                overlaies.setMap(mymap);
			            overlay[a.id] = overlaies;
			    	}
		    	}
			    imageActiveTip = $('<i></i>');
			    var id = $('#imagetip').children().first().append(imageActiveTip).data('id');
			    if (overlay[id]) $(overlay[id].div).addClass('active');
		    }	
		    activeTipid = 0;
		}
		function getTooltip(data) {
		    if(data.tree_name){
		    	var result = {width: GetCurrentStringWidth(data.tree_name,14)};
		    }else{
		    	var result = {width: GetCurrentStringWidth(data.name,14)};
		    }
		    if (data.photo) {
		        var photos = data.photo.split(';');
		        var gpses = data.gps.split(';');
		        photo = photos[0];
		        if(!gpses[0]){
			        for (var i = 0; i < gpses.length; i++) {
			        	if(gpses[i]){
			        		var nogps = gpses[i].split(',');
			        		result.x = nogps[0];
			        		result.y = nogps[1];
			        	}
			        }
			        if(!nogps){
			        	result.x = 39.909604;
			        	result.y = 116.397228;
			        }
		        }else{
		        	var gps = gpses[0].split(',');
		        	result.x = gps[0];
		        	result.y = gps[1];
		        }
		        result.image = 'photos/o/'+photo+'.jpg';
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
		function getPhotoTime(photoname) {

		    return parseInt(photoname.substr(3,10))*1000; 
		}
		function getMapBounds(a,b) {
		    var minLat=1000, minLng=1000, maxLat=0, maxLng=0;
			for(var i in a){
		        var data = a[i].gps;
		        var gpses = data.split(';');
		        if(!gpses[0]){
		        	var nogps;
			        for (var j = 0; j < gpses.length; j++) {
			        	if(gpses[j]){
			        		nogps =  gpses[j];
			        	}
			        }
			        if(nogps){
			        	gpses = nogps[0].split(',');
			        	var gps_x = gpses[0];
			        	var gps_y = gpses[1];
			        }else{
			        	var gps_x = 39.909604;
			        	var gps_y = 116.397228;
			        }
		        }else{
			        gpses = gpses[0].split(',');
			        var gps_x = gpses[0];
			        var gps_y = gpses[1];
		        }
		        if (gps_x && gps_y) {
		            if (gps_x<minLat) minLat=gps_x;
		            if (gps_x>maxLat) maxLat = gps_x;

		            if (gps_y<minLng) minLng=gps_y;
		            if (gps_y>maxLng) maxLng = gps_y;
		        }   
			}
			for(var i in b){
	    		var gps_x = b[i].x;
	    		var gps_y = b[i].y;
		        if (gps_x && gps_y) {
		            if (gps_x<minLat) minLat=gps_x;
		            if (gps_x>maxLat) maxLat = gps_x;

		            if (gps_y<minLng) minLng=gps_y;
		            if (gps_y>maxLng) maxLng = gps_y;
		        }   
			}     	    
		    var sw = new qq.maps.LatLng(maxLat, maxLng); //西南角坐标
		    var ne = new qq.maps.LatLng(minLat, minLng); //东北角坐标
		    return new qq.maps.LatLngBounds(ne, sw); //矩形的地理坐标范围
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
		function in24hours(ms) {
		    var now = new Date().getTime();
		    return now-ms<86400000;
		}
		function chooseproject(map_id){
		    if(mymap){
		    	if(!map_data){
		    		loadmapdata(map_id);
		    	} 
		    	var newdata = [];
		    	var projectdata = [];
		    	if(projectlist.length){
			    	for (var i = 0; i < projectlist.length; i++) {
			    		if(map_id == projectlist[i].id){
			    			projectdata[0] = projectlist[i]
			    		}	    		
			    	}
		    	}
		    	if(map_data.length){
			    	for (var i = 0; i < map_data.length; i++) {
			    		if(map_data[i].map_id == map_id){
			    			newdata[newdata.length] = map_data[i];
			    		}
			    	}
		    	} 
		    	deletealldom();
				overlayOnMap(newdata,projectdata);
				targemapid = map_id;
				loadallimage(true,'','',map_id);
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
		function loadmapdata(a){
	    	$.getJSON('/com/search_map_recordlist.php', {userid: user.userid}, function(json) {
	    		if(json){
	    			map_data = json;
	    			if(a){
	    				chooseproject(a);
	    			}else{
	    				loadprojectlist();
	    			}
	    		}else{
	    			map_data = [];
	    		}
	    	})
		}
		function clickImagetip(a,b){
	    	var newdata = [];
	    	var projectdata = [];
	    	for (var i = 0; i < projectlist.length; i++) {
    			if(projectlist[i].id == a){
    				projectdata[projectdata.length] = projectlist[i];
    			}
    		}	
    		for (var i = 0; i < map_data.length; i++) {
				if(map_data[i].map_order_id == b){
					newdata[0] = map_data[i];	
				}
			}		    			
	    	deletealldom();  		
			overlayOnMap(newdata);
			window.pageManager.go('projectimage');
		}

		function activeTip(id) {
			if (activeTipid == id) {
                return;
            }
            activeTipid = id;
            var overlays = overlay[id];
            if (overlays) {
                overlays.div.addClass('active').siblings('.active').removeClass('active');
                if (overlays.tip.image) {
                    $imagetip.html(dot_imagetip(overlays)).appendTo(overlays.div).show();
                } else {
                    $imagetip.hide();
                }
            }
		}

		function getDataByID(id) {
		    for (var i = map_data.length - 1; i >= 0; i--) {
		        mapdata = map_data[i];
		        if (mapdata.id == id) return mapdata;
		    }
		}
		function mapContains(mapbounds, gps_x,gps_y) {
		    if (gps_x && gps_y) {
		        return mapbounds.contains(new qq.maps.LatLng(gps_x,gps_y));
		    } else {
		        return false;
		    }
		}

	$('#container').on('click','.mysearch',function(){
		changeover(getActiveMenu());
	})
	$('#container').on('click','.searchallproject',function(){
		hasthisrecord = false;
		$this = $(this);
		if($this.hasClass('on')){
			$this.removeClass('on');
			$('#mysearch').css('opacity','0');
			window.pageManager.go(getActiveMenu());
		}else{
			if((getActiveMenu() == 'projectimage') || (getActiveMenu() == 'statistics')){
				$('#statistics').css('opacity','0');
				$('#projectimage').css('opacity','1');
			}else if(getActiveMenu() == 'profile'){
				$('#projectimage').css('opacity','0');
				$('#statistics').css('opacity','0');
				$('#profile').css('opacity','0');
				$('#tabbar .head').removeClass('on');
				$('#tabbar #gohome').addClass('on');
			}
			$this.addClass('on');
			$('#mysearch').css('opacity','1');
			window.pageManager.go('showallproject');
		}
	})
</script>

<!-- 全部项目 -->
<script type="text/html" id="tpl_showallproject">
    <div class="page" id="mysearch">
	    <div class="projectlists">
		    <div class="left">
		    	<div class="findallproject">全部项目</div>
		    	<div class="projectleftbox" id="left_project">
		    	</div>
		    	<div class="createnew" onclick="window.pageManager.go('createnew')">新建项目</div>
		    </div>
		    <div class="right">
		    	<div class="findalltree">全部苗木</div>
    	    	<div class="projectrightbox" id="right_tree">
    	    	</div>
		    </div>
	    </div>
    </div>
    <script type="text/javascript">
    	$('#mysearch').css('height',(height-70)+'px');
    	$('.projectleftbox').css('height',(height-145)+'px');
    	$('.projectrightbox').css('height',(height-110)+'px');
    	if(!projectlist){
    		loadprojectlist('showallproject');
    	}else if(!treelist && projectlist){
    		loadtreelist(projectlist[0]['id'],'showallproject');
    	}else{
    		if(projectlist.length){
				$('#left_project').html(dot_projectname(projectlist));
				if(treelist[projectlist[0].id].length){
					$('#right_tree').html(dot_treelistinfobuy(treelist[projectlist[0].id]));
				}else{
					$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
				}
    		}else{
				$('#left_project').html('<div class="weui-loadmore">没有数据！</div>');
				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    		}
    	}

    	$('#left_project').on('click','.projectshow',function(){
    		var $this = $(this).parent();
    		var mapid = $this.attr('mapid');
    		$this.siblings().removeClass('plon');
    		$this.addClass('plon');
    		if(treelist[mapid]){
    			if(treelist[mapid].length){
    				$('#right_tree').html(dot_treelistinfobuy(treelist[mapid]));
    			}else{
    				$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    			}
    		}else{
    			loadtreelist(mapid);
    		}
    	})

    	$('#left_project').on('click','.deleteproject',function(){
    		var edit = confirm('确定要删除吗？');
    		if(!edit) return;
    		var $this = $(this).parent();
    		var mapid = $this.attr('mapid');
    		$.post('/com/maps_delete.php', {mapid:mapid}, function(result) {
    			if(result){
    				var deletedata = [];
    				for (var i = 0; i < projectlist.length; i++) {
    					if(projectlist[i].id == mapid) deletedata[deletedata.length] = projectlist[i];
    				}
    				projectlist = deletedata;
    				$this.remove();
    				$('#alert').html('删除成功！');
    				$('#alerts').show();
    				setTimeout(function (){
    					$('#alerts').hide();
    				},1000)
    			}else{
    				$('#alert').html('项目有资料不可删除！');
    				$('#alerts').show();
    				setTimeout(function (){
    					$('#alerts').hide();
    				},1000)
    			}
    		})
    	})

		// 看订单下的所有苗木
		$('.findalltree').click(function(){
			var mapid = $('#left_project .plon').attr('mapid');
			if(!mapid) return;
			switch (getActiveMenu())
			{
			    case 'home':
				    chooseproject(mapid);
			    break;
			    case 'projectimage':
    	    		photo_isloading = false;
    	    		photo_isend = false;
    	    		isloadrecords_id = mapid;
    	    		$('#listimage').html('');
			    	lookthisrecords(mapid);
			    break;
			    case 'statistics':
			    	findstaticdata(mapid);
			    break;
			}
	        window.pageManager.go(getActiveMenu());
		})
		// 看所有项目
		$('.findallproject').click(function(){
			switch (getActiveMenu())
			{
			    case 'home':
			    	deletealldom(); 
				    overlayOnMap(map_data,projectlist);
			    break;
			    case 'projectimage':
    	    		photo_isloading = false;
    	    		photo_isend = false;
    	    		isloadrecords_id = false;
    	    		targemapid = null;
    	    		$('#listimage').html(loadstatisticphoto(allimagedata));
			    break;
			    case 'statistics':
			    	dealstatistics(statisticdata);
			    break;
			}
	        window.pageManager.go(getActiveMenu());
		})
		// 看单个苗木
		$('#right_tree').on('click','.treelist',function(){
			var $this = $(this);
			var mapid = $this.attr('mapid');
			var orderid = $this.attr('orderid');
			switch (getActiveMenu())
			{
			    case 'home':
			    	if(mymap){
				    	var newdata = [];
				    	var projectdata = [];
				    	for (var i = 0; i < projectlist.length; i++) {
			    			if(projectlist[i].id == mapid){
			    				projectdata[projectdata.length] = projectlist[i];
			    			}
			    		}	
			    		for (var i = 0; i < map_data.length; i++) {
		    				if(map_data[i].map_order_id == orderid){
		    					newdata[0] = map_data[i];	
		    				}
		    			}		    			
				    	deletealldom();  		
		    			overlayOnMap(newdata);
			    	}
			    break;
			    case 'projectimage':
			    	isloadrecords_id = false;
    		    	lookthisrecord(orderid);
			    break;
			    case 'statistics':
			    	findstaticdata(mapid);    
			    break;
			}
			window.pageManager.go(getActiveMenu());
		})
    </script>
</script>

<!-- 主页 -->
<script type="text/html" id="tpl_home">
    <div id="home" class="page" style="opacity:1">
    	<div class="header">
    		<div class="allproject searchallproject">全部项目<i class="iconfont icon-select" style="float: right;"></i></div>
    	</div>
	    <div id="boy">
	    </div>
	    <div id="imagetip" class="imagetip"></div>
    </div>
    <script type="text/javascript">
    	var $imagetip = $('#imagetip');
    	initMap();

		$('#imagetip').hide();

		loadmapdata();
		

    	$imagetip.on('click','li',function(){
    		var id = $(this).data('order_id');
    		lookthisrecord(id,true);
    	})

    </script>
</script>

<!-- 进度 -->
<script type="text/html" id="tpl_projectimage">
    <div id="projectimage" class="page">
		<div class="listimage">
			<div class="headselect">
				<input id="begindate1" class="weui-input select_timeinput" type="date">
				<input id="enddate1" class="weui-input select_timeinput" type="date">
			</div>
			<div id="listimage">
			</div>
		</div>
    </div>
    <script type="text/javascript">
    	var $begindate1 = $('#begindate1'),
    		$enddate1 = $('#enddate1'),
    		$_listimage = $('.listimage'),
    		$listimage = $('#listimage'),
    		time1,time2;
		$('#projectimage').css({
			"left":$width+'px',
			"height":(height-30)+'px'
		});

		$listimage.css({
			"height":(height-73)+'px'
		});

    	var atime = new Date();
    	var btime = new Date(atime.getTime() - 30*24*60*60*1000); 

    	$begindate1.val(deadltime(btime));
    	$enddate1.val(deadltime(atime));

    	if(hasthisrecord){
    		if(isObject(thisrecord)){
	    		$listimage.html(loadstatisticphoto(thisrecord));
	    		thisrecord = [];
    		}else{
		    	$listimage.html('<div class="weui-loadmore">没有数据！</div>');
		    }
	    }else if(!allimagedata){
	    	loadallimage(true);
	    }else if(allimagedata.length){
	    	$listimage.html(loadstatisticphoto(allimagedata));
	    }else{
	    	$listimage.html('<div class="weui-loadmore">没有数据！</div>');
	    }

	    $begindate1.change(function (){
	    	$listimage.html('');
	    	selecttime();
	    })
	    $enddate1.change(function (){
	    	$listimage.html('');
	    	selecttime();
	    })

	    $listimage.scroll(function(e) {
	    	if(photo_isloading || photo_isend) return;
	    	var scrollHeight = $(this)[0].scrollHeight;
	    	var scrollTop = $(this)[0].scrollTop;
	    	var elementHight = $(this).height();
	    	if(scrollTop + elementHight >= scrollHeight-300){
	    		if(isloadrecords_id){
	    			lookthisrecords(isloadrecords_id);
	    		}else{
	    			loadallimage(false,time1,time2,targemapid);
	    		}
	    	}
	    })

	    function selecttime(){
	    	allimagedata = '';
	    	photo_isloading = false;
	    	photo_isend = false;
	    	$listimage.html('');
	    	time1 = $('#begindate1').val();
	    	time2 = $('#enddate1').val();
	    	if(time1 > time2){
	    		var a = time1;
	    		time1 = time2;
	    		time2 = a;
	    	}
	    	if(isloadrecords_id){
	    		lookthisrecords(isloadrecords_id,time1,time2);
	    	}else{
	    		loadallimage(false,time1,time2,targemapid);
	    	}
	    }

	    
    </script>
</script>

<!-- 统计 -->
<script type="text/html" id="tpl_statistics">
    <div id="statistics" class="page">
		<div class="listimage1">
			<div id="listimage1">
			</div>
		</div>
    </div>
    <script type="text/javascript">
    	var $_listimage1 = $('.listimage1');
    		$listimage1 = $('#listimage1');

		$('#statistics').css({
			"left":$width+'px',
			"height":(height-30)+'px'
		});

		$listimage1.css({
			"height":(height-35)+'px'
		});

		loadstatistics();
		function loadstatistics(){
			$.getJSON('/com/search_map_recordstate.php', {userid: user.userid}, function(json) {
				if(json){
					statisticdata = json;
					dealstatistics(statisticdata);
				}else{
					$listimage1.append('<div class="weui-loadmore">没有数据！</div>');
				}
			});
		}
		function dealstatistics(statistics){
			var newdata = {};
			for (var i = 0; i < statistics.length; i++) {
				if(!newdata[statistics[i].id]){
					newdata[statistics[i].id] = {};
					newdata[statistics[i].id].name = statistics[i].name;
					newdata[statistics[i].id].data = [];
					newdata[statistics[i].id].data[statistics[i].tree_name] = {};
					newdata[statistics[i].id].data[statistics[i].tree_name][statistics[i].state] = 1;
				}else{
					var a = newdata[statistics[i].id].data[statistics[i].tree_name];
					if(a){
						var has = true;
						for(var j in a){
							if(j == statistics[i].state){
								has = false;
								newdata[statistics[i].id].data[statistics[i].tree_name][statistics[i].state] += 1;
							}
						}
						if(has){
							newdata[statistics[i].id].data[statistics[i].tree_name][statistics[i].state] = 1;
						}
					}else{
						newdata[statistics[i].id].data[statistics[i].tree_name] = {};
						newdata[statistics[i].id].data[statistics[i].tree_name][statistics[i].state] = 1;
					}
				}
			}
			$('#listimage1').html(dot_statistics_info(newdata));
		}
    </script>
</script>

<!-- 我的管理 -->
<script type="text/html" id="tpl_profile">
    <div class="page" id="mymanage">
	    <div id="mangerself">
	    	<div class="selfinfobox">
		    	<img id="selfinfo_headimg" src="">
	    		<div id="selfinfo_name"></div>
	    	</div>
	        <div class="sharelookpower btng">授权查看</div>
	        <div class="relogin btng">重新登录</div>
	    </div>
	    <div class="qrcodeimages">
	    	<div class="qrcodeimage_font"></div>
	    	<img src="" class="qrcodeimage" id="qrcodeimages1">
	    </div>
    </div>
    <script type="text/javascript">
    	$('#selfinfo_name').css('width','240px');

    	$('#mymanage').css({
    		"left":$width+'px',
    		"height":(height-30)+'px'
    	});
  
    	$('#selfinfo_headimg').attr('src','headimg/96/'+user.userid+'.jpg');
    	$('#selfinfo_name').html(user.name+'<br>'+user.phone);

    	$('.relogin').click(function() {
    		reLogin();
    	});

    	$('.sharelookpower').click(function(){
    		$('#qrcodeimages1').attr('src','./mapgroupqrcode/'+user.userid+'.png');
    		$('.qrcodeimage_font').html('将二维码发送给授权的用户');
    		$('.qrcodeimages').show();
    	})

    	$('.qrcodeimages').click(function() {
    		$('.qrcodeimages').fadeOut(100);
    	});
    </script>
</script>

<!-- 新建项目 -->
<script type="text/html" id="tpl_createnew">
    <div class="page" id="createnewbox">
		<div class="create_newproject_title">
			<div class="center_title">创建新项目</div>
			<div class="create_newproject_row1">
				<div class="create_newproject_low1">项目名称：</div>
				<input id="create_newproject_low2" placeholder="请输入项目名称" type="text" name="">
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
    </div>
    <script type="text/javascript">
    	$('#map_address').css('height',(height-90)+'px');
    	$('#address_map').css('height',(height-73)+'px');

    	$('#createnewbox').css({
    		"left":$width+'px',
    		"height":(height-30)+'px'
    	});

    	var topmap,nowlat,nowlag,addressdeteil;  	
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
    	    	nowlat = parseInt(nowlat*10000000)/10000000;
    	    	nowlag = parseInt(nowlag*10000000)/10000000;
    		    $.get('/com/map_user_insert.php',{userid:user.userid,name:projectname,x:nowlat,y:nowlag,address:addressdeteil},function(result){
    		    	if(result){
    		    		result = result.split(';');
    		    		var tempdata = [];
    		    		tempdata[0] = {};
    		    		tempdata[0].address = addressdeteil;
    		    		tempdata[0].id = result[0];
    		    		tempdata[0].name = projectname;
    		    		tempdata[0].userid = user.userid;
    		    		tempdata[0].switch = 1;
    		    		tempdata[0].num = 0;
    		    		tempdata[0].x = nowlat;
    		    		tempdata[0].y = nowlag;
    		    		tempdata[0].create_time = result[1];
    		    		for (var i = 0; i < projectlist.length; i++) {
    		    			tempdata[tempdata.length] = projectlist[i];
    		    		}
    		    		projectlist = tempdata;
    		    		treelist[projectlist[0].id] = {};
    		    		$('#left_project').html(dot_projectname(projectlist));
    		    		$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
    		    		
    			    	window.pageManager.back();
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
    </script>
</script>

<!-- 详图 -->
<script type="text/html" id="tpl_viewbigimages">
    <div class="page" id="viewbigimage">
		<div id="jcopeLightBox" class="jcope_lightbox testB">
		    <!-- 左侧 -->
		    <div class="lb_wrapper">
		        <!-- 上方展示大图 -->
		        <div class="lb_body" data-cmsid="eef710e24b3bbed684ebb1c5df63be5b" id="do_image" title="点击全屏浏览">
		            <a class="lb_toggle lb_prev" id="lbPrev"><span>上一张</span></a>
		            <a id="closeimage" class="closeimage none">×</a>
		            <a class="lb_toggle lb_next" id="lbNext"><span>下一张</span></a>
		        </div>
		        <!-- 下方展示小图 -->
		        <div class="lb_footer" id="lbFooter">
		            <div class="carousel">
		                <!-- 左右箭头标签 -->
		                <a class="carousel_arrow carousel_prev"><span>上一组</span></a>
		                    <!-- 框 -->
		                    <div class="carousel_wrapper">
		                        <!-- 内容 -->
		                        <ul class="carousel_list" id="smallimage">
		                        </ul>
		                    </div>
		                <a class="carousel_arrow carousel_next"><span>下一组</span></a>
		            </div>
		        </div>
		    </div>
		    <!-- 右侧 -->
		    <div class="lb_sidebar" id="lbSidebar">
		        <a id="backtohome" class="closeimage">×</a>
		        <div id="imageinfo"></div>
		        <div id="image_in_map"></div>
		    </div>
		</div>
    </div>
    <script type="text/javascript">

        var allbigimagedata = [];      
        var windowheight = window.screen.height;
        var windowwidth = window.screen.width;
        var showcount = 1;
        var biggest = false;
        var smallnow;
        $('#tabbar').hide();


        $('#backtohome').click(function(){
	        $('#tabbar a').removeClass('on');
	        $('#tabbar #gohome').addClass('on');
        	window.pageManager.go('home');
        	$('#tabbar').show();
        })

        loadimgsdata(targrphotoname,targemapid);
        natrue();
        // 初始化小地图
        var map = new qq.maps.Map($('#image_in_map')[0], {disableDefaultUI: true, zoom: 12});
        $('<img>').addClass('middleControl')
                  .attr('src','http://www.yangshuwang.com/img/poi.png')
                  .appendTo('#image_in_map');   

        // 加载正常图片页面样式
        function natrue(){
            $('#jcopeLightBox').css({"height":height+'px',"width":width+'px'});
            $('.lb_wrapper').css('width',(width-280)+'px');
            $('.lb_body').css('height',(height-130)+'px');
            $('#lbSidebar').css('left',(width-280)+'px');
            $('#recordview2').css('height','400px');
        }
        
        // 从数据库获取信息
        function loadimgsdata(imageid,id){
            if(id) targemapid = id;
            var counts = allbigimagedata.length;
            var limit = counts+',10';
            $.getJSON('/com/search_map_order_records.php',{id:targemapid,limit:limit,userid:user.userid},function(data){
                if(data){
                    showcount = Math.ceil(counts/10)+1;
                    for (var i = 0; i < data.length; i++) {
                        allbigimagedata[allbigimagedata.length] = data[i];
                    }
                    getsmallimage(imageid);
                }else{
                    loadover = false;
                    showcount = Math.ceil(counts/10);
                }
            })
        }

        // 将获取的信息中的图片信息分开
        function getsmallimage(imageid) {
            smallnow = [];
            var k = 0;
            var nothas = true;
            if(imageid){
                for (var i = (showcount-1)*10; i < allbigimagedata.length; i++) {
                    if(allbigimagedata[i].photo.indexOf(imageid) > -1){
                        nothas = false;
                    }
                }
            }else{
                nothas = false;
            } 
            if(nothas && imageid){
                loadimgsdata(imageid);
                return;
            }else{
                for (var i = (showcount-1)*10; i < allbigimagedata.length; i++) {
                    var photo = allbigimagedata[i].photo.split(';');
                    var photogps = '';
                    if(allbigimagedata[i].gps){
                        photogps = allbigimagedata[i].gps.split(';');
                    }                            
                    for (var j = 0; j < photo.length; j++) {
                        var lengths = smallnow.length;
                        smallnow[lengths] = {};
                        if(photogps){
                            smallnow[lengths].photogps = photogps[j];
                        }else{
                            smallnow[lengths].photogps = ''; 
                        }
                        if(imageid && (photo[j] == imageid)) k = lengths;
                        smallnow[lengths].photo = photo[j];
                        smallnow[lengths].active = allbigimagedata[i].active;
                        smallnow[lengths].name = allbigimagedata[i].name;
                        smallnow[lengths].phone = allbigimagedata[i].phone;
                        smallnow[lengths].time = getPhotoTime(allbigimagedata[i].phone);
                        smallnow[lengths].tree_attribute = allbigimagedata[i].tree_attribute;
                        smallnow[lengths].tree_name = allbigimagedata[i].tree_name;
                    }
                }
            }
            $('#smallimage').css('width',(smallnow.length*96)+'px');
            $('#smallimage').html(dot_smallimage(smallnow));
            $('#smallimage li').eq(k).addClass('current');
            changebigimage(smallnow[k].photo);
            var incenter = $('.carousel_wrapper').width()*0.5;
            var left = $('.carousel_wrapper').offset().left;
            var i = $('.current').attr('data-id');
            if(95*i > incenter){
                $('.carousel_wrapper').scrollLeft(incenter+left);
            }else{
                $('.carousel_wrapper').scrollLeft(95*i);
            }
        }

        function getPhotoTime(photoname) {
            return parseInt(photoname.substr(3,10))*1000; 
        }

        // 改变图片时同步信息
        function changebigimage(now){
            $('.lb_imgbox').remove();
            for (var i = 0; i < smallnow.length; i++) {
                if(smallnow[i].photo == now){
                    $('#do_image').append(dot_bigimage(smallnow[i]));
                    $('#imageinfo').html(dot_imageinfo(smallnow[i]));

                    if(smallnow[i].photogps){
                        var xy = smallnow[i].photogps.split(',');
                        setMap(xy[0],xy[1]); 
                    }else{
                        setMap(smallnow[i].x,smallnow[i].y);
                    }
                }
            }
            $(".lb_mainimg").on('load', function(){
                if(biggest){
                    biggestcss();
                }else{
                    loadcss(); 
                }
                $(".lb_mainimg").show();
            });
        }
        function setMap(x,y) {
            map.setCenter(new qq.maps.LatLng(x,y));
        }

        // 加载全屏图样式
        function biggestcss(){
            $('#do_image').css({"height":height+'px',"width":width+'px',"background":"#000"});
            var imagewidth = $('.lb_mainimg').width();
            var imageheight = $('.lb_mainimg').height();
            var i = imagewidth/imageheight;
            var j = windowwidth/windowheight;
            if(imagewidth>imageheight){
                if(i>j){
                    var w = windowwidth;
                    var h = imageheight*(windowwidth/imagewidth);
                }else{
                    var w = imagewidth*(windowheight/imageheight);
                    var h = windowheight;
                }
            }else{
                var w = (windowheight/imageheight)*imagewidth;
                var h = windowheight;
            }
            $('.lb_body').css({"height":windowheight+'px',"width":windowwidth+'px'});
            $('.lb_imgbox').css({"height":windowheight+'px',"width":w+'px',"margin-top": -(h/2)+'px',"margin-left": -(w/2)+'px',"top": "50%", "left": "50%"});
            $('.lb_mainimg').css({"height":h+'px',"width":w+'px'});
        }

        // 加载正常图片样式
        function loadcss(){
            var imagewidth = $('.lb_mainimg').width();
            var imageheight = $('.lb_mainimg').height();
            if(imagewidth > imageheight){
                if(imagewidth >= (width-400)){
                    var newimagewidth = width-400;
                    var newimageheight = (newimagewidth/imagewidth)*imageheight;
                }else{
                    var newimagewidth = imagewidth;
                    var newimageheight = imageheight;
                }
            }else{
                if(imageheight >= (height-130)){
                    var newimageheight = height-130;
                    var newimagewidth = (newimageheight/imageheight)*imagewidth;
                }else{
                    var newimageheight = imageheight;
                    var newimagewidth = imagewidth;
                }
            }
            $('.lb_imgbox').css({"height":newimageheight+'px',"width":newimagewidth+'px',"margin-top": -(newimageheight/2)+'px',"margin-left": -(newimagewidth/2)+'px',"top": "50%", "left": "50%"});
            $('.lb_mainimg').css({"height":newimageheight+'px',"width":newimagewidth+'px',"cursor": "pointer", "visibility": "visible", "top": "0px", "left": "0px"});
            $('.carousel_wrapper').css('width',(width-590)+'px');
        }

        // 点击小图
        $('.carousel_list').on('click','li',function(){
            $(this).siblings().removeClass('current');
            $(this).addClass('current');
            var dataindex = $(this).data('index');
            var dataid = $('.current').data('id');
            changebigimage(dataindex,dataid);
        })

        // 图片上一个
        $('#lbPrev').click(function(){
            if($('.current').prev('li').data('index')){
                $('.current').prev('li').addClass('currentnext');
                $('.current').removeClass('current');
                $('.currentnext').attr('class','current');
                var dataindex = $('.current').data('index');
                var dataid = $('.current').data('id');
                if(dataindex){
                    changebigimage(dataindex);
                    var left = $('.carousel_wrapper').scrollLeft();
                    var incenter = $('.carousel_wrapper').width()*0.5;
                    var currentleft = $('.current').offset().left;
                    if(currentleft<incenter){
                        $('.carousel_wrapper').scrollLeft(left-95);
                    }
                }
            }else{
                prevdata();
            }
        })

        function prevdata(){
            if(showcount > 1){
                    smallnow = [];
                    showcount--;
                    for (var i = (showcount-1)*10; i < allbigimagedata.length; i++) {
                        var photo = allbigimagedata[i].photo.split(';');
                        var photogps = '';
                        if(allbigimagedata[i].gps){
                            photogps = allbigimagedata[i].gps.split(';');
                        }                            
                        for (var j = 0; j < photo.length; j++) {
                            var lengths = smallnow.length;
                            smallnow[lengths] = {};
                            if(photogps){
                                smallnow[lengths].photogps = photogps[j];
                            }else{
                                smallnow[lengths].photogps = ''; 
                            }
                            smallnow[lengths].photo = photo[j];
                            smallnow[lengths].active = allbigimagedata[i].active;
                            smallnow[lengths].name = allbigimagedata[i].name;
                            smallnow[lengths].phone = allbigimagedata[i].phone;
                            smallnow[lengths].time = getPhotoTime(allbigimagedata[i].phone);
                            smallnow[lengths].tree_attribute = allbigimagedata[i].tree_attribute;
                            smallnow[lengths].tree_name = allbigimagedata[i].tree_name;
                        }
                    }
                    $('#smallimage').css('width',(smallnow.length*96)+'px');
                    $('#smallimage').html(dot_smallimage(smallnow));
                    $('#smallimage li').eq(smallnow.length-1).addClass('current');
                    changebigimage(smallnow[smallnow.length-1].photo);
                    $('.carousel_wrapper').scrollLeft($('.carousel_list').width());
                }else{
                    alert('无最新记录了！');
                }
        }

        function nextdata(){
            if(allbigimagedata[(showcount+1)*10]){
                    smallnow = [];
                    showcount++;
                    for (var i = (showcount-1)*10; i < allbigimagedata.length; i++) {
                        var photo = allbigimagedata[i].photo.split(';');
                        var photogps = '';
                        if(allbigimagedata[i].gps){
                            photogps = allbigimagedata[i].gps.split(';');
                        }                            
                        for (var j = 0; j < photo.length; j++) {
                            var lengths = smallnow.length;
                            smallnow[lengths] = {};
                            if(photogps){
                                smallnow[lengths].photogps = photogps[j];
                            }else{
                                smallnow[lengths].photogps = ''; 
                            }
                            smallnow[lengths].photo = photo[j];
                            smallnow[lengths].active = allbigimagedata[i].active;
                            smallnow[lengths].name = allbigimagedata[i].name;
                            smallnow[lengths].phone = allbigimagedata[i].phone;
                            smallnow[lengths].time = getPhotoTime(allbigimagedata[i].phone);
                            smallnow[lengths].tree_attribute = allbigimagedata[i].tree_attribute;
                            smallnow[lengths].tree_name = allbigimagedata[i].tree_name;
                        }
                    }
                    $('#smallimage').css('width',(smallnow.length*96)+'px');
                    $('#smallimage').html(dot_smallimage(smallnow));
                    $('#smallimage li').eq(0).addClass('current');
                    changebigimage(smallnow[0].photo);
                    $('.carousel_wrapper').scrollLeft(0);
                }else{
                    loadimgsdata();
                    $('.carousel_wrapper').scrollLeft(0);
                }
        }

        // 图片下一个
        $('#lbNext').click(function(){
            if($('.current').next('li').data('index')){
                $('.current').next('li').addClass('currentnext');
                $('.current').removeClass('current');
                $('.currentnext').attr('class','current');
                var dataindex = $('.current').data('index');
                var dataid = $('.current').data('id');
                if(dataindex){
                    changebigimage(dataindex);
                    var incenter = $('.carousel_wrapper').width()*0.6;
                    var currentleft = $('.current').offset().left;
                    var left = $('.carousel_wrapper').scrollLeft();
                    if(currentleft>incenter){
                        if($('.carousel_list').width()>left){
                            $('.carousel_wrapper').scrollLeft(left+95);
                        }
                    }
                }
            }else{
                nextdata();
            }
        })

        // 图片上一组
        $('.carousel_prev').click(function(){
            prevdata();
        })

        // 图片下一组
        $('.carousel_next').click(function(){
            nextdata();
        })

        // 全屏
        $('#do_image').on('click','.lb_mainimg',function(){
            if(!biggest){
                fullscreen();
                var docElm = document.getElementById("do_image");
                if (docElm.requestFullscreen) {
                    docElm.requestFullscreen();
                }
                else if (docElm.msRequestFullscreen) {
                    docElm.msRequestFullscreen();
                }
                else if (docElm.mozRequestFullScreen) {
                    docElm.mozRequestFullScreen();
                }
                else if (docElm.webkitRequestFullScreen) {
                    docElm.webkitRequestFullScreen();
                }
            }else{
                backsmall();
            }
        })

        // 退出全屏
        function backsmall(){
            if(biggest){
                exitFullscreen();

                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
                else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                }
                else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        }

        // 点击×退出全屏
        $('#closeimage').click(function(){
            backsmall();
        })

        function fullscreen() {
            if(!biggest){
                biggest = true;
                biggestcss();
                 $('#closeimage').show();
                $('#lbSidebar').hide();
            }
        }
        function exitFullscreen() {
            if(biggest){
                biggest = false;
                $('#lbSidebar').show();
                $('#closeimage').hide();
                $('#do_image').css("background","#fff");
                $('.lb_body').css({"height":height+'px',"width":'100%'});
                natrue();
                loadcss();
            }
        }

        if (document.exitFullscreen) document.addEventListener("fullscreenchange", function(e) {
            document.fullScreen ? fullscreen() : exitFullscreen();
        });
        if (document.mozCancelFullScreen) document.addEventListener("mozfullscreenchange", function(e) {
            document.mozFullScreen ? fullscreen() : exitFullscreen();
        });
        if (document.webkitCancelFullScreen) document.addEventListener("webkitfullscreenchange", function(e) {
            document.webkitIsFullScreen ? fullscreen() : exitFullscreen();
        });
        if (document.msExitFullscreen) document.addEventListener("msfullscreenchange", function(e) {
            document.msFullscreenEnabled ? fullscreen() : exitFullscreen();
        }); 
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
	    hasthisrecord = false;

	    $('.searchallproject').removeClass('on');
	    $('#mysearch').css('opacity','0');

	    if(id == 'projectimage'){
	    	$('#statistics').css('opacity','0');
	    	$('#projectimage').css('opacity','1');
	    }else if(id == 'statistics'){
	    	$('#projectimage').css('opacity','0');
	    	$('#statistics').css('opacity','1');
	    }else if(id == 'home'){
	    	$('#projectimage').css('opacity','0');
	    	$('#statistics').css('opacity','0');
	    	$('#mysearch').css('opacity','0');
	    	$('#profile').css('opacity','0');
	    }
	});

	function changeover(id){
		switch (id)
		{
		    case 'projectimage':
    	    	if(!allimagedata){
    		    	loadallimage(true);	
    	    	}else{
	        		window.pageManager.go(id);	
    	    	}
		    	break;
		    case 'showallproject':
		    	if(isObject(treelist[projectlist[0].id])){
		    		$('#right_tree').html(dot_treelistinfobuy(treelist[projectlist[0].id]));
		    	}else{
		    		$('#right_tree').html('<div class="weui-loadmore">没有数据！</div>');
		    	}
		    	$('#left_project').html(dot_projectname(projectlist));
		    	window.pageManager.go(id);
		    	break;
		    default :
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

	function searchgroup(){
		$.post('/com/search_map_group.php', {userid: user.userid}, function(result) {
			if(result){
				user.userid = result;
			}
			$('#headImage').attr('src','./headimg/96/'+user.userid+'.jpg');
			setPageManager();
		});
	}

    var user = getcookie('user2');
    user = user ? JSON.parse(user) : null;

	searchgroup();
</script>
</body>