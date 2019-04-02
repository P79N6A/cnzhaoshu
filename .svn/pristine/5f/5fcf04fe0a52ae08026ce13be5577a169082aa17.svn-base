
<!DOCTYPE html>
<html lang="en">
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
  <div id="img"></div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="http://203.195.235.76/jssdk/js/zepto.min.js"></script>
<script type="text/javascript">

function uploadImage(i) {
    wx.uploadImage({
        localId: localIds[i],
        isShowProgressTips: 1,
        success: function (res) {
            // 服务器端处理
            // $.post('com/record.upload2.php',{type: uploadData.worktype,work: uploadData.workname,peoples: uploadData.peoples,userid: user.userid,mediaId: res.serverId,gps: gps,index: i},function (result) {
            //         result = result.split('-');
            //         // 上传成功
            //         if (!record) {
            //             record = {
            //                 id: result[1]
            //             };
            //         }

            //         $('#upload'+parseInt(result[0])).html('').css('background-image', 'url(photos/m/'+result[2]+'.jpg)').attr('id', result[1] + '-' + result[2]);
            //   }
            // );
            // uploadIndex++;
            // if (uploadIndex < localIds.length) {
            //     uploadImage(uploadIndex);
            // } else {
            //     $('#uploading').hide();
            // }
        }
    });
}

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
          // $('#uploading').show();

          localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
          // 预览图片
          for(var i in localIds){
              // $('#img').append($(tmpl.replace('#id#',i).replace('#url#', localIds[i]))); 
              $('<img>').attr('src',localIds[i]).appendTo('#img')             
          }

          // 逐一上传图片
          // uploadImage(0);                
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

  function setWechatJSSDK(res){
      wx.config({
          debug: false,
          appId: res.appId,
          timestamp: res.timestamp,
          nonceStr: res.nonceStr,
          signature: res.signature,
          jsApiList: [
              'chooseImage',
              'previewImage',
              'uploadImage',
              'downloadImage'
          ]
      });
  }

  function loadWechatJSSDK() {
      $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
        setWechatJSSDK(res);
      });
  }
  setTimeout(loadWechatJSSDK, 500);
</script>
</html>