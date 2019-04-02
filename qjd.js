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

function createShopQrcode() {
    $.get('/com/shop.qrcode.create.php', {shopid: shopid}, function () {
        $('#shopqrcode').attr('src', '/shop/qrcode/'+shop.shopid+'.jpg?v=' + shop.version);       
    });
}

function showHome() {
    $('#pz_main').show();
    $('#tree').hide();
}
function showTree() {
    $('#pz_main').hide();
    $('#tree').show();
}

function showHonorImage(index) {
    var urls = [];
    for (var i in shop.honor) {
        urls[i] = 'http://www.cnzhaoshu.com/shop/honor/b/'+shop.honor[i].id+'.jpg'
    }

    wx.previewImage({
        current: 'http://www.cnzhaoshu.com/shop/honor/b/'+shop.honor[index].id+'.jpg', 
        urls: urls 
    });
}

function loadJS (url) {
    var script = document.createElement('script');
    script.src = url;
    document.body.appendChild(script);
}

function urlRequest(name)
{
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
    return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
}

var shopid = parseInt(urlRequest('shopid'));
var dot_honor = doT.template($("#dot_honor").text());
var dot_project = doT.template($("#dot_project").text());
var shop;
var isBaiWanDian = $.inArray(shopid, baiwan)>=0;
var width= window.screen.availWidth;

$('.image1').css({
  "min-height": (width*0.4)+"px"
});
$('.image2').css({
  "min-height": (width*0.4)+"px"
});

$('.image3').css({
  "min-height": (width*0.4)+"px"
});
$('.image4').css({
  "min-height": (width*0.4)+"px"
});
$('.image5').css({
  "min-height": (width*0.4)+"px"
});
$('.image6').css({
  "min-height": (width*0.4)+"px"
});
// 旗舰店弹窗广告
// if (shopid==91895) {
//     setTimeout(function () {
//       $('<a id="home_ad" href="/tree.php?treeid=66915" style="display:none; position: fixed;top: 0;right: 0;bottom: 0;left: 0; background-repeat: no-repeat;background-size:contain;background-position:center; background-image: url(ad/91895.jpg); background-color: #000;z-index: 101; "></a>').appendTo($(document.body)).fadeIn(2000);

//       setTimeout(function () {
//         $("#home_ad").fadeOut(2000);

//         setTimeout(function () {
//           $("#home_ad").remove();   
//         },3000);

//       },5000);

//     },1000);    
// }


$.getJSON('/com/shop.get.php', {shopid: shopid}, function (data) { 
    
    if ($.inArray(data.role,[101,100,9,8]) == -1) {
        location.replace('./shop.php?userid='+shopid);
        return;
    }

    shop = data;  
    $('#shoplogo').attr('src', '/headimg/96/'+data.shopid+'.jpg?v=' + data.version);
    $('#shopphoto').attr('src', '/shop/photo/m/'+data.shopid+'.jpg?v=' + data.version);
    $('#shopqrcode').attr('src', '/shop/qrcode/'+data.shopid+'.jpg?v=' + data.version);
    $('#wxqrcode').attr('src', '/shop/qrcode/wx'+shopid+'.jpg');

    document.title = data.name;
    $("#shopname").html(data.name);
    $("#shopphone").html(data.phone);
    if (data.introduction) $("#introduction").html(website_filter(data.introduction));
    $("#bohao").attr('href','tel:'+data.phone);
    $(".excel").attr('href','excel.shop.php?userid='+shopid);
    
    $("#dianmi").html('点米'+data.dianmi);
    
    if (data.gps) {
        $('#gps').attr('href', 'http://apis.map.qq.com/uri/v1/marker?marker=coord:'+data.gps.x+','+data.gps.y+';title:'+data.name+'&referer=zhaoshu');
    }

    $('#honors').html(dot_honor(data.honor));
    $('#projects').html(dot_project(data.project));

    $('#version').html(data.name);

    // 百万店
    if (isBaiWanDian) {
        $('<img>',{  
            src:'/img/baiwan.png',  
        }).css({
            position:'absolute',
            right:'0',
            top:'50px'              
        }).appendTo('body');  
    }
    // 广告
    if(data.project){
        if(data.project.length >= 5){
            for (var i = 0; i < data.project.length; i++) {
                if(data.project[i]){
                  $('.image'+(1+i)).css('background-image','url(./shop/project/b/'+data.project[i].id+'.jpg)');
                  $('.image'+(1+i)).parent().attr('href',data.project[i].msg_link);
                }
            } 
        }else{
            m = 0;
            for (var i = 0; i < 5; i++) {
              if(data.project.length > i){
                $('.image'+(1+i)).css('background-image','url(./shop/project/b/'+data.project[i].id+'.jpg)');
                $('.image'+(1+i)).parent().attr('href',data.project[i].msg_link);
              }else{
                $('.image'+(1+i)).css('background-image','url(./shop/project/b/'+data.project[m].id+'.jpg)');
                $('.image'+(1+i)).parent().attr('href',data.project[m].msg_link);
                m++;
                if(m == data.project.length){
                    m = 0;
                }
              }
            }
        }
    }else{
      for (var i = 0; i < 5; i++) {
        $('.image'+(1+i)).css('background-image','url(./images/banner.jpg)');
      }
    }


    // window.user = shop;
    // window.shareOrder = window.isShop ? '点米'+user.dianmi+(user.dianmi?'第' +user.dianmiOrder+'名':'') : '';

    // console.log(shop);
    // console.log(user);


    // loadJS('/js/rangeslider.js');
    // loadJS('/js/crypt.js?t=20160930');
    // prepareShare();


    // 微信分享
    // try{prepareShare()}catch(e){}

    // setTimeout(function() {
        loadJS('/js/basic_m.js?t=201801026');
        
        setTimeout(function () {
            loadJS('/js/index.js?t=20181013');
        }, 200); // 等basic_m.js加载完

        setTimeout(function () {
            $.get('com/qrcode.invite.php?shopid='+shopid,function () {
               $('#inviteqrcode').attr('src', '/qrinvite/'+shopid+'.jpg');
            });
            // 苗店访客记录
            if (window.user && shop.shopid!=user.shopid) {
              var url = 'com/visitshop.php?shopid='+shop.shopid+'&userid='+shop.userid+'&visitorid='+user.userid;
              if (flagid) url += '&flagid=' + flagid;
              if (typeof share != 'undefined') url += '&type=' + share;
              $.post(url);
            }
        }, 500);
    // },100);


    TouchSlide({ 
        slideCell:"#slideBox",
        titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul", 
        effect:"leftLoop", 
        autoPage:true,//自动分页
        autoPlay:true //自动播放
    });    


});


// 加载数据
