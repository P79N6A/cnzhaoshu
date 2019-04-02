<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
	<title>中国吉林森工集团</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
	<meta name="format-detection" content="telephone=no"/> 
	<link rel="stylesheet" href="/css/basic_m.css?t=20170425" type="text/css" />
	<link rel="stylesheet" href="/css/rangeslider.css"/>
</head>
<body>
<div id="content">
	<div id="header_bar">
    	<div class="search" >
        	<img class="search_logo" src="/platform/search_gh_81f2fe01ba34.jpg">
        	<input id="key" type="text" placeholder="15公分银杏"/>
    		<a href="javascript:onSearch()" class="search_button"></a>
        </div>
	</div>

	<div class="banner">
		<div id="slideBox" class="slideBox">
            <div class="bd">
                <ul></ul>
            </div>
   			<div class="hd">
            	<ul></ul>
            </div>
		</div>
	</div>

	<div id="filter" class="filter" style="margin-top: 60px">
		<ul id="where"></ul>
		<ul>♧<span id="total"></span><span id="average"></span>
			<div style="font-size:14px;padding:40px 18px 8px 20px">
				<input style="display:none" type="text" id="range" />
			</div>
			<span class="select">
				<a href="javascript:orderByPrice()" id="btn_price" class="unselect">价格◇</a>
				<a href="javascript:searchRenZheng()" id="btn_renzheng" class="unselect">已认证</a>
				<a href="javascript:searchYuanTu()" id="btn_yuantu" class="unselect">原图认证</a>
				<a href="javascript:searchShiPin()" id="btn_shipin" class="unselect">视频认证</a>
			</span>
		</ul>
		<ul class="specification">
			<span style="width:45px;display:inline-block">径<i>cm</i></span>
			<input type="text" id="spec_dbh"
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)searchDbh()"
					onpaste="return false">
			<span id="default_dbh"></span><br>
			<span style="width:45px;display:inline-block">冠<i>m</i></span>
			<input type="text" id="spec_crownwidth" 
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)searchCrownWidth()"
					onpaste="return false">
				<span id="default_crownwidth"></span><br>
			<span style="width:45px;display:inline-block">高<i>m</i></span>
			<input type="text" id="spec_height"
					placeholder="✎ 10-12"
					onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)searchHeight()"
					onpaste="return false">
			<span id="default_height"></span>
		</ul>		
		<ul id="province_ul"><span id="province"></span></ul>
	</div>

	<div id="userlist"></div>
	<div id="treelist"></div>

	<div id="footer" class="footer" style="display:none"></div>

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
<script>var platform=1026;var platformname='中国吉林森工集团';</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/js/TouchSlide.1.1.js"></script>
<script src="/js/rangeslider.js"></script>
<script src="/js/crypt.js?t=20160930"></script>
<script src="/js/grouplist.js?t=20171029"></script>
<script src="/js/basic_m.js?t=20180102"></script>
<script src="/js/index.js?t=20181013"></script>
</body></html>