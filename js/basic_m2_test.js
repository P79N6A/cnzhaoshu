var scrollTop;
var scrollTopTreeView;
var isMine = false;
var platformid;
var flagid;
var share;
var dictionary_attributes; // 属性字典
var attribute_name = {"5":"胸径","6":"地径","7":"盆径","10":"株高","11":"条长","12":"主蔓长","17":"株高"};


function $(o){
	return document.getElementById(o);
}
function urlRequest(name)
{
	var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
    return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
}
function getcookie(name){//获取指定名称的cookie的值
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == name) return unescape(temp[1]);
	} 
}
function loadJS (url) {
    var script = document.createElement('script');
    script.src = url;
    document.body.appendChild(script);
}
function showTime(time_str) {
	time_str = time_str.replace(/-/g,"/"); 
	var time = new Date(time_str);
	var now = new Date();
	var t = now.getTime() - time.getTime(); //ms

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
function inArray(key, array) {
	for(var k in array){ 
		if (array[k]==key) return true; 	  
	}  
	return false;
}

var ajax = function(url, call){
	var callback = call;
	var xmlHttp = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP")
									   : new XMLHttpRequest();    

	xmlHttp.open("GET", url, true);    
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4) {
			if (xmlHttp.status==200 || xmlHttp.status==0) {
				if (callback) callback(xmlHttp.responseText);
			}
		}
	};
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");    
	xmlHttp.send(null); 
	return true;   
}

function initFromWhere(argument) {
	platformid = urlRequest('platformid');
	var where = urlRequest('where')
	if (where) {
		try{
			where = JSON.parse(where);
			if (where.platformid) platformid = where.platformid;
			if (where.flagid) flagid = where.flagid;
			if (where.share) share = where.share;
		}catch(e){}
	}
}

function init () {
	user = JSON.parse(user);
	if (!user.name) user.name = '无名大咖';
	if (!user.phone) user.phone = '未注册手机';

	if (typeof visitor != "undefined") {
		visitor = JSON.parse(visitor);
		isMine = visitor.userid==user.userid;
	}

	trees = trees!='null' ? JSON.parse(trees) : [];

	var treecount = 0;
	for(var i in trees) {
		treecount += trees[i].count*1; 
	}



	var address = user.name.length<=5 && trees.length>0 ? trees[0].province + trees[0].district : '';

	document.title = window.isShop ? address + user.name : user.name + '的找树车';

	// var poi = trees.length>0 ? '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+trees[0].x+','+trees[0].y+';title:'+user.name+'&referer=geo"> </a>' : '';
	
	var html = '';
	if (isMine) {
		var type = window.isShop ? '我的苗店' : '我的找树车';
		html += type+'<br><a href="tel:' + user.phone + '">☏&nbsp;&nbsp;'+user.phone+'</a><br><i id="total">' + trees.length + '项' + treecount + '株</i>';
	}else{
		var type = window.isShop ? '' : '的找树车';
		// var titleNameCount = Math.floor((window.screen.width-20)/24);
		// if (state==2) titleNameCount -= 4;
		var name = window.isShop ? user.name : user.name + '的找树车';
		html += name.length>Math.floor(window.screen.width/24)
		        ? '<p style="font-size:'+ Math.floor(window.screen.width/name.length) +'px">'+name+'</p>'
		        : '<p>'+name+'</p>';
		html += '<a href="tel:' + user.phone + '">☏'+user.phone+'</a><br><i id="total">' + trees.length + '项' + treecount + '株</i>';
	}
	if (trees.length>0)	{
		// html += '<a class="poi" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+trees[0].x+','+trees[0].y+';title:'+user.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a>';
		html += '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+trees[0].x+','+trees[0].y+';title:'+user.name+'&referer=geo"> </a>';
	}

	// 导出excel
	html += window.isShop ? '<a class="excel" href="excel.shop.php?userid=' + user.userid + '"></a>'
				  	      : '<a class="excel" href="excel.cart.php?userid=' + user.userid + '"></a>';
	html += '<a class="headimg" href="javascript:sildeAllImage()"><img src="headimg/96/'+(window.isShop?user.shopid:user.userid)+'.jpg?t=' + new Date().getTime() + '"></a>';

	$('title').innerHTML = html;

	// user video
	if (window.isShop && user.video) {
		var div = document.createElement('div');
		// div.innerHTML = '<div id="playcount">▷' + user.playcount + ' 第' + videoOrder + '名</div>'; 
		// div.innerHTML = '<video onplay="playVideo()" preload="none" controls="controls" poster="/trees/video/'+user.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+user.video+'.mp4" type="video/mp4" /></video>';
		div.innerHTML = '<video preload="none" controls="controls" poster="/trees/video/'+user.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+user.video+'.mp4" type="video/mp4" /></video>';
		document.body.insertBefore(div,$('title'));
	}
	

	// 公司介绍
	if ( window.isShop && user.introduction ) addUserIntroduction();
	delete user.introduction;	

	setTimeout(addTrees,50);

	// 苗店访客记录
	if (window.isShop && window.visitor && visitor.shopid!=user.shopid) {
		var url = 'com/visitshop.php?shopid='+user.shopid+'&userid='+user.userid+'&visitorid='+visitor.userid;
		if (flagid) url += '&flagid=' + flagid;
		if (typeof share != 'undefined') url += '&type=' + share;
		ajax(url);
	}
}

function addUserIntroduction () {
	var ul = document.createElement('ul');
	ul.innerHTML = website_filter(user.introduction);
	$('treelist').appendChild(ul);
}

function addTrees (reload) {
    dictionary_attributes = isMine && localStorage.attributes2 ? JSON.parse(localStorage.attributes2) : {};
    var dictionary_names = [];

	for(var i in trees) {
		var tree = trees[i];


		if (!reload) {
			tree.basicname = tree.name;
			if (tree.pname) {
				tree.name = "'"+tree.pname+"'" + tree.name;
			}

			if (tree.age) tree.age = parseFloat(tree.age);
			if (tree.dbh) tree.dbh = parseFloat(tree.dbh);
			if (tree.height) tree.height = parseFloat(tree.height);
			if (tree.crownwidth) tree.crownwidth = parseFloat(tree.crownwidth);
			if (tree.branch_point_height) tree.branch_point_height = parseFloat(tree.branch_point_height);

			tree.price = Math.round(tree.price*100)/100;
			if (!isMine && tree.price==0) tree.price = '议价';

			if (!tree.unit) tree.unit = '株';

			tree.imgpath = decodeImgpath(tree.imgpath);

			if (tree.phototime) {
				tree.phototime = tree.phototime.split(';');
				tree.photogps = tree.photogps.split(';');
			}	

			if (window.isShop) {
				tree.username = user.name;
				tree.phone = user.phone;
			}	

			if (isMine && !dictionary_attributes[tree.basicname] && !inArray(tree.basicname, dictionary_names)) {
				dictionary_names.push('"'+tree.basicname+'"'); 
			}
		}


		var li = document.createElement('li');
		li.innerHTML = treeInnerHTML(tree, i);
		$('treelist').appendChild(li);
	}

	try{prepareShare()}catch(e){}		

	// 检查苗木字典
	if (isMine && dictionary_names.length>0) {
		ajax('com/dictionary_attribute_bynames.php?names='+dictionary_names.join(','),function(txt){
			var attributes = JSON.parse(txt);
			for(var key in attributes){ 
				var attribute = attributes[key];
				dictionary_attributes[attribute.name] = attribute.attribute;
			}

			delete localStorage.attributes;
			localStorage.attributes2 = JSON.stringify(dictionary_attributes);			
		});
	}	

}

function treeInnerHTML(tree, i) {
	// var renzheng = tree.state==2 ? '<span class="renzheng">已认证</span>' : '';
	var renzheng = tree.state==2 
				   ? (inArray(tree.userrole,[101,9])
				   	  ? '<span class="qjd">旗舰店</span>'
				   	  : '<span class="renzheng">已认证</span>')
				   : '';
	var collections = tree.collections>0 ? '<span class="cangmi">藏米'+tree.collections+'</span>' : '';
	
	var html = '<a href="javascript:showtree('+i+')">';
		html +=	'<img src="/trees/s2/'+tree.imgpath[0]+'" />';

	if (tree.phototime) 
		html += '<div class="photomark"></div>';

		html +=	'<h2>'+tree.name.substring(0,8)+'<span>¥'+tree.price + '</span> <i>'+showTime(tree.time)+'</i>'+renzheng+'</h2>';
		html +=	'<h3>'+attribute(tree)+'</h3>';
		html +=	'<h3>'+tree.username+'</h3>';
		html +=	'<h3>'+tree.province+tree.district+' '+tree.count+tree.unit+ collections + '</h3></a>';
	return html;
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

function showtree (i) {
	var tree = trees[i];
	var html = '';

	if (isMine && window.isShop) {
		var attribute_tree = dictionary_attributes ? dictionary_attributes[tree.basicname] : null;
		if (attribute_tree) attribute_tree = attribute_tree.split(',');

		// 我的树，可以修改属性规格、价格、数量						
		html += '<div class="header"><a class="back" href="javascript:closetree()">返回</a></div>';
		
		html += '<table>';

		html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
		if (tree.ldname)
			html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';

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
		// var renzheng = tree.state==2 ? '<span class="renzheng">已认证</span>' : '';
		var renzheng = tree.state==2 
					   ? (inArray(tree.userrole,[101,9])
					   	  ? '<span class="qjd">旗舰店</span>'
					   	  : '<span class="renzheng">已认证</span>')
					   : '';
		var collections = tree.collections>0 ? '<span class="cangmi">藏米'+tree.collections+'</span>' : '';
		// var poi = '<a class="poi" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a>';
		var poi = '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+tree.name+'&referer=geo"></a>';

		html += '<div class="header"><a class="back" href="javascript:closetree()">返回</a>'+poi+renzheng+collections+'</div>';
		
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

	// tree video
	if (tree.video) {
		// html += '<video onplay="playVideo()" preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
		html += '<video preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
	}


	if (tree.imgpath) {
		for(var v in tree.imgpath) {
			if (tree.phototime && tree.phototime[v])
				html += '<div style="text-align:center;">';
				html += '<a href="javascript:sildeTreeImage('+i+','+v+')"><img src="trees/o2/'+tree.imgpath[v]+'" /></a>';
			if (tree.phototime && tree.phototime[v]) {
				html += '<br><a class="poi2" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+ tree.photogps[v] + ';title:'+tree.username+tree.name+'&referer=geo"></a><div class="phototime">'+tree.phototime[v]+'</div></div>';
				// html += '<br><a class="poi2" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+ tree.photogps[v] + ';title:'+tree.username+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a><div class="phototime">'+tree.phototime[v]+'</div>';
			}
				html += '</div>';
		}
	}

	if (typeof visitor != "undefined"){
		// 有当前用户，微信回调，显示收藏按钮
		if (isMine && window.isCart) {
			html += '<button onclick="deletetree('+i+')">移出找树车</button>';
		} else {
			html += '<button onclick="addMyTree('+i+')">加入找树车</button>';
		}

		if (visitor.istrader) {
			// 当前用户有苗木认证权限，认证苗木
			if (tree.state==1) {
				html += '<button onclick="authenticateTree('+i+')">认证苗木</button>';
			}else if (tree.state==2) {
				html += '<button onclick="decertificationTree('+i+')">取消认证</button>';
			}
		}
	}

	if (isMine){
		if (window.isShop){
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

	}
	 
	if (!window.isShop) {
		html += '<button onclick="gotoShop('+tree.shopid+')">进入他的苗店</button>';
	}

	scrollTop = document.body.scrollTop;
	$('treelist').style.display = 'none';
	$('footer').style.display = 'none';
	document.body.scrollTop=0;

	var treeview = document.createElement('div');
	treeview.id = 'treeview';
	treeview.innerHTML = html;
	document.body.appendChild(treeview);

	// 自己访问自己不统计
	if (!window.visitor || visitor.shopid != tree.shopid) {
		ajax('com/accesstree.php?type=0&treeid='+tree.treeid+'&shopid='+tree.shopid+'&userid='+(window.visitor?visitor.userid:0), function(){});	
	}
}
function sildeAllImage() {
	var html = '<div class="bd"><ul>';
	
	for(var i in trees) {
		var tree = trees[i];

		for(var v in tree.imgpath) {
	        html += '<li data-id="'+i+','+v+'"></li>';
		}
	}
	
	html += '</ul></div><div class="hd"><ul></ul></div>';
		
	$('treelist').style.display = 'none';
	$('footer').style.display = 'none';

	var imageview = document.createElement('div');
	imageview.className = 'slideBox';
	imageview.id = 'imageview';
	// imageview.href = 'javascript:closeAllImage()';
	imageview.innerHTML = html;
	document.body.appendChild(imageview);

	TouchSlide({ 
		slideCell:"#imageview",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul", 
		effect:"left", 
		delayTime:500,
		interTime:3500,
		autoPage:true,
		autoPlay:true,
		startFun: loadSildeImage
	});
	loadSildeImage(-1,2);
}
function loadSildeImage(i,c) {
	if (++i<c) {
		var nodes = $('imageview').querySelector(".bd").querySelectorAll("li");
		// 加载下一个节点图片
		var node = nodes[i];

		if (!node.innerHTML) {
			var id = node.dataset.id.split(',');
			var tree = trees[id[0]];
			var html = '<img onclick="closeAllImage()" src="trees/o2/'+tree.imgpath[id[1]]+'"/>';
			html += '<span>'+tree.name+'¥'+tree.price+' '+tree.count+tree.unit+' '+tree.province+tree.district+'<br>'+attribute(tree)+'</span>';
			if (typeof visitor != "undefined" && !isMine) 
				html += '<i onclick="addMyTree('+id[0]+')">♡</i>';
			
			node.innerHTML = html;
			
			node.style.height = document.body.scrollHeight+'px';
			node.style.verticalAlign = 'middle';
		}
	}
}
function closeAllImage() {
	$('treelist').style.display = 'block';
	$('footer').style.display = 'block';
	document.body.removeChild($('imageview'));
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
function closetree (i) {
	$('treelist').style.display = 'block';
	$('footer').style.display = 'block';
	document.body.removeChild($('treeview'));
	document.body.scrollTop = scrollTop;

	if (i!=null) try{
		var node = $('treelist').querySelectorAll('li')[i];
		node.style.display = 'none';

		trees[i].isDeleted = true;

		var treecount = 0;
		var itemcount = 0;
		for(var v in trees) {
			var tree = trees[v];
			if (!tree.isDeleted) {
				treecount += tree.count*1; 
				itemcount++;
			}
		}
		$('total').innerHTML = itemcount + '项' + treecount + '株';
	}catch(e){}
}

function gotoShop (shopid) {
	window.location = 'shop.php?userid='+shopid;
}

function deletetree (i) {
	if (confirm("确定要删除本条数据吗？")) {
		var tree = trees[i];
		var isOwn = user.shopid == tree.shopid ? '&isOwn=1' : '';	
		var url = window.isCart ? 'com/deletemytree.php?userid='+user.userid+'&treeid='+tree.treeid+isOwn
						   :'com/deletetree.php?treeid='+tree.treeid;
		ajax(url,function () {});
		closetree(i);
	}
}
function updatetree (i) {
	var tree = trees[i];
	var data = {};

	var price = parseFloat($('price').value);
	if (!price || price<=0) {
		alert('价格：必须大于0');
		return;
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
	
	var node = $('treelist').querySelectorAll('li')[i];
	node.innerHTML = treeInnerHTML(tree, i);

	ajax('com/updatetree.php?treeid='+tree.treeid+'&data='+JSON.stringify(data), function () {
		alert('修改成功！');
	});
}

function addMyTree(i){
	var tree = trees[i]; 
	var isOwn = isMine ? '&isOwn=1' : '';	
	ajax('com/addmytree.php?userid='+visitor.userid+'&shopid='+tree.shopid+'&treeid='+tree.treeid+isOwn ,function(){
    	alert('加入成功！');	
	});
}

// 认证树
function authenticateTree (i) {
	trees[i].state = 2;
	ajax('com/authenticatetree.php?userid='+visitor.userid+'&state=2&treeid='+trees[i].treeid,function(){
    	alert('认证成功！');	
	});	
}
// 取消认证树
function decertificationTree (i) {
	trees[i].state = 1;
	ajax('com/authenticatetree.php?userid='+visitor.userid+'&state=1&treeid='+trees[i].treeid,function(){
    	alert('已取消认证！');	
	});
}

function toptree (i) {
	// 调整顺序
	var tree = trees[i];
	trees.splice(i,1);
	trees.unshift(tree);
	
	ajax('com/toptree.php?type=top&treeid='+tree.treeid,function (txt) {

		// 清楚已删除数据
		for (var i = trees.length - 1; i >= 0; i--) {
			if (trees[i].isDeleted) {
				trees.splice(i,1);
			}
		}

		// 重新加载数据
		$('treelist').innerHTML = '';
		closetree();
		// if ((state==1 || !isReferrer) && userintroduction) addUserIntroduction();
		addTrees(true);
	});
}

function untoptree (i) {
	ajax('com/toptree.php?type=untop&treeid='+trees[i].treeid,function () {
		window.location.href = window.location.href;
	});
}

function offshelvestree(i) {
	trees[i].state = -2;
	ajax('com/shelvestree.php?treeid='+trees[i].treeid+'&state=-2',function () {
    	alert('已下架，只有自己可见');			
	});
}
function onshelvestree(i) {
	var state = user.isrenzheng ? 2 : 1;
	trees[i].state = state;

	ajax('com/shelvestree.php?treeid='+trees[i].treeid+'&state='+state,function () {
    	alert('已上架，搜索可见');			
	});
}

function website_filter(str)
{
	var regEx1 = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w-   .\/?%&=]*)?/g;
	var arr1 = str.match(regEx1);
	if (arr1 != null) {
		for (var i=0;i<arr1.length;i++) {
			var link = arr1[i].replace(/www./,'');
			str = str.replace(arr1[i], '<a class="website" href="'+link+'">'+link+'</a>');
		}
	}


	var regEx2=/www.([\w-]+\.)+[\w-]+(\/[\w-   .\/?%&=]*)?/g;
	var arr2=str.match(regEx2);
	if(arr2 != null)
	{
		for(var i=0;i<arr2.length;i++)
		str = str.replace(arr2[i], '<a class="website" href="http://'+arr2[i]+'">'+arr2[i]+'</a>')
	}

	return str;
}

initFromWhere();
init();

if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
	loadJS('http://res.wx.qq.com/open/js/jweixin-1.0.0.js');
	loadJS('/js/wechat_test.js?t=201702109');
} 

setTimeout(function () {
	loadJS('/js/fastclick.min.js?t=20161205');

	var footer = platformid 
				? '<img onerror="this.src=\'http://qr.liantu.com/api.php?w=220&logo=http://cnzhaoshu.com/headimg/96/'+user.userid+'.jpg&text=http://www.cnzhaoshu.com/shop.php?userid='+user.userid+'\'" src="http://qr.liantu.com/api.php?w=220&logo=http://cnzhaoshu.com/headimg/96/'+user.userid+'.jpg&text=http://www.cnzhaoshu.com/shop.php?where={\"userid\":\"'+user.userid+'\",\"platformid\":\"'+platformid+'\"}">'
				: '<img src="http://qr.liantu.com/api.php?w=220&logo=http://cnzhaoshu.com/headimg/96/'+user.userid+'.jpg&text=http://www.cnzhaoshu.com/shop.php?userid='+user.userid+'">';
		footer += platformid
				? '<br><img src="/platform/wx'+platformid+'.png" onerror="this.src=\'/platform/wx.jpg\'">'
				: '<br><img src="/platform/wx.jpg">';
		footer += '<p>印在名片上，手机一扫可进店</p>';
	
	$('footer').innerHTML = footer;
},500);