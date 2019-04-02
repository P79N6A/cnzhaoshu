/*
站内登录
 */
// (function(){
	// 101旗舰店，100开放平台管理员,9老大,8系统管理员
	var pageRoles = {
		"":null,
		"index.html":null,
		"shop.html":null,
		"financial.html":null,
		"shop_honor.html":[101,9,8],
		"shop_project.html":[101,9,8],
		"invoice.html":[9,8],
		"user.html":[9],
		"platform_logo.html":[100,9,8],
		"platform_ad.html":[100,9,8],
		"dictionary_attribute_update.html":[9,8],
		"dictionary_grade_add.html":[9,8],
		"dictionary_grade_update.html":[9,8],
		"dictionary_price_add.html":[9,8],
		"dictionary_price_search.html":[9,8],
		"negotiation.html":[9,8],
		"transactlist.html":[9,8],
		"show_order.html":[9,8],
		"allrecharge.html":[9,8]
	};

	var menus = [
		{
			"name":"首页",
			"href":".",
			"icon":"icon-home-copy"
		},
		{
			"name":"苗店设置",
			"role_no":[101,9,8],
			"icon":"icon-woyaokaidian1",
			"href":"shop.html"
		},
		{
			"name":"旗舰店设置",
			"role":[101,9,8],
			"icon":"icon-woyaokaidian1",
			"sub_menu":[
				{
					"name":"公司信息",
					"href":"shop.html"
				},
				{
					"name":"荣誉资质",
					"href":"shop_honor.html"
				},
				{
					"name":"精品项目",
					"href":"shop_project.html"
				}
			]
		},
		{
			"name":"财务管理",
			"role":null,
			"icon":"icon-finance",
			"sub_menu":[
				{
					"name":"卖方发票设置",
					"href":"financial.html"
				}
			]
		},
		{
			"name":"苗木字典",
			"role":[9,8],
			"icon":"icon-shezhi",
			"sub_menu":[
				{
					"name":"属性表",
					"href":"dictionary_attribute_update.html"
				},
				{
					"name":"等级表",
					"href":"dictionary_grade_update.html"
				},
				{
					"name":"等级表批处理",
					"href":"dictionary_grade_add.html"
				},
				{
					"name":"造价表",
					"href":"dictionary_price_search.html"
				},
				{
					"name":"造价表批处理",
					"href":"dictionary_price_add.html"
				}
			]
		},
		{
			"name":"用户管理",
			"role":[9],
			"icon":"icon-comiisquanzi",
			"sub_menu":[
				{
					"name":"用户管理",
					"href":"user.html"
				}
			]
		},
		{
			"name":"微信平台",
			"role":[100,9,8],
			"icon":"icon-yunpingtai",
			"sub_menu":[
				{
					"name":"LOGO",
					"href":"platform_logo.html"
				},
				{
					"name":"广告",
					"href":"platform_ad.html"
				}
			]
		},
		{
			"name":"认证审核",
			"role":[9,8], 
			"icon":"icon-renzheng2",
			"sub_menu":[
				{
					"name":"卖方发票审核",
					"href":"invoice.html"
				}
			]
		},
		{
			"name":"管理",
			"role":[9,8], 
			"icon":"icon-pingtai",
			"sub_menu":[
				{
					"name":"交易纠纷",
					"href":"negotiation.html"
				},
				{
					"name":"交易列表",
					"href":"transactlist.html"
				},
				{
					"name":"交易金额",
					"href":"show_order.html"
				},
				{
					"name":"收支金额",
					"href":"allrecharge.html"
				}
			]
		}
	];


	var user;
	var qrcodeTicket;

	function getcookie(name){//获取指定名称的cookie的值
		var arrStr = document.cookie.split("; ");
		for(var i = 0;i < arrStr.length;i ++){
			var temp = arrStr[i].split("=");
			if(temp[0] == name) return unescape(temp[1]);
		} 
	}

	function delcookie(name){//为了删除指定名称的cookie，可以将其过期时间设定为一个过去的时间
		var date = new Date();
		date.setTime(date.getTime() - 10000);
		document.cookie = name + "=a;expires=" + date.toGMTString()+ ";path=/;domain=cnzhaoshu.com";
	}


	function loginQRcode() {
		var t = new Date().getTime();
		$.get('/com/loginqrcode.php?t='+t,function (ticket) {
			if (ticket) {
				qrcodeTicket = ticket;

				// ie6 不支持 showqrcode?ticket
				var isIE67 = navigator.userAgent.indexOf('MSIE')>0;
				if (isIE67) $('#login_qrcode').attr('src','/qrlogin/'+qrcodeTicket.toLowerCase()+'.jpg');
				else $('#login_qrcode').attr('src','https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='+ticket);

				setTimeout(checkLogin,2000);
				setTimeout(loginTimeout,600000); // 10分钟超时
			} else {
				setTimeout(loginQRcode,2000);				
			}
		});
	}
	function checkLogin() {
		var t = new Date().getTime();
		var isAutoLogin = $("input[type='checkbox']").is(':checked');
		$.getJSON('/com/checklogin.php?t='+t,{ticket:qrcodeTicket, autoLogin:isAutoLogin},function (json) {
			if (json) {
				window.location.replace('./');
			} else {
				setTimeout(checkLogin,2000);
			}
		});
	}
	
	function checkUser() {
		user = getcookie('user2');

		if (user) {
			try{
				user = JSON.parse(user);
				
				if (getWebFilename()=='login.html') {
					window.location.replace('./');
				} else {
					var check = checkRole();
					if (check) {
						loadHeader();
						loadMenu();
					} else if (check===false) {
						window.location.replace('role.html'); // 没有权限
					}
				}
				return;
			}catch(e){
				delcookie('user2');
			}
		}

		// 如果不是login.html 调到login.html
		if (getWebFilename()=='login.html') {
			loginQRcode();
			$('#login_qrcode').on('error',function(){ 
				this.src='/img/loging.gif'; 
				setTimeout(loginQRcode,2000);
			});	
		} else {
			window.location.replace('login.html');
		}	
	}

	function loginTimeout() {
		window.location.replace('500.html');
	}

	function logout() {
		delcookie('user2');
		window.location.replace('login.html');
	}

	function getWebFilename() {
		var path = location.pathname.split('/');
		return path[path.length-1];
	}

	function checkRole() {
		var pagerole = pageRoles[getWebFilename()];

		if (pagerole) {
			return $.inArray(user.role, pagerole)>=0;
		} else if (pagerole===null) {
			return true;	// 任何角色均可
		} else {
			return null;	// 页面没有定义
		}
	}
	
	function loadHeader() {
		var html = '<div class="sidebar-toggle-box"><div data-original-title="收放导航栏" data-placement="right" class="icon icon-iconfont16px icon-reorder tooltips"></div></div><a href="." class="logo">找树网<span>管理平台</span></a>';
			html += navigator.userAgent.indexOf('MicroMessenger')>0 || window.screen.height<700 || window.screen.width<700
					? '<div class="top-nav "><ul class="nav pull-right top-menu"><li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><img class="headimg-nav" onerror="this.src=\'/headimg/96/0.jpg\'" alt="" src="/headimg/96/'+user.userid+'.jpg"></a></li></ul></div>'
					: '<div class="top-nav "><ul class="nav pull-right top-menu"><li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><img class="headimg-nav" onerror="this.src=\'/headimg/96/0.jpg\'" alt="" src="/headimg/96/'+user.userid+'.jpg"> <span class="username">'+user.name+'</span><b class="caret"></b></a><ul class="dropdown-menu extended logout"><li><a href="/"><i class="icon icon-home-copy"></i>找树网首页</a></li><li><a href="/mytree.html"><i class="icon icon-woyaokaidian1"></i>我的苗店</a></li><li><a href="/findtree.html"><i class="icon icon-zhongxingpingbanche1"></i>我的找树车</a></li><li><a href="javascript:logout()"><i class="icon icon-tuichu"></i>安全退出</a></li></ul></li></ul></div>';
		$('#header').html(html);
	}

	function loadMenu() {
		var html = '<ul class="sidebar-menu">';
		var filename = getWebFilename();
		if (filename=='' || filename=='index.html') filename = '.';

		for (var i = 0; i < menus.length; i++) {
			var menu = menus[i];

			// 没有菜单权限，跳过
			if ( (menu.role && $.inArray(user.role, menu.role)<0)
				 || (menu.role_no && $.inArray(user.role, menu.role_no)>=0) ) continue;

			if (menu.href) {
				html += menu.href==filename ? '<li class="active">' : '<li>';
				html += '<a href="' + menu.href + '">';
				html += '<i class="icon ' + menu.icon + '"></i>';
				html += ' <span>' + menu.name + '</span>';
				html += '</a></li>';
			} else {
				// 有子菜单
				var sub_menu_html = '<ul class="sub">';
				var sub_menu = menu.sub_menu;
				var class_active = '';

				for (var j = 0; j < sub_menu.length; j++) {
					var submenu = sub_menu[j];
					sub_menu_html += '<li><a href="' + submenu.href + '">' + submenu.name + '</a></li>';
					if (submenu.href==filename) class_active = ' active';
				}
				sub_menu_html += '</ul>';

				html += '<li class="sub-menu' + class_active + '">';
				html += '<a href="javascript:;">';
				html += '<i class="icon ' + menu.icon + '"></i>';
				html += ' <span>' + menu.name + '</span>';
				html += '<span class="arrow"></span></a>';
				html += sub_menu_html;
				html += '</li>';
			}
		}

		html += '</ul>';

		$('#sidebar').html(html);
	}
 
	checkUser();

// })();