var isPc = false;
var page = 0;
var itemHeight = 101;
var pageItems = Math.ceil($(window).height()/itemHeight); //15;
var isLoading = false; // 正在加载数据;
var isEnd = false;	   // 已经加载完
var trees = [];		// json数据集合
var scrollTop;
var scrollTopTreeView;
var user;


/***************** commonly function ********************/
function urlRequest(name)
{
	var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
    return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
}
function addcookie(name, value){//添加cookie
	var date = new Date();
	date.setTime(date.getTime() + 315360000000);  // ms 365*10*24*3600*1000

	document.cookie = name + "=" + escape(value) + ";expires=" + date.toGMTString() + ";path=/;domain=cnzhaoshu.com";
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

function isPhone (str) {
	return /^1[3-5,7-8]{1}[0-9]{9}$/.test(str) || /^([0-9]{3,4}-)?[0-9]{7,8}$/.test(str);
}

function inArray(key, array) {
  for(var k in array){ 
    if (array[k]==key) return true;     
  }  
  return false;
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
function mORcm(m) {
	return m<1 ? Math.round(m*100)+'公分' : m+'米';
}

/***************** tree list *******************/

function search (forWhere,forLimit,isPriceSlider) {
	if (isLoading) return;

	isLoading = true;
	if (window.url_shop_id) forLimit = '';
	$('#searchmore').show();
	if ($('#treelist li').length==0) trees = [];

	$.getJSON('com/search.php',{where:forWhere,limit:forLimit},function (json) {
		if (json) {
			var last = trees.length;
			trees = trees.concat(json);			
			var length = trees.length;

			for (var i = last; i < length; i++) {
				var tree = addTree(trees[i],i);
				$('#treelist').append(tree);
			};		

			// 插入信息流广告
			// if (last==0) {
			// 	var i = json.length>=2 ? 1 : json.length-1;
			// 	$('<li style="width: 100%;padding:0"><a href="http://mp.weixin.qq.com/s/-aHKm_7jFaMkMlgxmjNw3w#wechat_redirect"><img style="width: 100%;border-radius: 0" src="ad/20171117.jpg"></a></li>').insertAfter($('#treelist li').eq(i));
			// }

			isEnd = json.length<pageItems;			
		} else {
			isEnd = true;
		} 


		isLoading = false;
		$('#searchmore').hide();
		$('#where').html() ? $('#where').show() : $('#where').hide();
		trees.length>0 ? $('#province').show() : $('#province').hide();
		
		try{prepareShare()}catch(e){}		
	});

	page++;
	
	setPrice(forWhere,isPriceSlider);
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

function addTree (tree,i) {
	if (tree.pname) {
		tree.name = "'"+tree.pname+"'" + tree.name;
	}

	if (tree.age) tree.age = parseFloat(tree.age);
	if (tree.dbh) tree.dbh = parseFloat(tree.dbh);
	if (tree.height) tree.height = parseFloat(tree.height);
	if (tree.crownwidth) tree.crownwidth = parseFloat(tree.crownwidth);
	if (tree.branch_point_height) tree.branch_point_height = parseFloat(tree.branch_point_height);

	tree.price = Math.round(tree.price*100)/100;
	if (tree.price==0) tree.price = '议价';

	if (!tree.unit) tree.unit = '株';

	tree.imgpath = decodeImgpath(tree.imgpath);

	if (tree.phototime) {
		tree.phototime = tree.phototime.split(';');
		tree.photogps = tree.photogps.split(';');
	}	

	var renzheng = '';
	switch (tree.state) {
		case 2: renzheng = '<span class="renzheng">已认证</span>'; break;
		case 3: renzheng = '<span class="qjd">旗舰店</span>'; break;
		case 4: renzheng = '<span class="qjd">单品王</span>'; break;
	}

	var collections = tree.collections>0 ? '<span class="cangmi">藏米'+tree.collections+'</span>' : '';
	
	var html = '<a href="javascript:showtree('+i+')">';
		html +=	'<img src="/trees/s2/'+tree.imgpath[0]+'" />';
	
	if (tree.invoice) 
		html += '<img class="fapiao" src="/img/fapiao.png?t=2">';

	if (tree.userstate) 
		html += '<img style="position: absolute; width: 40px; height: 40px; border-radius: 50%; margin: 50px 0 0 -40px;" onerror="this.parentNode.removeChild(this);" src="/platform/'+tree.userstate+'.png">';

	if (tree.phototime) 
		html += '<div class="poi"></div>';

		if (tree.type!=101) {
	  		html +=	'<h2>'+tree.name.substring(0,8)+'<span>¥'+tree.price + '</span> <i>'+showTime(tree.time)+'</i>'+renzheng+'</h2>';
			html +=	'<h3>'+attribute(tree)+'</h3>';
			html +=	'<h3>'+tree.username+'</h3>';
			html +=	'<h3>'+tree.province+tree.district + ' ' + tree.count+ tree.unit + collections + '</h3></a>';
		} else {
	  		html +=	'<h2>'+tree.name.substring(0,8)+' <i>'+showTime(tree.time)+'</i>'+renzheng+'</h2>';
			html +=	'<h3>'+tree.remark+'</h3>';
			html +=	'<h3>'+tree.username+'</h3>';
			html +=	'<h3>'+tree.province+tree.district + ' ' + collections + '</h3></a>';
		}


	var li = document.createElement('li');
	li.innerHTML = html;
	return li;
}

function showtree (i) {
	var attribute_name = {"5":"胸径","6":"地径","7":"盆径","10":"株高","11":"条长","12":"主蔓长","17":"株高"};
	var tree = trees[i];
	var html = '';
	// var operate_menu = '<div class="operate_menu"><a href="javascript:closetree()"><b class="om_back"></b><br>返回</a>';

	var renzheng = '';
	switch (tree.state) {
		case 2: renzheng = '<span class="renzheng">已认证</span>'; break;
		case 3: renzheng = '<span class="qjd">旗舰店</span>'; break;
		case 4: renzheng = '<span class="qjd">单品王</span>'; break;
	}	

	var collections = tree.collections>0 ? '<span class="cangmi">藏米'+tree.collections+'</span>' : '';
	var poi = '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+' '+tree.name+';addr:'+tree.address+'&referer=geo"> </a>';
	// var poi = '<a class="poi" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+' '+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a>';

	html += '<div class="header"><a class="back" href="javascript:closetree()">返回</a>'+renzheng+collections+'</div>';
	
	html += '<table>';
	
	html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
	if (tree.ldname)
		html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';

	if (tree.invoice) 
		html += '<img class="fapiao" src="/img/fapiao.png?t=2">';
	
	if (tree.type!=101)
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
	
	if (tree.type!=101)
		html += '<tr><td class="field">数量：</td><td>'+tree.count+tree.unit+'</td>';
	html += '<tr><td class="field">位置：</td><td>'+tree.province+' '+tree.district+'</td>';
	html += '<tr><td class="field">苗商：</td><td>'+tree.username+'</td>';
	html += '<tr><td class="field">联系电话：</td><td><a href="tel:'+tree.userphone+'">'+tree.userphone+'</a></td>';
	html += '<tr><td class="field">发布时间：</td><td>'+tree.time+'</td>';
	html += '</table>';
	
	if (tree.video) {
		html += '<video onplay="playVideo()" preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
	}

	for(var v in tree.imgpath) {
		if (tree.phototime && tree.phototime[v])
			html += '<div style="text-align:center;">';

			html += '<a href="javascript:sildeTreeImage('+i+','+v+')"><img src="trees/o2/'+tree.imgpath[v]+'" /></a>';
		
		if (tree.phototime && tree.phototime[v]) {
			html += '<br><a class="poi2" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'
				    + tree.photogps[v] + ';title:'+tree.username+tree.name+';addr:'+tree.address+'&referer=geo"></a><div class="phototime">'+tree.phototime[v]+'</div></div>';
			// html += '<br><a class="poi2" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:'
				    // + tree.photogps[v] + ';title:'+tree.username+tree.name+'&key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&referer=zhaoshu"></a><div class="phototime">'+tree.phototime[v]+'</div>';
		}
			html += '</div>';
	}

	if (user){
		// 有当前用户，微信回调，现实收藏按钮
		// html += '<button onclick="addMyTree('+i+')">加入找树车</button>';
		// operate_menu += '<a href="javascript:addMyTree('+i+')"><b class="om_favourite"></b><br>收藏</a>';

		if (user && user.istrader) {
			// 当前用户有苗木认证权限，认证苗木
			// html += tree.state!=4 ? '<button onclick="authenticateTree('+i+')">单品认证</button>'
								  // : '<button onclick="decertificationTree('+i+')">取消认证</button>';
			// if (tree.state==1) {
			// 	html += '<button onclick="authenticateTree('+i+')">单品认证</button>';
			// 	// operate_menu += '<a href="javascript:authenticateTree('+i+')"><b class="om_authen"></b><br>认证</a>';
			// }else if (tree.state==2 || tree.state==4) {
			// 	html += '<button onclick="decertificationTree('+i+')">取消认证</button>';
			// 	// operate_menu += '<a href="javascript:decertificationTree('+i+')"><b class="om_unauthen"></b><br>取消认证</a>';
			// }
		}
	}

	// html += '<button onclick="gotoShop('+tree.shopid+')">进入他的苗店</button>';
	// html += '<a href="/goodsinfo.php?treeid='+tree.treeid+'"><button>找树宝 下单</button></a>';
	// operate_menu += '<a href="/m2.php?userid='+tree.userid+'"><b class="om_shop"></b><br>进店</a>';
	// html += operate_menu;
	// html +='<br><br><br><br><br>';

	scrollTop = document.body.scrollTop;
	$('#filter').hide();
	$('#treelist').hide();
	$('#footer').hide();
	document.body.scrollTop=0;

	var treeview = document.createElement('div');
	treeview.id = 'treeview';
	treeview.innerHTML = html;
	document.body.appendChild(treeview);

	// 自己访问自己不统计
	if (!user || user.shopid != tree.shopid) {
		$.post('/com/accesstree.php',{type:0, treeid:tree.treeid, shopid:tree.shopid, userid:(user?user.userid:0)});
	}
}

function sildeTreeImage(i,j) {
	var tree = trees[i];

	var html = '<div class="bd"><ul>';
	for(var v in tree.imgpath) {
        html += '<li><img onclick="closeImageView()" src="trees/o2/'+tree.imgpath[v]+'"/>';
		html += '<span>'+tree.name+'¥'+tree.price+' '+tree.count+tree.unit+' '+tree.province+tree.district+'<br>'+attribute(tree)+'</span>';
		if (user) 
			html += '<i onclick="addMyTree('+i+')">♡</i>';
		html += '</li>';	
	}
		html += '</ul></div><div class="hd"><ul></ul></div>';

	scrollTopTreeView = document.body.scrollTop;
	$('#treeview').hide();
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

	var nodes = document.getElementById('imageview').querySelector(".bd").querySelectorAll("li");
	for (var i = nodes.length - 1; i >= 0; i--) {
		var li = nodes[i];
		li.style.height = document.body.scrollHeight+'px';
		li.style.verticalAlign = 'middle';
	}
}
function closeImageView() {
	$('#treeview').show();
	$('#imageview').remove();
	document.body.scrollTop = scrollTopTreeView;
}

function closetree () {
	$('#treeview').remove();
	$('#filter').show();
	$('#treelist').show();
	$('#footer').show();
	document.body.scrollTop = scrollTop;
}

function addMyTree(i){
	var tree = trees[i]; 
	var isOwn = user && user.shopid == tree.shopid ? '&isOwn=1' : '';	
	$.post('com/addmytree.php?userid='+user.userid+'&treeid='+tree.treeid+'&shopid='+tree.userid+isOwn ,function(){
    	alert('加入成功！');	
	});
}

// 认证树
function authenticateTree (i) {
	$.post('com/authenticatetree.php?userid='+user.userid+'&state=2&treeid='+trees[i].treeid,function(){
		trees[i].state = 2;
    	alert('认证成功！');	
	});	
}
// 取消认证树
function decertificationTree (i) {
	$.post('com/authenticatetree.php?userid='+user.userid+'&state=1&treeid='+trees[i].treeid,function(){
		trees[i].state = 1;
    	alert('已取消认证！');	
	});
}


function onSearch (key) {
	if (!key) key = $.trim($("#key").val());
	if (!key) return;

	if (!window.isHome) {
		location.href = 'index.html?key=' + key;
		return;
	}

	$('#where').html('');
	$('#spec_dbh').val('');
	$('#spec_crownwidth').val('');
	$('#spec_height').val('');
	$("#btn_price").html('价格◇');
	$("#btn_price").attr('class','unselect');
	$("#btn_renzheng").attr('class','unselect');
	$("#btn_yuantu").attr('class','unselect');
	$("#btn_shipin").attr('class','unselect');

	searchKey(key);
	$('#key').blur();

	if ($('#userlist').length>0) {
		$('#userlist').hide();
		$('#treelist').show();
		$('#footer').show();		
	}

	// 旗舰店搜索切换树列表
	if ($("#tree").is(":hidden")) {
		showTree();
	}	
}

function gotoShop (shopid) {
	window.location = 'shop.php?userid='+shopid;
}

function checkUser () {
	user = getcookie('user2');

	if (user) {
		user = JSON.parse(user);
	}
}


checkUser();

$(function () {
	loadJS('/js/fastclick.min.js?t=20161205');

	$('#key').keydown(function (e) {
		if (e.keyCode==13 && !isLoading) onSearch();
	});
	
	if (user) {
		$('#footer_menu').show();

		$.get('/com/count.cart.php', {userid: user.userid}, function (count) {
			$('#nav_cart i').html('<span>'+count+'</span>');
		});

		$('#nav_cart').attr('href','cart.php?userid='+user.userid);
		$('#nav_shop').attr('href','shop.php?userid='+user.userid);
		$('#headImage').html('<img src="headimg/96/'+user.userid+'.jpg">');
	}

	if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
		// loadJS('http://res.wx.qq.com/open/js/jweixin-1.0.0.js');
		loadJS('/js/wechat.js?t=201801022');
	} 
});

(function(){	
	var isHidden = false;
	var startTouchTime;
	var startCY;


	$("#content").on("touchstart", function(event) {
		startTouchTime = new Date().getTime();

		var touch = event.targetTouches[0];
		startCY = touch.clientY; 
	});
	$("#content").on("touchmove", function(event) {
		var touch = event.changedTouches[0];
		var deltaY = startCY - touch.clientY;

		if (deltaY>0) {
			// 上推隐藏
			if (!isHidden) {
				isHidden = true;
				$("#header_bar").css("top","-50px");
				$("#footer_menu").css("bottom","-50px");
			}
		} else {
			if (isHidden) {
				isHidden = false;
				$("#header_bar").css("top","0");
				$("#footer_menu").css("bottom","0");
			}
			if (deltaY/(new Date().getTime()-startTouchTime)<-1.2) {
				$(document).scrollTop(0);  // 快速滑动置顶
			}
		}
	});
})();
