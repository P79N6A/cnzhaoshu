<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
	<meta name="format-detection" content="telephone=no"/> 
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="img/icon180.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/icon152.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/icon144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/icon120.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icon114.png">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/icon76.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icon72.png">
    <link rel="apple-touch-icon-precomposed" href="img/icon57.png">
    <link rel="shortcut icon" href="img/icon120.png">
    <link rel="icon" sizes="192x192" href="img/icon192.png">
    <link rel="icon" sizes="128x128" href="img/icon128.png">
	<link rel="stylesheet" href="css/basic_m.css?t=20170425" type="text/css" />
	<link rel="stylesheet" href="css/rangeslider.css"/>
	<style type="text/css">
		.txtScroll-left{ position:relative;font-size: 14px}
		.txtScroll-left .bd{ width:100%; overflow:hidden;    }
		.txtScroll-left .bd ul{ overflow:hidden; zoom:1; border: 0 }
		.txtScroll-left .bd ul li{text-align: center;}
		.txtScroll-left .bd ul li span{ color:#999;  }
	</style>
</head>
<body>

<div id="content">
	<div id="header_bar">
    	<div class="search" >
        	<img id="logo" class="search_logo" onerror="this.src='/img/logo72.jpg'">
        	<input id="key" type="text" placeholder="15公分银杏"/>
    		<a href="javascript:onSearch()" class="search_button"></a>
        </div>
	</div>

	<div class="banner">
		<a href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MjM5MTQwMzA1OQ==&scene=123&from=singlemessage&isappinstalled=0#wechat_redirect">
	        <img style="width: 100%" src="ad/1.jpg">		
		</a>
	</div>

	<div id="filter" class="filter">
		<ul id="where"></ul>
		<ul>♧<span id="total"></span><span id="average"></span>
			<div style="font-size:14px;padding:40px 18px 8px 20px">
				<input style="display:none" type="text" id="range" />
			</div>
			<div style="text-align:center">
				<a href="javascript:orderByPrice()" id="btn_price" class="unselect">价格◇</a>
				<a href="javascript:orderByTime()" id="btn_time" class="unselect">时间</a>
				<a href="javascript:searchFilter('qingdi','清地树')" id="btn_qingdi" class="unselect">清地树</a>
				<a href="javascript:searchFilter('qijian','旗舰店')" id="btn_qijian" class="unselect">旗舰店</a>
				<a href="javascript:searchFilter('renzheng','已认证')" id="btn_renzheng" class="unselect">已认证</a>
				<a href="javascript:searchFilter('fapiao','有发票')" id="btn_fapiao" class="unselect">有发票</a>
				<a href="javascript:searchFilter('yuantu','原图认证')" id="btn_yuantu" class="unselect">原图认证</a>
				<a href="bjmm.php" class="unselect">北京苗木</a>
				<a href="bjhyxh.php" class="unselect">北京协会</a>
				<a href="bjzm.php" class="unselect">北京种苗协会</a>
				<a href="jzmx.php" class="unselect">冀中苗讯</a>
			</div>
		</ul>
		<ul class="specification">
			<span style="width:45px;display:inline-block">径<i>cm</i></span>
			<input type="text" id="spec_dbh"
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
					onpaste="return false">
			<span id="default_dbh"></span><br>
			<span style="width:45px;display:inline-block">冠<i>m</i></span>
			<input type="text" id="spec_crownwidth" 
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
					onpaste="return false">
				<span id="default_crownwidth"></span><br>
			<span style="width:45px;display:inline-block">高<i>m</i></span>
			<input type="text" id="spec_height"
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
					onpaste="return false">
			<span id="default_height"></span>
		</ul>		
		<ul id="province_ul"><span id="province"></span></ul>
	</div>

	<div id="treelist"></div>
	<div id="footer"></div>

    <!-- 底部菜单 -->
	<div id="footer_menu" class="h_0100_1">
		<a href="#">
			<li>
				<i class="nav_11"></i>
			    <span>首页</span>
			</li>
		</a>
		<a href="yusuanphone.php">
			<li>
				<i class="nav_5"></i>
			    <span>招投标</span>
			</li>	            
		</a>
		<a id="nav_cart" href="">
			<li>
				<i class="nav_3"></i>
			    <span>找树车</span>
			</li>	           
		</a>
    	<a id="nav_moments" href="zsq.php">
	        <li>
        		<i class="nav_2"></i>
                <span>找树圈</span>
	        </li>	           
        </a>
        <a href="/admin/">
	        <li>
            	<i id="headImage" class="nav_4"></i>
                <span>我</span>
	        </li>
        </a>
    </div>
    
	<div id="searchmore">正在加载...</div>
</div>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/js/TouchSlide.1.1.js"></script>
<script src="/js/rangeslider.js"></script>
<script src="/js/crypt.js?t=201811052"></script>
<script src="/js/basic_m.js?t=20180102"></script>
<script src="/js/index.js?t=20181020"></script>
</body></html>