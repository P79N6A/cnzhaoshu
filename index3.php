<!DOCTYPE html><html><head>
<title>环球主题公园苗木管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
    <meta name="format-detection" content="telephone=no"/>
<!-- <link rel="stylesheet" href="css/weui.min.css"/> -->
<style type="text/css">
    body,html {
        height: 100%;
        -webkit-tap-highlight-color: transparent
    }
    html {
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }
    body {
        line-height: 1.6;
        font-family: Helvetica,sans-serif;
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        user-select:none;
        background-color:#eee;
    }
    * {
      margin: 0;
      padding: 0;
      border: 0;
    }

    a {
      text-decoration: none;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    li{
        list-style: none outside none;
    }

    .page, .page2{
        display: none;
        position:absolute;
        width: 100%;
        top:0;
        right:0;
        bottom:0;
        left:0;
        background-color:#eee;
        overflow-y:auto;
        overflow-x:hidden; 
        -webkit-overflow-scrolling:touch;
    }
    @-webkit-keyframes a{0%{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);opacity:0}to{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}
    @keyframes a{0%{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);opacity:0}to{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}
    .page.js_show {display: block; opacity:1;z-index: 1000}
    .page.slideIn{display: block;-webkit-animation:a .2s forwards;animation:a .2s forwards;z-index: 1001}
    .fullpage{top:0;bottom: 0;}
    .toppage{top:0;z-index: 101}
    .bottom-50{padding-bottom: 50px;}
    #home{display: block;}


    /************ tabbar  ***********/
    .tabbar{
        position:absolute; 
        bottom:0; 
        display: -webkit-box;
        display: -webkit-flex;display:
        flex; width:100%; 
        color: #fff; 
        background-color: #000; 
        height: 49px;
        line-height: 22px;  
        z-index: 1000;
        opacity: 0.8;
    }
    .tabbar a{
        display: block;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        flex: 1;        
        padding: 7px 0 0;
        text-align: center;
    }
    .tabbar i{
        font-size: 24px;
    }
    .tabbar p{
        font-size: 12px;
    }
    .tabbar .head{
        line-height: 18px;
    }
    .tabbar .head img{
        height: 24px;width: 24px;border-radius: 50%;margin-top: -1px;
    }
    .tabbar .on{
        color: #09BB07;
    }
    .tabbar .on i{
        font-weight: bolder;
    }

    /*搜索记录*/
    #search {
        text-align: center;
    }
    #search i{
        display: inline-block;
        margin: 0 10px;
        font-style: normal;
    }


    .weui-loadmore {
        float: left;
        width: 100%;
        margin: 1.5em auto;
        line-height: 1.6em;
        font-size: 14px;
        text-align: center;
        margin: 15px 0;
    }
    .weui-loading {
      /*content: "\e67e";*/
      width: 20px;
      height: 20px;
      display: inline-block;
      vertical-align: middle;
      -webkit-animation: weuiLoading 1s steps(12, end) infinite;
              animation: weuiLoading 1s steps(12, end) infinite;
    }
    @-webkit-keyframes weuiLoading {
      0% {-webkit-transform: rotate3d(0, 0, 1, 0deg);}
      100% {-webkit-transform: rotate3d(0, 0, 1, 360deg);}
    }
    @keyframes weuiLoading {
      0% {-webkit-transform: rotate3d(0, 0, 1, 0deg);}
      100% {-webkit-transform: rotate3d(0, 0, 1, 360deg);}
    }
    .weui-loadmore__tips {
        display: inline-block;
        vertical-align: middle;
    }
    
    .date {
        font-size: 10px;
        color: #888;
    }
    .fr{float: right}
    .col-15{width: 15%}
    .search-input.fontsize-10{font-size: 10px;}
    .center{text-align: center;}
    .none{display: none;}
    .cell_box{width:92%;padding:0 4%;overflow: hidden;}
    .cell{width:92%;background:#fff;height:44px;line-height:44px;border-radius:5px;padding:0 4%; margin-top:10px;}
    .cell input{font-size: 14px; width: 100%;line-height: 24px}
    em{float: right;color: #ccc;font-size: 12px;font-style: normal}
    em:before{ float:right; display:block; font-family: "iconfont"; content: "\e635";font-style: normal;color: #ccc}
    .green{color: green}
    .blue{color: #7cb6d0}
    .bg_green{color: #fff; background-color: green}
    .bg_orange{color: #fff; background-color: orange}
    .prompt{
        width: 100%; text-align: center;color: #ccc;margin-top: 20px; text-shadow: 1px 1px 1px #fff;
    }

    .scan_qrcode{
        position: absolute;
        display: none;
        right: 10px;
        top: 10px;
        width: 20px;
        text-align: center;
        line-height: 20px;
        font-size: 20px;
        z-index: 1001;
    }

    /*字体图标*/

    @font-face {font-family: "iconfont";
      src: url('iconfont_phone/iconfont.ttf?t=1489121588103') format('truetype');
    }

    .iconfont {
      font-family:"iconfont" !important;
      font-size:16px;
      font-style:normal;
      -webkit-font-smoothing: antialiased;
      /*-webkit-text-stroke-width: 0.2px;*/
      -moz-osx-font-smoothing: grayscale;
    }


    .icon-search:before { content: "\348d"; }

    .icon-fanhui:before { content: "\e600"; }

    .icon-select:before { content: "\e7dd"; }

    .icon-iconfontshanchu:before { content: "\e614"; }

    .icon-close:before { content: "\e619"; }

    .icon-jiantou:before { content: "\e635"; }

    .icon-xiao41:before { content: "\e88c"; }

    .icon-xiao42:before { content: "\e88d"; }

    .icon-ri:before { content: "\e657"; }

    .icon-shezhi:before { content: "\e658"; }

    .icon-xinzaolindi:before { content: "\e8f2"; }

    .icon-loading:before { content: "\e611"; }

    .icon-iconmingchengpaixu65-copy:before { content: "\e71d"; }

    .icon-mingdanshuju:before { content: "\e62f"; }

    .icon-renzheng:before { content: "\e6af"; }

    .icon-timer:before { content: "\e601"; }

    .icon-liuyan:before { content: "\e60a"; }

    .icon-renyuan:before { content: "\e7e6"; }

    .icon-home:before { content: "\e64c"; }

    .icon-jin:before { content: "\e63e"; }

    .icon-shanchu3:before { content: "\e67c"; }

    .icon-shenpi:before { content: "\e67a"; }

    .icon-yue-2:before { content: "\e602"; }

    .icon-saoma1:before { content: "\e60f"; }

</style>
</head>
<body>
    <div class="container" id="container"></div>
    

    <!-- 右上角扫码 -->
    <i id="scanQRCode" class="iconfont icon-saoma1 scan_qrcode" style="font-size: 20px"></i>
    <!-- 底部菜单 -->
    <div id="tabbar" class="tabbar"></div>

<!-- 底部菜单模版 -->
<script id="dot_tabbar" type="text/x-dot-template">
    <a data-id="home">
        <i class="iconfont icon-home"></i>
        <p>{{=app.lang.menu_home}}</p>
    </a>
    <a data-id="tree">
        <i class="iconfont icon-xinzaolindi"></i>
        <p>{{=app.lang.menu_tree}}</p>
    </a>
    <a data-id="record">
        <i class="iconfont icon-iconmingchengpaixu65-copy"></i>
        <p>{{=app.lang.menu_record}}</p>
    </a>
    <a data-id="me" class="head">
        <img id="avatar">
        <p>{{=app.lang.menu_me}}</p>
    </a>
</script>

<!-- 主页 -->
<script id="dot_tooltip" type="text/x-dot-template">
    <div class="tooltip" style="width:{{=it.tip.width}}px" onclick="activeTip({{=it.id}})" ondblclick="loadTree({{=it.id}})">
        {{=app.language=='zh_CN'?it.name:it.ldname}}
        <p>{{=it.id}}</p>
        {{?in24hours(it.time)}}<i></i>{{?}}
    </div>
</script>
<script id="dot_imagetip" type="text/x-dot-template">
    <li data-id="{{=it.id}}" style="background-image:url({{=it.tip.image}})">
        <h4>{{=it.type?app.lang.work[it.type]:''}}</h4>
        <p>{{=it.time?string2shortTime(it.time):''}}</p>
    </li>
</script>
<script id="tpl_home" type="text/html">
    <div id="home" class="page">
        <div id="map"></div>
        <div id="imagetip" class="imagetip"></div>
    </div>
    <style type="text/css">
        #map{
            position:absolute;
            top:0;
            bottom:0;
            left: 0;
            right: 0;
        }
        #imagetip{
            position:absolute; 
            bottom:49px; 
            height: 100px; 
            white-space: nowrap; 
            opacity: 0.95;
        }
        .imagetip li{
            display: inline-block;
            height: 100%;
            width: 150px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .imagetip li *{
            position: absolute;
            line-height: 14px;
            color: #fff;
            text-shadow: 1px 1px 1px #000;
            text-align: center;
            width: 150px;
            opacity: 0.8;
        }
        .imagetip li i{
            top: 0;
            display: block;
            height: 3px;
            background-color: #FF0000;
        }
        .imagetip h4{
            bottom: 12px;
            font-size: 14px;
            overflow: hidden;
            font-weight: normal;
        }
        .imagetip p{
            bottom: 0;
            font-size: 10px;
        }

        .tooltip{
            position: absolute;
            margin-left: -30px;
            padding: 4px 2px;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.3);
            background-color: #fff; 
            border-radius: 2px;
            opacity: 0.9;
            font-size: 14px;
            line-height: 14px;
            text-align: center;
            /*font-weight: bold;*/
            z-index: 1000000000;
        }
        .tooltip:before {
            position: absolute;
            content: "";
            bottom: -8px;
            left: 22px;
            border: 8px solid transparent;
            border-bottom: 0;
            border-top-color: rgba(0,0,0,0.3);
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
        .tooltip.active{
            color: #fff;
            background-color: #FF0000;
            z-index: 10000000001;
        }
        .tooltip.active:after {
            position: absolute;
            content: "";
            bottom: -7px;
            left: 23px;
            border: 7px solid transparent;
            border-bottom: 0;
            border-top-color: #FF0000;
        }
        .tooltip p {
            font-size: 10px;
        }
        .tooltip i {
            position: absolute;
            left: 10px;
            bottom: -28px;
            width: 40px;
            height: 40px;
            box-shadow: 0 0 0 5px #fff;
            background-color: #FF0000;
            border-radius: 100%;
            -webkit-animation: sk-pulseScaleOut 1s infinite ease-in-out;
                    animation: sk-pulseScaleOut 1s infinite ease-in-out; 
        }
        @-webkit-keyframes sk-pulseScaleOut {
          0% {-webkit-transform: scale(0);transform: scale(0); }
          100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0; }
        }

        @keyframes sk-pulseScaleOut {
          0% {-webkit-transform: scale(0);transform: scale(0); }
          100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0; } 
        }     
    </style>
    <script type="text/javascript">
        var dot_tooltip = doT.template(document.getElementById('dot_tooltip').text);
        var dot_imagetip = doT.template(document.getElementById('dot_imagetip').text);

        if (typeof qq == 'undefined') {
            // 没有加载过QQ地图
            loadJS('https://map.qq.com/api/js?v=2.exp&callback=initMap');
        } else {
            initMap();
        }

        function initMap() {
            if (!app.mapdata) {
                loadMapData();
                window.setTimeout(initMap,100);
                return;
            }

            // 获取dom元素添加地图信息
            app.map = new qq.maps.Map(document.getElementById('map'), {disableDefaultUI: true});
            
            // 在地图上插入标签
            initTooltipOverlay();
            overlayOnMap();

            // 移除地图版本号
            removeMapVersion('map');


            // 当地图中心属性更改时触发事件
            // 如果当前激活的项目没有在窗口内，将窗口内的 第一个overlay激活，如果当前窗口没有overlay，全部不激活
            qq.maps.event.addListener(app.map, 'bounds_changed', function() {
                var mapbounds = app.map.getBounds();
                if (mapbounds) {
                    if (!mapContains(mapbounds, getDataByID(app.activeTipid))) {
                        for (var i = 0, len = app.mapdata.length; i < len; i++) {
                            var data = app.mapdata[i];
                            if (mapContains(mapbounds, data)) {
                                activeTip(data.id);
                                break;
                            }
                        }
                    }
                }
            });
        }
        // 判断数据是否在当前地图内
        function mapContains(mapbounds, data) {
            if (data.x && data.y) {
                return mapbounds.contains(new qq.maps.LatLng(data.x, data.y));
            } else {
                return false;
            }
        }

        // 地图标签
        function TooltipOverlay(html, x, y) {
                this.div = $(html);
                this.x = x;
                this.y = y;
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

        // 加载地图标签和图片标签
        function overlayOnMap() {
            var mapdata = app.mapdata;
            // 根据数据坐标初始化地图边界
            app.map.fitBounds(getMapBounds(mapdata));

            // 移除多余
            for (var id in app.imagetip) {
                if (!getDataByID(id)) {
                    $('#imagetip [data-id="' + id + '"]').remove();
                    delete app.imagetip[id];

                    app.overlay[id].setMap(null);
                    delete app.overlay[id];
                }
            }

            for (var id in app.overlay) {
                if (!getDataByID(id)) {
                    app.overlay[id].setMap(null);
                    delete app.overlay[id];
                }
            }


            // 添加新的
            for (var i = 0; i<mapdata.length; i++) {
                var data = mapdata[i];

                // 计算标签数据
                data.tip = getTooltip(data);

                // 图片标签
                if (!app.imagetip[data.id]) {
                    $('#imagetip').append(dot_imagetip(data)); 
                    app.imagetip[data.id] = 1;
                }

                // 地图标签
                if (data.x && !app.overlay[data.id]) {
                    var overlay = new TooltipOverlay(dot_tooltip(data), data.x, data.y);

                    overlay.setMap(app.map);
                    app.overlay[data.id] = overlay;
                }

                delete data.tip;
            }
                
            // 图片标签复位
            app.imagetipX = 0;
            $('#imagetip').css({"transform":"translateX(0)","-webkit-transform":"translateX(0)"});

            // 只有一个地图标签激活
            if (typeof app.activeTipid != 'undefined' && app.activeTipid != app.mapdata[0].id) {
                if (app.overlay[app.activeTipid]) {
                    $(app.overlay[app.activeTipid].div).removeClass('active');
                }
                
            }

            // 激活标签
            if (!app.imageActiveTip) app.imageActiveTip = $('<i></i>');
            var id = $('#imagetip').children().first().append(app.imageActiveTip).data('id');

            app.activeTipid = id;
            if (app.overlay[id]) $(app.overlay[id].div).addClass('active');
        }

        // 计算标签数据
        function getTooltip(data) {
            var tip = {
                    width: Math.max(GetCurrentStringWidth(app.language=='zh_CN'?data.name:data.ldname,14), 
                                    GetCurrentStringWidth(data.id,10)) //计算标签宽度
                };

            if (data.photo) {
                var photos = data.photo.split(';');
                photo = photos[photos.length-1];

                tip.image = ( photo.substr(-1)=='v'?'videos/':'photos/m/' )+photo+'.jpg';
                tip.time = getPhotoTime(photo);
            } else {
                result.image = 'photos/0.jpg';
            }

            return tip;
        }

        // 图片标签索引
        function getImagetipIndexByID(id) {
            id = id.toString();
            var $imagetips = $('#imagetip').children();
            for (var i = 0, len = $imagetips.length; i < len; i++) {
                if ($imagetips.eq(i).data('id') == id) {
                    return i;
                } 
            }
        }
        // 激活标签
        function activeTip(id, imagetipIndex) {
            if (app.activeTipid == id) {
                var translateX = 'translateX(' + app.imagetipX + 'px)';
                $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
                return;
            }
            app.activeTipid = id;

            if (app.overlay[id]) {
                $(app.overlay[id].div).addClass('active').siblings('.active').removeClass('active');
            }

            $imagetip = $('#imagetip [data-id="' + id + '"]');
            if ($imagetip.length) {
                if (imagetipIndex || imagetipIndex==0) {
                    // imagetip激活，如果不在当前视图，移到中心
                    var data = getDataByID(id);
                    if (!mapContains(app.map.getBounds(), data)) {
                        app.map.panTo(new qq.maps.LatLng(data.x, data.y));
                    }
                } else {
                    imagetipIndex = getImagetipIndexByID(id);
                }

                $imagetip.append(app.imageActiveTip.show());
                app.imagetipX = -( imagetipIndex * ($('#imagetip li').width()+10) - 30);
                if (app.imagetipX>0) app.imagetipX = 0;
                // 滚动
                var translateX = 'translateX(' + app.imagetipX + 'px)';
                $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
            } else {
                app.imageActiveTip.hide();
            }
        }
        // 根据id获取数据
        function getDataByID(id) {
            for (var i = app.mapdata.length - 1; i >= 0; i--) {
                var data = app.mapdata[i];
                if (data.id == id) return data;
            }
        }

        // 滑动图片
        function onImagetipTouchstart(event) {
            var touch = event.targetTouches[0];
            app.touchX = touch.clientX;
            app.touchTime = new Date().getTime();

            $('#imagetip').on('touchmove', onImagetipTouchmove);
            $('#imagetip').on('touchend', onImagetipTouchend);
        }
        function onImagetipTouchmove(event) {
            var touch = event.targetTouches[0];
            var deltaX = app.touchX - touch.clientX;

            var translateX = 'translateX(' + (app.imagetipX-deltaX) + 'px)';
            $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
        }
        function onImagetipTouchend(event) {
            var touch = event.changedTouches[0];
            var deltaX = app.touchX - touch.clientX;
            if (deltaX>50) {
                // 向后找
                var n = Math.round(deltaX/($('#imagetip li').width()+10));
                if (n==0) n = 1;

                var $imagetips = $('#imagetip').children();
                var index = getImagetipIndexByID(app.activeTipid) + n;
                var maxIndex = $imagetips.length - 1;
                if (index>maxIndex) index = maxIndex;

                activeTip($imagetips.eq(index).data('id'), index);
            } else if (deltaX<-50) {
                // 向前找
                var n = Math.round(deltaX/($('#imagetip li').width()+10));
                if (n==0) n = -1;

                var index = getImagetipIndexByID(app.activeTipid) + n;
                if (index<0) index = 0;
                
                activeTip($('#imagetip').children().eq(index).data('id'), index);
            } else {
                if (Math.abs(deltaX)<5 && new Date().getTime()-app.touchTime<200 ) {
                    var id = $(touch.target).data('id') || $(touch.target).parent().data('id');
                    if (id) {
                        if (id==app.activeTipid) {
                            loadTree(id);
                        } else {
                            activeTip(id);
                        }
                    }
                } else {
                    var translateX = 'translateX(' + app.imagetipX + 'px)';
                    $('#imagetip').css({"transform":translateX,"-webkit-transform":translateX});
                }
            }

            $('#imagetip').off('touchmove', onImagetipTouchmove);
            $('#imagetip').off('touchend', onImagetipTouchend);
        }

        // 计算数据的地图边界
        function getMapBounds(datas) {
            var minLat=1000, minLng=1000, maxLat=0, maxLng=0;
            for (var i = datas.length - 1; i >= 0; i--) {
                var data = datas[i];
                    
                if (data.x && data.y) {
                    if (data.x<minLat) minLat=data.x;
                    if (data.x>maxLat) maxLat = data.x;

                    if (data.y<minLng) minLng=data.y;
                    if (data.y>maxLng) maxLng = data.y;
                }
            }

            var sw = new qq.maps.LatLng(maxLat, maxLng); //西南角坐标
            var ne = new qq.maps.LatLng(minLat, minLng); //东北角坐标
            return new qq.maps.LatLngBounds(ne, sw); //矩形的地理坐标范围
        }

        // 移除地图版本号
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

        function loadMapData() {
            if (app.isDataLoading) return;    
            app.isDataLoading = true;
                
            $.getJSON('com/getMapData.php', function(json) {
                app.isDataLoading = false;
                app.mapdata = json;
            });
        }

        app.overlay = {};
        app.imagetip = {};

        $('#imagetip').on('touchstart', onImagetipTouchstart);        

        loadMapData();
    </script>
</script>


<!-- 苗木列表 -->
<script id="tpl_tree" type="text/html">
<div class="page treeSelector">
    <section id="packageList" class="left"></section>
    <section id="nameList" class="middle"></section>
    <section id="treeList" class="right" ></section>
</div>
<style type="text/css">
    .treeSelector section{
        position:absolute;
        top:0;
        bottom:0;
        line-height: 45px;
        overflow-y:auto;
        -webkit-overflow-scrolling:touch;
        /*font-size: 12px;*/
    }
    .treeSelector .left{
        float: left;
        background-color:#ccc;
        left:0;
        width: 30%;
        padding-bottom: 40px;
        text-align: center;
        padding-bottom: 50px;
    }
    .treeSelector .middle{
        float: left;
        background-color:#ddd;
        left:30%;
        width: 30%;
        padding-bottom: 40px;
        text-align: center;
        padding-bottom: 50px;
    }
    .treeSelector .right{
        float: right;
        right:0;
        width: 40%;
        line-height: 18px;
        padding-bottom: 100px;
        text-align: center;
    }
    .treeSelector .right p{
        font-size: 10px;
        color: #999;
    }
    .treeSelector .on{
        background-color: #eee;
        box-shadow: -30px 0 15px rgba(0,0,0,.3);
    }
    .treeSelector .left .on{
        background-color: #ddd;
    }
    .treeSelector .right li{ 
        margin: 0 10px;
        padding-top: 5px;
        height: 39px;
        border-bottom: 1px solid #ddd;
    }    
</style>
<script type="text/javascript">
    function loadTreeList(trees) {
        // 数据已经按包、名称、编号排好序
        
        var packagelist = [];

        for (var i in trees) {
            var tree = formatTreeData(trees[i]);
            // var tree = trees[i];
            // 包列表
            if ($.inArray(tree.package, packagelist)==-1) {
                packagelist.push(tree.package);
            }
        }

        // 按包名称排序
        try{
            packagelist.sort(function(x, y){
                return x[0].localeCompare(y[0]);
            });
        }catch(e){}
        packagelist.unshift(app.lang.all);

        var $packagelist = $('#packageList').html('');
        for (var i in packagelist) {
                var $li = $('<li/>').html(packagelist[i])
                                    .on('click', function() {
                                        $(this).addClass('on').siblings('.on').removeClass('on');
                                        loadTreeByPackage($(this).html());
                                    });
                $packagelist.append($li);
        }

        // 激活第一个
        $('#packageList').children().first().addClass('on');
        loadTreeByPackage(packagelist[0]);
    }

    function loadTreeByPackage(package) {
        app.package = package;

        var namelist = [];

        for (var i in app.trees) {
            var tree = app.trees[i];
            if ( (package==app.lang.all || package==tree.package) && $.inArray(tree.name, namelist)==-1) {
                namelist.push(tree.name);
            }
        }
        namelist.push(app.lang.all);

        var $namelist = $('#nameList').html('');
        for (var i in namelist) {
            var $li = $('<li/>').html(namelist[i])
                                .on('click', function() {
                                    $(this).addClass('on').siblings('.on').removeClass('on');
                                    loadTreeByName($(this).html());
                                });
            $namelist.append($li);
        }

        $('#nameList').children().first().addClass('on');
        loadTreeByName(namelist[0]);
    }

    function loadTreeByName(name) {  
        var $treelist = $('#treeList').html('');
        var treelist = [];

        for (var i in app.trees) {
            var tree = app.trees[i];
            if (tree.name==name && (app.package==app.lang.all || tree.package==app.package)) {
                treelist.push({
                    id: tree.id, 
                    height: tree.height1==0&&tree.height2==10000?'':(tree.height1==tree.height2?tree.height1:tree.height1+'-'+tree.height2),
                    dbh: tree.dbh1==0&&tree.dbh2==10000?'':(tree.dbh1==tree.dbh2?tree.dbh1:tree.dbh1+'-'+tree.dbh2),
                    width: tree.width1==0&&tree.width2==10000?'':(tree.width1==tree.width2?tree.width1:tree.width1+'-'+tree.width2)
                });
            }
        }
        // 按编号排序
        treelist.sort(function(x, y){
            return x.id > y.id ? 1 : -1;
        });

        // 写入列表
        for (var i in treelist) {
            var tree = treelist[i];

            var html = 'NO.' + tree.id + '<p>'
                     + (tree.height ? app.lang.height + tree.height + ' ' : '')
                     + (tree.dbh ? app.lang.dbh + tree.dbh + ' ' : '') 
                     + (tree.width ? app.lang.width + tree.width : '')
                     + '</p>' ;

            var $li = $('<li/>').html(html)
                                .attr('data-id', tree.id)
                                .on('click', function() {
                                    loadTree($(this).data('id'));
                                });
            $treelist.append($li);
        }
    }

    $.getJSON('com/getTreeList.php', function (json) {
        app.trees = json;
        loadTreeList(app.trees);
    })
</script>
</script>



<!-- 苗木详情 -->
<script id="dot_treeview" type="text/x-dot-template">
    <table><tbody>
        <tr><th colspan="2">{{=it.name}}</th></tr>
        {{?it.pinyin}}<tr><td class="ldname" colspan="2">{{=it.pinyin}}</td></tr>{{?}}
        {{?it.ldname}}<tr><td class="ldname" colspan="2">{{=it.ldname}}</td></tr>{{?}}
        <tr><td class="ldname" colspan="2">{{=it.package+', '+it.co+', '+it.de}}</td></tr>
        <tr><td class="ldname" colspan="2">NO.{{=it.id}}</td></tr>
        <tr><td class="ldname" colspan="2">&nbsp;</td></tr>

        <tr><td class="field">{{=app.lang.height}}<span class="unit">{{=app.lang.m}}</span></td>
            <td><input id="height" onkeyup="checkValue('height')" type="text" placeholder＝"{{=app.lang.maximum}} 20" value="{{=it.height1==0&&it.height2==10000?'':(it.height1==it.height2?it.height1:it.height1+'-'+it.height2)}}"/></td>
        </tr>
        <tr><td class="field">{{=app.lang.dbh}}<span class="unit">{{=app.lang.cm}}</span></td>
            <td><input id="dbh" type="text" onkeyup="checkValue('dbh')"  placeholder＝"{{=app.lang.maximum}} 100" value="{{=it.dbh1==0&&it.dbh2==10000?'':(it.dbh1==it.dbh2?it.dbh1:it.dbh1+'-'+it.dbh2)}}"/></td>
        </tr>
        <tr><td class="field">{{=app.lang.width}}<span class="unit">{{=app.lang.m}}</span></td>
            <td><input id="crownwidth" type="text" onkeyup="checkValue('crownwidth')" placeholder＝"{{=app.lang.maximum}} 20" value="{{=it.width1==0&&it.width2==10000?'':(it.width1==it.width2?it.width1:it.width1+'-'+it.width2)}}"/></td>
        </tr>

        <tr><td colspan="2"><input id="notes" type="text" placeholder="{{=app.lang.notes+': '+ app.lang.atmost+' 30 '+app.lang.character}}" value="{{=it.notes}}"/></td></tr>
    </tbody></table>
    {{for(var i in it.record) { }}
        {{{var photos=it.record[i].photo.split(';'); var gpss=it.record[i].photogps.split(';')}}}
        {{for(var j in photos) { }}
            <div style="text-align:center;">
                <a href="javascript:;"><img src="photos/o/{{=photos[j]}}.jpg" /></a>
                <br>
                {{?gpss[j]}}<a class="poi2" href="https://apis.map.qq.com/uri/v1/marker?marker=coord:{{=gpss[j]}};title:{{=it.name}}&referer=geo"></a>{{?}}
                <div class="phototime">{{=it.record[i].time}}</div>
            </div>
        {{ } }}
    {{ } }}
</script>
<script id="tpl_treeview" data-id="remove" type="text/html">
    <div class="page fullpage">
        <div id="treeview" class="page" style="display: block;"></div>
    </div>
    <style type="text/css">
        #treeview{
            position: absolute;
            top: 0;
            width: 100%;
            background-color: #fff;
            font-size: 18px;
            border-left: 10px solid #fff;
            border-right: 10px solid #fff;
            box-sizing: border-box;
            padding: 10px 0 80px 0;
            /*z-index: 1001;*/
        }
        #treeview img{
            width: 100%;
            margin-top: 10px;
            border-radius: 2px;
        }
        #treeview .header{
            position: fixed;
            top: 0;
            left: 0;
            padding: 5px 0 5px 0;
            width: 100%;
            height: 32px;
            line-height: 32px;
            background-color: #fff;
            box-shadow: 0 1px 5px rgba(0,0,0,.3);
            opacity: 0.9;
        }
        #treeview .back{
            background: url(/img/back.png) no-repeat;
            background-size:10px 18px;
            background-position: 0px 1px;
            padding-left: 14px;
            margin-left: 10px;
            line-height: 18px;
            height: 18px;
            color: #999;
        }
        #treeview table{
            margin-top: 43px;
            width: 100%;
            /*background-color: #eee;*/
            border-radius: 2px;
            /*border: 5px solid #eee;*/
            box-sizing: border-box;
        }
        #treeview table th{
            font-size: 24px;
        }
        #treeview table .ldname{
            font-size:14px;
            color:#bbb;
            text-align: center;
        }
        #treeview table .price{
            font-size: 24px;
            font-weight: bold;
            color: #f39700;
        }
        #treeview table .field{
            text-align: right;
            width: 50%;
            color: #bbb;    
        }
        #treeview table .field span{
            font-size: 10px;
            color: #ccc;
        }
        #treeview input,#treeview textarea{
            height: auto;
            padding: 5px 10px;
            line-height: 1.428571429;
            vertical-align: middle;
            border-radius: 4px;
            outline: none !important;
            background-image: none;
            box-sizing: border-box;
            text-rendering: auto;
            letter-spacing: normal;
            word-spacing: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            font-size: 20px;
            width: 100px;
        }
        #treeview table input{
            width: 100%;
        }
        #treeview #notes{
            text-align: center;
        }

        #treeview .renzheng, #treeview .qjd, #treeview .cangmi{
            margin-top:7px;
        }

        #treeview button{
            margin-top: 10px;
            width: 100%;
            height: 42px;
            background-color: #FF7F00;
            border: 0;
            border-radius: 5px;
            font-size: 18px;
            color: #fff;
        }        
    </style>
    <script type="text/javascript">
        var dot_treeview = doT.template(document.getElementById('dot_treeview').text);            

        function showtree (tree) {
            var html = tree ? dot_treeview(tree) : app.lang.nodata;
            $('#treeview').html(html);
            // $('#treeview input').attr('readonly','readonly');//将input元素设置为readonly
              // 　　$('input').removeAttr("readonly");//去除input元素的readonly属性

            // 图片


            // 地图
        }

        function checkValue(id) {
            $this = $('#'+id);
            var value = $this.val().replace(' ',''); //去掉空格
            $this.val(value.replace(/[^\d.d{0,2}-]/g,''));         
        }

        // 修改
        function updatetree (i) {
            var data = {};

            var height = $('#height').val().replace(' ',''); //去掉空格
            if (height) {
                height = height.split('-');
                data["height1"] = parseFloat(height[0]);
                if (height.length>1) {
                    data["height2"] = parseFloat(height[1]);
                }
            } else {
                data.height1 = 0;
                data.height2 = 10000;
            }

            var dbh = $('#dbh').val().replace(' ',''); //去掉空格
            if (dbh) {
                dbh = dbh.split('-');
                data.dbh1 = parseFloat(dbh[0]);
                if (dbh.length>1) {
                    data.dbh2 = parseFloat(dbh[1]);
                }
            } else {
                data.dbh1 = 0;
                data.dbh2 = 10000;
            }

            var width = $('#crownwidth').val().replace(' ',''); //去掉空格
            if (width) {
                width = width.split('-');
                data.width1 = parseFloat(width[0]);
                if (width.length>1) {
                    data.width2 = parseFloat(width[1]);
                }
            } else {
                data.width1 = 0;
                data.width2 = 10000;
            }

            data.notes = $('#notes').val().trim(); //去掉收尾空格

            console.log(data);

            $.post('com/updateTree.php', {data:data, treeid:app.treeid}, function (r) {
                console.log(r);
                $('#treeview input').attr('readonly','readonly').addClass('readonly');
                // alert('修改成功！');
            });
        }        

        $(function () {
            $.getJSON('com/getTree.php',{treeid: app.treeid},function (json) {
                json && (app.tree = formatTreeData(json));
                showtree(app.tree);
            });
        })

    </script>
</script>

<!-- 上传图片 -->
<script id="dot_upload" type="text/x-dot-template">
    <div class="title">
        <span id="areanumber"></span><span id="projectname"></span>
    </div>

    <div id="workitems" class="weui-cells">
        {{for(var i in it) { }}
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            {{{var items=it[i]}}}
            {{for(var j in items) { }}
            <label class="{{=app.language=='zh_CN'?'workitem':'workitem_en'}}"> 
                <input type="radio" name="work" value="{{=items[j]}}" class="weui-check"> 
                <i class="weui-icon-checked"></i>{{=app.lang.work[items[j]]}} 
            </label>
            {{ } }}
        </div>
        {{ } }}
        <div class="weui-cell weui-cells_checkbox">
            <label class="weui-label">
                    <input type="radio" name="work" value="8" class="weui-check">
                    <i class="weui-icon-checked"></i>{{=app.lang.other}}
            </label>
            <input id="otherwork" class="weui-input" type="text" maxlength="10" placeholder="{{=app.lang.input_work_name}}">
        </div>
    </div>

    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">{{=app.lang.upload_photo}}</p>
                    </div>
                    <div class="weui-uploader__bd photolist">
                        <ul class="weui-uploader__files" style="width: 100%" id="uploaderFiles"></ul>
                        <ul class="input-box">
                            <div class="weui-uploader__input-box h5-upload none">
                                <input id="uploaderInput" class="weui-uploader__input" type="file" multiple />
                            </div>
                            <div class="weui-uploader__input-box weui-upload android-input-box none">{{=app.lang.multiple_photos}}</div>
                            <div class="weui-uploader__input-box weui-upload weui-uploader__camera none" data-type="camera"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="uploading" class="alert">{{=app.lang.upload_notexit}}</div>

    <div class="weui-gallery" id="gallery">
        <span class="weui-gallery__img" id="galleryImg"></span>
        <div class="weui-gallery__opr">
            <a href="javascript:;" class="weui-gallery__del">
                <i class="weui-icon-delete weui-icon_gallery-delete"></i>
            </a>
        </div>
    </div>

    <div class="js_dialog" id="iosDialog1" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">{{=app.lang.confirmation_delete}}</strong></div>
            <div class="weui-dialog__bd"></div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">{{=app.lang.cancel}}</a>
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">{{=app.lang.ok}}</a>
            </div>
        </div>
    </div>
</script>
<script id="tpl_upload" data-id="remove" type="text/html">
    <div class="page">
        <div id="upload" class="page" style="display: block;">
        </div>
    </div>
    <link rel="stylesheet" href="css/weui.min.css"/>

    <style type="text/css">
        #upload{
            margin-bottom: 49px;
        }
        .weui-cells{
            margin-top: 10px;
        }
        .weui-cell{
            padding: 10px;
        }
        .weui-cell:before{
            left: 10px;
        }
        .title{
            padding: 10px;  
            box-shadow: 0 1px 5px rgba(0,0,0,.3);
            background-color: #4E4D5D;
            color: #fff;
        }
        .title img{
            float: right;
            height: 24px;
            width: 24px;
            margin-left: 10px;
        }
        #projectname{
            color: #ccc;
            padding-left: 5px;
            font-size: 8px;
        }
        .weui-cells_checkbox .weui-icon-checked:before {
            font-size: 20px;
            line-height: 22px;
        }
        [class*=" weui-icon-"]:before, [class^=weui-icon-]:before {
             margin-left: 0; 
             margin-right: 0; 
        }
        [class*=" weui-icon-"], [class^=weui-icon-] {
            vertical-align: bottom;
        }
        .weui-cells_checkbox .weui-icon-checked:before {
            font-size: 18px;
            line-height: 20px;
        }
        .photolist{
            text-align: center;
        }
        .weui-uploader__input-box, .weui-uploader__file{
            float: none;
            display: inline-block;
        }
        .weui-uploader__files{
            display: inline-block;
        }
        .workitem{
            width: 33%;
            display: inline-block;
            font-size: 14px;
        }
        .workitem_en{
            width: 50%;
            display: inline-block;
            font-size: 12px;
        }
        .input-box .weui-uploader__input-box {
            line-height: 140px;
            color: #ccc;
            font-size: 10px;
            vertical-align: middle;
        }
        .input-box{
            width: 100%;
        }
        .weui-uploader__camera{
            background-image: url(img/camera.png);
            background-size: cover;
        }
        .weui-uploader__camera:before, .weui-uploader__camera:after{
            display: none;
        }
        .alert{
            display: none; position: fixed; top: 0; width: 100%;height: 55px; background-color: red;color: #fff; line-height: 55px; text-align: center;
        }
        .none{
            display: none;
        }        
    </style>

    <script type="text/javascript">

        var dot_upload = doT.template(document.getElementById('dot_upload').text);            

        var record, localIds, localIdsIndex, gps, uploadIndex, uploadData;

        var work_items = [
            [40,41,42,43,44],
            [3],
            [19,20,21,17,22],
            [9,10,11,12,13],
            [23,24,25,26,27],
            [28,29,30,31,32],
            [15,33,34],
            [35,6],
            [36,37,38]
        ];
        // var tmpl2 = '<li id="#id#" class="weui-uploader__file" style="background-image:url(#url#)"></li>',
        var tmpl2 = '<li id="#id#" class="weui-uploader__file" style="background-image:url(#url#)"></li>',
            tmpl = '<li id="upload#id#" class="weui-uploader__file"><img style="width:100%;height:100%;opacity:0.6" src="#url#"></li>',
            tmpl1 = '<li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(#url#)"><div id="progress#id#" class="weui-uploader__file-content">1%</div></li>'


        // 检查权限，获取当前养护区、养护记录
        function getRecord(treeid) {
            record = null;
            $.getJSON('com/record.get.php', {treeid:treeid, userid:user.id, role:user.role}, function(json) {
                if (json) {
                    var tree = json.tree;
                    $('#areanumber').html(tree.name);
                    $('#projectname').html('No.'+tree.id+' '+tree.package);

                    // 有今日养护记录
                    if (json.record) {
                        setRecord(json.record);
                    }           
                } else {
                    // 没有权限
                    pageManager.go('denied'); 
                }
            });
        }

        // 切换工作项目
        function getWork(treeid, type) {
            console.log({treeid:treeid, userid:user.id, role:user.role, type: type});
            record = null;
            $('#uploaderFiles').html('');
            if (type==8) type = $('#otherwork').val();



            $.getJSON('com/record.work.php', {treeid:treeid, userid:user.id, role:user.role, type: type}, function(json) {
                console.log(json);
                if (json) {
                    setRecord(json);
                }
            });    
        }

        // 设置养护信息
        function setRecord(data) {
            record = data;

            // 养护类型
            $("#workitems input[value='"+record.type+"']").prop("checked",'checked');
            if (record.type==8) $('#otherwork').val(record.work);

            var photos = record.photo.split(';');
            for(var i in photos){
                $('#uploaderFiles').append($(tmpl2.replace('#id#',record.id+'-'+photos[i]).replace('#url#', 'photos/m/'+photos[i]+'.jpg')));
            }
        }

        // 删除图片
        function deletePhoto() {
            var id = $("#gallery").fadeOut(100).data('id');
            $('#'+id).remove();
            console.log(id);

            $.post('com/record.delete.photo.php', {id: id}, function(result){
                $("#galleryImg").attr("style", '');
            });
        }

        // 删除当前工作项
        function deleteRecord() {
            $.post('com/record.delete.php', {id: record.id});
            $('#uploaderFiles').html('');
            
            record = null;  
            $("#galleryImg").attr("style", '');   
        }

        // 安卓/iOS上传按钮不同
        function setUploadMode() {
            if (app.isiOS) {   
                $('.h5-upload').css('display','inline-block').append(app.lang.small_photos);                    
                if (app.isWechat) $('.weui-uploader__camera').css('display','inline-block');
            } else {
                if (app.isWechat) $('.weui-upload').css('display','inline-block');
                if (app.isAndroid) {
                    $('.h5-upload').css('display','inline-block').append(app.lang.small_photo);
                    document.getElementById('uploaderInput').multiple = '';
                } else {
                    $('.h5-upload').css('display','inline-block').append(app.lang.small_photos); 
                }
            }
        }


        // h5选择图片上传
        function h5Upload(e) {
            if (e.target.files.length == 0) return;

            // 先检查养护项 是否设置
            var worktype = $("#workitems input:checked").val();
            if (!worktype) {
                alert(app.lang.require_workitem);
                $("#uploaderInput").val('');
                return;
            }
            if (worktype == '8' && $.trim($('#otherwork').val()) == '') {
                alert(app.lang.require_itemname);
                $("#uploaderInput").val('');
                return;
            }

            // 取gps                
            if (app.isWechat) wx.getLocation({
                type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    gps = res.latitude + ',' + res.longitude;
                }
            }); 

            uploadData = {
                worktype: worktype,
            };

            $('#uploading').show();
            uploadIndex = 0;
            h5UploadImage();
        }

        // h5压缩上传
        function h5UploadImage() {
            if (uploadIndex < $("#uploaderInput")[0].files.length) {
                var file = $("#uploaderInput")[0].files[uploadIndex++];

                    lrz(file, {
                        width: 1280,
                        height: 1280
                    }).then(function(rst) {
                        // 显示图片
                        $('#uploaderFiles').append($(tmpl1.replace('#id#', uploadIndex).replace('#url#', rst.base64)));

                        console.log($("#uploaderInput"));

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'com/record.upload.php');

                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                // 上传成功, 移除进度条
                                if (!record) {
                                    record = {
                                        id: xhr.response.split('-')[0]
                                    };
                                }
                                $('#progress' + uploadIndex).parent().removeClass('weui-uploader__file_status').attr('id', xhr.response);
                                $('#progress' + uploadIndex).remove();
                            } else {
                                // 处理错误
                                $('#progress' + uploadIndex).parent().remove();
                                // alert('上传失败, 请重新上传');
                            }
                            // 开始下一个
                            h5UploadImage();
                        };

                        if (xhr.upload) {
                            try {
                                xhr.upload.addEventListener('progress', function(e) {
                                    if (!e.lengthComputable) return false;
                                    // 上传进度
                                    $('#progress' + uploadIndex).html(Math.round(((e.loaded / e.total) || 0) * 100) + '%');
                                });
                            } catch (err) {
                                // console.error('进度展示出错了,似乎不支持此特性?', err);
                            }
                        }

                        var exif = rst.origin.exifdata;
                        console.log(rst);

                        // 照片时间
                        var time = exif.DateTime ? string2Milliseconds(exif.DateTime) : rst.origin.lastModified;
                        rst.formData.append('time', time);
                        console.log(time); 

                        // 照片gps，照片没有gps就用当前位置
                        if (exif.GPSLatitude && exif.GPSLongitude) {
                            alert(exif.GPSLatitude);
                            gps = GPS.qqGps(exif.GPSLatitude.toString(), exif.GPSLatitudeRef, exif.GPSLongitude.toString(), exif.GPSLongitudeRef).toString();
                            rst.formData.append('gps', gps);
                        } else {
                            var now = new Date().getTime()/1000;
                            if (gps && now-time<8) {
                                rst.formData.append('gps', gps);
                            }
                        }
                        alert(gps);
                        console.log('gps', gps); 
                        // 添加参数
                        rst.formData.append('type', uploadData.worktype);
                        rst.formData.append('userid', user.id);
                        rst.formData.append('treeid', app.treeid);

                        console.log(rst.formData);

                        // 上传
                        xhr.send(rst.formData);
                    });
            } else {
                // 传完啦
                uploadData = null;
                $("#uploaderInput").val('');
                $('#uploading').hide();
            }
        }


        // 微信接口选择图片上传
        function wxUpload () {
            // 先检查养护项 是否设置
            var worktype = $("#workitems input:checked").val();
            if (!worktype) {
                alert(app.lang.require_workitem);
                return;
            }
            if (worktype=='8' && $.trim($('#otherwork').val())=='') {
                alert(app.lang.require_itemname);
                return;
            }
            
            uploadData = {worktype: worktype};
            uploadIndex = 0;

            gps = '';
            var isCamera = $(this).data('type')=='camera';
            // if (isCamera){
                // 取gps                
                wx.getLocation({
                    type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                    success: function (res) {
                        gps = res.latitude + ',' + res.longitude;
                    }
                }); 
            // }

            // 选择图片
            wx.chooseImage({
                sizeType: isCamera?['compressed']:['original'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: isCamera?['camera']:['album'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    $('#uploading').show();

                    localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    // 预览图片
                    for(var i in localIds){
                        $('#uploaderFiles').append($(tmpl.replace('#id#',i).replace('#url#', localIds[i])));                
                    }

                    // 逐一上传图片
                    wxUploadImage(0);                
                }
            });
        }

        // 微信接口上传图片
        function wxUploadImage(i) {
            wx.uploadImage({
                localId: localIds[i],
                isShowProgressTips: 1,
                success: function (res) {
                    // 服务器端处理
                    $.post('com/record.wxupload.php',
                        {
                            type: uploadData.worktype,
                            userid: user.id,
                            treeid: app.treeid,
                            mediaId: res.serverId,
                            gps: gps,
                            index: i  // 计数
                        },

                        function (result) {
                            result = result.split('-');

                            // 上传成功
                            if (!record) {
                                record = {
                                    id: result[1]
                                };
                            }

                            $('#upload'+parseInt(result[0])).html('')
                                                            .css('background-image', 'url(photos/m/'+result[2]+'.jpg)')
                                                            .attr('id', result[1] + '-' + result[2]);
                        }
                    );

                    uploadIndex++;
                    if (uploadIndex < localIds.length) {
                        wxUploadImage(uploadIndex);
                    } else {
                        uploadData = null;
                        $('#uploading').hide();
                    }
                }
            });
        }

        // 绑定事件
        function bindEvent() {
            // H5上传
            $("#uploaderInput").on("change", h5Upload);
            // 微信上传
            if (app.isWechat) $('.weui-upload').on('click', wxUpload);


            // 切换工作项
            $("#workitems input").on('click', function() { 
                // 养护项变更后，重新获取该养护项的养护日志
                var worktype = parseInt($("#workitems input:checked").val());
                console.log(worktype)
                if (!record || record.type!=worktype) {
                    getWork(app.treeid, worktype);
                }
            }); 
            // 选中其他
            $('#otherwork').on('focus', function(e) {
                $("#workitems input[value='8']").prop("checked",'checked');
            });


            // 浏览图片、删除图片
            $("#uploaderFiles").on("click", "li", function(){
                $('#iosDialog1 .weui-dialog__bd').html(app.lang.confirmation_delete_notes);
                $('#iosDialog1 .weui-dialog__btn_primary').attr('href', 'javascript:deletePhoto()');

                var img = this.getAttribute("style");
                if (img.length<100) {
                    img = img.replace('/m/', '/o/');
                }
                $("#galleryImg").attr("style", img);
                $("#gallery").data('id', this.id).fadeIn(100);
            });

            $("#gallery").on("click", 'span', function(){
                $("#gallery").fadeOut(100);
                $("#galleryImg").attr("style", '');
            });
            $("#gallery").on("click", '.weui-gallery__del', function(){
                $('#iosDialog1').fadeIn(200);
            });

            // 隐藏对话框
            $('#iosDialog1').on('click', '.weui-dialog__btn', function(){
                $(this).parents('.js_dialog').fadeOut(200);
            });
        }


        $(function(){
            // 设置工作项
            $('#upload').html(dot_upload(work_items));

            // 获取苗木工作项
            getRecord(app.treeid);

            // 绑定事件
            setTimeout(bindEvent, 300);
            // bindEvent();
            // 安卓/iOS上传按钮不同
            setUploadMode();
        });
    </script>
</script>


<!-- 个人中心 -->
<script id="dot_me" type="text/x-dot-template">
    <div class="cell_box" onclick="pageManager.go('profile')">        
        <li class="cell">
            <i class="iconfont icon-renzheng green"></i>
            <span>{{=app.lang.edit_profile}}</span>
            <em></em>
        </li>
    </div>
    {{?$.inArray(user.role,[1,2,3])!=-1}}
    <div class="cell_box">        
        <li class="cell" onclick="pageManager.go('renzheng')">
            <i class="iconfont icon-renzheng green"></i>
            <span>{{=app.lang.authorize}}</span>
            <em></em>
        </li>
    </div>
    {{?}}
    {{?user.role==1}}
    <div class="cell_box">        
        <li class="cell" onclick="pageManager.go('member')">
            <i class="iconfont icon-renzheng green"></i>
            <span>{{=app.lang.member_manager}}</span>
            <em></em>
        </li>
    </div>
    {{?}}
    <div class="cell_box" onclick="changeLanguage()">
        <li class="cell center bg_green">{{=app.lang.change_language}}</li>
    </div>
</script>
<script id="tpl_me" data-id="remove" type="text/html">
    <div id="me" class="page">
        <div class="cell_box">
            <div class="profile_cell">
                <img id="profile_avatar" src="" class="zt_l" width="100%"/>
                <div class="zt_r">
                    <div class="name"></div>
                    <div class="phone"></div>
                    <div class="role"></div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .profile_cell{width:100%;background:#fff;border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;float:left;padding:15px 0;margin-top:10px;}
        .zt_l{width:80px;height:80px;float:left;margin:0 10% 0 4%;border-radius: 50%;border:4px solid #eee}
        .zt_r{float:left;padding-top:10px}
        .zt_r .name{font-size: 17px;line-height: 17px;color:#333}
        .zt_r .phone, .zt_r .role{font-size: 15px;line-height: 15px;color:#666;margin-top:10px}       
    </style>
    <script type="text/javascript">
        var dot_me = doT.template(document.getElementById('dot_me').text); 
        $('#me').append(dot_me());

        // $('#profile .zt_name').html((user.name?user.name:'游客')+' '+(user.phone?user.phone:''));
        $('#me .name').html((user.name?user.name:'游客'));
        $('#me .role').html(app.lang['role'+user.role]);
        if (user.phone) $('#me .phone').html(user.phone);

        $('#profile_avatar').attr('src','avatar/'+user.id+'.jpg')
                            .error(onErrorAvatar);

        function changeLanguage() {
            localStorage.language = app.language=='zh_CN' ? 'en_US' : 'zh_CN';
            window.location.reload();
        }
    </script>
</script>

<!-- 修改个人信息 -->
<script id="dot_profile" type="text/x-dot-template">
    <li class="cell">
       <input id="name" type="text" data-invalid="required" maxlength="5" placeholder="✎ {{=app.lang.name}}">
    </li>
    <li class="cell">
       <input id="phone" type="number" data-invalid="phone" placeholder="✎ {{=app.lang.phone}}">
    </li>
    <li class="cell">
       <input id="company" type="text" data-invalid="required" maxlength="20" placeholder="✎ {{=app.lang.company}}">
    </li>
    <li class="cell center bg_green" onclick="updateUser()">{{=app.lang.ok}}</li>
    <li class="cell center bg_orange" onclick="pageManager.back()">{{=app.lang.cancel}}</li>
</script>

<script id="tpl_profile" data-id="remove" type="text/html">
    <div id="editor" class="page cell_box">        
    </div>

    <script type="text/javascript">
        var dot_profile = doT.template(document.getElementById('dot_profile').text); 
        $('#editor').append(dot_profile());

        $('#name').val(user.name?user.name:'');
        $('#phone').val(user.phone?user.phone:'');
        $('#company').val(user.company?user.company:'');

        function updateUser() {
            if (inputInvalid.check($('#editor'))) {
                var data = {
                    name: $('#name').val(), 
                    phone: $('#phone').val(), 
                    company: $('#company').val()
                }

                user.name = data.name;
                user.phone = data.phone;
                user.company = data.company;

                $.post('com/updateUser.php', {userid:user.id, data:data}, function (result) {
                    alert(app.lang.modify_ok);
                    pageManager.back();
                });
            }
        }
    </script>


</script>


<!-- 认证角色 -->
<script id="dot_renzheng" type="text/x-dot-template">
    <div class="cell_box">        
        <li data-role="1" class="cell none admin">
            <i class="iconfont icon-renzheng blue"></i>
            <span>{{=app.lang.role1}}</span><em></em>
        </li>
        <li data-role="2" class="cell none super">
            <i class="iconfont icon-renzheng blue"></i>
            <span>{{=app.lang.role2}}</span><em></em>
        </li>
        <li data-role="3" class="cell none super work">
            <i class="iconfont icon-renzheng blue"></i>
            <span>{{=app.lang.role3}}</span><em></em>
        </li>
        <li data-role="4" class="cell none super">
            <i class="iconfont icon-renzheng blue"></i>
            <span>{{=app.lang.role4}}</span><em></em>
        </li>
    </div>
</script>
<script id="tpl_renzheng" data-id="remove" type="text/html">
    <div id="renzheng" class="page">
    </div>
    <script type="text/javascript">
        var dot_renzheng = doT.template(document.getElementById('dot_renzheng').text);            
        
        $(function(){
            // 设置工作项
            $('#renzheng').html(dot_renzheng(app));

            if ($.inArray(user.role,[1,2,3]) == -1) {    
                pageManager.back(); // 没有权限
            } else if (user.role==1 || user.role==0) {        
                $('#renzheng .none').show(); // 管理员, 解锁 区域经理、现场负责人
            } else if (user.role==2) {        
                $('#renzheng .super').show(); // 超级管理员, 解锁 全部
            } else if (user.role==3) {
                $('#renzheng .work').show(); // 区域经理，解锁 现场负责人       
            }

            $('#renzheng .cell_box').on('click', 'li',function () {
                var role = parseInt(this.dataset.role);
                app.renzheng = {
                    role: role,
                    rolename: app.lang['role'+role],
                    userid: user.id,
                    expired: app.lang.expired,
                    time: new Date().getTime()
                };

                window.pageManager.go('renzheng_admin'); // 填写管理员认证信息
            });            

        });        
    </script>
</script>

<!-- 认证二维码 -->
<script type="text/html" data-id="remove" id="tpl_renzheng_admin">
<div id="renzheng_admin" class="page">
    <div id="qrcode" class="cell_box center">        
        <img class="qrcode" src=""><br><p class="prompt"></p>
    </div>
</div>
<style type="text/css">
    .qrcode{
        max-width: 100%; margin-top: 15px; border-radius: 5px;
    }
</style>
<script type="text/javascript">
    $(function(){
        $.get('com/renzheng.php', app.renzheng, function (id) {
            id = parseInt(id); // %20id 多出空格
            if (id) {
                app.renzheng.id = id;
                $('#renzheng_admin #qrcode img').attr('src', 'qrcode/renzheng/'+id+'.jpg');
                $('#renzheng_admin #qrcode p').html(app.lang.forward_qrcode);
            } else {
                // alert('认证失败，请重新认证');
                pageManager.back();
            }
        });
    });
</script>
</script>

<!-- 人员管理 -->
<script id="dot_member" type="text/x-dot-template">
    {{for(var i in it) { }}
    <li data-id="{{=it[i].id}}">
        <img src="avatar/{{=it[i].id}}.jpg" onerror="onErrorAvatar()">
        <p>{{=it[i].name}}</p>
        <p>{{=app.lang['role'+it[i].role]}}</p>
    </li>
    {{ } }}
</script>
<script id="tpl_member" data-id="remove" type="text/html" >
    <div id="member" class="page member bottom-50"></div>
    <style type="text/css">
        .member li{
            float: left;
            width: 33.33%;
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
        .member img {
            width: 90px;
            height: 90px;
            border-radius: 100%;
        }
    </style>
    <script type="text/javascript">
        MEMBER_LI_HEIGHT = 150;
        MEMBER_COLUMN = 3;
        var number = Math.ceil($(window).height()/MEMBER_LI_HEIGHT+1)*MEMBER_COLUMN;

        var dot_member = doT.template(document.getElementById('dot_member').text);

        function loadMember(where, isReload) {
            if (app.isDataLoading) return;

            $('#member').append($('#html_loadmore').html());
            app.isDataLoading = true;

            var limit = $('#member li').length + ',' + number;

            $.getJSON('com/user.search.php', {limit:limit}, function(json) {
                $('#member').append(dot_member(json));

                // 没有数据或少于请求数据的数量，加载完了
                if (!json || json.length<number) {
                    app.isEndMember = true;                   
                }

                app.isDataLoading = false;
                $('#member .weui-loadmore').remove();
            });
        }


        delete app.isEndMember;

        loadMember();

        // 向下滚屏，持续加载
        $('#member').scroll(function () {
                        if (app.isDataLoading || app.isEndMember) return;
                        
                        var scrollHeight = $(this)[0].scrollHeight;//滚动距离总长(注意不是滚动条的长度)
                        var scrollTop = $(this)[0].scrollTop;//滚动到的当前位置
                        var elementHight = $(this).height();//视窗高度

                        if(scrollTop + elementHight >= scrollHeight-50) {
                            loadMember(yangshu.memberWhere);
                        } 
                    })
                    .on('click', 'li',function () {
                        alert(1);
                        // loadRecord({userid: $(this).data('id')});                           
                    })

    </script>
</script>


<!-- loadmore -->
<script id="html_loadmore" type="text/html">
    <div class="weui-loadmore">
        <i class="weui-loading iconfont icon-loading"></i>
        <span class="weui-loadmore__tips">正在加载</span>
    </div>
</script>
<script id="html_nodata" type="text/html">
    <div class="weui-loadmore">亲，没有数据！</div>
</script>

<script src="js/zepto.min.js"></script>
<script src="js/doT.min.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="js/lrz.all.bundle.js"></script>
<script src="js/gps.min.js"></script>
<script src="js/fastclick.min.js"></script>


<!-- 多语言 -->
<script type="text/javascript">
    var language_dictionary = {
        "zh_CN":{
            menu_home: '首页',
            menu_me: '我',
            menu_tree: '苗木',
            menu_record: '日志',
            authorize: '认证授权',
            edit_profile: '修改个人信息',
            member_manager: '人员管理',
            change_language: 'English',
            name: '姓名',
            phone: '手机',
            company: '单位',
            all: '全部',
            height: '高',
            dbh: '径',
            width: '冠服',
            m: '米',
            cm: '公分',
            maximum: '最大',
            atmost: '最多',
            notes: '备注',
            character: '字',
            nodata: '没有数据！',
            upload_photo: "上传照片",
            multiple_photos: "多张大图",
            small_photos: "多张小图",
            small_photo: "单张小图",
            upload_notexit: "正在上传，请勿退出！",
            confirmation_delete: "删除确认",
            confirmation_delete_notes: "您确定要删除当前日志照片？",
            cancel: "取消",
            ok: "确定",
            other: "其他",
            input_work_name: "请输入自定义项目名称",
            require_workitem: "必须选定工作项",
            require_itemname: "请填写其他项的内容",
            forward_qrcode: '长按并转发二维码',
            modify_ok: '修改成功',
            role1: "甲方管理员", 
            role2: "甲方工作人员", // 不能编辑
            role3: "施工方",
            role4: "访客", // 不能编辑
            expired: "过期",
            work: {
                "40": "号树",
                "41": "起树",
                "42": "装车",
                "43": "卸车",
                "44": "定植",
                "8": "其他",
                "9": "草坪修剪",
                "10": "绿篱色块修剪",
                "11": "球类修剪",
                "12": "花灌木修剪",
                "13": "乔木修剪",
                "2": "施肥",
                "3": "浇水",
                "14": "松土除草",
                "15": "树堰修葺",
                "7": "补植",
                "5": "病虫害防治",
                "6": "绿地保洁",
                "16": "植物防寒",
                "17": "草坪复壮",
                "18": "亮点打造",
                "19": "草坪施肥",
                "20": "灌木施肥",
                "21": "乔木施肥",
                "22": "大树复壮",
                "23": "草坪病害防治",
                "24": "地下害虫防治",
                "25": "苗木病害防治",
                "26": "苗木虫害防治",
                "27": "蛀干虫害防治",
                "28": "草坪播种",
                "29": "草坪铺植",
                "30": "宿根栽植",
                "31": "花卉栽植",
                "32": "苗木栽植",
                "33": "草坪切边",
                "34": "除草/除蘖",
                "35": "落叶清理",
                "36": "涂白",
                "37": "裹干",
                "38": "搭防寒障"
            }
        },
        "en_US":{
            menu_home: 'Home',
            menu_me: 'Me',
            menu_tree: 'Trees',
            menu_record: 'Record',
            authorize: 'Authorize',
            edit_profile: 'Profile',
            member_manager: 'Member',
            change_language: '中文',
            name: 'Name',
            phone: 'Phone',
            company: 'Company/Department',
            all: 'ALL',
            height: 'Height',
            dbh: 'Diameter',
            width: 'Width',
            m: 'm',
            cm: 'cm',
            maximum: 'maximum',
            atmost: 'at most',
            notes: 'notes',
            character: 'characters',
            nodata: 'No Data!',
            upload_photo: "Photo",
            multiple_photos: "Photos",
            small_photos: "Small Photos",
            small_photo: "Small Photo",
            upload_notexit: "uploading, do not exit!",
            confirmation_delete: "Confirmation Delete",
            confirmation_delete_notes: "Are you sure to delete this photo?",
            cancel: "Cancel",
            ok: "Ok",
            other: "Other",
            input_work_name: "input item name",
            require_workitem: "Must select work item",
            require_itemname: "Fill in the name of other item",
            forward_qrcode: 'Forward QR Code',
            modify_ok: 'Modified Success',
            role1: "Administrator", 
            role2: "Party A", // 不能编辑
            role3: "Worker",
            role4: "Visitor", // 不能编辑
            expired: "Expired",
            work: {
                "40": "Specified tree",
                "41": "Tree excavation",
                "42": "Pick up",
                "43": "Pick off",
                "44": "Planting",
                "8": "Other",
                "9": "Lawn trim",
                "10": "Hedges pruning",
                "11": "Ball hedges pruning",
                "12": "Flower shrubs pruning",
                "13": "Trees pruning",
                "2": "Fertilization",
                "3": "Watering",
                "14": "Loose soil weeding",
                "15": "Tree weir repair",
                "7": "Replanting",
                "5": "Pest control",
                "6": "Green cleaning",
                "16": "Cold proof",
                "17": "Lawn rejuvenation",
                "18": "Highlight build",
                "19": "Lawn fertilization",
                "20": "Shrubs fertilization",
                "21": "Trees fertilization",
                "22": "Trees rejuvenation",
                "23": "Prevention of lawn diseases",
                "24": "Underground pest control",
                "25": "Prevention of seedling",
                "26": "Pest control of seedlings",
                "27": "Pest control of trunk borer",
                "28": "Lawn sowing",
                "29": "Lawn planting",
                "30": "Perennial planting",
                "31": "Flowers planted",
                "32": "Seedlings planted",
                "33": "Lawn trimming",
                "34": "Weeding / Remove tillers",
                "35": "Deciduous cleaning",
                "36": "In addition to white",
                "37": "Wrap it",
                "38": "Take cold protection"
            }
        }
    };  
</script>

<!-- 常用业务代码 -->
<script type="text/javascript">
    // 加载苗木信息
    function loadTree(id) {
        app.treeid = id;
        pageManager.go('treeview');
    }

    // 标准化苗木规格数据
    function formatTreeData(tree) {
        tree.height1 = parseFloat(tree.height1);
        tree.height2 = parseFloat(tree.height2);
        tree.dbh1 = parseFloat(tree.dbh1);
        tree.dbh2 = parseFloat(tree.dbh2);
        tree.width1 = parseFloat(tree.width1);
        tree.width2 = parseFloat(tree.width2);
        return tree;
    }

    // 头像容错
    function onErrorAvatar() {
        this.src='avatar/0.jpg';
    }

    // 输入框检查
    var inputInvalid = {
        check: function ($container) {
            var result = true;
            var $inputs = $container.find('input');

            for (var i = $inputs.length - 1; i >= 0; i--) {
                var $input = $inputs[i];
                var value = $.trim( $input.value );
                switch ($input.dataset.invalid)
                {
                    case 'required':
                        if (!value) {
                            $input.value = '';
                            result = false;
                        }
                        break;
                    case 'phone':
                        if (!this.isPhone(value)) {
                            $input.value = '';
                            result = false;
                        }
                        break;
                    case 'number':
                        if (isNaN(value) ) {
                            $input.value = '';
                            result = false;
                        }
                        break;
                }
            }
            return result;
        },
        isPhone: function(str) {
            return /^1[3-5,7-8]{1}[0-9]{9}$/.test(str) || /^([0-9]{3,4}-)?[0-9]{7,8}$/.test(str);
        }
    }

    //比较两个对象是否相等，不包含原形上的属性计较
    var compareObject = function(obj1, obj2) {
            if (!obj1 && !obj2) return true;

            if (obj1 && obj2 && propertyLength(obj1) == propertyLength(obj2)) {
                for (var ob in obj1) {
                    if (obj1.hasOwnProperty(ob) && obj2.hasOwnProperty(ob)) {
                        if (obj1[ob] !== obj2[ob]) {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }

            return true;
        };
    //获得对象上的属性个数，不包含对象原形上的属性
    var propertyLength = function(obj) {
            var count = 0;
            if (obj) for (var ooo in obj) count++;
            return count;
        };    

    // 字符串时间转ms
    function string2Milliseconds(str) {
        str = str.replace(/-/g,"/"); 
        str = str.replace(':','/'); 
        str = str.replace(':','/'); 
        var time = new Date(str).getTime(); //ms   
        return time;
    }


    Date.prototype.date = function(){
        var month = this.getMonth()+1;   
        var date = this.getDate();  

        if(month < 10) month = "0" + month;
        if(date < 10) date = "0" + date;
              
        return this.getFullYear() + '-' + month + '-' + date;
    }
    Date.prototype.monday = function(){
      var now = new Date();
      var week = now.getDay();

      //一天的毫秒数  
      var millisecond = 1000 * 60 * 60 * 24;  
      //减去的天数    
      var minusDay = week != 0 ? week - 1 : 6;  
      //本周 周一    
      var monday = new Date(now.getTime() - (minusDay * millisecond));  

      return monday;
    }
    Date.prototype.monthFirstday = function(){
        var month = this.getMonth()+1;   

        if(month < 10) month = "0" + month;
              
        return this.getFullYear() + '-' + month + '-01';
    }

    // 通过照片文件名获取拍照时间 毫秒
    function getPhotoTime(photoname) {
        // return parseInt(photoname.substr(3,10))*1000; 
        return parseInt(photoname); 
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
    function string2shortTime(str) {
        if (str) {
            str = str.replace(/-/g,"/"); 
            var time = new Date(str).getTime(); //ms   
            return ms2shortTime(time);
        } else {
            return '刚刚';
        }
    }
    function name2time(photoname) {
        var ms = getPhotoTime(photoname);
        var date = new Date();
        date.setTime(ms);
        return date.toLocaleTimeString();
    }
    function string2date(str) {
        return str.split(' ')[0];
    }
    // function time2date(ms) {
    //     var newDate = new Date();
    //     newDate.setTime(ms);
    //     return newDate.toLocaleDateString()
    // }
    function in24hours(time) {
        if (typeof time == 'string') {
            time = new Date(time).getTime()
        }
        var now = new Date().getTime();
        return now-time<86400000;
    }

    // 获取文本长度
    function GetCurrentStringWidth(text, fontsize) {
        var currentObj = $('<span></span>').html(text)
                                           .css({"font-size":fontsize+'px', "visibility":"hidden"})
                                           .appendTo(document.body);
        var width = currentObj.width();
        currentObj.remove();
        return width+2;
    }

    function getObjectByID(id, object) {
        for (var i = object.length - 1; i >= 0; i--) {
            if (object[i].id==id) {
                return object[i];
            }
        }
        return null;    
    }
    function getPorjectByID(id) {
        for (var i = app.project.length - 1; i >= 0; i--) {
            if (app.project[i].id==id) {
                return app.project[i];
            }
        }
        return null;
    }
    function getAreaByID(id) {
        for (var i = app.area.length - 1; i >= 0; i--) {
            if (app.area[i].id==id) {
                return app.area[i];
            }
        }
        return null;
    }

    function selectProjectName(name) {
        $('#selectProject').children().first().html(name);
    }
    function selectProjectNameByID(projectid){
        var project = getPorjectByID(projectid);
        selectProjectName(project.name);
    }
</script>

<!-- 页面框架 -->
<script type="text/javascript">
    /************ 单页面框架 兼容JQuery 模版内 用script2 代替 script  **************/    

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
            if (config.title) {
                document.title = config.title;
            }

            var html = $(config.template).html();
            if (window.jQuery && html.indexOf('script2')>0) {
                // jQuery 模版内 用script2 代替 script，加载时恢复
                html = html.replace(new RegExp(/script2/g),'script');
            }
            
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
            if (config.js) {
                loadJS(config.js, 'js_'+config.name);
            }
            
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

    function setPageManager(page){
        var pages = {}, tpls = $('script[type="text/html"]');

        for (var i = 0, len = tpls.length; i < len; ++i) {
            var tpl = tpls[i], name = tpl.id.replace(/tpl_/, '');
            pages[name] = {
                name: name,
                url: '#' + name,
                template: '#' + tpl.id,
                js:  $(tpl).data('js'),
                title:  $(tpl).data('title'),
                autoremove: $(tpl).data('id') ? true : false
            };
            pageManager.push(pages[name]);
        }

        // pages.home.url = '#';
        // pageManager.setDefault('home');
        pageManager.setDefault(page);
    }
</script>

<!-- 引导程序 -->
<script type="text/javascript">
    var app = {
        version: 1.01,  // 系统版本好，用于自动升级
        isWechat: navigator.userAgent.indexOf("MicroMessenger") > 0, // 是否微信
        isiOS: !!navigator.userAgent.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), // ios终端
        isAndroid: navigator.userAgent.indexOf('Android') > -1 || navigator.userAgent.indexOf('Adr') > -1, //android终端
        language: 'zh_CN',
        lang: language_dictionary['zh_CN']
    }
    // 从缓存中获取用户，加快加载
    var user = localStorage.user_universal ? JSON.parse(localStorage.user_universal) : {id: 0, role: 0};

    // 动态加载js文件
    function loadJS(url, id) {
        if (!id || $('#'+id).length==0) {
            var $js = document.createElement("script");
            $js.src = url;
            if (id) $js.id = id;
            document.body.appendChild($js);            
        }
    }

    // 检查用户或系统更新
    function checkVersion() {
        $.getJSON('com/checkVersion.php', {code: app.code, userid: user.id}, function (json) {
            if ( json.v > app.version ) {
                window.location.reload(true); // 系统升级, 强制刷新缓存
            } else if (!compareObject(user, json)) {
            // } else if (user.id!=json.id || user.role!=json.role || user.package!=json.package) {
                    // 用户身份变更，重新加载
                    localStorage.user_universal = JSON.stringify(json);
                    window.location.reload();
            }
        });
    }

    // 配置微信接口
    function loadWechatJSSDK() {
        $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
            wx.config({
                debug: false,
                appId: res.appId,
                timestamp: res.timestamp,
                nonceStr: res.nonceStr,
                signature: res.signature,
                jsApiList: [
                    'chooseImage',
                    'uploadImage',
                    'scanQRCode'
                ]
            });
            wx.ready(function () {
            });
        });
    }

    $(function () {
        // 从path的hash值中解析参数
        var hash = location.hash.replace('#','').split('-');
        app.hash = hash;
        app.treeid = hash[0];
        app.code = hash[1];

        // 系统语言，用户设置优先
        app.language = localStorage.language || hash[2] || app.language;
        app.lang = app.language=='zh_CN' ? language_dictionary['zh_CN'] : language_dictionary['en_US'];

        // 检查系统和用户更新
        checkVersion();

        if (app.isWechat) {
            // 配置微信接口
            loadWechatJSSDK();

            // 微信扫码
            $('#scanQRCode').on('click', function () {
                wx.scanQRCode();
            }).show();
        }


        // fastClick();
        // androidInputBugFix();


        // 扫码直接进入苗木信息页面
        var page = app.treeid ? 'treeview' : 'home';
        // var page = app.treeid ? 'upload' : 'home';


        // 加载但页面框架
        setPageManager(page);
        pageManager.init();

        // 设置菜单
        var dot_tabbar = doT.template(document.getElementById('dot_tabbar').text);
        $('#tabbar').html(dot_tabbar)
                    .find('a').on('click', function(){
                                    var page = $(this).data('id');
                                    pageManager.go(page);
                                });
        // 设置头像
        $('#avatar').attr('src','avatar/'+user.id+'.jpg')
                    .error(onErrorAvatar);

    })
</script>
</body></html>