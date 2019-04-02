<!DOCTYPE html><html>

<?php 
// include 'jssdk.php';
// $jssdk = new JSSDK();
// $signPackage = $jssdk->GetSignPackage();

$treeid = $_REQUEST['treeid'];


include'com/db2.php';

$db = new db();
$trees = $db->query('select * from v_tree where treeid='.$treeid);
unset($db);


$db = new db('utf8','yangshu','yangshu','g5v5y6k7k83a');
$records = $db->query('select work,photo,project,username,time from v_record where flagid=1001 and photo is not null and city=\'北京市\' order by time desc limit 2');
unset($db);



echo '<script type="text/javascript">var trees=\''.json_encode($trees).'\';</script>';	
echo '<script type="text/javascript">var records=\''.json_encode($records).'\';</script>';	

?>

<head>
	<title>环球主题公园 苗木监管平台</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-s	cale=1, width=device-width" />
	<meta name="format-detection" content="telephone=no"/> 
	<link rel="stylesheet" href="/css/basic_m.css?t=20170304" type="text/css" />
</head>
<body>
<div class="header" style="background: linear-gradient(#005ec7,#0574f0);/* opacity:1; */background: #036ce2 url(/img/huanqiu.png) no-repeat center;width: 100%;height: 60px;background-size: contain;"> </div>
<div id="treeview" style="top: 60px;padding-bottom:0;margin-bottom:50px;"></div>

</body>

</html>
<script src="/js/crypt.js?t=20160930"></script>
<script src="/js/TouchSlide.1.1.js"></script>
<script src="/js/fastclick.min.js?t=20161205"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script type="text/javascript">
var isMine = false;
var dictionary_attributes; // 属性字典
var tree;
var scrollTopTreeView = 0;

function $(o){
	return document.getElementById(o);
}
function valueTrim (value) {
	return value.replace(/(^\s*)|(\s*$)/g,'');
}
function inArray(key, array) {
	for(var k in array){ 
		if (array[k]==key) return true; 	  
	}  
	return false;
}
function stringTrim (str) {
	return str.replace(/(^\s*)|(\s*$)/g,'');
}
function mORcm(m) {
	return m<1 ? m*100+'公分' : m+'米';
}
function mORcmArray(m) {
	if (m) { 
		return m<1 ? {value:m*100,unit:'公分'} : {value:m,unit:'米'};
	} else {
		return {value:0,unit:'米'};
	}
}

var xmlHttp;
var callback;   
function createXMLHttpRequest() {    
	if (window.ActiveXObject) {    
		return new ActiveXObject("Microsoft.XMLHTTP");    
	}else if (window.XMLHttpRequest) {    
		return new XMLHttpRequest();    
	}    
}
function ajax(url, call){
	callback = call;
	xmlHttp = createXMLHttpRequest();    

	xmlHttp.open("GET", url, true);    
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4) {
			if (xmlHttp.status==200 || xmlHttp.status==0) {
				callback(xmlHttp.responseText);
			}
		}
	};
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");    
	xmlHttp.send(null); 
	return true;   
}

function init () {
	trees = trees!='null' ? JSON.parse(trees) : [];
	tree = trees[0];
	
	// document.title = tree.username;

	if (typeof visitor != "undefined") {
		visitor = JSON.parse(visitor);
		isMine = visitor.userid==tree.userid;
	}



    dictionary_attributes = isMine && localStorage.attributes2 ? JSON.parse(localStorage.attributes2) : {};
    // dictionary_attributes = {};
    var dictionary_names = [];
	
	tree.username = '江苏澳洋园林';
	tree.price = tree.state==-2 ? '已下架' : ( !isMine && tree.price==0 ? '议价' : Math.round(tree.price*100)/100);

	if (tree.age) tree.age = parseFloat(tree.age);
	if (tree.dbh) tree.dbh = parseFloat(tree.dbh);
	if (tree.height) tree.height = parseFloat(tree.height);
	if (tree.crownwidth) tree.crownwidth = parseFloat(tree.crownwidth);
	if (tree.branch_point_height) tree.branch_point_height = parseFloat(tree.branch_point_height);

	if (tree.pname) {
		tree.basicname = tree.name.replace(tree.pname, '');
		tree.name = tree.name.replace(tree.pname, "'"+tree.pname+"'");
	} else {
		tree.basicname = tree.name;
	}

	tree.imgpath = decodeImgpath(tree.imgpath);

	if (tree.phototime) {
		tree.phototime = tree.phototime.split(';');
		tree.photogps = tree.photogps.split(';');
	}
}

function showtree () {	
	var i = 0;
	var html = '';
	var attribute_name = {"5":"胸径","6":"地径","7":"盆径","10":"株高","11":"条长","12":"主蔓长","17":"株高"};

	
	var poi = '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+tree.name+'&referer=geo"></a>';

	// var yanghu = '';

	// // if (tree.qrcodeid && tree.qrcodeid.toString()[0]=='3') {
	// if (tree.qrcodeid) {
	// 	// 养护信息
	// 	yanghu += '<a href=\'http://www.yangshuwang.com/m.html?where={"flagid":'+tree.qrcodeid.toString().substring(1,5)+'}\' style="margin-left: 10px;color:green">养护♧</a>';
	// }



	// html += '<div class="header" style="background: linear-gradient(#005ec7,#0574f0);opacity:1;background-image:url(/img/huanqiu.png)"> </div>';
	
	html += '<table style="color:#036ce2; margin-top:0">';

	html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
	if (tree.ldname)
		html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';

	// html += '<tr><td class="field">上车单价：</td><td class="price">'+tree.price+'</td></th>';

	if (tree.qrcodeid) html += '<tr><td class="field">树牌：</td><td>'+tree.qrcodeid+'</td>';
	else html += '<tr><td class="field">编号：</td><td>'+tree.treeid+'</td>';
	
	if (tree.dbh)
		html += '<tr><td class="field">'+(tree.dbh_type?attribute_name[tree.dbh_type]:'胸径')+'：</td><td>'+tree.dbh+'公分</td>';
	if (tree.age)
		html += '<tr><td class="field">苗龄：</td><td>'+tree.age+'年</td>';
	if (tree.crownwidth)
		html += '<tr><td class="field">冠幅：</td><td>'+mORcm(tree.crownwidth)+'</td>';
	if (tree.height)
		html += '<tr><td class="field">'+(tree.height_type?attribute_name[tree.height_type]:'株高')+'：</td><td>'+mORcm(tree.height)+'</td>';
	if (tree.branch_point_height) 
		html += '<tr><td class="field">分枝点高：</td><td>'+mORcm(tree.branch_point_height)+'</td>';
	if (tree.branch_bough_number)
		html += '<tr><td class="field">分枝数：</td><td>'+tree.branch_bough_number+'个</td>';
	if (tree.substrate)
		html += '<tr><td class="field">基质：</td><td>'+tree.substrate+'</td>';
	// if (tree.remark)
	// 	html += '<tr><td class="field">备注：</td><td>'+tree.remark+'</td>';
	
	html += '<tr><td class="field">数量：</td><td>'+tree.count+tree.unit+'</td>';
	html += '<tr><td class="field">苗源地：</td><td>'+tree.province+' '+tree.district+poi+'</td>';
	html += '<tr><td class="field">供应商：</td><td>'+tree.username+'</td>';
	html += '<tr><td class="field">联系电话：</td><td><a style="color:#036ce2" href="tel:'+tree.userphone+'">'+tree.userphone+'</a></td>';
	html += '<tr><td class="field">入圃时间：</td><td>'+tree.time+'</td>';
	html += '<tr><td class="field">片区：</td><td>2</td>';
	html += '<tr><td class="field">承包项：</td><td>5'+poi+'</td>';
	html += '</table>';

	html += '<a id="record" href="http://www.yangshuwang.com/m.html?where={%22flagid%22:1001}" style="display: block; margin-top: 10px;width: 100%;border-radius: 2px;overflow: hidden;height: 148px;">'; 
	html += '<ul style="box-sizing: border-box; padding-left: 8px;width: 100%;background-color: #036ce2;color: #fff;">养护日志：<span id="record_date"></span></ul>';
    // html += '<li style="background-position: center;background-repeat: no-repeat;background-size: cover;width: 48%;height: 120px;background-image:url(http://www.yangshuwang.com/photos/m/ztx1505095856.jpg)"> <p style="position: absolute;margin-top: 95px;width: 46.8%;color: #fff;font-size: 12px;height: 25px;line-height: 12px;overflow: hidden;background-color: rgba(0,0,0,.3);">草坪修剪<br>公主坟-南礼士路 高思佳</p> </li>';
    // html += '<li style="background-position: center;background-repeat: no-repeat;background-size: cover;width: 48%;height: 120px;background-image:url(http://www.yangshuwang.com/photos/m/ztx1505095856.jpg)"> <p style="position: absolute;margin-top: 95px;width: 46.8%;color: #fff;font-size: 12px;height: 25px;line-height: 12px;overflow: hidden;background-color: rgba(0,0,0,.3);">修理剪草机<br>公主坟-南礼士路 高思佳</p> </li>';
    html += '</a>';


	if (tree.video) {
		html += '<video preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
	}


	if (tree.imgpath) {
		for(var v in tree.imgpath) {
			if (tree.phototime && tree.phototime[v])
				html += '<div style="text-align:center;">';
				html += '<a href="javascript:sildeTreeImage('+i+','+v+')"><img src="trees/o2/'+tree.imgpath[v]+'"></a>';

			if (tree.phototime && tree.phototime[v]) 
				html += '<br><a class="poi2" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+ tree.photogps[v] + ';title:'+tree.username+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a><div class="phototime">'+tree.phototime[v]+'</div></div>';
		}
	}
	html += '<p style="color:#ccc;text-align:center;margin-bottom:15px"><a href="http://www.cnzhaoshu.com">找树网提供技术支持</a></p>';

	$('treeview').innerHTML = html;
}

function attribute(tree) {
	var attribute = [];

	tree.dbh && attribute.push('径'+tree.dbh+'公分'); 
	tree.age && attribute.push('龄'+tree.age+'年'); 
	tree.crownwidth && attribute.push('冠'+mORcm(tree.crownwidth)); 
	tree.height && attribute.push('高'+mORcm(tree.height)); 
	tree.branch_point_height && attribute.push('分'+mORcm(tree.branch_point_height)); 
	tree.branch_bough_number && attribute.push('枝'+tree.branch_bough_number+'个'); 

	return attribute.join(' ');
}

function sildeTreeImage(i,j) {
	var tree = trees[i];

	var html = '<div class="bd"><ul>';
	for(var v in tree.imgpath) {
        html += '<li><img onclick="closeImageView()" src="trees/o2/'+tree.imgpath[v]+'"/>';
		html += '<span>'+tree.username+' '+tree.name+' '+tree.province+tree.district+'<br>'+attribute(tree)+'</span>';
		if (typeof visitor != "undefined" && !isMine) 
			html += '<i onclick="addMyTree('+i+')">♡</i>';
		html += '</li>';	
	}
		html += '</ul></div><div class="hd"><ul></ul></div>';

	scrollTopTreeView = document.body.scrollTop;
	$('treeview').style.display = 'none';
	document.body.scrollTop=0;

	var imageview = document.createElement('a');
	imageview.className = 'slideBox';
	imageview.id = 'imageview';
	// imageview.href = 'javascript:closeImageView()';
	imageview.innerHTML = html;
	document.body.appendChild(imageview);


	TouchSlide({ 
		slideCell:"#imageview",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul", 
		effect:"left", 
		defaultIndex: j,
		delayTime:500,
		interTime:3500,
		autoPage:true,//自动分页
		autoPlay:true //自动播放
	});

	var nodes = $('imageview').querySelector(".bd").querySelectorAll("li");
	for (var i = nodes.length - 1; i >= 0; i--) {
		var li = nodes[i];
		li.style.height = document.body.scrollHeight+'px';
		li.style.verticalAlign = 'middle';
	}
}

function closeImageView() {
	$('treeview').style.display = 'block';
	document.body.removeChild($('imageview'));
	document.body.scrollTop = scrollTopTreeView;
}

function loadRecord() {
	records = JSON.parse(records);

	var html = '';
	for(var i in records) {
		var record = records[i];
		var photos = record.photo.split(';');

    	html += '<li style="background-position: center;float:'+(i==0?'right':'left')+';background-repeat: no-repeat;background-size: cover;width: 49%;height: 120px;background-image:url(http://www.yangshuwang.com/photos/m/'+photos[0]+'.jpg)"> <p style="margin-top: 95px;width: 100%; color: #fff;font-size: 12px;height: 25px;line-height: 12px;overflow: hidden;background-color: rgba(0,0,0,.3);">'+record.work+'<br>'+record.project+' '+record.username+'</p> </li>';
	}

	$('record').innerHTML += html;

	$('record_date').innerHTML = records[0].time.split(' ')[0];
	
}


init();
showtree();
loadRecord(); // 加载养护日志


// 微信分享

function getImageUrl(){
    return 'http://www.cnzhaoshu.com/trees/s2/'+tree.imgpath[0];
}
function getLink(type){
    return 'http://www.cnzhaoshu.com/t.php?treeid='+tree.treeid;
} 

function getTitle(isTimeline) {
    return '环球主题公园苗木监管平台';
}

function getDescription (isTimeline) {
    return '2区5承包项,'+tree.username+','+tree.name;
}

function prepareShare () {
    wx.onMenuShareAppMessage({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(0),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareTimeline({
      title: getTitle(true) +','+ getDescription(true),
      link: getLink(1),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareQQ({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(2),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareWeibo({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(3),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareQZone({
      title: getTitle(),
      desc: getDescription(),
      link: getLink(4),
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
            'previewImage'
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
      ajax('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function(res) {
          setWechatJSSDK(JSON.parse(res));
      });
}
loadWechatJSSDK();

// 

</script>
