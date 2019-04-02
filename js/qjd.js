function website_filter(a) {
    var b = a.match(/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w-   .\/?%&=]*)?/g);
    if (null != b)
        for (var c = 0; c < b.length; c++) {
            var d = b[c].replace(/www./, "");
            a = a.replace(b[c], '<a class="website" href="' + d + '">' + d + "</a>")
        }
    b = a.match(/www.([\w-]+\.)+[\w-]+(\/[\w-   .\/?%&=]*)?/g);
    if (null != b)
        for (c = 0; c < b.length; c++) a = a.replace(b[c], '<a class="website" href="http://' + b[c] + '">' + b[c] + "</a>");
    return a
}

function createShopQrcode() {
    $.get("/com/shop.qrcode.create.php", {
        shopid: shopid
    }, function () {
        $("#shopqrcode").attr("src", "/shop/qrcode/" + shop.shopid + ".jpg?v=" + shop.version)
    })
}

function showHome() {
    $("#pz_main").show();
    $("#tree").hide()
}

function showTree() {
    $("#pz_main").hide();
    $("#tree").show()
}

function showHonorImage(a) {
    var b = [],
        c;
    for (c in shop.honor) b[c] = "http://www.cnzhaoshu.com/shop/honor/b/" + shop.honor[c].id + ".jpg";
    wx.previewImage({
        current: "http://www.cnzhaoshu.com/shop/honor/b/" + shop.honor[a].id + ".jpg",
        urls: b
    })
}

function loadJS(a) {
    var b = document.createElement("script");
    b.src = a;
    document.body.appendChild(b)
}

function urlRequest(a) {
    return (a = RegExp("[?&]" + a + "=([^&]*)").exec(window.location.search)) && decodeURIComponent(a[1].replace(/\+/g, " "))
}
var shopid = parseInt(urlRequest("shopid")),
    dot_honor = doT.template($("#dot_honor").text()),
    dot_project = doT.template($("#dot_project").text()),
    shop, isBaiWanDian = 0 <= $.inArray(shopid, baiwan),
    width = window.screen.availWidth;
$(".image1").css({
    "min-height": .4 * width + "px"
});
$(".image2").css({
    "min-height": .4 * width + "px"
});
$.getJSON("/com/shop.get.php", {
    shopid: shopid
}, function (a) {
    if (-1 == $.inArray(a.role, [101, 100, 9, 8])) location.replace("./shop.php?userid=" + shopid);
    else {
        shop = a;
        $("#shoplogo").attr("src", "/headimg/96/" + a.shopid + ".jpg?v=" + a.version);
        $("#shopphoto").attr("src", "/shop/photo/m/" + a.shopid + ".jpg?v=" + a.version);
        $("#shopqrcode").attr("src", "/shop/qrcode/" + a.shopid + ".jpg?v=" + a.version);
        $("#wxqrcode").attr("src", "/shop/qrcode/wx" + shopid + ".jpg");
        document.title = a.name;
        $("#shopname").html(a.name);
        $("#shopphone").html(a.phone);
        a.introduction && $("#introduction").html(website_filter(a.introduction));
        $("#bohao").attr("href", "tel:" + a.phone);
        $(".excel").attr("href", "excel.shop.php?userid=" + shopid);
        $("#dianmi").html("\u70b9\u7c73" + a.dianmi);
        a.gps && $("#gps").attr("href", "http://apis.map.qq.com/uri/v1/marker?marker=coord:" + a.gps.x + "," + a.gps.y + ";title:" + a.name + "&referer=zhaoshu");
        $("#honors").html(dot_honor(a.honor));
        $("#projects").html(dot_project(a.project));
        $("#version").html(a.name);
        isBaiWanDian && $("<img>", {
            src: "/img/baiwan.png"
        }).css({
            position: "absolute",
            right: "0",
            top: "50px"
        }).appendTo("body");
        if (a.project)
            if (5 <= a.project.length)
                for (var b = 0; b < a.project.length; b++) a.project[b] && ($(".image" + (1 + b)).css("background-image", "url(./shop/project/b/" + a.project[b].id + ".jpg)"), $(".image" + (1 + b)).parent().attr("href", a.project[b].msg_link));
            else
                for (b = m = 0; 5 > b; b++) a.project.length > b ? ($(".image" + (1 + b)).css("background-image", "url(./shop/project/b/" + a.project[b].id + ".jpg)"), $(".image" + (1 + b)).parent().attr("href", a.project[b].msg_link)) : ($(".image" + (1 + b)).css("background-image",
                    "url(./shop/project/b/" + a.project[m].id + ".jpg)"), $(".image" + (1 + b)).parent().attr("href", a.project[m].msg_link), m++, m == a.project.length && (m = 0));
        else
            for (b = 0; 5 > b; b++) $(".image" + (1 + b)).css("background-image", "url(./images/banner.jpg)");
        loadJS("/js/basic_m.js?t=201801026");
        setTimeout(function () {
            loadJS("/js/index.js?t=20181013")
        }, 200);
        setTimeout(function () {
            $.get("com/qrcode.invite.php?shopid=" + shopid, function () {
                $("#inviteqrcode").attr("src", "/qrinvite/" + shopid + ".jpg")
            });
            if (window.user && shop.shopid != user.shopid) {
                var a =
                    "com/visitshop.php?shopid=" + shop.shopid + "&userid=" + shop.userid + "&visitorid=" + user.userid;
                flagid && (a += "&flagid=" + flagid);
                "undefined" != typeof share && (a += "&type=" + share);
                $.post(a)
            }
        }, 500);
        TouchSlide({
            slideCell: "#slideBox",
            titCell: ".hd ul",
            mainCell: ".bd ul",
            effect: "leftLoop",
            autoPage: !0,
            autoPlay: !0
        })
    }
});