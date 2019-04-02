
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>找树圈</title>
<link href="zsq.css?t=201703072"" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="topshow">
	<div class="showinfo">
		<button type="button" class="alert_btn">×</button>
		<div id="showinfo">
		</div>
	</div>
</div>
<div class="zsq_box">
    <div class="zsq_top">
        <a class="zt_l" style="overflow:hidden;width:30%" id="gomyshop" href="">
            <img id="zt_lo" src="" width="100%"/>
        </a>
        <div class="zt_r" style="width:50%">
            <div class="zt_name" id="zt_name">
            </div>
            <div class="zt_tel" id="zt_tel">
            </div>
        </div>
    </div>
    <div class="zsq_bottom sideMenu">
    	<ul>
	        <li class='slide_li'>
				<div class="zb_item" draworder="1">
			        <div class="zi_tet bg_1">我的收藏</div>
			        <div class="zi_num">
			            <span id="mycollectnow"></span><span id="mycollectall"></span>
			        </div>
			        <em></em>
			    </div>
		        <div class="l_main1" id="mycollect">
		        </div>
	        </li>
    		<li class='slide_li'>
				<div class="zb_item" draworder="2">
			        <div class="zi_tet bg_2">收藏我的</div>
			        <div class="zi_num">
			            <span id="collectnow"></span><span id="collectall"></span>
			        </div>
			        <em></em>
			    </div>
		        <div class="l_main1" id="collectshop">
		        </div>
	        </li>
	        <li class='slide_li'>
				<div class="zb_item" draworder="3">
			        <div class="zi_tet bg_3">分享我的</div>
			        <div class="zi_num">
			            <span id="sharenow"></span><span id="shareall"></span>
			        </div>
			        <em></em>
			    </div>
		        <div class="l_main1" id="shareshop">
		        </div>
	        </li>
	        <li class='slide_li'>
				<div class="zb_item" draworder="4">
			        <div class="zi_tet bg_4">访问我的</div>
			        <div class="zi_num">
			            <span id="visitnow"></span><span id="visitall"></span>
			        </div>
			        <em></em>
			    </div>
		        <div class="l_main1" id="visitshop">
		        </div>
	        </li>
        </ul>
    </div>
	
</div>

    <!-- 底部菜单 -->
	<div id="footer_menu" class="h_0100_1">
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
			<a href="yusuanphone.php">
				<li>
					<i class="nav_5"></i>
				    <span>招投标</span>
				</li>	            
			</a>
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

<!-- 加载模板 -->
<script id="dot_visitor" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <a class="modal-content-show showmore" dateid="{{=it[i].userid}}">
            <img src="/headimg/96/{{=it[i].userid}}.jpg"  onerror="onerrorHeadimg()" class="visitorimg" width="70%"/>
            <p class="showname">{{=it[i].name?it[i].name:'无名大咖'}}</p>
        </a>
    {{ } }}
</script>

<script id="dot_collector" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <a href='cart.php?where={"userid":{{=it[i].useridb?it[i].useridb:it[i].userid}},"shopid":{{=it[i].shopid}}}' class="modal-content-show">
        
        	<div class="showtime">{{=string2shortTime(it[i].time)}}</div>
            <img src="/headimg/96/{{=it[i].userid}}.jpg"  onerror="onerrorHeadimg()" class="visitorimg" width="70%"/>
            <p class="showname">{{=it[i].name?it[i].name:'无名大咖'}}</p>
        </a>
    {{ } }}
</script>

<script id="dot_showinfo" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <div class="oneinfo">
			<img src="/headimg/96/{{=it[i].visitorid}}.jpg" onerror="onerrorHeadimg()" class="headimg">
			<div class="infoway">
				<span class="span1">{{=it[i].name?it[i].name:'无名大咖'}}</span>
				<span class="span2 showname">{{=it[i].time}}</span>
				<span class="span3 showname">
				{{? it[i].type == 0}}
					通过对话
				{{?? it[i].type == 1}}
					通过朋友圈
				{{?? it[i].type == 2}}
					通过QQ
				{{?? it[i].type == 3}}
					通过微博
				{{?? it[i].type == 4}}
					通过QQ空间
				{{?}}
				<span class="way showname"></span></span>
			</div>
		</div>
    {{ } }}
</script>


<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/js/doT.min.js"></script>
<script src="/js/zsq.js?t=20170410"></script>
<script src="/js/fastclick.min.js?t=20161205"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</body>
</html>

