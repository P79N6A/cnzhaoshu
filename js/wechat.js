var shareOrder = "", $userlist = document.getElementById("userlist");
function getImageUrl() {
    if ($userlist) return "http://www.cnzhaoshu.com/platform/" + window.platform + ".png";
    if (window.isShop || window.isCart) {
        if (window.shop && shop.headimg) return "http://www.cnzhaoshu.com/headimg/96/" + shop.shopid + ".jpg?v=" + shop.version;
        if (user.headimg) return "http://www.cnzhaoshu.com/headimg/96/" + (window.isShop ? user.shopid : user.userid) + ".jpg?v=" + user.version
    }
    var a = document.getElementById("treelist").getElementsByTagName("img")[0];
    return a ? a.src : "http://www.cnzhaoshu.com/img/logo0.jpg"
}

function getLink(a) {
    if ($userlist) return location.href;
    if (window.isShop || window.isCart) {
        if (!window.shop || 101 != shop.role && 9 != shop.role) {
            if (101 == user.role || 9 == user.role) return "http://www.cnzhaoshu.com/qjd.php?shopid=" + user.userid;
            var b = {userid: user.userid};
            b.share = a;
            window.platformid && (b.platformid = platformid);
            window.flagid && (b.flagid = flagid);
            return "http://www.cnzhaoshu.com/" + (window.isShop ? "shop" : "cart") + ".php?where=" + encodeURIComponent(JSON.stringify(b))
        }
        return "http://www.cnzhaoshu.com/qjd.php?shopid=" +
            shop.userid
    }
    b = window.where;
    b.share = a;
    window.platformid && (b.platformid = platformid);
    window.platformname && (b.platformname = platformname);
    window.flagid && (b.flagid = flagid);
    a = "http://www.cnzhaoshu.com/m.php?where=" + encodeURIComponent(JSON.stringify(b));
    delete b.platformid;
    delete b.platformname;
    delete b.flagid;
    delete b.share;
    return a
}

function getTitle(a) {
    if ($userlist) return document.title + " ";
    if (window.isShop) {
        if (window.shop) {
            var b = window.isBaiWanDian ? "[\u767e\u4e07\u5e97]" : "";
            return shop.shopname + (a ? 101 == shop.role || 9 == shop.role ? "\uff0c\u627e\u6811\u7f51\u65d7\u8230\u5e97" + b + "\uff01" : shop.isrenzheng ? "\uff0c\u627e\u6811\u7f51\u5df2\u8ba4\u8bc1" + b + "\uff01" : "" : "")
        }
        return user.shopname + (a ? 101 == user.role || 9 == user.role ? "\uff0c\u627e\u6811\u7f51\u65d7\u8230\u5e97\uff01" : user.isrenzheng ? "\uff0c\u627e\u6811\u7f51\u5df2\u8ba4\u8bc1\uff01" :
            "" : "")
    }
    return window.isCart ? user.name + "\u7684\u627e\u6811\u8f66" : document.title + " "
}

function getDescription(a) {
    if ($userlist) return users.length + "\u5bb6\u4f1a\u5458\u5355\u4f4d " + users_count + "\u9879 " + users_total + "\u682a\u7cbe\u54c1\u82d7\u6728";
    var b = document.getElementById("total").innerHTML;
    if (window.isShop || window.isCart) {
        if (a) return shareOrder;
        a = window.isBaiWanDian ? "[\u767e\u4e07\u5e97]" : "";
        a = window.isShop ? !window.shop || 101 != shop.role && 9 != shop.role ? 101 == user.role || 9 == user.role ? "\u627e\u6811\u7f51\u65d7\u8230\u5e97" + a : user.isrenzheng ? "\u627e\u6811\u7f51\u5df2\u8ba4\u8bc1" + a : "" :
            "\u627e\u6811\u7f51\u65d7\u8230\u5e97" + a : "";
        a += a ? " " + shareOrder : shareOrder;
        a += "\n";
        if (trees.length) {
            var d = [], c;
            for (c in trees) {
                var e = trees[c];
                3 > d.length && !inArray(e.name, d) && d.push(e.name)
            }
            b = b.substring(0, b.indexOf("\u9879") + 1);
            return a + d.join(",") + "\u7b49" + b
        }
        return a
    }
    c = "";
    if (window.where) {
        where.key && (c += where.key + ",");
        where.province && (c += where.province + ",");
        where.city && where.city != where.province && (c += where.city + ",");
        where.district && (c += where.district + ",");
        if (where.dbh || where.dbh1) c += "\u5f84" + $.trim($("#spec_dbh").val()) +
            ",";
        if (where.crownwidth || where.crownwidth1) c += "\u51a0" + $.trim($("#spec_crownwidth").val()) + ",";
        if (where.height || where.height1) c += "\u9ad8" + $.trim($("#spec_height").val()) + ","
    }
    return c + "\u4e3a\u60a8\u627e\u5230" + b + "\u7cbe\u54c1\u82d7\u6728"
}

function shareSuccess(a) {
    console.log(a);
    window.isShop && (window.visitor ? ajax("com/shareshop.php?shopid=" + user.shopid + "&userid=" + user.userid + "&type=" + a + "&visitorid=" + visitor.userid) : window.shop && window.user && $.post("com/shareshop.php?shopid=" + shop.shopid + "&userid=" + shop.userid + "&type=" + a + "&visitorid=" + user.userid))
}

function prepareShare() {
    wx.onMenuShareAppMessage({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(0),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(0)
        }
    });
    wx.onMenuShareTimeline({
        title: getTitle(!0) + getDescription(!0),
        link: getLink(1),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(1)
        }
    });
    wx.onMenuShareQQ({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(2),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(2)
        }
    });
    wx.onMenuShareWeibo({
        title: getTitle(), desc: getDescription(), link: getLink(3),
        imgUrl: getImageUrl(), success: function () {
            shareSuccess(3)
        }
    });
    wx.onMenuShareQZone({
        title: getTitle(),
        desc: getDescription(),
        link: getLink(4),
        imgUrl: getImageUrl(),
        success: function () {
            shareSuccess(4)
        }
    })
}

function setWechatJSSDK(a) {
    wx.config({
        debug: !1,
        appId: a.appId,
        timestamp: a.timestamp,
        nonceStr: a.nonceStr,
        signature: a.signature,
        jsApiList: "onMenuShareTimeline onMenuShareAppMessage onMenuShareQQ onMenuShareQZone onMenuShareWeibo hideMenuItems previewImage".split(" ")
    });
    wx.ready(function () {
        wx.hideMenuItems({menuList: ["menuItem:copyUrl"]});
        prepareShare()
    })
}

function loadWechatJSSDK() {
    "undefined" == typeof $.getJSON ? ajax("/com/wechat.jssdk.php?url=" + encodeURIComponent(location.href.split("#")[0]), function (a) {
        setWechatJSSDK(JSON.parse(a))
    }) : $.getJSON("/com/wechat.jssdk.php?url=" + encodeURIComponent(location.href.split("#")[0]), function (a) {
        setWechatJSSDK(a)
    })
}

loadWechatJSSDK();