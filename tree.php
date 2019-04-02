<!DOCTYPE html><html>
<?php 
include 'com/wechat_login.php';
wechatLogin('m2');

include 'jssdk.php';
$jssdk = new JSSDK();
$signPackage = $jssdk->GetSignPackage();



$treeid = $_REQUEST['treeid'];

if ($treeid=='67029') {
	header('Location: http://www.cnzhaoshu.com/t.php?treeid='.$treeid);
} else {
	include_once 'com/db2.php';

	$db = new db();
	$trees = $db->query('select * from v_tree where treeid='.$treeid);
	unset($db);

	echo '<script type="text/javascript">var trees=\''.json_encode($trees).'\';</script>';	
}

?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
	<meta name="format-detection" content="telephone=no"/> 
	<link rel="stylesheet" href="/css/basic_m.css?t=20170304" type="text/css" />
</head>
<body>
<div id="treeview"></div>
</body></html>
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
	
	document.title = tree.username;

	if (typeof visitor != "undefined") {
		visitor = JSON.parse(visitor);
		isMine = visitor.userid==tree.userid;
	}



    dictionary_attributes = isMine && localStorage.attributes2 ? JSON.parse(localStorage.attributes2) : {};
    // dictionary_attributes = {};
    var dictionary_names = [];
	
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

	if (!tree.unit) tree.unit = '株';

	if (isMine && !dictionary_attributes[tree.basicname] && !inArray(tree.basicname, dictionary_names)) {
		dictionary_names.push('"'+tree.basicname+'"'); 
	}

	// 检查苗木字典
	if (isMine && dictionary_names.length>0) {
		ajax('com/dictionary_attribute_bynames.php?names='+dictionary_names.join(','),function(txt){
			var attributes = JSON.parse(txt);
			for(var key in attributes){ 
				var attribute = attributes[key];
				dictionary_attributes[attribute.name] = attribute.attribute;
			}

			localStorage.attributes2 = JSON.stringify(dictionary_attributes);			
		});
	}	
}

function showtree () {	
	var i = 0;
	var html = '';
	var attribute_name = {"5":"胸径","6":"地径","7":"盆径","10":"株高","11":"条长","12":"主蔓长","17":"株高"};

	if (isMine) {
		var attribute_tree = dictionary_attributes ? dictionary_attributes[tree.basicname] : null;
		if (attribute_tree) attribute_tree = attribute_tree.split(',');
		
		// 我的树，可以修改属性规格、价格、数量						
		html += '<div class="header"><a class="back" href="javascript:gotoShop('+tree.userid+')">苗店</a></div>';
		
		html += '<table>';

		html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
		if (tree.ldname)
			html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';
		if (tree.invoice) 
			html += '<img class="fapiao" src="/img/fapiao.png?t=2">';

		if (tree.qrcodeid) html += '<tr><td class="field">树牌：</td><td>'+tree.qrcodeid+'</td>';
		else html += '<tr><td class="field">编号：</td><td>'+tree.treeid+'</td>';
		
		if (tree.dbh || ( attribute_tree && inArray(tree.dbh_type,attribute_tree) ))
			html += '<tr><td class="field">'+(tree.dbh_type?attribute_name[tree.dbh_type]:'胸径')+'：</td><td><input id="dbh" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过100" value="'+(tree.dbh||0)+'"/>公分</td>';
		if (tree.age || ( attribute_tree && inArray(8,attribute_tree) ))
			html += '<tr><td class="field">苗龄：</td><td><input id="age" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过1000" value="'+(tree.age||0)+'"/>年</td>';
		if (tree.crownwidth || ( attribute_tree && inArray(9,attribute_tree) )) {
			var v = mORcmArray(tree.crownwidth);
			html += '<tr><td class="field">冠幅：</td><td><input id="crownwidth" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过20" value="'+v.value+'"/><span>'+v.unit+'</span></td>';
		}
		if (tree.height || ( attribute_tree && inArray(tree.height_type,attribute_tree) )) {
			var v = mORcmArray(tree.height);
			html += '<tr><td class="field">'+(tree.height_type?attribute_name[tree.height_type]:'株高')+'：</td><td><input id="height" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过20" value="'+v.value+'"/><span>'+v.unit+'</span></td>';
		}
		if (tree.branch_point_height || ( attribute_tree && inArray(13,attribute_tree) )) {
			var v = mORcmArray(tree.branch_point_height);
			html += '<tr><td class="field">分枝点高：</td><td><input id="branch_point_height" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过20" value="'+v.value+'"/><span>'+v.unit+'</span></td>';
		}
		if (tree.branch_bough_number || ( attribute_tree && inArray(14,attribute_tree) ))
			html += '<tr><td class="field">分枝数：</td><td><input id="branch_bough_number" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"不超过10" value="'+(tree.branch_bough_number||0)+'"/>个</td>';

		
		html += '<tr><td class="field">上车单价：</td><td><input id="price" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"大于0" value="'+tree.price+'"/>元</td></th>';
		html += '<tr><td class="field">数量：</td><td><input id="count" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')" type="text" placeholder＝"大于0小于10万" value="'+tree.count+'"/>'+tree.unit+'</td>';
		if (tree.substrate || ( attribute_tree && inArray(19,attribute_tree) ))
			html += '<tr><td class="field">基质：</td><td><textarea id="substrate" rows="1" placeholder="最多10个字">'+(tree.substrate||'')+'</textarea></td>';		
		html += '<tr><td class="field">备注：</td><td><textarea id="remark" rows="3" placeholder="最多30个字">'+(tree.remark||'')+'</textarea></td>';
		html += '</table>';

		html += '<button onclick="updatetree('+i+')">修改苗木信息</button>';
	} else {
		var renzheng = '';
		switch (tree.state) {
			case 2: renzheng = '<span class="renzheng">已认证</span>'; break;
			case 3: renzheng = '<span class="qjd">旗舰店</span>'; break;
			case 4: renzheng = '<span class="qjd">单品王</span>'; break;
		}
		var collections = tree.collections>0 ? '<span class="cangmi">藏米'+tree.collections+'</span>' : '';
		// var poi = '<a class="poi" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a>';

		var poi = '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+tree.name+';addr:'+tree.address+'&referer=geo"></a>';

		var yanghu = '';

		if (tree.qrcodeid && tree.qrcodeid.toString()[0]=='3') {
			// 养护信息
			yanghu += '<a href=\'http://www.yangshuwang.com/m.html?where={"flagid":'+tree.qrcodeid.toString().substring(1,5)+'}\' style="margin-left: 10px;color:green">养护♧</a>';
		}



		html += '<div class="header"><a class="back" href="javascript:gotoShop('+tree.shopid+')">苗店</a>'+yanghu+poi+renzheng+collections+'</div>';
		
		html += '<table>';

		html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
		if (tree.ldname)
			html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';

		html += '<tr><td class="field">上车单价：</td><td class="price">'+tree.price+'</td></th>';

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
		if (tree.remark)
			html += '<tr><td class="field">备注：</td><td>'+tree.remark+'</td>';
		
		html += '<tr><td class="field">数量：</td><td>'+tree.count+tree.unit+'</td>';
		html += '<tr><td class="field">位置：</td><td>'+tree.province+' '+tree.district+'</td>';
		html += '<tr><td class="field">苗商：</td><td>'+tree.username+'</td>';
		html += '<tr><td class="field">联系电话：</td><td><a href="tel:'+tree.userphone+'">'+tree.userphone+'</a></td>';
		html += '<tr><td class="field">发布时间：</td><td>'+tree.time+'</td>';
		html += '</table>';
	}

	if (tree.video) {
		html += '<video preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
	}


	if (tree.imgpath) {
		for(var v in tree.imgpath) {
			if (tree.phototime && tree.phototime[v])
				html += '<div style="text-align:center;">';
				html += '<a href="javascript:sildeTreeImage('+i+','+v+')"><img src="trees/o2/'+tree.imgpath[v]+'"></a>';

			if (tree.phototime && tree.phototime[v]) 
				html += '<br><a class="poi2" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+ tree.photogps[v] + ';title:'+tree.username+tree.name+';addr:'+tree.address+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a><div class="phototime">'+tree.phototime[v]+'</div></div>';
		}
	}

	if (typeof visitor != "undefined"){
		// 有当前用户，微信回调，显示收藏按钮
		if (!isMine) {
			html += '<a href="/goodsinfo.php?treeid='+tree.treeid+'"><button>找树宝 下单</button></a>';
			html += '<button onclick="addMyTree('+i+')">加入找树车</button>';
			html += '<button onclick="gotoShop('+tree.shopid+')">进入他的苗店</button>';
		}

		if (visitor.istrader) {
			// 当前用户有苗木认证权限，认证苗木
			if (tree.state==1) {
				html += '<button onclick="authenticateTree('+i+')">单品认证</button>';
			}else if (tree.state==2 || tree.state==4) {
				html += '<button onclick="decertificationTree('+i+')">取消认证</button>';
			}
		}
	}

	if (isMine){
		html += '<button onclick="toptree('+i+')">置顶</button>';
		if (tree.top) {
			html += '<button onclick="untoptree('+i+')">取消置顶</button>';
		}
		if (tree.state>0){
			html += '<button onclick="offshelvestree('+i+')">下架</button>';
		}if (tree.state==-2)	{
			html += '<button onclick="onshelvestree('+i+')">上架</button>';
		}

		html += '<button onclick="deletetree('+i+')">删除苗木</button>';
	}

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
		html += '<span>'+tree.name+'¥'+tree.price+' '+tree.count+tree.unit+' '+tree.province+tree.district+'<br>'+attribute(tree)+'</span>';
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

function gotoShop (shopid) {
	window.location = 'shop.php?userid='+shopid;
}

function deletetree (i) {
	if (confirm("确定要删除本条数据吗？")) {
		ajax('com/deletetree.php?treeid='+tree.treeid, function(){
			alert('已经删除');
		});
	}
}
function updatetree (i) {
	var data = {};

	var price = parseFloat($('price').value);

	if (visitor.role==101) {
		// 旗舰店，可以为0
		if ( (!price && price!=0) || price<0) {
			alert('价格：必须大于0');
			return;
		}
	} else {
		if (!price || price<=0) {
			alert('价格：必须大于0');
			return;
		}
	}
	if (tree.price != price)
		data.price = $('price').value = tree.price = price;

	var count = parseInt($('count').value);
	if (!count || count<=0 || count>100000) {
		alert('数量：只能为 1－10万 的整数');
		return;
	}
	if (tree.count != count)
		data.count = $('count').value = tree.count = count;

	if ($('dbh')) {
		var dbh = parseFloat($('dbh').value);
		if (isNaN(dbh) || dbh<0 || dbh>100) {
			alert( (tree.dbh_type?attribute_name[tree.dbh_type]:'胸径') + '：不小于0，不超过100');
			return;
		}
		if (tree.dbh != dbh)
			data.dbh = $('dbh').value = tree.dbh = dbh;
	}

	if ($('crownwidth')) {
		var crownwidth = parseFloat($('crownwidth').value);
		var max = $('crownwidth').nextSibling.innerHTML=='公分' ? 500 : 20;

		if (isNaN(crownwidth) || crownwidth<0 || crownwidth>max) {
			alert('冠幅：不小于0，不超过'+max);
			return;
		}

		if ($('crownwidth').nextSibling.innerHTML=='公分') crownwidth = crownwidth/100;
		if (tree.crownwidth != crownwidth) 
			data.crownwidth = tree.crownwidth = crownwidth;
	}

	if ($('height')) {
		var height = parseFloat($('height').value);
		var max = $('height').nextSibling.innerHTML=='公分' ? 500 : 20;

		if (isNaN(height) || height<0 || height>max) {
			alert( (tree.height_type?attribute_name[tree.height_type]:'株高') + '：不小于0，不超过2'+max);
			return;
		}
		if ($('height').nextSibling.innerHTML=='公分') height = height/100;
		if (tree.height != height) 
			data.height = tree.height = height;
	}

	if ($('age')) {
		var age = parseFloat($('age').value);
		if (isNaN(age) || age<0 || age>1000) {
			alert('苗龄：不小于0，不超过1000');
			return;
		}
		if (tree.age != age) 
			data.age = $('age').value = tree.age = age;
	}

	if ($('branch_point_height')) {
		var branch_point_height = parseFloat($('branch_point_height').value);
		var max = $('branch_point_height').nextSibling.innerHTML=='公分' ? 500 : 20;

		if (isNaN(branch_point_height) || branch_point_height<0 || branch_point_height>max) {
			alert('分枝点高：不小于0，不超过'+max);
			return;
		}
		
		if ($('branch_point_height').nextSibling.innerHTML=='公分') branch_point_height = branch_point_height/100;
		if (tree.branch_point_height != branch_point_height) 
			data.branch_point_height = tree.branch_point_height = branch_point_height;
	}

	if ($('branch_bough_number')) {
		var branch_bough_number = parseFloat($('branch_bough_number').value);
		if (isNaN(branch_bough_number) || branch_bough_number<0 || branch_bough_number>10) {
			alert('分枝数：不小于0，不超过10');
			return;
		}
		if (tree.branch_bough_number != branch_bough_number) 
			data.branch_bough_number = $('branch_bough_number').value = tree.branch_bough_number = branch_bough_number;
	}

	if ($('substrate')) {
		var substrate = stringTrim($('substrate').value);
		if ((substrate != tree.substrate) && (tree.substrate || substrate)) {
			data.substrate = $('substrate').value = tree.substrate = substrate.substring(0,10);
		}
	}
	if ($('remark')) {
		var remark = stringTrim($('remark').value);
		if ((remark != tree.remark) && (tree.remark || remark)) {
			data.remark = $('remark').value = tree.remark = remark.substring(0,30);;
		}
	}
	
	var data = JSON.stringify(data);
	if (data.length>2) {
		ajax('com/updatetree.php?treeid='+tree.treeid+'&data='+data, function () {
			alert('修改成功！');
		});
	}
}

function addMyTree(i){
	var isOwn = isMine ? '&isOwn=1' : '';	
	ajax('com/addmytree.php?userid='+visitor.userid+'&shopid='+tree.shopid+'&treeid='+tree.treeid+isOwn ,function(){
    	alert('加入成功！');	
	});
}

// 认证树
function authenticateTree (i) {
	trees[i].state = 2;
	ajax('com/authenticatetree.php?userid='+visitor.userid+'&state=2&treeid='+trees[i].treeid,function(){
    	showtree();
    	alert('认证成功！');

	});	
}
// 取消认证树
function decertificationTree (i) {
	trees[i].state = 1;
	ajax('com/authenticatetree.php?userid='+visitor.userid+'&state=1&treeid='+trees[i].treeid,function(){
    	showtree();
    	alert('已取消认证！');	
	});
}

function toptree (i) {
	// 调整顺序	
	trees[i].top = true;
	ajax('com/toptree.php?type=top&treeid='+trees[i].treeid,function () {
		showtree();
		alert('已经置顶');
	});
}

function untoptree (i) {
	trees[i].top = false;
	ajax('com/toptree.php?type=untop&treeid='+trees[i].treeid,function () {
		showtree();
		alert('已经取消置顶');
	});
}

function offshelvestree(i) {
	trees[i].state = -2;
	ajax('com/shelvestree.php?treeid='+trees[i].treeid+'&state=-2',function () {
		showtree();
    	alert('已下架，只有自己可见');			
	});
}
function onshelvestree(i) {
	var state = visitor.isrenzheng ? 2 : 1;
	trees[i].state = state;

	ajax('com/shelvestree.php?treeid='+trees[i].treeid+'&state='+state,function () {
 		showtree();
   		alert('已上架，搜索可见');			
	});
}

init();
showtree();

// 自己访问自己不统计
if (!isMine) {
	ajax('com/accesstree.php?type=0&treeid='+trees[0].treeid+'&shopid='+trees[0].shopid, function(){});	
}


  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo'
    ]
  });


function getTitle () {
	return tree.province+' '+tree.district+' '+tree.name + ' '+tree.price+'元';
}
function getImageUrl(){
	return 'http://cnzhaoshu.com/trees/s2/' + tree.imgpath[0];
}

function getLink(){
	return window.location.href;
} 

function getDescription () {
	var attribute = [];
	tree.dbh && attribute.push('径'+tree.dbh+'公分'); 
	tree.age && attribute.push('龄'+tree.age+'年'); 
	tree.crownwidth && attribute.push('冠'+tree.crownwidth+'米'); 
	tree.height && attribute.push('高'+tree.height+'米'); 
	tree.branch_point_height && attribute.push('分'+tree.branch_point_height+'米'); 
	tree.branch_bough_number && attribute.push('枝'+tree.branch_bough_number+'个'); 

	return attribute.join(' ');
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

wx.ready(function () {
    prepareShare();
});
</script>
