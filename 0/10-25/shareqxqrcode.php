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
<title>找树网--上传授权</title>

</head>
<body>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
        var user = getcookie('user2');
        user = user ? JSON.parse(user) : null;
        var qxqrcodeid = urlRequest("id");

        function getcookie(name){//获取指定名称的cookie的值
            var arrStr = document.cookie.split("; ");
            for(var i = 0;i < arrStr.length;i ++){
                var temp = arrStr[i].split("=");
                if(temp[0] == name) return unescape(temp[1]);
            } 
        }

        function urlRequest(name) {
            var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
            return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
        }

        $.getJSON('/com/search_map_orderqrcodeinfo.php',{qrcodeid:qxqrcodeid,userid:user.userid},function(json){
            if(json){
                window.location.href = "./map.php?1#showallproject";
            }else{
                alert('授权失败，请重新扫描二维码');
            }
        })


	</script>

</body>