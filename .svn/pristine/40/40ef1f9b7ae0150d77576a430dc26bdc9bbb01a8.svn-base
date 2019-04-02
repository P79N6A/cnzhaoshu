<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>我上传的监管图片</title>
<style type="text/css">
    body{
        margin: 0;  
        padding:0;  
        border: 0;  
        font: inherit;  
        font-size: 100%;  
        vertical-align: baseline;
        background-color: #eee;
    }
    #listimage{
        width:100%;
        float: left;
        -webkit-overflow-scrolling: touch;
    }
    .photoinfo{
        width: 100%;
        position: fixed;
        height:100%;
        z-index: 100;
        display: none;
        background-color: #fff;
    }
    #photoinfo{
        width: 100%;
        height:100%;
        overflow-y: auto;
    }
    .photobox{
        width:46%;
        float: left;
        margin:2px 2%;
    }
    .treephoto{
        width:100%;
        height:130px;
        position: relative;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .treephoto p{
        width: 100%;
        color: #fff;
        font-size: 12px;
        background-color: rgba(0,0,0,.3);
        position: absolute;
        bottom: 0;  
    }
    .photo_title{
        height: 25px;
        line-height: 25px;
        float: left;
        width: 94%;
        background: #09BB07;
        padding: 0 3%;
        color: #fff;
    }
    .record_info {
        width: 96%;
        float: left;
        padding: 10px 1%;
        margin: 5px 1%;
        background: #fff;
        border-radius: 4px;
    }
    .recordview{
        width:98%;
        padding: 4px 1%;
        float: left;
        border-bottom: 1px dashed #ddd;
    }
    .recordview_row{
        width:33%;
        float: left;
    }
    .recordview_row1{
        width:67%;
        float: left;
    }
    .addresspng{
        width: 38px;
        position: absolute;
        bottom: 10px;
        background-image: url(./img/poi.png);
        height: 50px;
        margin-left: 47%;
        background-repeat: no-repeat;
    }
    .bgimg{
        width:100%;
        position:relative;
        float: left;
    }
    .bgimg img{
        width:98%;
        padding: 5px 1%;
    }
    a {
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
    }
</style>

</head>
<body>
    <div id="listimage">
    </div>
    <div class="photoinfo">
        <div id="photoinfo">
        </div>
    </div>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var photo_isloading = false,photo_isend=false,allimagedata=[];

        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        function getcookie(name){
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }
        function datetime(time){
            time = time.substring(0,10);
            return time;
        }
        function lookphotoinfo(data){
            for (var i = 0; i < allimagedata.length; i++) {
                if(allimagedata[i].id == data){
                    photoindex = allimagedata[i];
                }
            }
            $('#photoinfo').html(writeinfo(photoindex));
            $('.photoinfo').show();
        }
        function writeinfo(data){
            var photos= data.photo.split(';');
            var gpses= data.gps.split(';');
            var str;
            var str = '<div class="record_info"><div class="recordview"><div class="recordview_row">苗木名称：</div><div class="recordview_row1">'+data.tree_name+'</div></div><div class="recordview"><div class="recordview_row">苗木规格：</div><div class="recordview_row1">'+data.tree_attribute+'</div></div><div class="recordview"><div class="recordview_row">负&nbsp;&nbsp;责&nbsp;&nbsp;人：</div><div class="recordview_row1">'+data.name+'</div></div><div class="recordview"><div class="recordview_row">联系电话：</div><div class="recordview_row1"><a href="tel:'+data.phone+'">'+data.phone+'</a></div></div><div class="recordview"><div class="recordview_row">进&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;度：</div><div class="recordview_row1">'+data.active+'</div></div></div>';
            for (var i = 0; i < photos.length; i++) {
                if(gpses[i]){
                    str += '<div class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="hide()"><div class="addresspng" onclick="lookaddress('+gpses[i]+',\''+data.tree_name+'\')"></div></div>';
                }else{
                    str += '<div class="bgimg"><img src="/photos/o/'+photos[i]+'.jpg" onclick="hide()"></div>';
                }
            }
            return str;
        } 
        function lookaddress(gpsx,gpsy,name){
            var data = escape(JSON.stringify(allimagedata));
            document.cookie="allimagedata="+data;
            window.location = 'http://apis.map.qq.com/uri/v1/marker?marker=coord:'+gpsx+','+gpsy+';title:'+name+'&amp;key=CNPBZ-SM4WD-UHP4G-PSOWR-Z7ZVO-YKFJU&amp;referer=zhaoshu';
        }
        function hide(){
            $('.photoinfo').hide();
        }
        function loadstatisticphoto(photo){
            var time = '';
            var str = '';
            for (var i in photo) {
                var photos= photo[i].photo.split(';')[0];
                if(datetime(photo[i].time) == time){
                    str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
                }else{
                    time = datetime(photo[i].time);
                    str += '<div class="photo_title">'+time+'</div>';
                    str += '<div class="photobox" onclick="lookphotoinfo('+photo[i].id+');"><div class="treephoto" style="background-image:url(photos/m/'+photos+'.jpg)"><p>'+photo[i].tree_name+' '+photo[i].active+'<br>'+photo[i].tree_attribute+'</p></div></div>';
                }
            }
            return str;
        }

        function loadallimage(){
            if(photo_isloading) return;
            photo_isloading = true;
            var limit = $('#listimage .photobox').length + ',20';
            $.getJSON('/com/search_mymap_images.php', {userid: user.userid,limit:limit}, function(json) {
                if(json){
                    for (var i = 0; i < json.length; i++) {
                        allimagedata[allimagedata.length] = json[i];
                    }
                    photo_isloading = false;
                    $('#listimage').append(loadstatisticphoto(json));
                }else{
                    photo_isend = true;
                    $('#listimage').append('<div class="weui-loadmore">没有数据！</div>');
                }
            })
        }
        
        if(getcookie('allimagedata')){
            allimagedata = getcookie('allimagedata');
            allimagedata = JSON.parse(allimagedata);
            $('#listimage').html(loadstatisticphoto(allimagedata));
            document.cookie="allimagedata=";
        }else{
            loadallimage();
        }
	</script>
</body>