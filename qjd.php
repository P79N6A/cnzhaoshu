<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="css/basic_m.css?t=20170425" type="text/css" />
    <link rel="stylesheet" href="css/rangeslider.css"/>
    <link href="qjdm.css?t=20170330" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="pz_top">
    <div class="c_0100_1">
        <div class="so">
          <input id="key" type="text" class="Search" placeholder="15公分银杏">
          <input onclick="onSearch()" type="image" src="images/Search.png" class="sear_sub">
        </div>
    </div>
</div>
    <div class="banner">
        <div id="slideBox" class="slideBox">
            <div class="bd">
                <ul id="projectimage">
                  <li><a class="pic" href=""><div class="image1"></div></a></li>
                  <li><a class="pic" href=""><div class="image2"></div></a></li>
                  <li><a class="pic" href=""><div class="image3"></div></a></li>
                  <li><a class="pic" href=""><div class="image4"></div></a></li>
                  <li><a class="pic" href=""><div class="image5"></div></a></li>
                </ul>
            </div>
            <div class="hd">
                <ul></ul>
            </div>
        </div>
    </div>
    <div class="c_0100_2">
        <div class="l_0100_1">
            <div class="logo"><img id="shoplogo" alt="" /></div>
            <div class="lc_0100_1">
                <div id="shopname" class="text_0100_1" style="overflow: hidden; height: 26px"></div>
                <div class="text_0100_2"><a href="#">品牌旗舰店</a><span id="dianmi"></span></div>
            </div>
        </div>
        <a class="excel" href=""></a>
        <div style="display: none;" class="l_0100_2"><span>线上交易额<strong>500</strong>万</span></div>
    </div>
    <div class="c_0100_3">
        <li>
            <a href="javascript:showHome()">
                <i class="nav1"></i>
                <span class="name">公司首页</span>
            </a>
        </li>
        <li>
            <a href="javascript:showTree()">
                <i class="nav2"></i>
                <span class="name">精品苗木</span>
            </a>
        </li>
        <li>
            <a id="gps" href="#" target="_blank">
                <i class="nav4"></i>
                <span class="name">地图定位</span>
            </a>
        </li>
    </div>
    <div class="c_0100_5"></div>
<div id="pz_main" class="pz_main">
    <div class="c_0100_9">
        <div class="l_0100_6">
            <div class="tit_0100_2"><span><strong style=" font-size:15px;">公司介绍</strong>&nbsp;&nbsp;Company Profile</span></div>
        </div>
        <div class="l_0100_7">
            <p class="pic_180"><span><img src="images/main28.png" width="100%" /></span></p>
            <p id="introduction"></p>
        </div>
    </div>
    <div class="c_0100_8">
        <div class="l_0100_3 tit_bg1">
            <div class="tit_0100_1">
                <strong style=" color:#fff;">荣誉资质</strong>
                <span style=" color:#fff;">Qualification</span>
            </div>
            <div class="pic_tit1"><img src="images/main22.png" width="100%" /></div>
        </div>
        <div id="honors" class="l_0100_5"></div>
    </div>
    <div class="c_0100_8">
        <div class="l_0100_3">
            <div class="tit_0100_1">
                <strong>精品内容</strong>
                <span>Boutique projects</span>
            </div>
            <div class="pic_tit1"><img src="images/main19.png" width="100%" /></div>
        </div>
        <div class="l_0100_4">
            <ul id="projects"></ul>
        </div>
    </div>
</div>
<div id="tree" style="display: none;">
    <div id="filter" class="filter">
        <ul id="where"></ul>
        <ul>♧<span id="total"></span><span id="average"></span>
            <div style="font-size:14px;padding:40px 18px 8px 20px">
                <input style="display:none" type="text" id="range" />
            </div>
            <div style="text-align:center">
                <a href="javascript:orderByPrice()" id="btn_price" class="unselect">价格◇</a>
                <a href="javascript:orderByTime()" id="btn_time" class="unselect">时间</a>
                <a href="javascript:searchRenZheng()" id="btn_renzheng" class="unselect">已认证</a>
                <a href="javascript:searchYuanTu()" id="btn_yuantu" class="unselect">原图认证</a>
                <a href="javascript:searchShiPin()" id="btn_shipin" class="unselect">视频认证</a><br>
            </div>
        </ul>
        <ul class="specification">
            <span style="width:45px;display:inline-block">径<i>cm</i></span>
            <input type="text" id="spec_dbh"
                    placeholder="✎ 10-12"
                    onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
                    onpaste="return false">
            <span id="default_dbh"></span><br>
            <span style="width:45px;display:inline-block">冠<i>m</i></span>
            <input type="text" id="spec_crownwidth" 
                    placeholder="✎ 10-12"
                    onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
                    onpaste="return false">
                <span id="default_crownwidth"></span><br>
            <span style="width:45px;display:inline-block">高<i>m</i></span>
            <input type="text" id="spec_height"
                    placeholder="✎ 10-12"
                    onkeyup="value=value.replace(/[^\d\.\-\－]/g,'');if(event.keyCode==13)this.blur()"
                    onpaste="return false">
            <span id="default_height"></span>
        </ul>       
        <ul id="province_ul"><span id="province"></span></ul>
    </div>

    <div id="treelist"></div>    
</div>
<div class="c_0100_7">
    <img id="shopqrcode" onerror="createShopQrcode()" width="150" height="150" /><br/>
    <img id="wxqrcode" onerror="this.src='./shop/qrcode/wx1.jpg'" width="154" height="154" /><br/>
    <img id="inviteqrcode" width="150"/><br/>
</div>
<div class="pz_down">
    <div class="bq">
        <span id="version"></span><br>
        京ICP证1403号
    </div>
    <div class="c_0100_6"></div>
</div>
<div class="pf_tel">
    <div class="tel">联系电话：<span id="shopphone"></span></div>
    <a id="bohao" class="bohao" href="#">一键拨号</a>
</div>    


<script id="dot_honor" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <li>
            {{? i>0}}
            <img src="./shop/honor/b/{{=it[i].id}}.jpg"/>
            {{??}}
            <img class="honorimagehead" src="./shop/honor/b/{{=it[i].id}}.jpg" width="100%"/>
            {{?}} 
            
        </li>
    {{ } }}
</script>
<script id="dot_project" type="text/x-dot-template">
    {{ for(var i in it) { }}
        <li>
            <a href="{{=it[i].msg_link}}">
                <div class="pic_108">
                    <div class="boxF">
                        <div class="boxS">
                            <div class="boxT" style=" background:url(./shop/project/m/{{=it[i].id}}.jpg) center no-repeat; background-size:100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text_0100_3"><span>{{=it[i].msg_title}}</span><i class="jiantou"></i></div>
            </a>
        </li>
    {{ } }}r
</script>
<script>var isShop=true; var baiwan=[63670];</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/js/TouchSlide.1.1.js"></script>
<script src="/js/rangeslider.js"></script>
<script src="/js/crypt.js?t=20160930"></script>
<script src="/js/doT.min.js"></script>
<script src=""></script>
<script src="/js/qjd.js?t=20181013"></script>
</body>
</html>
  