var isHome = true;
var where = {};
var total = 0;
var items = 0;
var isRegion = false;
var priceSlider;
var previousWhere = {};
var url_shop_id = urlRequest("shopid");
var url_phone = urlRequest("phone");
var platformid = "";
var platformname;
var flagid;
var share;

function getWhere() {
    if (typeof platform != "undefined") {
        where.platform = platform
    }
    if (url_phone && typeof isOpenApi != "undefined") {
        where.phone = url_phone
    }
    if (url_shop_id) {
        where.shopid = url_shop_id
    }
    if (flagid) {
        where.flagid = flagid
    } else {
        if (window.union) {
            where.flagid = union
        }
    }
    var str = JSON.stringify(where);
    if (str.length < 3) {
        str = ""
    }
    return str
}

function getLimit() {
    return page * pageItems + "," + pageItems
}

function isWhere() {
    return where["key"] || where["province"] || where["phone"] || where["shopid"] || where["dbh"] || where["dbh1"] || where["crownwidth"] || where["crownwidth1"] || where["height"] || where["height1"] || where["price"] || where["price1"] || where["renzheng"] || where["fapiao"] || where["qijian"] || where["yuantu"] || where["shipin"] || where["platform"]
}

function getProvince(forWhere) {
    $("#province").html("");
    var url;
    if (isWhere()) {
        url = "/com/province.php"
    } else {
        url = "/data/p.json";
        forWhere = ""
    }
    $.getJSON(url, {where: forWhere}, function (json) {
        total = 0;
        items = 0;
        var html = "";
        if (json) {
            if (json.length == 1) {
                where.province = json[0].province;
                getCitys();
                return
            }
            for (var i = 0; i < json.length; i++) {
                var p = json[i];
                html += "<a href=\"javascript:searchProvince('" + p.province + "'," + p.items + "," + p.count + ')">' + p.province + "<span>" + shortPrice(p.count) + "</span></a>";
                total += p.count * 1;
                items += p.items * 1
            }
        }
        $("#province").html(html);
        setTotal(items, total)
    })
}

function setTotal(items, total) {
    $("#total").html(items + "项" + total + "株");
    try {
        prepareShare()
    } catch (e) {
    }
}

function searchKey(key, province, isExact) {
    if (isRegion) {
        province = where.province
    }
    where = {};
    if (key) {
        if (isPhone(key)) {
            where.phone = key;
            $("#where").append('<span id="s_key" onclick="searchAll()">' + where.phone + "<b>╳</b></span>")
        } else {
            where.key = decompositionKey(key);
            if (isExact) {
                where.exact = 1
            }
        }
    }
    if (province) {
        where.province = province
    }
    research();
    if (where.key) {
        resetDefaultSpecifications();
        $("#where").append('<span id="s_key" onclick="searchAll()">' + where.key + "<b>╳</b></span>")
    }
    if (province) {
        $("#where").html('<span id="s_province" onclick="searchForCancleProvince()">' + province + "<b>╳</b></span>")
    }
}

function cn_2_num(string) {
    var convert_cn = ["〇", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十"];
    var str;
    if (string.indexOf("公分") >= false) {
        str = string.split("公分")[0]
    } else {
        if (string.indexOf("厘米") >= false) {
            str = string.split("厘米")[0]
        } else {
            if (string.indexOf("米") >= false) {
                str = string.split("米")[0]
            } else {
                if (string.indexOf("的") >= false) {
                    str = string.split("的")[0]
                } else {
                    return string
                }
            }
        }
    }
    str = str.replace("零", "〇");
    var len = str.length;
    var num = 0;
    var k = "";
    var num_cn = "";
    for (var i = 0; i < len; i++) {
        cn = str[i];
        if (cn == "十") {
            num = num + (k ? parseInt(k) * 10 : 10);
            k = "";
            num_cn += cn
        } else {
            var key = $.inArray(cn, convert_cn);
            if (key >= 0) {
                k += key.toString();
                num_cn += cn
            }
        }
    }
    if (k) {
        num = num + parseInt(k)
    }
    return num_cn ? string.replace(num_cn, num) : string
}

function decompositionKey(key) {
    key = key.replace("至", "-");
    key = key.replace("－", "-");
    if (key.indexOf("-") >= 0) {
        key = key.split("-");
        key = cn_2_num(key[0]) + "-" + cn_2_num(key[1])
    } else {
        key = cn_2_num(key)
    }
    key = key.replace("的", "");
    key = key.replace("_", "");
    key = key.replace("h", "");
    var value = key.replace(/[^\d\.\-\－]/g, "");
    if (value) {
        if (value.length >= 3 && value.indexOf(".") < 0 && value.indexOf("-") < 0) {
            where.key = key;
            return
        }
        var isHeight = false;
        key = key.replace(value, "");
        key = key.toLowerCase();
        if (key.indexOf("公分") >= 0) {
            key = key.replace("公分", "")
        } else {
            if (key.indexOf("厘米") >= 0) {
                key = key.replace("公分", "")
            } else {
                if (key.indexOf("cm") >= 0) {
                    key = key.replace("cm", "")
                } else {
                    if (key.indexOf("米") >= 0) {
                        key = key.replace("米", "");
                        isHeight = true
                    } else {
                        if (key.indexOf("m") >= 0) {
                            key = key.replace("m", "");
                            isHeight = true
                        }
                    }
                }
            }
        }
        if (isHeight) {
            defaultHeight(value, true)
        } else {
            defaultDbh(value, true)
        }
    }
    return key
}

function resetDefaultSpecifications() {
    $("#default_dbh").html("");
    $("#default_crownwidth").html("");
    $("#default_height").html("");
    $.getJSON("/com/specification.php", {key: where.key}, function (json) {
        if (json) {
            var count = isPc ? 9 : 7;
            var html = "";
            for (var i = 1; i < count; i++) {
                var dbh = json["dbh" + i];
                if (dbh) {
                    dbh = Math.round(dbh * 100) / 100;
                    html += '<a href="javascript:defaultDbh(' + dbh + ')">' + dbh + "</a>"
                }
            }
            $("#default_dbh").html(html);
            html = "";
            for (var i = 1; i < count; i++) {
                var crownwidth = json["crownwidth" + i];
                if (crownwidth) {
                    crownwidth = Math.round(crownwidth * 100) / 100;
                    html += '<a href="javascript:defaultCrownWidth(' + crownwidth + ')">' + crownwidth + "</a>"
                }
            }
            $("#default_crownwidth").html(html);
            html = "";
            for (var i = 1; i < count; i++) {
                var height = json["height" + i];
                if (height) {
                    height = Math.round(height * 100) / 100;
                    html += '<a href="javascript:defaultHeight(' + height + ')">' + height + "</a>"
                }
            }
            $("#default_height").html(html)
        }
    })
}

function defaultDbh(dbh, isFromKey) {
    $("#spec_dbh").val(dbh);
    searchDbh(isFromKey)
}

function defaultCrownWidth(crownwidth) {
    $("#spec_crownwidth").val(crownwidth);
    searchCrownWidth()
}

function defaultHeight(height, isFromKey) {
    $("#spec_height").val(height);
    searchHeight(isFromKey)
}

function searchAll() {
    $("#where").html("");
    $("#spec_dbh").val("");
    $("#spec_crownwidth").val("");
    $("#spec_height").val("");
    $("#default_dbh").html("");
    $("#default_crownwidth").html("");
    $("#default_height").html("");
    if (!isPc && $("#userlist").length > 0) {
        $("#userlist").show();
        $("#treelist").hide();
        $("#footer").hide()
    } else {
        var province = isRegion ? where.province : "";
        where = {};
        if (isRegion) {
            where.province = province;
            $("#where").html('<span id="s_province" onclick="searchForCancleProvince()">' + province + "<b>╳</b></span>")
        }
        research()
    }
}

function searchDbh(isFromKey) {
    var dbh = $.trim($("#spec_dbh").val());
    delete where.dbh;
    delete where.dbh1;
    delete where.dbh2;
    if (dbh) {
        dbh = dbh.replace("－", "-").replace("。", ".");
        var node = $("#s_dbh");
        if (node.length > 0) {
            $(node).html("径" + dbh + "<b>╳</b>")
        } else {
            $("#where").append('<span id="s_dbh" onclick="searchForCancleSpecifications(\'dbh\')">径' + dbh + "<b>╳</b></span>")
        }
        dbh = dbh.split("-");
        if (dbh.length == 1) {
            where.dbh = dbh[0]
        } else {
            where.dbh1 = dbh[0];
            where.dbh2 = dbh[1]
        }
    } else {
        $("#s_dbh").remove()
    }
    if (isFromKey !== true) {
        research()
    }
}

function searchCrownWidth() {
    var crownwidth = $.trim($("#spec_crownwidth").val());
    delete where.crownwidth;
    delete where.crownwidth1;
    delete where.crownwidth2;
    if (crownwidth) {
        crownwidth = crownwidth.replace("－", "-").replace("。", ".");
        var node = $("#s_crownwidth");
        if (node.length > 0) {
            $(node).html("冠" + crownwidth + "<b>╳</b>")
        } else {
            $("#where").append('<span id="s_crownwidth" onclick="searchForCancleSpecifications(\'crownwidth\')">冠' + crownwidth + "<b>╳</b></span>")
        }
        crownwidth = crownwidth.split("-");
        if (crownwidth.length == 1) {
            where.crownwidth = crownwidth[0]
        } else {
            where.crownwidth1 = crownwidth[0];
            where.crownwidth2 = crownwidth[1]
        }
    } else {
        $("#s_crownwidth").remove()
    }
    research()
}

function searchHeight(isFromKey) {
    var height = $.trim($("#spec_height").val());
    delete where.height;
    delete where.height1;
    delete where.height2;
    if (height) {
        height = height.replace("－", "-").replace("。", ".");
        var node = $("#s_height");
        if (node.length > 0) {
            $(node).html("高" + height + "<b>╳</b>")
        } else {
            $("#where").append('<span id="s_height" onclick="searchForCancleSpecifications(\'height\')">高' + height + "<b>╳</b></span>")
        }
        height = height.split("-");
        if (height.length == 1) {
            where.height = height[0]
        } else {
            where.height1 = height[0];
            where.height2 = height[1]
        }
    } else {
        $("#s_height").remove()
    }
    if (isFromKey !== true) {
        research()
    }
}

function searchForCancleSpecifications(type) {
    delete where[type];
    delete where[type + "1"];
    delete where[type + "2"];
    $("#s_" + type).remove();
    $("#spec_" + type).val("");
    research()
}

function searchProvince(province, items, count) {
    where.province = province;
    var node = $("#s_province");
    if (node.length > 0) {
        $(node).html(province + "<b>╳</b>")
    } else {
        $("#where").append('<span id="s_province" onclick="searchForCancleProvince()">' + province + "<b>╳</b></span>")
    }
    $("#treelist").html("");
    page = 0;
    search(getWhere(), getLimit());
    getCitys(province)
}

function searchForCancleProvince() {
    if (isRegion) {
        alert(where.province + "分站,不可取消！");
        return
    }
    $("#s_province").remove();
    $("#s_city").remove();
    $("#s_district").remove();
    delete where.province;
    delete where.city;
    delete where.district;
    research()
}

function getCitys(province) {
    delete where.city;
    $("#province").html("");
    $.getJSON("/com/province.php", {where: getWhere()}, function (citys) {
        if (citys && citys.length == 1) {
            where.city = citys[0].city;
            getDistricts();
            return
        }
        total = 0;
        items = 0;
        var html = "";
        if (citys) {
            for (var i = 0; i < citys.length; i++) {
                var city = citys[i];
                html += "<a href=\"javascript:searchCity('" + city.city + "'," + city.items + "," + city.count + ')">' + city.city + "<span>" + shortPrice(city.count) + "</span></a>";
                total += city.count * 1;
                items += city.items * 1
            }
        }
        setTotal(items, total);
        $("#province").html(html);
        $("#province_ul").show()
    })
}

function searchCity(city, items, count) {
    where.city = city;
    var node = $("#s_city");
    if (node.length > 0) {
        $(node).html(city + "<b>╳</b>")
    } else {
        $("#where").append('<span id="s_city" onclick="searchForCancleCity()">' + city + "<b>╳</b></span>")
    }
    $("#treelist").html("");
    page = 0;
    search(getWhere(), getLimit());
    getDistricts(city)
}

function searchForCancleCity() {
    $("#s_city").remove();
    $("#s_district").remove();
    delete where.city;
    delete where.district;
    research()
}

function getDistricts(city) {
    delete where.district;
    $("#province").html("");
    $.getJSON("/com/province.php", {where: getWhere()}, function (districts) {
        total = 0;
        items = 0;
        var html = "";
        if (districts) {
            for (var i = 0; i < districts.length; i++) {
                var district = districts[i];
                html += "<a href=\"javascript:searchDistrict('" + district.district + "'," + district.items + "," + district.count + ')">' + district.district + "<span>" + shortPrice(district.count) + "</span></a>";
                total += district.count * 1;
                items += district.items * 1
            }
        }
        $("#province").html(html);
        setTotal(items, total)
    })
}

function searchDistrict(district, items, count) {
    where.district = district;
    var node = $("#s_district");
    if (node.length > 0) {
        $(node).html(district + "<b>╳</b>")
    } else {
        $("#where").append('<span id="s_district" onclick="searchForCancleDistrict()">' + district + "<b>╳</b></span>")
    }
    $("#total").html(items + "项" + count + "株");
    $("#treelist").html("");
    page = 0;
    search(getWhere(), getLimit())
}

function searchForCancleDistrict() {
    $("#s_district").remove();
    delete where.district;
    research()
}

function searchFilter(which, name) {
    if ($("#s_" + which).length > 0) {
        cancleFilter(which);
        return
    }
    $("#where").append('<span id="s_' + which + '" onclick="cancleFilter(\'' + which + "')\">" + name + "<b>╳</b></span>");
    $("#btn_" + which).attr("class", "selected");
    where[which] = 1;
    research()
}

function cancleFilter(which) {
    $("#btn_" + which).attr("class", "unselect");
    $("#s_" + which).remove();
    delete where[which];
    research()
}

function searchGroup(group) {
    var btn = $("#group" + group);
    var s_group = $("#s_group");
    if (s_group.length > 0 && s_group.html() == btn.html()) {
        return
    }
    if (btn.attr("class") == "selected") {
        cancleGroup()
    } else {
        $("#group1000").attr("class", "unselect");
        $("#group1001").attr("class", "unselect");
        $("#group1022").attr("class", "unselect");
        btn.attr("class", "selected");
        if (s_group.length > 0) {
            s_group.html(btn.html() + "<b>╳</b>")
        } else {
            $("#where").append('<span id="s_group" onclick="cancleGroup()">' + btn.html() + "<b>╳</b></span>")
        }
        where.platform = group;
        research()
    }
}

function cancleGroup() {
    $("#group1000").attr("class", "unselect");
    $("#group1001").attr("class", "unselect");
    $("#s_group").remove();
    delete where.platform;
    if ($("s_province").length == 0) {
        delete where.province
    }
    if ($("s_city").length == 0) {
        delete where.city
    }
    if ($("s_district").length == 0) {
        delete where.district
    }
    research()
}

function orderByPrice() {
    var btn = $("#btn_price");
    var s_price = $("#s_price");
    if (s_price.length > 0 && s_price.html() == btn.html()) {
        return
    }
    if (btn.html() == "价格◇") {
        btn.html("价格▲");
        btn.attr("class", "selected");
        $("#where").append('<span id="s_price" onclick="cancleByPrice()">价格▲<b>╳</b></span>');
        where.price = "up"
    } else {
        if (btn.html() == "价格▲") {
            btn.html("价格▼");
            s_price.html("价格▼<b>╳</b>");
            where.price = "down"
        } else {
            cancleByPrice();
            return
        }
    }
    research(true)
}

function cancleByPrice() {
    $("#btn_price").attr("class", "unselect");
    $("#btn_price").html("价格◇");
    $("#s_price").remove();
    delete where.price;
    research(true)
}

function orderByTime() {
    if ($("#s_time").length > 0) {
        cancleTime();
        return
    }
    $("#where").append('<span id="s_time" onclick="cancleTime()">时间<b>╳</b></span>');
    $("#btn_time").attr("class", "selected");
    where.time = 1;
    research()
}

function cancleTime() {
    $("#btn_time").attr("class", "unselect");
    $("#s_time").remove();
    delete where.time;
    research()
}

function research(isPriceSlider) {
    $("#treelist").html("");
    page = 0;
    var forWhere = getWhere();
    search(forWhere, getLimit(), isPriceSlider);
    if (where.city) {
        getDistricts()
    } else {
        if (where.province) {
            getCitys()
        } else {
            getProvince(forWhere)
        }
    }
}

function searchMore() {
    var scrollTop = itemHeight > 100 ? $(document).scrollTop() : $(document.body).scrollTop();
    var top = $("#treelist").offset().top;
    if (isPc && $("#userlist").length > 0) {
        if (scrollTop > top) {
            if ($("#userlist").attr("class") == "") {
                $("#userlist").attr("class", "userlist_fixed");
                $("#userlist").height($(window).height())
            }
        } else {
            if ($("#userlist").attr("class") != "") {
                $("#userlist").removeClass()
            }
        }
    }
    if (isEnd || isLoading || $("#treeview").length > 0 || (!isPc && $("#userlist").length > 0 && $("#userlist").css("display") != "none")) {
        return
    }
    if (scrollTop > top + $("#treelist").height() - $(window).height()) {
        $("#searchmore").show();
        search(getWhere(), getLimit())
    }
}

function shortPrice(price) {
    if (price >= 100000000) {
        return (price / 100000000).toFixed(4) + "亿"
    } else {
        if (price >= 10000) {
            return parseInt(price / 10000) + "万"
        } else {
            return price
        }
    }
}

function setPrice(forWhere, isPriceSlider) {
    $("#average").html("");
    if (!isPriceSlider) {
        $("#s_pricerange").remove()
    }
    var url;
    if (isWhere()) {
        url = "/com/averageprice.php"
    } else {
        url = "/data/a.json";
        forWhere = ""
    }
    $.getJSON(url, {where: forWhere}, function (price) {
        var priceRange;
        if (price.avg > 0) {
            $("#average").html(" 均价<b>¥" + price.avg.toFixed(2) + "</b>");
            priceRange = {
                min: price.min.toFixed(2),
                max: price.max.toFixed(2),
                from: price.min.toFixed(2),
                to: price.max.toFixed(2),
                avg: price.avg.toFixed(2),
                histogram: price.histogram
            }
        } else {
            priceRange = {min: 0, max: 0, from: 0, to: 0}
        }
        if (!isPriceSlider) {
            if (!priceSlider) {
                initPriceSlider()
            }
            priceSlider.update(priceRange)
        }
    })
}

function checkWhereChanged() {
    var where1 = cloneWhere(previousWhere);
    delete where1.price;
    delete where1.price1;
    delete where1.price2;
    var where2 = cloneWhere(where);
    delete where2.price;
    delete where2.price1;
    delete where2.price2;
    if (JSON.stringify(where1) != JSON.stringify(where2)) {
        previousWhere = cloneWhere(where);
        return true
    } else {
        return false
    }
}

function cloneWhere(source) {
    var target = {};
    for (var k in source) {
        target[k] = source[k]
    }
    return target
}

function searchPrice(data) {
    if (data.from == data.min) {
        delete where.price1
    } else {
        where.price1 = data.from
    }
    if (data.to == data.max) {
        delete where.price2
    } else {
        where.price2 = data.to
    }
    research(true);
    if ($("#s_pricerange").length > 0) {
        $("#s_pricerange").html("价格" + data.from + "-" + data.to + "<b>╳</b>")
    } else {
        $("#where").append('<span id="s_pricerange" onclick="cancleSearchPrice()">价格' + data.from + "-" + data.to + "<b>╳</b></span>")
    }
}

function cancleSearchPrice() {
    delete where.price1;
    delete where.price2;
    research()
}

function initPriceSlider() {
    $("#range").ionRangeSlider({
        hide_min_max: true,
        type: "double",
        step: 10,
        prefix: "¥",
        grid: true,
        onFinish: searchPrice
    });
    priceSlider = $("#range").data("ionRangeSlider");
    $("#range").show()
}

function init() {
    if (urlRequest("where")) {
        var string_where = urlRequest("where");
        string_where = string_where.replace(/“/g, '"');
        where = JSON.parse(string_where);
        if (where.key) {
            $("#where").html('<span id="s_key" onclick="searchAll()">' + where.key + "<b>╳</b></span>")
        }
        if (where.dbh) {
            $("#where").append('<span id="s_dbh" onclick="searchForCancleSpecifications(\'dbh\')">径' + where.dbh + "<b>╳</b></span>");
            $("#spec_dbh").val(where.dbh);
            if (isNaN(where.dbh)) {
                where.dbh = where.dbh.replace(",", "-");
                var dbh = where.dbh.split("-");
                if (dbh.length == 2) {
                    where.dbh1 = dbh[0];
                    where.dbh2 = dbh[1];
                    delete where.dbh
                }
            }
        } else {
            if (where.dbh1 && where.dbh2) {
                $("#where").append('<span id="s_dbh" onclick="searchForCancleSpecifications(\'dbh\')">径' + where.dbh1 + "-" + where.dbh2 + "<b>╳</b></span>");
                $("#spec_dbh").val(where.dbh1 + "-" + where.dbh2)
            }
        }
        if (where.crownwidth) {
            $("#where").append('<span id="s_crownwidth" onclick="searchForCancleSpecifications(\'crownwidth\')">冠' + where.crownwidth + "<b>╳</b></span>");
            $("#spec_crownwidth").val(where.crownwidth);
            if (isNaN(where.crownwidth)) {
                where.crownwidth = where.crownwidth.replace(",", "-");
                var crownwidth = where.crownwidth.split("-");
                if (crownwidth.length == 2) {
                    where.crownwidth1 = crownwidth[0];
                    where.crownwidth2 = crownwidth[1];
                    delete where.crownwidth
                }
            }
        } else {
            if (where.crownwidth1 && where.crownwidth2) {
                $("#where").append('<span id="s_crownwidth" onclick="searchForCancleSpecifications(\'crownwidth\')">冠' + where.crownwidth1 + "-" + where.crownwidth2 + "<b>╳</b></span>");
                $("#spec_crownwidth").val(where.crownwidth1 + "-" + where.crownwidth2)
            }
        }
        if (where.height) {
            $("#where").append('<span id="s_height" onclick="searchForCancleSpecifications(\'height\')">高' + where.height + "<b>╳</b></span>");
            $("#spec_height").val(where.height);
            if (isNaN(where.height)) {
                where.height = where.height.replace(",", "-");
                var height = where.height.split("-");
                if (height.length == 2) {
                    where.height1 = height[0];
                    where.height2 = height[1];
                    delete where.height
                }
            }
        } else {
            if (where.height1 && where.height2) {
                $("#where").append('<span id="s_height" onclick="searchForCancleSpecifications(\'height\')">高' + where.height1 + "-" + where.height2 + "<b>╳</b></span>");
                $("#spec_height").val(where.height1 + "-" + where.height2)
            }
        }
        if (where.age) {
            $("#where").append('<span id="s_age" onclick="searchForCancleSpecifications(\'age\')">龄' + where.age + "<b>╳</b></span>");
            if (isNaN(where.age)) {
                where.age = where.age.replace(",", "-");
                var age = where.age.split("-");
                if (age.length == 2) {
                    where.age1 = age[0];
                    where.age2 = age[1];
                    delete where.age
                }
            }
        } else {
            if (where.age1 && where.age2) {
                $("#where").append('<span id="s_age" onclick="searchForCancleSpecifications(\'age\')">龄' + where.age1 + "-" + where.age2 + "<b>╳</b></span>")
            }
        }
        if (where.branch_point_height) {
            $("#where").append('<span id="s_branch_point_height" onclick="searchForCancleSpecifications(\'branch_point_height\')">高' + where.branch_point_height + "<b>╳</b></span>");
            if (isNaN(where.branch_point_height)) {
                where.branch_point_height = where.branch_point_height.replace(",", "-");
                var branch_point_height = where.branch_point_height.split("-");
                if (branch_point_height.length == 2) {
                    where.branch_point_height1 = branch_point_height[0];
                    where.branch_point_height2 = branch_point_height[1];
                    delete where.branch_point_height
                }
            }
        } else {
            if (where.branch_point_height1 && where.branch_point_height2) {
                $("#where").append('<span id="s_branch_point_height" onclick="searchForCancleSpecifications(\'branch_point_height\')">高' + where.branch_point_height1 + "-" + where.branch_point_height2 + "<b>╳</b></span>")
            }
        }
        if (where.branch_bough_number) {
            where.branch_bough_number = where.branch_bough_number.replace(",", "-");
            $("#where").append('<span id="s_branch_bough_number" onclick="searchForCancleSpecifications(\'branch_bough_number\')">分' + where.branch_bough_number + "<b>╳</b></span>");
            if (isNaN(where.branch_bough_number)) {
                var branch_bough_number = where.branch_bough_number.split("-");
                if (branch_bough_number.length == 2) {
                    where.branch_bough_number1 = branch_bough_number[0];
                    where.branch_bough_number2 = branch_bough_number[1];
                    delete where.branch_bough_number
                }
            }
        } else {
            if (where.branch_bough_number1 && where.branch_bough_number1) {
                $("#where").append('<span id="s_branch_bough_number" onclick="searchForCancleSpecifications(\'branch_bough_number\')">分' + where.branch_bough_number1 + "-" + where.branch_bough_number2 + "<b>╳</b></span>")
            }
        }
        if (where.substrate) {
            $("#where").append('<span id="s_substrate" onclick="searchForCancleSpecifications(\'substrate\')">' + where.substrate + "<b>╳</b></span>")
        }
        if (where.province) {
            $("#where").append('<span id="s_province" onclick="searchForCancleProvince()">' + where.province + "<b>╳</b></span>")
        }
        if (where.city && where.city != where.province) {
            $("#where").append('<span id="s_city" onclick="searchForCancleCity()">' + where.city + "<b>╳</b></span>")
        }
        if (where.district) {
            $("#where").append('<span id="s_district" onclick="searchForCancleDistrict()">' + where.district + "<b>╳</b></span>")
        }
        if (where.region) {
            isRegion = true
        }
        if (where.platformid) {
            platformid = where.platformid;
            delete where.platformid
        }
        if (where.platformname) {
            platformname = where.platformname;
            delete where.platformname
        }
        if (where.flagid) {
            flagid = where.flagid;
            delete where.flagid
        }
        if (typeof where.share != "undefined") {
            share = where.share;
            delete where.share
        }
    } else {
        var key = urlRequest("key");
        if (key) {
            key = key.replace(/(^\s*)|(\s*$)/g, "");
            if (isNaN(key)) {
                where.key = key;
                var keys = key.split(" ");
                where.key = decodeURI(keys[0]);
                $("#where").html('<span id="s_key" onclick="searchAll()">' + keys[0] + "<b>╳</b></span>");
                if (keys.length > 1) {
                    where.province = decodeURI(keys[1]);
                    $("#where").append('<span id="s_province" onclick="searchForCancleProvince()">' + keys[1] + "<b>╳</b></span>")
                }
            } else {
                where.phone = key;
                $("#where").html('<span id="s_key" onclick="searchAll()">' + key + "<b>╳</b></span>")
            }
        }
        var shop = urlRequest("shop");
        if (shop) {
            where.shopid = decodeURI(shop);
            $("#where").html('<span id="s_key" onclick="searchAll()">' + urlRequest("shopname") + "<b>╳</b></span>")
        }
        var dbh = urlRequest("dbh");
        if (dbh) {
            where.dbh = decodeURI(dbh);
            $("#where").append('<span id="s_dbh" onclick="searchForCancleSpecifications(\'dbh\')">径' + dbh + "<b>╳</b></span>")
        }
        var crownwidth = urlRequest("crownwidth");
        if (crownwidth) {
            where.crownwidth = decodeURI(crownwidth);
            $("#where").append('<span id="s_crownwidth" onclick="searchForCancleSpecifications(\'crownwidth\')">冠' + crownwidth + "<b>╳</b></span>")
        }
        var height = urlRequest("height");
        if (height) {
            where.height = decodeURI(height);
            $("#where").append('<span id="s_height" onclick="searchForCancleSpecifications(\'height\')">高' + height + "<b>╳</b></span>")
        }
        var province = urlRequest("province");
        if (province) {
            where.province = decodeURI(province);
            $("#where").append('<span id="s_province" onclick="searchForCancleProvince()">' + province + "<b>╳</b></span>")
        }
        var city = urlRequest("city");
        if (city) {
            where.city = decodeURI(city);
            if (city != province) {
                $("#where").append('<span id="s_city" onclick="searchForCancleCity()">' + city + "<b>╳</b></span>")
            }
        }
        var district = urlRequest("district");
        if (district) {
            where.district = decodeURI(district);
            $("#where").append('<span id="s_district" onclick="searchForCancleDistrict()">' + district + "<b>╳</b></span>")
        }
    }
    if (isPc || $("#userlist").length <= 0) {
        var forWhere = getWhere();
        search(forWhere, getLimit());
        if (where.city) {
            getDistricts()
        } else {
            if (where.province) {
                getCitys()
            } else {
                getProvince(forWhere)
            }
        }
    }
    if (!isPc) {
        if (!window.isShop && !window.isCart) {
            document.title = window.platformname ? window.platformname : "找树网 找放心树"
        }
        var logo = platformid ? "/platform/search_" + platformid + ".jpg" : "/img/logo72.jpg";
        $("#logo").attr("src", logo);
        var footer = platformid ? '<br><img src="/platform/wx' + platformid + '.png" onerror="this.src=\'/platform/wx.jpg\'">' : '<br><img src="/platform/wx.jpg">';
        $("#footer").html(footer)
    }
    if (where.key) {
        resetDefaultSpecifications()
    }
}

init();
$(function () {
    $("#spec_dbh").change(searchDbh);
    $("#spec_crownwidth").change(searchCrownWidth);
    $("#spec_height").change(searchHeight);
    if (!url_shop_id) {
        $(window).scroll(searchMore)
    }
});