console.log(location);
console.log(location.pathname);
/*
站内登录
 */
// (function(){
// 101旗舰店，100开放平台管理员,9老大,8系统管理员
var pageRoles = {
    "":null,
    "/admin/shop.html":null,
    "/admin/show_order.html":[9,8]
};

var user;
var qrcodeTicket;

function urlRequest(name)
{
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}
function getLoginUrl() {
    return window.location.href.split("login_uri=")[1]
}
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
            var url = getLoginUrl();
            window.location.replace( url ? url : '.' );
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

            if (getWebFilename()=='/login.html') {
                // window.location.replace( urlRequest('login_uri') );
                window.location.replace( '.' );
            } else {
                if (checkRole()===false) {
                    window.location.replace('/role.html'); // 没有权限
                }
            }
            return;
        }catch(e){
            delcookie('user2');
        }
    }

    // 没有登录

    if(navigator.userAgent.indexOf("MicroMessenger")>0){
        // 微信登录
        var href = location.href.split("#");
        var path = href[0],
            hash = href[1] || '';

        window.location.replace("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx400fa6a12644f696&redirect_uri=http://www.cnzhaoshu.com/login.php?login_uri="+path+"&response_type=code&scope=snsapi_base&state="+hash);
    } else {
        // 扫二维码登录
        // 如果不是login.html 调到login.html
        if (getWebFilename()=='/login.html') {
            loginQRcode();
            $('#login_qrcode').on('error',function(){
                this.src='/img/loging.gif';
                setTimeout(loginQRcode,2000);
            });
        } else {
            window.location.replace('/login.html?login_uri='+location.href);
        }
    }
}

function loginTimeout() {
    window.location.replace('/500.html');
}

function logout() {
    delcookie('user2');
    window.location.replace('/login.html?login_uri='+location.href);
}

function getWebFilename() {
    return location.pathname;

    // var path = location.pathname.split('/');
    // return path[path.length-1];
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

checkUser();

// })();
