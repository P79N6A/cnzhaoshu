var shareInformation = '';//isShop ? '传视频！拜大年！赢大奖！' : '';
// var shareOrder = '';//isShop ? '第' +dianmiOrder+ '名,' : '';

function getImageUrl(){
  if (window.isShop || window.isCart) {
    if (window.shop && shop.headimg) {
      return 'http://www.cnzhaoshu.com/headimg/96/'+shop.shopid+'.jpg?v=' + shop.version; // 微信头像 
    } else if (user.headimg) {
      return 'http://www.cnzhaoshu.com/headimg/96/'+(window.isShop?user.shopid:user.userid)+'.jpg?v=' + user.version; // 微信头像
    }
  } 

  var treelist = document.getElementById("treelist");
  var shareImgObj = treelist.getElementsByTagName("img")[0];
  if (shareImgObj) {
    return shareImgObj.src;
  } else {
    return 'http://www.cnzhaoshu.com/img/logo0.jpg';
  }
}
function getLink(type){
  // encodeURIComponent 必须，否则QQ分享无效
  if (window.isShop || window.isCart) {
      if (window.shop && (shop.role==101||shop.role==9)) {
        return 'http://www.cnzhaoshu.com/qjd.php?shopid='+shop.userid;
      } else if (user.role==101||user.role==9) {
        return 'http://www.cnzhaoshu.com/qjd.php?shopid='+user.userid;
      } else {
        var where = {"userid": user.userid};

        where.share = type;
        if (window.platformid) where.platformid = platformid;
        if (window.flagid) where.flagid = flagid;

        var page = window.isShop ? 'shop' : 'cart';
        return 'http://www.cnzhaoshu.com/'+page+'.php?where='+encodeURIComponent(JSON.stringify(where));
      }
  } else {
      var where = window.where;
      where.share = type;
      if (window.platformid) where.platformid = platformid;
      if (window.platformname) where.platformname = platformname;
      if (window.flagid) where.flagid = flagid;

      var url = 'http://www.cnzhaoshu.com/m.php?where='+encodeURIComponent(JSON.stringify(where));

      delete where.platformid;
      delete where.platformname;
      delete where.flagid;
      delete where.share;

      return url;
  }
} 

function getTitle(isTimeline) {
  if (window.isShop) {
    if (window.shop) {
      return shop.shopname + (isTimeline ? (shop.role==101||shop.role==9?'，找树网旗舰店！' : (shop.isrenzheng ? '，找树网已认证！' : '')) : '');
      // return shop.shopname + (isTimeline ? '，找树网旗舰店！' : '');      
    } else {
      return user.shopname + (isTimeline ? (user.role==101||user.role==9?'，找树网旗舰店！' : (user.isrenzheng ? '，找树网已认证！' : '')) : '');
    }
  } else if (window.isCart) {
    return user.name + '的找树车'; 
  } else {
    return document.title + ' ';
  }
}

function getDescription (isTimeline) {
  var content = document.getElementById('total').innerHTML;
  if (window.isShop || window.isCart) {
      if (isTimeline) return '';
      // 提取前10个树木名称
      var collections = 0;
      var treenames = [];
      // alert(0);
      for(var i in trees) {
        var tree = trees[i];
        collections += tree.collections;
        if (treenames.length<3 && !inArray(tree.name,treenames)) {
          treenames.push(tree.name);
        }     
      }

      var renzheng = window.isShop ? (window.shop && (shop.role==101 || shop.role==9) ? '找树网旗舰店\n' : (user.role==101||user.role==9?'找树网旗舰店\n':(user.isrenzheng ? '找树网已认证\n' : ''))) : '';
      // content = window.isCart ? content.substring(0,content.indexOf('项')+1) : '';
      content = content.substring(0,content.indexOf('项')+1);
      return renzheng + treenames.join(',') + '等' + content; // + ',藏米'+ collections + '\n' +;
  }else{
    var keyword='';
    if (window.where) {
      if (where.key) keyword += where.key+',';
      if (where.province) keyword += where.province+',';
      if (where.city && where.city!=where.province) keyword += where.city+',';
      if (where.district) keyword += where.district+',';
      if (where.dbh || where.dbh1) keyword += '径'+ $.trim($("#spec_dbh").val())+',';
      if (where.crownwidth || where.crownwidth1) keyword += '冠'+ $.trim($("#spec_crownwidth").val())+',';
      if (where.height || where.height1) keyword += '高'+$.trim($("#spec_height").val())+',';
    }
    return keyword + '为您找到' + content + '精品苗木';
  }
}

function shareSuccess (type) {
  if (window.isShop){
    if (window.visitor) {
      ajax('com/shareshop.php?shopid='+user.shopid+'&userid='+user.userid+'&type='+type+'&visitorid='+visitor.userid);
    }else if (window.shop && window.user){
      $.post('com/shareshop.php?shopid='+shop.shopid+'&userid='+shop.userid+'&type='+type+'&visitorid='+user.userid);
    }
  }
}

function prepareShare () {
    alert('prepareShare');
    alert(getLink(0));
    alert(getLink(1));
    alert(getImageUrl());
    alert(getTitle());
    alert(getTitle(1));
    alert(getDescription());
    alert(getDescription(1));

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
      title: getTitle(true) + getDescription(true),
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

function setWechatJSSDK(res){
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
            'hideMenuItems',
            'previewImage'
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
    if (typeof $.getJSON == "undefined" ) {
      ajax('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function(res) {
          setWechatJSSDK(JSON.parse(res));
      });
    } else {
      $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
          setWechatJSSDK(res);
      });
    }
}
loadWechatJSSDK();
