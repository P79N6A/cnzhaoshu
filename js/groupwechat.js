
function getImageUrl(){
    return 'http://cnzhaoshu.com/platform/'+ (window.platform ? platform : union) +'.jpg';
}
function getLink(){
    return window.location.href;
} 

function getDescription (isAppMessage) {
    if (isAppMessage) return "\n专注！专业！专家！\n" + users.length + "家会员单位";
    else return "！专注！专业！" + users.length + "家会员单位";
}

wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareAppMessage({
      title: document.title,
      desc: getDescription(true),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareTimeline({
      title: document.title + getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareQQ({
      title: document.title,
      desc: getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });

    wx.onMenuShareWeibo({
      title: document.title,
      desc: getDescription(),
      link: getLink(),
      imgUrl: getImageUrl()
    });
});
