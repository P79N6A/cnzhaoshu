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
		.row-1{
			width: 10%;
		}
		.row-2{
			width: 20%;
		}
		.row-3{
			width: 30%;
		}
		.row-4{
			width: 40%;
		}
		.row-5{
			width: 50%;
		}
		.row-6{
			width: 60%;
		}
		.row-7{
			width: 70%;
		}
		.row-8{
			width: 80%;
		}
		.row-9{
			width: 90%;
		}
		.row-10{
			width: 100%;
		}
		.left{
			float: left;
		}
		.right{
			float: right;
		}
		.textright{
			text-align: right;
		}	
		.greenfont{
			color:#09BB07;
		}
		.active{
			border: 2px solid red;
		}
		.alltreelist{
			width:35%;
			float: left;
			line-height: 40px;
			color:#666;
			padding-left:5%;
		}
		.scanqrcode{
			width:40%;
			float: right;
			line-height: 40px;
			color:#666;
			text-align: center;
		}
		/*全部苗木*/
		#boy{
			width:100%;
			top:40px;
			position: relative;
			background-color: rgb(229, 227, 223);
			overflow: hidden;
			transform: translateZ(0px);
		}
		.supervision_info{
			width: 100%;
		    top: 40px;
		    position: relative;
		}
		.search_title{
			width: 96%;
			padding: 5px 2%;
			float: left;
			background-color: #efeff4;
			border-bottom: 1px solid #ddd;
		}
		.search_title *{
			line-height: 35px;
			height:35px;
		}
		.search_title input{
			border-radius: 35px;
			width:65%;
			padding: 0px 4%;
			font-size:16px;
			color:#999;
		}
		.button_searching{
			width:10%;
			font-size: 16px;
			text-align:center;
		}
		.button_reset{
			width:15%;
			font-size: 16px;
			text-align:center;
		}
		.tree_box{
			width:92%;
			padding: 5px 4%;
			color:#555;
			background-color: #efeff4;
			float: left;
			overflow-y: auto;
			-webkit-overflow-scrolling: touch;
		}
		.tree_info{
			width:100%;
			padding: 10px 0;
			border-bottom: 1px dashed #fff;
		}
		.tree_info a{
			color:#09BB07;
		}
		/*全部苗木*/
		/*首页*/
		#imagetip {
		    height: 100px;
	        position: absolute;
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
		.tooltip.active {
		    color: #fff;
		    background-color: red;
		    z-index: 10;
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
		/*首页*/
		/*进度*/
		.listimage,.listimage1{
			width: 100%;
			position: relative;
			top: 40px;
		}
		#listimage,#listimage1{
			width: 100%;
			float: left;
			height: 100%;
			overflow-y: auto;
			-webkit-overflow-scrolling: touch;
		}
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
		.select_timeinput{
			width: 30%;
		    float: left;
		    height: 40px;
		    line-height: 40px;
		    text-align: center;
		    font-size: 13px;
		}
		.onestatistics{
			width:92%;
			margin:2px 4%;
			float: left;
			font-size: 17px;

		}
		.onestatistics div:nth-child(1){
			float: left;
			width:40%;
		}
		.onestatistics div:nth-child(2){
			float: left;
			color:#999;
			width:25%;
			text-align: center;
		}
		.onestatistics div:nth-child(3){
			float: right;
			color:#999;
			width:35%;
			text-align: right;
		}
		#mangerself{
			width:100%;
			background-color: #eee;
			float: left;
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
		#alerts{
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

		/*进度*/
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
    <a data-id="profile" class="head">
        <img id="headImage" src="">
        <p>我</p>
    </a>
</div>

<script id="dot_allmytree" type="text/x-dot-template">
    {{ for(var i in it) { }}
	    <div class="tree_info left" data-id="{{=it[i].id}}">
            <div class="row-1 left">{{=numbern()+'.'}}</div>
            <div class="row-5 left">{{=it[i].tree_name}}</div>
            <div class="row-4 left textright">号树</div>
        	<div class="row-9 right">{{=it[i].tree_attribute}}</div>	
	    </div>
    {{ } }}
</script>

<script id="dot_imagetip" type="text/x-dot-template">
    <li data-id="{{=it.id}}" style="background-image:url({{=it.tip.image}})">
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

<script id="dot_statistics_info" type="text/x-dot-template">
    {{ for(var i in it) { }}
    	{{ for(var j in it[i]) { }}
			<div class="onestatistics">
				<div>{{=i}}</div>
				<div>{{=witchstate(j)}}</div>
				<div>{{=it[i][j]+'项'}}</div>
			</div>
		{{ } }}
    {{ } }}
</script>

<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script src="./js/doT.min.js"></script>
<script src="./js/zepto.min.js"></script>
<script type="text/javascript" src="./js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	var height = $(window).height();
	var width = $(window).width();
	var showalltree_isloading = false,showalltree_isend = false,photo_isloading = false,photo_isend = false;
	
	var tpl_showallproject_data;
	var $container = $('#container');
	var mymap;
	var allmapdata;
	var allimagedata;
	var timeimagedata;
	var keyvalue = [];
	// 地图上的点
	var overlay = {};
	var imagetip = {};
	// 详情
	var photoindex;
	var thisrecord;
	var hasthisrecord = false;

	var dot_allmytree = doT.template($('#dot_allmytree').text());
	var dot_imagetip = doT.template($('#dot_imagetip').text());
	var dot_tooltip = doT.template($('#dot_tooltip').text());
	var dot_statistics_info = doT.template($('#dot_statistics_info').text());

	var user = getcookie('user2');
	user = user ? JSON.parse(user) : null;

	function getcookie(name){
	    var arrStr = document.cookie.split("; ");
	    for(var i = 0;i < arrStr.length;i ++){
	        var temp = arrStr[i].split("=");
	        if(temp[0] == name) return unescape(temp[1]);
	    } 
	}
	$container.on('click','.mysearch',function(){
		changeover(getActiveMenu());
	})
	$('#headImage').attr('src','./headimg/96/'+user.userid+'.jpg');
	$container.on('click','.alltree_list',function(){
		window.pageManager.go('showallproject');
	})
	function getActiveMenu() {
	    return $('#tabbar .on').data('id');
	}
	function witchstate(a){
		switch (a)
		{	
			case '0':
				return '暂无';
				break;
		    case '1':
		    	return '号树';
		    	break;
		    case '2':
		    	return '起树';	
		    	break;
		    case '3':
		    	return '装车';	
		    	break;
		    case '4':
		    	return '物流';	
		    	break;
		    case '5':
		    	return '卸车';	
		    	break;
		    case '6':
		    	return '栽种';	
		    	break;
		    case '7':
		    	return '其他';	
		    	break;
		}
	}
	// 搜索苗木数据
	function searchmytree(name){
		if(showalltree_isloading) return;
		showalltree_isloading = true;
		var limit = $('#tree_box .tree_info').length + ',15';
		$.getJSON('/com/search_map_supervision_name.php', {userid:user.userid,name:name,limit:limit}, function(json) {
			if(json){
				$('#tree_box').append(dot_allmytree(json));
				showalltree_isloading = false;
			}else{
				showalltree_isend = true;
				$('#tree_box').append('<div class="weui-loadmore">没有数据！</div>');
			}
		});
	}
	// 加载苗木数据
	function searchallmytree(state){
		if(showalltree_isloading) return;
		showalltree_isloading = true;
		var limit = $('#tree_box .tree_info').length + ',15';
		$.getJSON('/com/search_map_supervision.php', {userid:user.userid,limit:limit}, function(json) {
			if(json){
				if(!tpl_showallproject_data){
					tpl_showallproject_data = json;
				}else{
					for (var i = 0; i < json.length; i++) {
						tpl_showallproject_data[tpl_showallproject_data.length] = json[i];
					}
				}
				$('#tree_box').append(dot_allmytree(json));
				showalltree_isloading = false;
			}else{
				showalltree_isend = true;
				$('#tree_box').append('<div class="weui-loadmore">没有数据！</div>');
			}
			if(state){
				changeover('showallproject');
			}
		});
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
	function TooltipOverlay(html, x, y) {
        this.div = $(html);
        this.x = x;
        this.y = y;
	}
	function overlayOnMap(mapdata) {
    	mymap.fitBounds(getMapBounds(mapdata));

	    // 添加新的
	    if(mapdata){
		    for (var i = 0; i<mapdata.length; i++) {
		        var data = mapdata[i];
		        data.tip = getTooltip(data);
		        if (data.photo && !imagetip[data.id]) {
	    	        if (!imagetip[data.id]) {
	    	            $('#imagetip').append(dot_imagetip(data)); 
	    	            imagetip[data.id] = 1;
	    	        }

	    	        if (data.tip.x && !overlay[data.id]) {
	    	            var overlaies = new TooltipOverlay(dot_tooltip(data), data.tip.x, data.tip.y);
		                overlaies.setMap(mymap);
	    	            overlay[data.id] = overlaies;
	    	        }
	    	        delete data.tip;
	    	    }else{
	    	    	var overlaies = new TooltipOverlay(dot_projecttooltip(data), data.tip.x, data.tip.y);
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
	function getMapBounds(datas) {
		if(datas){
		    var minLat=1000, minLng=1000, maxLat=0, maxLng=0;
			for(var i in datas){
		        var data = datas[i].gps;
		        var gpses = data.split(';');
		        gpses = gpses[0].split(',');
		        var gps_x = gpses[0];
		        var gps_y = gpses[1];
		        if (gps_x && gps_y) {
		            if (gps_x<minLat) minLat=gps_x;
		            if (gps_x>maxLat) maxLat = gps_x;

		            if (gps_y<minLng) minLng=gps_y;
		            if (gps_y>maxLng) maxLng = gps_y;
		        }    			
			}    	    
		}else{
			var minLat=37, minLng=110, maxLat=40, maxLng=120;
		}
	    var sw = new qq.maps.LatLng(maxLat, maxLng); //西南角坐标
	    var ne = new qq.maps.LatLng(minLat, minLng); //东北角坐标
	    return new qq.maps.LatLngBounds(ne, sw); //矩形的地理坐标范围
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
	        var gps = gpses[0].split(',');
	        result.image = 'photos/m/'+photo+'.jpg';
	        result.time = getPhotoTime(photo);
	        result.x = gps[0];
	        result.y = gps[1];
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
	function loadmapdata(){
		$.getJSON('/com/search_map_records.php', {userid:user.userid}, function(json) {
			if(json){
				allmapdata = json;
				overlayOnMap(json);
				$('#boy').css('height',(height-192)+'px');
				$('#imagetip').css('top',(height-152)+'px');
			}else{
				$('#boy').css('height',(height-92)+'px');
				$('#imagetip').hide();
			}
		});
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

	            var gpses = data.gps.split(';');
	            gpses = gpses[0].split(',');
	            var gps_x = gpses[0];
	            var gps_y = gpses[1];

	            if (!mapContains(mymap.getBounds(), gps_x,gps_y)) {
	                mymap.panTo(new qq.maps.LatLng(gps_x,gps_y));
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
	function mapContains(mapbounds, gps_x,gps_y) {
	    if (gps_x && gps_y) {
	        return mapbounds.contains(new qq.maps.LatLng(gps_x,gps_y));
	    } else {
	        return false;
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
	    for (var i = allmapdata.length - 1; i >= 0; i--) {
	        mapdata = allmapdata[i];
	        if (mapdata.id == id) return mapdata;
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
	function datetime(time){
		time = time.substring(0,10);
		return time;
	}
	function loadallimage(a,b){
		if(photo_isloading) return;
		photo_isloading = true;
		var limit = $('#listimage .photobox').length + ',14';
		$.getJSON('/com/search_time_images.php', {userid: user.userid,limit:limit,begin:a,end:b}, function(json) {
			if(json){
				if(!allimagedata) allimagedata = [];
				for (var i = 0; i < json.length; i++) {
					allimagedata[allimagedata.length] = json[i];
				}
				$('#listimage').append(loadstatisticphoto(json));
				photo_isloading = false;
			}else{
				photo_isend = true;
				$('#listimage').append('<div class="weui-loadmore">没有数据！</div>');
			}
		});
	}
	function loadstatisticphoto(photo){
		var time = '';
		var str = '';
		for (var i in photo) {
			var photos= photo[i].photo.split(';')[0];
			if(datetime(photo[i].time) == time){
				str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
			}else{
				time = datetime(photo[i].time);
				str += '<div class="photo_title">'+time+'</div>';
				str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
			}
		}
		return str;
	}
	function lookthisrecord(id){
		$.getJSON('/com/search_this_records.php',{id:id},function(json){
			if(json){
				thisrecord = json;
				hasthisrecord = true;
				photo_isloading = true;
				photo_isend = true;
				$('#listimage').html(loadstatisticphoto(thisrecord));
				window.pageManager.go('projectimage');	
			}
		})
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
	            'hideMenuItems',
	            'scanQRCode'
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
<!-- 全部苗木 -->
<script type="text/html" id="tpl_showallproject">
    <div class="page" id="mysearch">
    	<div class="header">
    		<div class="alltreelist mysearch">全部苗木<i class="iconfont icon-select"></i></div>
    	</div>
	    <div class="supervision_info">
	    	<div class="search_title">
		        <div class="button_reset greenfont left">清空</div>
		        <input type="text" class="left" id="searchInput" placeholder="苗木名称或进度">
		        <i class="weui-icon-search button_searching greenfont left"></i>
	    	</div>
	        <div id="tree_box" class="tree_box">
	        </div>
	    </div>
    </div>
    <script type="text/javascript">
    	var number = 1,
    		issearching = false,
    		searchname,
    		$searchInput = $('#searchInput'),
    		$supervision_info = $('.supervision_info'),
    		$button_searching = $('.button_searching'),
    		$button_reset = $('.button_reset'),
    		$tree_box = $('#tree_box');
    	$supervision_info.css('height',(height-90)+'px');
    	$tree_box.css('height',(height-146)+'px');
    	function numbern(){
    		return number++;
    	}
        $button_reset.click(function(){
        	$searchInput.val('');
        	issearching = false;
        	searchname = null;
        	showalltree_isloading = false;
        	showalltree_isend = false;
        	$tree_box.html('');
        	number = 1;
        	$tree_box.html(dot_allmytree(tpl_showallproject_data));
        })
        $button_searching.click(function(){
        	searchname = $.trim($searchInput.val());
        	if(searchname){
        		issearching = true;
        		showalltree_isloading = false;
        		showalltree_isend = false;
	        	$tree_box.html('');
	        	number = 1;
	        	searchmytree(searchname);
        	}
        })
        $tree_box.scroll(function(e) {
        	if(showalltree_isloading && showalltree_isend) return;
        	var scrollHeight = $(this)[0].scrollHeight;
        	var scrollTop = $(this)[0].scrollTop;
        	var elementHight = $(this).height();
        	if(scrollTop + elementHight >= scrollHeight-300){
        		if(issearching){
        			searchmytree(searchname);
        		}else{
        			searchallmytree();
        		}
        	}
        });
        searchallmytree(true);

		// 看单个苗木
		$tree_box.on('click','.tree_info',function(){
			var id = $(this).data('id');
			switch (getActiveMenu())
			{
			    case 'home':
			    	var newdata = [];
			    	for (var i = 0; i < allmapdata.length; i++) {
			    		if(allmapdata[i].id == id){
			    			newdata[newdata.length] = allmapdata[i];
			    		}
			    	}	
			    	if(newdata.length){
			    		$('#boy').css('height',(height-192)+'px');
			    		$('#imagetip').show();
			    	}else{
			    		$('#boy').css('height',(height-92)+'px');
			    		$('#imagetip').hide();
			    	} 
			    	deletealldom();  	
	    			overlayOnMap(newdata);

			    	if(mymap){
				    	if(allmapdata){
				    		$('#boy').css('height',(height-192)+'px');
				    		$('#imagetip').show();
				    	}else{
				    		$('#boy').css('height',(height-92)+'px');
				    		$('#imagetip').hide();
				    	}
				    	deletealldom();
				    	overlayOnMap(allmapdata);
			    	}
			    break;
			    case 'projectimage':
			    	lookthisrecord(id);
			    	window.pageManager.go(getActiveMenu());
			    	break;
			    default:
					window.pageManager.go(getActiveMenu());
			    	break;
			}
		})
    </script>
</script>
<!-- 主页 -->
<script type="text/html" id="tpl_home">
    <div id="home" class="page">
    	<div class="header">
    		<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
    		<div class="scanqrcode" id="scanQRCode1">绑定二维码</div>
    	</div>
	    <div id="boy">
	    </div>
	    <div id="imagetip" class="imagetip"></div>

	    <div id="alerts"><div id="alert"></div></div>

    </div>
    <script type="text/javascript">
   	 	var $imagetip = $('#imagetip');
   	 	var $alerts = $('#alerts');
   	 	var $alert = $('#alert');
    	initMap();
    	loadmapdata();
    	$imagetip.on('touchstart', onImagetipTouchstart);
    	$imagetip.on('click','li',function(){
    		var id = $(this).data('id');
    		lookthisrecord(id);
    		for (var id in imagetip) {
		        $('#imagetip [data-id="' + id + '"]').remove();
		        delete imagetip[id];
		        overlay[id].setMap(null);
		        delete overlay[id];
    		}
    	})

    	$('#scanQRCode1').click(function(){
			wx.scanQRCode({
				needResult: 1,
				desc: 'scanQRCode desc',
				success: function (res) {
					var id = res.resultStr.split('=')[1];
					$.post('/com/insert_map_supervision_qrcode.php', {userid: user.userid,qrcode:id}, function(result) {
						if(result){
							$alert.html('二维码绑定成功！');
						}else{
							$alert.html('绑定失败,请重新绑定！');
						}
						$alerts.show();
						setTimeout(function (){
							$alerts.hide();
						},1500)
					});
				}
			});
    		
    	})
    </script>
</script>
<!-- 进度 -->
<script type="text/html" id="tpl_projectimage">
    <div id="projectimage" class="page">
		<div class="header">
			<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
			<input id="begindate1" class="weui-input select_timeinput" type="date">
			<input id="enddate1" class="weui-input select_timeinput" type="date">
		</div>
		<div class="listimage">
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
    		

		var atime = new Date();
		var btime = new Date(atime.getTime() - 30*24*60*60*1000); 

		$begindate1.val(deadltime(btime));
		$enddate1.val(deadltime(atime));
		function deadltime(a){
			var y = a.getFullYear();
			var m = a.getMonth()+1;
			m = (m < 10)? '0'+m : m;
			var d = a.getDate();
			d = (d < 10)? '0'+d : d;
			return y+'-'+m+'-'+d;
		}

    	$_listimage.css('height',(height-92)+'px');
    	$begindate1.change(selecttime);
    	$enddate1.change(selecttime);

    	if(hasthisrecord){
    		$listimage.html(loadstatisticphoto(thisrecord));
    		hasthisrecord = false;
    	}else if(!allimagedata){
    		loadallimage();
    	}

    	$listimage.scroll(function(e) {
    		if(photo_isloading && photo_isend) return;
    		var scrollHeight = $(this)[0].scrollHeight;
    		var scrollTop = $(this)[0].scrollTop;
    		var elementHight = $(this).height();
    		if(scrollTop + elementHight >= scrollHeight-300){
    			loadallimage(time1,time2);
    		}
    	});
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
    		loadallimage(time1,time2);
    	}
    	

    	function lookphotoinfo(data){
    		var has = false;
    		if(allimagedata){
	    		for (var i = 0; i < allimagedata.length; i++) {
	    			if(allimagedata[i].id == data){
	    				photoindex = allimagedata[i];
	    				has = true;
	    			}
	    		}
    		}
    		if(!has){
    			for (var i = 0; i < thisrecord.length; i++) {
    				if(thisrecord[i].id == data){
    					photoindex = thisrecord[i];
    				}
    			}
    		}
    		var photodata = escape(JSON.stringify(photoindex));
    		document.cookie="recordview="+photodata;
    		window.pageManager.go('recordview');
    	}
    </script>
</script>
<!-- 进度详情 -->
<script id="tpl_recordview" type="text/html">
	<div id="recordview" class="page fullpage">
		<div id="photoinfo"></div>
	</div>
	<script type="text/javascript">
		if(photoindex){
			$('#photoinfo').html(writeinfo(photoindex));
		}else{
			photoindex = getcookie('recordview');
			photoindex = JSON.parse(photoindex);
			$('#photoinfo').html(writeinfo(photoindex));
		}
		function writeinfo(data){
			var photos= data.photo.split(';');
			var gpses= data.gps.split(';');
			var str;
			var str = '<div class="record_info"><div class="recordview"><div class="recordview_row">苗木名称：</div><div class="recordview_row1">'+data.tree_name+'</div></div><div class="recordview"><div class="recordview_row">苗木规格：</div><div class="recordview_row1">'+data.tree_attribute+'</div></div><div class="recordview"><div class="recordview_row">负&nbsp;责&nbsp;&nbsp;人：</div><div class="recordview_row1">'+data.name+'</div></div><div class="recordview"><div class="recordview_row">联系电话：</div><div class="recordview_row1">'+data.phone+'</div></div><div class="recordview"><div class="recordview_row">进&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;度：</div><div class="recordview_row1">'+data.active+'</div></div></div>';
			for (var i = 0; i < photos.length; i++) {
				str += '<div class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="window.pageManager.back()"><div class="addresspng" onclick="lookaddress('+gpses[i]+',\''+data.tree_name+'\')"></div></div>';
			}
			return str;
		}
		function lookaddress(gpsx,gpsy,name){
			window.location = 'http://apis.map.qq.com/uri/v1/marker?marker=coord:'+gpsx+','+gpsy+';title:'+name+'&amp;key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&amp;referer=zhaoshu';
		}
	</script>
</script>
<!-- 统计 -->
<script type="text/html" id="tpl_statistics">
    <div id="statistics" class="page">
		<div class="header">
			<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
		</div>
		<div class="listimage1">
			<div id="listimage1">
			</div>
		</div>
    </div>
    <script type="text/javascript">
    	var $_listimage1 = $('.listimage1');
    		$listimage1 = $('#listimage1');

		$_listimage1.css('height',(height-92)+'px');
		loadstatistics();
		function loadstatistics(){
			$.getJSON('/com/search_map_recordsstate.php', {userid: user.userid}, function(json) {
				if(json){
					dealstatistics(json);
				}else{
					$listimage1.append('<div class="weui-loadmore">没有数据！</div>');
				}
			});
		}
		function dealstatistics(statistics){
			var treenames = [];
			for (var i = 0; i < statistics.length; i++) {
				if(!treenames.length){
					treenames[treenames.length] = statistics[i].tree_name;
					keyvalue[statistics[i].tree_name] = {};
					keyvalue[statistics[i].tree_name][statistics[i].state] = 1;
				}else{
					var has = false;
					for (var j = 0; j < treenames.length; j++) {
						if(statistics[i].tree_name == treenames[j]){
							if(keyvalue[treenames[j]][statistics[i].state]){
								keyvalue[treenames[j]][statistics[i].state] += keyvalue[treenames[j]][statistics[i].state];
							}else{
								keyvalue[treenames[j]][statistics[i].state] = 1;
							}
							has = true;
						}
					}
					if(!has){
						treenames[treenames.length] = statistics[i].tree_name;
						keyvalue[statistics[i].tree_name] = {};
						keyvalue[statistics[i].tree_name][statistics[i].state] = 1;
					} 
				}
			}
			$listimage1.html(dot_statistics_info(keyvalue));
		}
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
	        <div class="relogin">重新登录</div>
	    </div>
    </div>
    <script type="text/javascript">
    	var $mangerself = $('#mangerself'),
    		$selfinfo_name = $('#selfinfo_name'),
    		$relogin = $('.relogin'),
    		$selfinfo_headimg = $('#selfinfo_headimg');

    	$mangerself.css('height',(height-50)+'px');
    	$selfinfo_name.css('width',(0.94*width-110)+'px');
    	$selfinfo_headimg.attr('src','headimg/96/'+user.userid+'.jpg');
    	$selfinfo_name.html(user.name+'<br>'+user.phone);
    	$relogin.click(function() {
    		reLogin();
    	});
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
			    	if(allmapdata){
			    		$('#boy').css('height',(height-192)+'px');
			    		$('#imagetip').show();
			    	}else{
			    		$('#boy').css('height',(height-92)+'px');
			    		$('#imagetip').hide();
			    	}
			    	deletealldom();
			    	overlayOnMap(allmapdata);
		    	}
	    		window.pageManager.go(id);	
		    	break;
    	    case 'projectimage':
    	    	$('#listimage').html('');
    	    	if(!allimagedata){
    		    	loadallimage();
    	    	}else{
    	    		$('#listimage').append(loadstatisticphoto(allimagedata));
    	    	}
    	    	photo_isloading = false;
    	    	photo_isend = false;
        		window.pageManager.go(id);	
    	    	break;
		    default:
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
    setPageManager();
</script>
</body>