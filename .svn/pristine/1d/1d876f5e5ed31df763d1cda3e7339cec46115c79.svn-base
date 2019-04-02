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
		.alltreelist{
			width:43%;
			float: left;
			line-height: 40px;
			color:#666;
			padding-left:7%;
		}
		/*全部苗木*/
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
			padding: 5px 0;
			border-bottom: 1px dashed #fff;
		}
		.tree_info a{
			color:#09BB07;
		}
		/*全部苗木*/

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
    <a data-id="member" class="">
        <i class="iconfont icon-renyuan"></i>
        <p>人员</p>
    </a>
    <a data-id="profile" class="head">
        <img id="headImage" src="">
        <p>我</p>
    </a>
</div>

<script id="dot_allmytree" type="text/x-dot-template">
    {{ for(var i in it) { }}
	    <div class="tree_info left">
		    <div class="looking_map" data-id="{{=it[i].id}}">
                <div class="row-1 left">{{=numbern()+'.'}}</div>
                <div class="row-5 left">{{=it[i].tree_name}}</div>
                <div class="row-4 left textright">号树</div>
            	<div class="row-9 right">{{=it[i].tree_attribute}}</div>				    	
		    </div>
        	<div class="row-9 right">{{=it[i].username}} <a href="tel:{{=it[i].phone}}">{{=it[i].phone}}</a></div>
	    </div>
    {{ } }}
</script>

<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script src="./js/doT.min.js"></script>
<script src="./js/zepto.min.js"></script>
<script type="text/javascript" src="./js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	var height = $(window).height();
	var width = $(window).width();
	var showalltree_isloading = false,showalltree_isend = false;
	var tpl_showallproject_data;

	var dot_allmytree = doT.template($('#dot_allmytree').text());

	var user = getcookie('user2');
	user = user ? JSON.parse(user) : null;

	function getcookie(name){
	    var arrStr = document.cookie.split("; ");
	    for(var i = 0;i < arrStr.length;i ++){
	        var temp = arrStr[i].split("=");
	        if(temp[0] == name) return unescape(temp[1]);
	    } 
	}

	$('#container').on('click','.mysearch',function(){
		changeover(getActiveMenu());
	})

	$('#container').on('click','.alltree_list',function(){
		window.pageManager.go('showallproject');
	})

	function getActiveMenu() {
	    return $('#tabbar .on').data('id');
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
			}
			if(state){
				changeover('showallproject');
			}
		});
	}
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
		        <input type="text" class="left" id="searchInput" placeholder="苗木名称或电话">
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
    		$tree_box = $('#tree_box');

    	function numbern(){
    		console.log(number);
    		return number++;
    	}

    	$supervision_info.css('height',(height-90)+'px');
    	$tree_box.css('height',(height-146)+'px');

        $tree_box.on('click','.looking_map',function(){
        	var id = $(this).data('id');
        	alert(id);
        })

        $('.button_reset').click(function(){
        	$searchInput.val('');
        	issearching = false;
        	searchname = null;
        	showalltree_isloading = false;
        	showalltree_isend = false;
        	$tree_box.html('');
        	number = 1;
        	$('#tree_box').html(dot_allmytree(tpl_showallproject_data));
        })

        $('.button_searching').click(function(){
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

    </script>
</script>

<!-- 主页 -->
<script type="text/html" id="tpl_home">
    <div id="home" class="page">
    	<div class="header">
    		<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
    	</div>
	    <div id="boy">
	    </div>
	    <div id="imagetip" class="imagetip"></div>
    </div>
    <script type="text/javascript">
    	
    </script>
</script>
<!-- 进度详情 -->
<script id="tpl_recordview" type="text/html">
	<div id="recordview" class="page fullpage">
		<div id="photoinfo"></div>
	</div>
	<script type="text/javascript">

	</script>
</script>
<!-- 进度 -->
<script type="text/html" id="tpl_projectimage">
    <div id="projectimage" class="page">
		<div class="header">
			<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
			<div class="isbuy">采购</div>
			<div class="issell">供应</div>
		</div>
		<div class="select_jdname">
			<div class="selectbox">
				<select id="projectselectbox_treename" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="projectselectbox_statistics" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="projectselectbox_supplier" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
		</div>
		<div id="listimage">
		</div>
    </div>
    <script type="text/javascript">
    	
    </script>
</script>
<!-- 统计 -->
<script type="text/html" id="tpl_statistics">
    <div id="statistics" class="page">
		<div class="header">
			<div class="alltreelist alltree_list">全部苗木<i class="iconfont icon-select"></i></div>
			<div class="isbuy">采购</div>
			<div class="issell">供应</div>
		</div>
		<div class="select_name">
			<div class="selectbox">
				<select id="selectbox_treename" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="selectbox_statistics" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
			<div class="selectbox">
				<select id="selectbox_supplier" class="weui-select">
				</select>
				<i class="iconfont icon-select"></i>
			</div>
		</div>
		<div class="select_time">
        	<input id="begindate2" class="weui-input select_timeinput" type="date">
        	<input id="enddate2" class="weui-input select_timeinput" type="date">
		</div>
		<div id="listimage1">
		</div>
    </div>
    <script type="text/javascript">
    	
    </script>
</script>
<!-- 人员 -->
<script type="text/html" id="tpl_member">
    <div id="member" class="page">
		<div class="header">
			<div class="alltreelist alltree_list" >全部苗木<i class="iconfont icon-select"></i></div>
		</div>
		<div id="listimage2">

		</div>
    </div>
    <script type="text/javascript">
    	
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
    	
    </script>
</script>
<!-- 我的项目管理 -->
<script type="text/html" id="tpl_mangerproject">
    <div class="page" id="mangerprojectbox">
    	<div class="showprojects">
    		<div class="sharelookpower">授权所有项目</div>
		    <div id="projects">
		    </div>
	    	<div class="create_project" onclick="window.pageManager.go('createnew')">新建项目</div>
    	</div>
	    <div class="qrcodeimages">
	    	<div class="qrcodeimage_font"></div>
	    	<img src="" class="qrcodeimage" id="qrcodeimages1">
	    </div>
    </div>
    <script type="text/javascript">
    	
    </script>
</script>
<!-- 新建项目 -->
<script type="text/html" id="tpl_createnew">
    <div class="page" id="createnewbox">
		<div class="create_newproject_title">
			<div class="center_title">创建新订单</div>
			<div class="create_newproject_row1">
				<div class="create_newproject_low1">订单名称：</div>
				<input id="create_newproject_low2" placeholder="请输入订单名称" type="text" name="">
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
		<div class="qrcodeimages">
			<div class="qrcodeimage_font">将此二维码发送给卖家即可生成苗木监管</div>
			<img src="" class="qrcodeimage" id="qrcodeimages2">
		</div>
    </div>
    <script type="text/javascript">
    	
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
		    	
	    		window.pageManager.go(id);	
		    	break;
		    case 'projectimage':
		    	
		    	window.pageManager.go(id);	
		    	break;
		    case 'statistics':
		    	 
		    	window.pageManager.go(id);	 		        
		    	break;
		    case 'member':
		        
		        window.pageManager.go(id);	
		    	break;
		    case 'showallproject':
		    	window.pageManager.go(id);	
		    	break;
		    case 'profile':
	    		
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