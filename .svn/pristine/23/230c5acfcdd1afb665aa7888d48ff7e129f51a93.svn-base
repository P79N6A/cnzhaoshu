var page = 0;
var itemHeight = 360;
var columns = $('#userlist').length>0 ? 4 : 5;
var pageItems = Math.ceil($(window).height()/itemHeight)*columns; //15;
var isLoading = false; // 正在加载数据;
var isEnd = false;	   // 已经加载完
var qrcodeTicket;
var isLogin = false;
var loginuserid;
var loginuserstate;
// var isReload = true;


//获取网页url?参数
function urlRequest(name)
{
	var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
    return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
}

function valueTrim (id) {
	var value = $(id).val();
	return value.replace(/(^\s*)|(\s*$)/g,'');
}

function isPhone (str) {
	return /^1[3-5,7-8]{1}[0-9]{9}$/.test(str);
}

function addcookie(objName,objValue,objHours){//添加cookie
	if (!objHours) objHours = 2400;

	var str = objName + "=" + escape(objValue);
	if(objHours > 0){//为0时不设定过期时间，浏览器关闭时cookie自动消失
		var date = new Date();
		var ms = objHours*3600*1000;
		date.setTime(date.getTime() + ms);
		str += "; expires=" + date.toGMTString();
	}
	document.cookie = str;
}

function getcookie(objName){//获取指定名称的cookie的值
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == objName) return unescape(temp[1]);
	} 
}

function delcookie(name){//为了删除指定名称的cookie，可以将其过期时间设定为一个过去的时间
	var date = new Date();
	date.setTime(date.getTime() - 10000);
	document.cookie = name + "=a; expires=" + date.toGMTString();
}

function login () {
	// 蒙板
	$.blockUI({ message: '<p style="font-size:18px;font-weight: bold;padding-top:10px">请 用 微 信 扫 描 二 维 码 登 录</p><img id="qrcode" width="280" height="280" alt="二维码登录" onclick="$.unblockUI()" onerror="reloadLoginQRcode()" src="/img/loging.gif" />',
				css: {
					border: 0,
					top: '100px',
					left: ($(window).width()-280)/2 + 'px',
					width: '280px',
					height: '315px'
				}
	});

	loginQRcode();
}

function reloadLoginQRcode () {
	$('#qrcode').attr('src','/img/loging.gif');
	setTimeout(loginQRcode,2000);
}

function loginQRcode () {	
	// 获取二维码图片430*, t强制刷新
	var t = new Date().getTime();
	$.get('/com/loginqrcode.php?t='+t,function (ticket) {
		qrcodeTicket = ticket;
		// $('#qrcode').attr('src','https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='+ticket);
		$('#qrcode').attr('src','/qrlogin/'+ticket.toLowerCase()+'.jpg');

		// 激活500ms检查是否登录
		setTimeout(checkLogin,500);
	})

}

function checkLogin () {
	var t = new Date().getTime();
	$.getJSON('/com/checklogin.php',{ticket:qrcodeTicket, time:t},function (json) {
		if (json && json.state=='1') {
			$.unblockUI();

			var user = json.userstate + ';' + json.userid;
			if (json.name) {
				user += ';'+json.name;
			};

			addcookie('user',user);
			window.location.reload();
			// if (isReload) window.location.reload();
			// else checkUser();
		} else {
			setTimeout(checkLogin,2000);
		}
	});
}

function logout () {
	delcookie('user');
	// window.location.reload();
	if ($('#open_home').length>0) window.location.href=getcookie('open_home');
	else if (window.location.href.indexOf('findtree.html')>0 || window.location.href.indexOf('mytree.html')>0) window.location.href='.'; 
		 else window.location.reload();
}

function checkUser () {
	var user = getcookie('user');

	if (user) {
		user = user.split(';');
		loginuserstate = user[0];
		loginuserid = user[1];

		// $('#welcome').html(user[user.length-1]+'，欢迎来找树');
		$('#welcome').html(user[user.length-1]);
		$('#logout').show();
		$('#login').hide();
		isLogin = true;
	} else {
		isLogin = false;
	}
}



function search (forWhere,forLimit) {
	isLoading = true;
	$.getJSON('/com/search.php',{where:forWhere,limit:forLimit,fromWhere:'pc'},function (json) {
		if (json) {
			for (var i = 0; i < json.length; i++) {
				var tree = addTree(json[i]);
				$('#treelist').append(tree);
			};

			isEnd = json.length<pageItems;			
		} else {
			isEnd = true;
		} 

		var trees = $('#treelist').children();
		var treelistHeight = Math.ceil(trees.length/columns) * itemHeight + 50;
		// if (treelistHeight<1000) treelistHeight=1000;

		$('#treelist').height(treelistHeight);

		isLoading = false;
		$('#searchmore').hide();

		if (typeof isOpenApi != "undefined") try{
			var top = $('#treelist').offset().top;
			var height = treelistHeight<$(window).height()-top ? $(window).height()-top : treelistHeight;			
			XD.sendMessage(parent, height + top);
		}catch(e){}
	});

	page++;

	// 计算评价价格
	$('#average').html('');
	if (window.where && where.key) 
		$.getJSON('/com/averageprice.php',{where:forWhere},function (json) {
			if (json.count>0) {
				$('#average').html(' 均价: <b>'+(json.total/json.count).toFixed(2)+'</b>');
			}
		});
}

function addTree (tree) {
	try{
		if (tree.price>0) {
			if (Math.round(tree.price)!=tree.price) {
				tree.price = tree.price.toFixed(2);
			}
		}else{
			tree.price = '议价';
		}
		tree.dbh = Math.round(tree.dbh*10)/10;
		tree.crownwidth = Math.round(tree.crownwidth*10)/10;
		tree.height = Math.round(tree.height*10)/10;	

		var imgpath = decodeImgpath(tree.imgpath);

		var renzheng = tree.state==2 ? '<span class="renzheng">已认证</span>' : '';
		var collections = tree.collections>0 ? ' <span class="cangmi">藏米'+tree.collections+'</span>' : '';

		var html = '<div class="imgbox">';
			html += '<img src="/trees/s2/'+imgpath[0]+'" />';

			if (tree.phototime) 
				html += '<br><img class="photomark" src="/img/poi.png">';

	  		html +=	'</div><p><span class="name">'+tree.name+'</span></p>';
			html +=	'<p><span class="price"><i>￥</i>'+tree.price+'</span> <span class="count">'+tree.count+'株</span></p>';
			html +=	'<p class="size">胸(地)径'+tree.dbh+'厘米 冠幅'+tree.crownwidth+'米 高'+tree.height+'米</p>';
			html +=	'<p>'+tree.username+'</p>';
			html +=	'<p><span class="place">'+tree.province+' '+tree.district+' '+collections+renzheng+'</span></p>';
		
		var href = "tree.html?userid="+tree.userid;
			href += "&username="+tree.username;
			href += "&userphone="+tree.userphone;
			href += "&treeid="+tree.treeid;
			if (tree.qrcodeid) href += "&qrcodeid="+tree.qrcodeid;
			href += "&name="+tree.name;
			href += "&state="+tree.state;
			href += "&collections="+tree.collections;
			href += "&imgpath="+imgpath.join(';');
			if (tree.phototime) {
				href += "&phototime="+tree.phototime;
				href += "&photogps="+tree.photogps;
			}
			href += "&gps="+tree.x+','+tree.y;
			href += "&dbh="+tree.dbh;
			href += "&crownwidth="+tree.crownwidth;
			href += "&height="+tree.height;
			href += "&price="+tree.price;
			href += "&count="+tree.count;
			href += "&place="+tree.province+' '+tree.district;
		if (window.location.href.indexOf('findtree.html')>0)
			href += "&type=findtree";
		if (typeof isOpenApi != "undefined") return $("<a/>").html(html).attr({"href":href});
		else return $("<a/>").html(html).attr({"href":href,"target":"_blank"}); 
	}catch(e){}
}

function onSearch (key) {
	if (!key) key = valueTrim('#key');
	if (!key) return;

	if (!window.isHome) {
		location.href = './?key=' + key;
		return;
	}
	
	$('#where').html('');
	$("#btn_price").html('价格◇');
	$("#btn_price").attr('class','unselect');
	$("#btn_renzheng").attr('class','unselect');
	$("#btn_yuantu").attr('class','unselect');
	$("#btn_shipin").attr('class','unselect');
	$("#group1000").attr('class','unselect');
	$("#group1001").attr('class','unselect');
	
	searchKey(key);
}

function setHotkey () {
	var hotkeys = new Array("元宝枫","白腊","国槐","石榴","海棠","银杏","紫叶李","玉兰","油松","山楂");
	var html = '<a href="javascript:onSearch(\'北京鸿美苗木\')">企业</a><a href="javascript:onSearch(\'18518035059\')">手机</a>';
	for (var i = 0; i < hotkeys.length; i++) {
		html += '<a href="javascript:onSearch(\''+hotkeys[i]+'\')">'+hotkeys[i]+'</a>';
	};

	$('#hotkey').html(html);
}

function setCart () {
	if (isLogin) {
		$.getJSON('/com/usertree.php',{userid:loginuserid,type:'find'},function (json) {
			if (json) {
				$('#cart').html(json.length);
				$("#cart").animate({fontSize:"110px",lineHeight:"0"}).animate({fontSize:"32px",lineHeight:"80%"});
			}
		});
	}
}

checkUser();
setHotkey();
setCart();
$('#key').keydown(function (e) {
	if (e.keyCode==13) onSearch();
});
$('#cart').click(function(){
	window.location = 'findtree.html';
});
