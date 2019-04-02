function addcookie(a, b) {
    var c = new Date;
    c.setTime(c.getTime() + 31536E7);
    document.cookie = a + "=" + escape(b) + ";expires=" + c.toGMTString() + ";path=/;domain=yangshuwang.com"
}

function clearcookie() {
    var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
    if (keys) {
        var expires = new Date(0).toUTCString();
        for (var i = keys.length; i--;) {
            document.cookie = keys[i] + '=0;expires=' + expires + ";path=/";
            document.cookie = keys[i] + '=0;expires=' + expires + ";path=/;domain=yangshuwang.com";
        }
    }
}

function loadJS(a, b) {
    if (!b || b && 0 == $("#" + b).length) {
        var c = document.createElement("script");
        b && (c.id = b);
        c.src = a;
        document.body.appendChild(c)
    }
}

Date.prototype.date = function () {
    var a = this.getMonth() + 1, b = this.getDate();
    10 > a && (a = "0" + a);
    10 > b && (b = "0" + b);
    return this.getFullYear() + "-" + a + "-" + b
};

Date.prototype.monday = function () {
    var a = new Date, b = a.getDay(), b = 0 != b ? b - 1 : 6;
    return new Date(a.getTime() - 864E5 * b)
};
Date.prototype.monthFirstday = function () {
    var a = this.getMonth() + 1;
    10 > a && (a = "0" + a);
    return this.getFullYear() + "-" + a + "-01"
};

function getPhotoTime(a) {
    return 1E3 * parseInt(a.substr(3, 10))
}

function ms2shortTime(a) {
    a = (new Date).getTime() - a;
    return 36E5 > a ? (a = Math.floor(a / 6E4), 0 == a ? "\u521a\u521a" : a + "\u5206\u949f\u524d") : 864E5 > a ? Math.floor(a / 36E5) + "\u5c0f\u65f6\u524d" : 2592E6 > a ? Math.floor(a / 864E5) + "\u5929\u524d" : 31104E6 > a ? Math.floor(a / 2592E6) + "\u6708\u524d" : "1\u5e74\u524d"
}

function string2shortTime(a) {
    return a ? (a = a.replace(/-/g, "/"), a = (new Date(a)).getTime(), ms2shortTime(a)) : "\u521a\u521a"
}

function name2time(a) {
    a = getPhotoTime(a);
    var b = new Date;
    b.setTime(a);
    return b.toLocaleTimeString()
}

function string2date(a) {
    return a.split(" ")[0]
}

function in24hours(a) {
    return 864E5 > (new Date).getTime() - a
}

function GetCurrentStringWidth(a, b) {
    b = $("<span></span>").html(a).css({"font-size": b + "px", visibility: "hidden"}).appendTo(document.body);
    var c = b.width();
    b.remove();
    return c + a.length
}

var compareObject = function (a, b) {
        if (!a && !b) return !0;
        if (a && b && propertyLength(a) == propertyLength(b)) for (var c in a) if (a.hasOwnProperty(c) && b.hasOwnProperty(c)) {
            if (a[c] !== b[c]) return !1
        } else return !1; else return !1;
        return !0
    }, propertyLength = function (a) {
        var b = 0;
        if (a) for (var c in a) b++;
        return b
    }, InputInvalid = {
        check: function (a) {
            var b = !0;
            a = a.find("input");
            for (var c = a.length - 1; 0 <= c; c--) {
                var d = a[c], e = $.trim(d.value);
                switch (d.dataset.invalid) {
                    case "required":
                        e || (d.value = "", b = !1);
                        break;
                    case "phone":
                        this.isPhone(e) ||
                        (d.value = "", b = !1);
                        break;
                    case "number":
                        isNaN(e) && (d.value = "", b = !1)
                }
            }
            return b
        }, isPhone: function (a) {
            return /^1[3-5,7-8]{1}[0-9]{9}$/.test(a) || /^([0-9]{3,4}-)?[0-9]{7,8}$/.test(a)
        }
    },
    overscroll = function (a) {
        a.addEventListener("touchstart", function () {
            var b = a.scrollTop, c = a.scrollHeight, d = b + a.offsetHeight;
            0 === b ? a.scrollTop = 1 : d === c && (a.scrollTop = b - 1)
        });
        a.addEventListener("touchmove", function (b) {
            a.offsetHeight < a.scrollHeight && (b._isScroller = !0)
        })
    };
document.body.addEventListener("touchmove", function (a) {
    a._isScroller || a.preventDefault()
});
var pageManager = {
    $container: $("#container"),
    _pageStack: [],
    _configs: [],
    _defaultPage: null,
    frontPage: null,
    lastPage: null,
    setDefault: function (a) {
        this._defaultPage = this._find("name", a);
        return this
    },
    init: function () {
        var a = this;
        $(window).on("hashchange", function () {
            var b = 0 === location.hash.indexOf("#") ? location.hash : "#";
            a.lastPage = a.frontPage;
            a.frontPage = b.replace("#", "");
            var d = a._findInStack(b);
            d ? $(d.dom[0]).addClass("js_show").siblings(".js_show").removeClass("js_show") : (b = a._find("url", b) || a._defaultPage,
                a._go(b));
            a._autoremove(a.frontPage);
            a._activeMenu(a.frontPage)
        });
        var b = 0 === location.hash.indexOf("#") ? location.hash : "#";
        a.frontPage = b.replace("#", "");
        b = a._find("url", b) || a._defaultPage;
        this._go(b);
        a._activeMenu(a.frontPage);
        return this
    },
    _autoremove: function (a) {
        for (var b = 0, c = this._pageStack.length; b < c; b++) {
            var d = this._pageStack[b];
            d && d.config && d.config.autoremove && d.config.name != a && (d.dom.remove(), this._pageStack.splice(b, 1), d.config.js && $("#js_" + d.config.name).remove())
        }
    },
    _activeMenu: function (a) {
        $('#tabbar [data-id="' +
            (a || "home") + '"]').addClass("on").siblings(".on").removeClass("on");
        "member" == a ? $("#header").addClass("member_search") : $("#header").removeClass("member_search")
    },
    push: function (a) {
        this._configs.push(a);
        return this
    },
    remove: function (a) {
        for (var b = 0, c = this._pageStack.length; b < c; b++) {
            var d = this._pageStack[b];
            if (d.config.name === a) {
                d.dom.remove();
                this._pageStack.splice(b, 1);
                break
            }
        }
    },
    find: function (a) {
        for (var b = 0, c = this._pageStack.length; b < c; b++) if (this._pageStack[b].config.name === a) return !0;
        return !1
    },
    pop: function () {
        this.remove(this.frontPage);
        history.back()
    },
    go: function (a) {
        if (a = this._find("name", a)) location.hash = a.url
    },
    _go: function (a) {
        var b = $(a.template).html(), c = $(b).addClass("slideIn");
        c.on("animationend webkitAnimationEnd", function () {
            c.removeClass("slideIn").addClass("js_show")
        });
        this.$container.append(c);
        this._pageStack.push({config: a, dom: c});
        a.isBind || this._bind(a);
        a.js && loadJS(a.js, "js_" + a.name);
        return this
    },
    back: function () {
        history.back()
    },
    _findInStack: function (a) {
        for (var b = null, c = 0, d = this._pageStack.length; c < d; c++) {
            var e = this._pageStack[c];
            if (e.config.url === a) {
                b = e;
                break
            }
        }
        return b
    },
    _find: function (a, b) {
        for (var c = null, d = 0, e = this._configs.length; d < e; d++) if (this._configs[d][a] === b) {
            c = this._configs[d];
            break
        }
        return c
    },
    _bind: function (a) {
        var b = a.events || {}, c;
        for (c in b) for (var d in b[c]) this.$container.on(d, c, b[c][d]);
        a.isBind = !0
    }
};

function androidInputBugFix() {
    /Android/gi.test(navigator.userAgent) && window.addEventListener("resize", function () {
        "INPUT" != document.activeElement.tagName && "TEXTAREA" != document.activeElement.tagName || window.setTimeout(function () {
            document.activeElement.scrollIntoViewIfNeeded()
        }, 0)
    })
}

function setPageManager() {
    for (var a = {}, b = $('script[type="text/html"]'), c = 0, d = b.length; c < d; ++c) {
        var e = b[c], g = e.id.replace(/tpl_/, "");
        a[g] = {
            name: g,
            url: "#" + g,
            template: "#" + e.id,
            js: $(e).data("js"),
            autoremove: $(e).data("id") ? !0 : !1
        };
        pageManager.push(a[g])
    }
    a.home.url = "#";
    pageManager.setDefault("home")
}

setPageManager();
androidInputBugFix();

function saveLocalStorageKey(a) {
    if (window.localStorage) {
        var b = localStorage.searchKey ? JSON.parse(localStorage.searchKey) : [];
        0 > b.indexOf(a) && 20 < b.push(a) && b.shift();
        localStorage.searchKey = JSON.stringify(b)
    }
}

function onerrorHeadimg() {
    event.srcElement.src = "headimg/96/0.jpg"
}

$("#headImage").attr("src", "headimg/96/" + user.userid + ".jpg?v=" + user.version).error(onerrorHeadimg);
$("#logo").attr("src", "platform/" + urlWhere.flagid + ".png").error(function () {
    this.src = "platform/1000.png"
});
$("#searchInput").on("blur", function () {
    $("#header").removeClass("only_search");
    -1 != yangshu.searchInput && (window.pageManager.back(), $("#searchInput").val(yangshu.searchInput));
    window.setTimeout(function () {
        $.trim($("#searchInput").val()).length ? $("#searchCancle").show() : $("#searchCancle").hide()
    }, 200)
}).on("focus", function () {
    window.pageManager.go($(this).data("id"));
    $("#header").addClass("only_search");
    yangshu.searchInput = $("#searchInput").val();
    this.value.length && window.setTimeout(function () {
        var a =
            $("#searchInput").val();
        $("#searchInput").val("").focus().val(a)
    }, 10)
}).on("keydown", function (a) {
    13 == a.keyCode && (a = $.trim(this.value)) && (searchKey(a), saveLocalStorageKey(a))
});
$("#searchCancle").on("click", function () {
    $(this).hide();
    searchCancled()
});
$("#selectProject").on("click", function () {
    var a = $(this).data("id");
    $("#" + a).hasClass("js_show") ? window.pageManager.back() : window.pageManager.go(a)
});
$("#tabbar a").on("click", function () {
    var a = $(this).data("id");
    if (window.pageManager.find(a)) switch (a) {
        case "home":
            overlayProjectOnMap();
            break;
        case "record":
            loadRecord()
    }
    window.pageManager.go(a);
    if ("home" == a || "profile" == a) try {
        prepareShare()
    } catch (b) {
    }
});
var yangshu = {};

function roleName(a) {
    return (a = {
        11: "\u73b0\u573a\u8d1f\u8d23\u4eba",
        12: "\u517b\u62a4\u5458\u5de5",
        13: "\u517c\u804c\u517b\u62a4",
        10: "\u7ba1\u7406\u5458",
        2: "\u533a\u57df\u7ecf\u7406",
        3: "\u7532\u65b9\u7269\u4e1a",
        1: "\u517b\u62a4\u7ba1\u7406",
        127: "\u8d85\u7ea7\u7ba1\u7406\u5458"
    }[a]) ? a : ""
}

function getMapBounds(a) {
    for (var b = 1E3, c = 1E3, d = 0, e = 0, g = a.length - 1; 0 <= g; g--) {
        var f = a[g];
        f.x && f.y && (f.x < b && (b = f.x), f.x > d && (d = f.x), f.y < c && (c = f.y), f.y > e && (e = f.y))
    }
    a = new qq.maps.LatLng(d, e);
    b = new qq.maps.LatLng(b, c);
    return new qq.maps.LatLngBounds(b, a)
}

function removeMapVersion(a) {
    var b = $("#" + a).children().children();
    if (1 < b.length) for (var c = b.length - 1; 0 <= c; c--) {
        var d = $(b[c]);
        1E5 < parseInt(d.css("z-index")) && d.hide()
    } else setTimeout(function () {
        removeMapVersion(a)
    }, 50)
}

function getActiveMenu() {
    return $("#tabbar .on").data("id")
}

function searchKey(a) {
    yangshu.searchInput = -1;
    $("#searchInput").val(a).blur();
    var b = getActiveMenu();
    switch (b) {
        case "home":
            var c = [], d;
            for (d in yangshu.project) 0 <= yangshu.project[d].name.indexOf(a) && (c[c.length] = yangshu.project[d]);
            c.length && (1 == c.length && c[0].photo ? (a = c[0], yangshu.activeProjectid = a.id, selectProjectName(a.name), overlayProjectAreaOnMap(a.id)) : (yangshu.isAreaMap = !1, overlayOnMap(c)));
            break;
        case "member":
            loadMember({flagid: urlWhere.flagid, name: a}, !0);
            break;
        case "data":
            break;
        default:
            c = yangshu.isAreaMap ?
                {projectid: yangshu.activeProjectid} : {flagid: urlWhere.flagid}, c.key = a, loadRecord(c)
    }
    window.pageManager.go(b)
}

function searchCancled() {
    $("#searchInput").val("").removeClass("fontsize-10");
    switch (getActiveMenu()) {
        case "home":
            overlayProjectOnMap();
            break;
        case "member":
            loadMember({flagid: urlWhere.flagid}, !0);
            break;
        case "data":
            break;
        default:
            delete yangshu.recordWhere, loadRecord()
    }
}

function loadProjectData() {
    yangshu.project || yangshu.isLoadingProject || (yangshu.isLoadingProject = !0, $.getJSON("com/get.project.php", {
        flagid: urlWhere.flagid,
        userid: user.userid
    }, function (a) {
        yangshu.isLoadingProject = !1;
        yangshu.mapdata = yangshu.project = a;
        window.localStorage && (localStorage["project" + urlWhere.flagid] = JSON.stringify(a))
    }))
}

function loadProject(a, b) {
    if (yangshu.renzheng) yangshu.renzheng.projectid = a, yangshu.renzheng.project = b, window.pageManager.go("renzheng_admin"); else switch (b ? selectProjectName(b) : selectProjectNameByID(a), getActiveMenu()) {
        case "home":
            $("#home").length && overlayProjectAreaOnMap(a);
            window.pageManager.go("home");
            break;
        case "record":
            yangshu.activeProjectid = a, loadRecord({projectid: a});
            break;
        case "statistics":
            yangshu.activeProjectid = a, loadStatistics({projectid: a})
    }
}

function loadRecord(a) {
    var b = "undefined" == typeof a;
    b && (a = yangshu.isAreaMap ? {projectid: yangshu.activeProjectid} : {flagid: urlWhere.flagid});
    compareObject(yangshu.recordWhere, a) || ($("#record").length ? reloadRecordView(a) : yangshu.recordWhere = a);
    a.projectid && selectProjectNameByID(a.projectid);
    b || window.pageManager.go("record")
}

function getObjectByID(a, b) {
    for (var c = b.length - 1; 0 <= c; c--) if (b[c].id == a) return b[c];
    return null
}

function getPorjectByID(a) {
    for (var b = yangshu.project.length - 1; 0 <= b; b--) if (yangshu.project[b].id == a) return yangshu.project[b];
    return null
}

function getAreaByID(a) {
    for (var b = yangshu.area.length - 1; 0 <= b; b--) if (yangshu.area[b].id == a) return yangshu.area[b];
    return null
}

function selectProjectName(a) {
    $("#selectProject").children().first().html(a);
    $("#selectProject2").children().first().html(a)
}

function selectProjectNameByID(a) {
    a = getPorjectByID(a);
    selectProjectName(a.name)
}

function loadLocalSearchKey() {
    if (window.localStorage && localStorage.searchKey) for (var a = JSON.parse(localStorage.searchKey), b = $("#search"), c = a.length - 1; 0 <= c; c--) {
        var d = $("<i/>").html(a[c]).on("click", function () {
            searchKey($(this).html())
        });
        b.append(d)
    }
}

urlWhere.areaid ? (location.hash = "#record", yangshu.recordWhere = {areaid: urlWhere.areaid}) : urlWhere.recordid ? (location.hash = "#recordview", yangshu.recordWhere = {id: urlWhere.recordid}) : urlWhere.recordWhere ? (location.hash = "#record", yangshu.recordWhere = urlWhere.recordWhere) : urlWhere.statistics && (location.hash = "#statistics");
pageManager.init();

/*
function checkVersion(){
    $.getJSON("com/get.version.php",{userid:user.userid},function(a){a.userid!=user.userid||a.flagid&&a.flagid!=user.flagid?reLogin():a.userid&&(user.role!=a.role||a.projectid&&user.projectid!=a.projectid)?(user.role=a.role,user.projectid=a.projectid,resetUserCookie(),window.location.reload()):window.isPC&&a.pcsys>version||!window.isPC&&a.sys>version?window.location.reload(!0):a.userid&&(user.version!=a.version&&($("#headImage").attr("src","headimg/96/"+a.userid+".jpg?v="+a.version).error(onerrorHeadimg),
user.version=a.version,resetUserCookie()),window.localStorage&&(localStorage["user_"+a.userid]=JSON.stringify(a)))})}

    function resetUserCookie(){var a=JSON.stringify(user);addcookie("user2"+user.flagid,a);user.openid&&user.flagid!=user.openid&&addcookie("user2"+user.openid,a)}


    function reLogin(){clearcookie();window.location.reload(!0)}


function setProfile(){if(user.userid&&window.localStorage){var a=JSON.parse(localStorage["user_"+user.userid]),b=0<=$.inArray(a.role,[10,127])?"":2==a.role?a.department?a.department+"<br>":"":a.project?a.project+"<br>":"";$("#profile .zt_name").html((a.name?a.name:"\u8bbf\u5ba2")+" "+(a.phone?a.phone:"\u672a\u767b\u8bb0\u7535\u8bdd"));$("#profile .zt_tel").html(b+roleName(a.role))}else $("#profile .zt_name").html("\u8bbf\u5ba2");$("#profile_headimg").attr("src","headimg/96/"+user.userid+".jpg?v="+
user.version).error(onerrorHeadimg);0<=$.inArray(user.role,[10,11,127,2])&&$("#profile #btnRenZheng").on("click",function(){window.pageManager.go("renzheng")}).show()}

*/
function checkVersion() {
    $.getJSON('com/get.version.php', {userid: user.userid}, function (json) {
        console.log(json);
        if (json.userid != user.userid || (json.flagid && json.flagid != user.flagid)) {
            reLogin();  // 用户id或平台变更，重新登录                
        } else if (json.userid && (user.role != json.role || (json.projectid && user.projectid != json.projectid))) {
            // 用户身份变更，刷新页面
            user.role = json.role;
            user.projectid = json.projectid;
            resetUserCookie();

            window.location.reload();
        } else if ((window.isPC && json.pcsys > version) || (!window.isPC && json.sys > version)) {
            reLogin();
            // window.location.reload(true); // 系统升级
        } else if (json.userid) {
            if (user.version != json.version) {
                $('#headImage').attr('src', 'headimg/96/' + json.userid + '.jpg?v=' + json.version)
                    .error(onerrorHeadimg);

                user.version = json.version;
                resetUserCookie();
            }
            if (window.localStorage) {
                localStorage['user_' + json.userid] = JSON.stringify(json);
            }
        }
        user = json;
        document.title = user.company;
    });
}

function resetUserCookie() {
    var user_cookie = JSON.stringify(user);
    addcookie('user2' + user.flagid, user_cookie);
    if (user.openid && user.flagid != user.openid) addcookie('user2' + user.openid, user_cookie);
}

function reLogin() {
    clearcookie();
    window.location.reload(true);
}

function setProfile() {
    if (user.userid && window.localStorage) {
        var data = JSON.parse(localStorage['user_' + user.userid]);

        var project = $.inArray(data.role, [10, 127]) >= 0 ? ''
            : (data.role == 2 ? (data.department ? (data.department + '<br>') : '')
                : (data.project ? (data.project + '<br>') : ''));

        $('#profile .zt_name').html((data.name ? data.name : '访客') + ' ' + (data.phone ? data.phone : '未登记电话'));
        $('#profile .zt_tel').html(project + roleName(data.role));
    } else {
        $('#profile .zt_name').html('访客');
    }

    $('#profile_headimg').attr('src', 'headimg/96/' + user.userid + '.jpg?v=' + user.version).error(onerrorHeadimg);


    if ($.inArray(user.role, [10, 11, 127, 2]) >= 0) {
        $('#profile #btnRenZheng').on('click', function () {
            window.pageManager.go('renzheng');
        }).show();
    }
}

setTimeout(checkVersion, 300);


/*
function setWechatShare(){if(0<navigator.userAgent.indexOf("MicroMessenger")){var a=function(a){wx.config({debug:!1,appId:a.appId,timestamp:a.timestamp,nonceStr:a.nonceStr,signature:a.signature,jsApiList:"onMenuShareTimeline onMenuShareAppMessage onMenuShareQQ onMenuShareQZone onMenuShareWeibo hideMenuItems".split(" ")});wx.ready(function(){wx.hideMenuItems({menuList:["menuItem:copyUrl"]});prepareShare()})};loadJS("https://res.wx.qq.com/open/js/jweixin-1.0.0.js");(function(){$.getJSON("/com/wechat.jssdk.php?url="+
encodeURIComponent(location.href.split("#")[0]),function(b){a(b)})})()}}
function getImageUrl(){switch(pageManager.frontPage){case "recordview":var a=yangshu.record[yangshu.recordIndex].photo.split(";")[0];return"https://www.yangshuwang.com/"+("v"==a.substr(-1)?"videos/":"photos/m/")+a+".jpg";case "record":return a=yangshu.record[0].photo.split(";")[0],"https://www.yangshuwang.com/"+("v"==a.substr(-1)?"videos/":"photos/m/")+a+".jpg";default:return"https://www.yangshuwang.com/platform/"+urlWhere.flagid+".png"}}
function getLink(a){a={flagid:urlWhere.flagid};switch(pageManager.frontPage){case "recordview":a.recordid=yangshu.record[yangshu.recordIndex].id;break;case "record":a.recordWhere=yangshu.recordWhere}return"https://www.yangshuwang.com/m.html?where="+encodeURIComponent(JSON.stringify(a))}
function getTitle(){switch(pageManager.frontPage){case "recordview":var a=yangshu.record[yangshu.recordIndex];return a.project+a.areanumber+"\u7684\u517b\u62a4\u65e5\u5fd7";case "record":return"\u56ed\u6797\u7eff\u5316\u517b\u62a4\u65e5\u5fd7";default:return"\u56ed\u6797\u7eff\u5316\u517b\u62a4\u5e73\u53f0"}}
function getDescription(){switch(pageManager.frontPage){case "recordview":var a=yangshu.record[yangshu.recordIndex];return a.work+a.peoples+"\u4eba,"+string2date(a.time)+" "+a.username+" "+a.userphone;case "record":return $("#searchInput").val();default:return""}}function shareSuccess(a){}
function prepareShare(){wx.onMenuShareAppMessage({title:getTitle(),desc:getDescription(),link:getLink(0),imgUrl:getImageUrl(),success:function(){shareSuccess(0)}});wx.onMenuShareTimeline({title:getTitle()+" "+getDescription(),link:getLink(1),imgUrl:getImageUrl(),success:function(){shareSuccess(1)}});wx.onMenuShareQQ({title:getTitle(),desc:getDescription(),link:getLink(2),imgUrl:getImageUrl(),success:function(){shareSuccess(2)}});wx.onMenuShareWeibo({title:getTitle(),desc:getDescription(),link:getLink(3),
imgUrl:getImageUrl(),success:function(){shareSuccess(3)}});wx.onMenuShareQZone({title:getTitle(),desc:getDescription(),link:getLink(4),imgUrl:getImageUrl(),success:function(){shareSuccess(4)}})}
*/

/***********微信分享*************/

function setWechatShare() {
    if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
        loadJS('http://res.wx.qq.com/open/js/jweixin-1.0.0.js');

        function setWechatJSSDK(res) {
            wx.config({
                debug: false,
                appId: res.appId,
                timestamp: res.timestamp,
                nonceStr: res.nonceStr,
                signature: res.signature,
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'onMenuShareQQ',
                    'onMenuShareQZone',
                    'onMenuShareWeibo',
                    'hideMenuItems'
                ]
            });

            wx.ready(function () {
                wx.hideMenuItems({
                    menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                });

                prepareShare();
            });
        }

        function loadWechatJSSDK() {
            $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
                setWechatJSSDK(res);
            });
        }

        loadWechatJSSDK();
    }
}

function getImageUrl() {
    var url = 'http://www.yangshuwang.com/';
    switch (pageManager.frontPage) {
        case 'recordview':
            var photo = yangshu.record[yangshu.recordIndex].photo.split(';')[0];
            return url + (photo.substr(-1) == 'v' ? 'videos/' : 'photos/m/') + photo + '.jpg';
        case 'record':
            var photo = yangshu.record[0].photo.split(';')[0];
            return url + (photo.substr(-1) == 'v' ? 'videos/' : 'photos/m/') + photo + '.jpg';
        default:
            return url + 'platform/' + urlWhere.flagid + '.png';
    }
}

function getLink(type) {
    var where = {flagid: urlWhere.flagid};
    switch (pageManager.frontPage) {
        case 'recordview':
            where.recordid = yangshu.record[yangshu.recordIndex].id;
            break;
        case 'record':
            where.recordWhere = yangshu.recordWhere;
            break;
    }
    return 'http://www.yangshuwang.com/m.html?where=' + encodeURIComponent(JSON.stringify(where));
}

function getTitle() {
    switch (pageManager.frontPage) {
        case 'recordview':
            var record = yangshu.record[yangshu.recordIndex];
            return record.project + record.areanumber + '的养护日志';
        case 'record':
            return user.company;//'园林绿化养护日志';
        default:
            return user.company;//'园林绿化养护平台';
    }
}

function getDescription() {
    switch (pageManager.frontPage) {
        case 'recordview':
            var record = yangshu.record[yangshu.recordIndex];
            return record.work + record.peoples + '人,' + string2date(record.time) + ' ' + record.username + ' ' + record.userphone;
        case 'record':
            return $('#searchInput').val();
        default:
            return '';
    }
}

function shareSuccess(type) {
}

function prepareShare() {
    wx.onMenuShareAppMessage({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(0),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(0);
        }
    });

    wx.onMenuShareTimeline({
        title: getTitle() + ' ' + getDescription(),
        link: getLink(1),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(1);
        }
    });

    wx.onMenuShareQQ({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(2),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(2);
        }
    });

    wx.onMenuShareWeibo({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(3),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(3);
        }
    });

    wx.onMenuShareQZone({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(4),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(4);
        }
    });
}

/********延时处理，检查用户********/

setTimeout(setWechatShare, 500);

if (0 < navigator.userAgent.indexOf("MicroMessenger")) {
    document.oncontextmenu = function () {
        return false
    }
}