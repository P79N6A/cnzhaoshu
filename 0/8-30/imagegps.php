
<!DOCTYPE html>
<html lang="en">
<?php
  include 'com/wechat_login.php';
  include 'com/getsignature.php';
  wechatLogin();
  $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  getsignature($url);
?>
<head>
  <meta charset="utf-8">
  <title>微信JS-SDK Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="http://203.195.235.76/jssdk/css/style.css">
</head>
<body ontouchstart="">
<div class="wxapi_container">
    <div class="lbox_close wxapi_form">
      <h3 id="menu-image">图像接口</h3>
      <span class="desc">拍照或从手机相册中选图接口</span>
      <button class="btn btn_primary" id="chooseImage">chooseImage</button>
      <span class="desc">预览图片接口</span>
      <button class="btn btn_primary" id="previewImage">previewImage</button>
      <span class="desc">上传图片接口</span>
      <button class="btn btn_primary" id="uploadImage">uploadImage</button>
      <span class="desc">下载图片接口</span>
      <button class="btn btn_primary" id="downloadImage">downloadImage</button>
    </div>
  </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  var configinfo = getcookie('signature');
  
  function getcookie(name){//获取指定名称的cookie的值
      var arrStr = document.cookie.split("; ");
      for(var i = 0;i < arrStr.length;i ++){
          var temp = arrStr[i].split("=");
          if(temp[0] == name) return unescape(temp[1]);
      } 
  }
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config(configinfo);
</script>
<script src="http://203.195.235.76/jssdk/js/zepto.min.js"></script>
<script type="text/javascript">
  wx.ready(function () {

    var images = {
      localId: [],
      serverId: []
    };
    document.querySelector('#chooseImage').onclick = function () {
      wx.chooseImage({
        success: function (res) {
          images.localId = res.localIds;
          alert('已选择 ' + res.localIds.length + ' 张图片');
        }
      });
    };

    // 5.2 图片预览
    document.querySelector('#previewImage').onclick = function () {
      wx.previewImage({
        current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
        urls: [
          'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
          'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
          'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'
        ]
      });
    };

    // 5.3 上传图片
    document.querySelector('#uploadImage').onclick = function () {
      if (images.localId.length == 0) {
        alert('请先使用 chooseImage 接口选择图片');
        return;
      }
      var i = 0, length = images.localId.length;
      images.serverId = [];
      function upload() {
        wx.uploadImage({
          localId: images.localId[i],
          success: function (res) {
            i++;
            //alert('已上传：' + i + '/' + length);
            images.serverId.push(res.serverId);
            if (i < length) {
              upload();
            }
          },
          fail: function (res) {
            alert(JSON.stringify(res));
          }
        });
      }
      upload();
    };

    // 5.4 下载图片
    document.querySelector('#downloadImage').onclick = function () {
      if (images.serverId.length === 0) {
        alert('请先使用 uploadImage 上传图片');
        return;
      }
      var i = 0, length = images.serverId.length;
      images.localId = [];
      function download() {
        wx.downloadImage({
          serverId: images.serverId[i],
          success: function (res) {
            i++;
            alert('已下载：' + i + '/' + length);
            images.localId.push(res.localId);
            if (i < length) {
              download();
            }
          }
        });
      }
      download();
    };
  });
</script>
</html>