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
			width:100%;
			height:39px;
			position: relative;
			background-color: #fff;
			top:0;
		}
		.allproject{
			width:35%;
			float: left;
			line-height: 40px;
			color:#666;
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
			.projectleftbox{
				width:100%;
				float: left;
				overflow-y: scroll;
				background: #ddd;
				-webkit-overflow-scrolling: touch;
			}
			.createnew{
				width: 100%;
				height: 35px;
				line-height: 35px;
				float: left;
				text-align: center;
				color: #fff;
				font-size: 18px;
				background: #aaa;
			}
			.findalltree{
				width: 100%;
				height: 33px;
				float: left;
				text-align: center;
				line-height: 33px;
				color: #fff;
				background: #ccc;
			}
			.findallproject{
				width: 100%;
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
				width: 100%;
				height: 35px;
				line-height: 35px;
				float: right;
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
		/*主页*/
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
			#boy{
				width:100%;
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
				width: 30%;
			    float: left;
			    height: 40px;
			    line-height: 40px;
			    text-align: center;
			    font-size: 13px;
			}
			.listimage,.listimage1{
				width: 100%;
				position: relative;
			}
			#listimage,#listimage1{
				width: 100%;
				float: left;
				height: 100%;
				overflow-y: auto;
				-webkit-overflow-scrolling: touch;
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
			.btng{
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
			.qrcodeimages{
				background: #eee;
				width:100%;
				left:0;
				top:0;
				z-index: 3000;
				position: fixed;
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
        	<div class="projectname_row1">
        		<span>{{=datetime(it[i].create_time)}}</span>
        		<span>{{=(it[i].switch == 1) ? '未完成' : '完成'}}</span>
        	</div>
        	<div class="projectname_row2">{{=it[i].name}}</div>
        	<div class="projectname_row3">{{=it[i].address}}</div>
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
    <li data-id="{{=it.id}}" style="background-image:url({{=it.tip.image}})" data-order_id="{{=it.map_order_id}}">
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
	var height = $(window).height();
	var width = $(window).width();
	var projectlist,mymap,treelist,map_data,thisrecord,allimagedata,photoindex,isloadrecords_id,statisticdata;
	var photo_isloading = false,photo_isend = false;
	var hasthisrecord = false;

	// 地图上的点
	var overlay = {};
	var imagetip = {};
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
	function lookaddress(gpsx,gpsy,name){
		window.location = 'http://apis.map.qq.com/uri/v1/marker?marker=coord:'+gpsx+','+gpsy+';title:'+name+'&amp;key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&amp;referer=zhaoshu';
	}

	// 进度
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
		function lookthisrecord(id,a){
			$.getJSON('/com/search_map_order_record.php',{id:id},function(json){
				if(json){
					thisrecord = json;
					$('#listimage').html(loadstatisticphoto(json));
				}else{
					$('#listimage').html('<div class="weui-loadmore">没有数据！</div>');
				}
				hasthisrecord = true;
				if(a) window.pageManager.go('projectimage');	
			})
		}
		function lookthisrecords(id,a,b){
			if(photo_isloading) return;
			photo_isloading = true;
			var limit = $('#listimage .photobox').length + ',20';
			$.getJSON('/com/search_map_order_records.php',{id:id,limit:limit,begin:a,end:b},function(json){
				if(json){
					$('#listimage').append(loadstatisticphoto(json));
					photo_isloading = false;
				}else{
					$('#listimage').append('<div class="weui-loadmore">没有数据！</div>');
					photo_isend = true;
				}
			})
		}
		function loadallimage(state,a,b){
			if(photo_isloading) return;
			photo_isloading = true;
			var limit = $('#listimage .photobox').length + ',20';
			$.getJSON('/com/search_time_images.php', {userid: user.userid,limit:limit,begin:a,end:b}, function(json) {
				if(!allimagedata) allimagedata = [];
				if(json){
					for (var i = 0; i < json.length; i++) {
						allimagedata[allimagedata.length] = json[i];
					}
					photo_isloading = false;
					if(!state) $('#listimage').append(loadstatisticphoto(json));
				}else{
					photo_isend = true;
					if(!state) $('#listimage').append('<div class="weui-loadmore">没有数据！</div>');
				}
				if(state) changeover('projectimage');
			});
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
    		$('#photoinfo').html(writeinfo(photoindex));
    		window.pageManager.go('recordview');
    	}
    	function writeinfo(data){
    		var photos= data.photo.split(';');
    		var gpses= data.gps.split(';');
    		var str;
    		var str = '<div class="record_info"><div class="recordview"><div class="recordview_row">苗木名称：</div><div class="recordview_row1">'+data.tree_name+'</div></div><div class="recordview"><div class="recordview_row">苗木规格：</div><div class="recordview_row1">'+data.tree_attribute+'</div></div><div class="recordview"><div class="recordview_row">负&nbsp;&nbsp;责&nbsp;&nbsp;人：</div><div class="recordview_row1">'+data.name+'</div></div><div class="recordview"><div class="recordview_row">联系电话：</div><div class="recordview_row1"><a href="tel:'+data.phone+'">'+data.phone+'</a></div></div><div class="recordview"><div class="recordview_row">进&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;度：</div><div class="recordview_row1">'+data.active+'</div></div></div>';
    		for (var i = 0; i < photos.length; i++) {
    			if(gpses[i]){
    				str += '<div class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="window.pageManager.back()"><div class="addresspng" onclick="lookaddress('+gpses[i]+',\''+data.tree_name+'\')"></div></div>';
    			}else{
    				str += '<div class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="window.pageManager.back()"></div>';
    			}
    		}
    		return str;
    	} 

	// 地图
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
		    	    imagetipX = 0;
		    	    $('#imagetip').css({"transform":"translateX(0)","-webkit-transform":"translateX(0)"});
		    	    if ((typeof activeTipid != 'undefined') && (activeTipid != mapdata[0].id)) {
		    	        if (overlay[activeTipid]) {
		    	            $(overlay[activeTipid].div).removeClass('active');
		    	        }
		    	    }
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
		    	var newdata = [];
		    	var projectdata = [];
		    	for (var i = 0; i < projectlist.length; i++) {
		    		if(map_id == projectlist[i].id){
		    			projectdata[0] = projectlist[i]
		    		}	    		
		    	}
		    	for (var i = 0; i < map_data.length; i++) {
		    		if(map_data[i].map_id == map_id){
		    			newdata[newdata.length] = map_data[i];
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
				overlayOnMap(newdata,projectdata);
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

	// 下图拖拽
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
		function getImagetipIndexByID(id) {
		    id = id.toString();
		    var $imagetips = $('#imagetip').children();
		    for (var i = 0, len = $imagetips.length; i < len; i++) {
		        if ($imagetips.eq(i).data('id') == id) {
		            return i;
		        } 
		    }
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
		            if(gpses[0]){
		            	gpses = gpses[0].split(',');
			            var gps_x = gpses[0];
			            var gps_y = gpses[1];
		            }else{
	    	        	var nogps;
	    		        for (var i = 0; i < gpses.length; i++) {
	    		        	if(gpses[i]){
	    		        		nogps =  gpses[i];
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
		            }
		            	

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

	// 微信
		function getTitle () {
		    return '找树网交易监管平台';
		}
		function getImageUrl(){
		    return 'http://cnzhaoshu.com/img/hall.jpg';
		}
		function getLink(){
		    return 'http://cnzhaoshu.com/maps.php';
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


	$('#container').on('click','.mysearch',function(){
		changeover(getActiveMenu());
	})
	$('#container').on('click','.searchallproject',function(){
		hasthisrecord = false;
		window.pageManager.go('showallproject');
	})



</script>

<!-- 全部项目 -->
<script type="text/html" id="tpl_showallproject">
    <div class="page" id="mysearch">
    	<div class="header">
    		<div class="allproject mysearch">全部项目<i class="iconfont icon-select"></i></div>
    	</div>
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
    	    	<div class="createnewtree">绑定二维码</div>
		    </div>
	    </div>
    </div>
    <script type="text/javascript">
    	$('.projectleftbox').css('height',(height-158)+'px');
    	$('.projectrightbox').css('height',(height-158)+'px');

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

    	$('#mysearch').on('click','.createnewtree',function(){
    		var map_id = $('#left_project .plon').attr('mapid');
			wx.scanQRCode({
				needResult: 1,
				desc: 'scanQRCode desc',
				success: function (res) {
					var id = res.resultStr.split('=')[1];
					$.post('/com/insert_map_order_qrcode.php', {userid: user.userid,qrcode:id,mapid:map_id}, function(result) {
						if(result){
							if(result > 0){
								$('#alert').html('二维码绑定成功！');
							}else if(result == '-1'){
								$('#alert').html('二维码已经被占用！');
							}else{
								$('#alert').html('二维码已经被别的用户占用！');
							}
						}else{
							$('#alert').html('绑定失败,请重新绑定！');
						}
						$('#alerts').show();
						setTimeout(function (){
							$('#alerts').hide();
						},1500)
					});
				}
			});
    	})
    	$('#left_project').on('click','.projectname',function(){
    		var $this = $(this);
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
				    	if(newdata.length){
				    		$('#boy').css('height',(height-196)+'px');
				    		$('#imagetip').show();
				    	}else{
				    		$('#boy').css('height',(height-96)+'px');
				    		$('#imagetip').hide();
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
    <div id="home" class="page">
    	<div class="header">
    		<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
    	</div>
	    <div id="boy">
	    </div>
	    <div id="imagetip" class="imagetip"></div>
    </div>
    <script type="text/javascript">
    	var $imagetip = $('#imagetip');
    	initMap();
    	$('#boy').css('height',(height-196)+'px');
    	$imagetip.show();

    	$.getJSON('/com/search_map_recordlist.php', {userid: user.userid}, function(json) {
    		if(json){
    			map_data = json;
    			loadprojectlist();
    		}
    	});

    	$imagetip.on('click','li',function(){
    		var id = $(this).data('order_id');
    		lookthisrecord(id,true);
    	})

    	$imagetip.on('touchstart', onImagetipTouchstart);
    </script>
</script>

<!-- 进度 -->
<script type="text/html" id="tpl_projectimage">
    <div id="projectimage" class="page">
		<div class="header">
			<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
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
    	$_listimage.css('height',(height-92)+'px');
    	
	    if(hasthisrecord){
	    	$listimage.html(loadstatisticphoto(thisrecord));
	    }else if(!allimagedata){
	    	loadallimage(true);
	    }else{
	    	$listimage.html(loadstatisticphoto(allimagedata));
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
	    	if(photo_isloading && photo_isend) return;
	    	var scrollHeight = $(this)[0].scrollHeight;
	    	var scrollTop = $(this)[0].scrollTop;
	    	var elementHight = $(this).height();
	    	if(scrollTop + elementHight >= scrollHeight-300){
	    		if(isloadrecords_id){
	    			lookthisrecords(isloadrecords_id);
	    		}else{
	    			loadallimage(false,time1,time2);
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
	    		loadallimage(false,time1,time2);
	    	}
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
	</script>
</script>

<!-- 统计 -->
<script type="text/html" id="tpl_statistics">
    <div id="statistics" class="page">
		<div class="header">
			<div class="allproject searchallproject">全部项目<i class="iconfont icon-select"></i></div>
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
    <div class="page">
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
    	$('#mangerself').css('height',(height-50)+'px');
    	$('#selfinfo_name').css('width',(0.94*width-110)+'px');
  
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
    	$('.create_newproject_title').css('height',(height-50)+'px');
    	$('#map_address').css('height',(height-90)+'px');
    	$('#address_map').css('height',(height-75)+'px');
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
    			    	window.pageManager.back()
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
		    	$('#left_project').html(dot_projectname(projectlist));
		    	$('#right_tree').html(dot_treelistinfobuy(treelist[projectlist[0].id]));
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