<!DOCTYPE html><html>
    <title>上传养护记录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="css/weui.min.css"/>
    <!-- <link rel="stylesheet" href="css/2.css?t=201705022"/> -->
    <style type="text/css">
    body{
        background-color: #efefef;
    }
    .weui-cells{
        margin-top: 10px;
    }
    .weui-cell{
        padding: 10px;
    }
    .weui-cell:before{
        left: 10px;
    }
    .title{
        padding: 10px;  
        box-shadow: 0 1px 5px rgba(0,0,0,.3);
        background-color: #4E4D5D;
        color: #fff;
    }
    .title img{
        float: right;
        height: 24px;
        width: 24px;
        margin-left: 10px;
    }
    #projectname{
        color: #ccc;
        padding-left: 5px;
        font-size: 8px;
    }
    .weui-cells_checkbox .weui-icon-checked:before {
        font-size: 20px;
        line-height: 22px;
    }
    [class*=" weui-icon-"]:before, [class^=weui-icon-]:before {
         margin-left: 0; 
         margin-right: 0; 
    }
    [class*=" weui-icon-"], [class^=weui-icon-] {
        vertical-align: bottom;
    }
    .weui-cells_checkbox .weui-icon-checked:before {
        font-size: 18px;
        line-height: 20px;
    }
    .photolist{
        text-align: center;
    }
    .weui-uploader__input-box, .weui-uploader__file{
        float: none;
        display: inline-block;
    }
    .weui-uploader__files{
        display: inline-block;
    }
    .workitem{
        width: 33%;
        display: inline-block;
        font-size: 14px;
    }

    .input-box .weui-uploader__input-box {
        line-height: 140px;
        color: #ccc;
        font-size: 10px;
        vertical-align: middle;
    }
    .input-box{
        width: 100%;
    }
    .weui-uploader__camera{
        background-image: url(../img/camera.png);
        background-size: cover;
    }
    .weui-uploader__camera:before, .weui-uploader__camera:after{
        display: none;
    }
    .alert{
        display: none; position: fixed; top: 0; width: 100%;height: 55px; background-color: red;color: #fff; line-height: 55px; text-align: center;
    }
    .none{
        display: none;
    }
        
    </style>
</head>
<body>
    <div class="title">
        <span id="areanumber"></span><span id="projectname" style="font-size:8px">北京找树网科技股份有限公司</span>
    </div>
    <div class="title" style="position:absolute;right:0;top:0;box-shadow:none">
        <img id="scanQRCode" src="./img/scan.png?t=2" alt="">
        <img id="viewRecord" src="./img/view.png" alt="">
        <img id="setArea" src="./img/set.png" alt="">
        <img id="deleteRecord" src="./img/del.png" alt="">
    </div>
    <div id="workitems" class="weui-cells">
        <div class="weui-cell">
            养护项
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="3" class="weui-check"> <i class="weui-icon-checked"></i>浇水 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="19" class="weui-check"> <i class="weui-icon-checked"></i>草坪施肥 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="20" class="weui-check"> <i class="weui-icon-checked"></i>灌木施肥 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="21" class="weui-check"> <i class="weui-icon-checked"></i>乔木施肥 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="17" class="weui-check"> <i class="weui-icon-checked"></i>草坪复壮 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="22" class="weui-check"> <i class="weui-icon-checked"></i>大树复壮 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="9" class="weui-check"> <i class="weui-icon-checked"></i>草坪修剪 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="10" class="weui-check"> <i class="weui-icon-checked"></i>绿篱色块修剪 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="11" class="weui-check"> <i class="weui-icon-checked"></i>球类修剪 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="12" class="weui-check"> <i class="weui-icon-checked"></i>花灌木修剪 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="13" class="weui-check"> <i class="weui-icon-checked"></i>乔木修剪 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="23" class="weui-check"> <i class="weui-icon-checked"></i>草坪病害防治 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="24" class="weui-check"> <i class="weui-icon-checked"></i>地下害虫防治 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="25" class="weui-check"> <i class="weui-icon-checked"></i>苗木病害防治 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="26" class="weui-check"> <i class="weui-icon-checked"></i>苗木虫害防治 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="27" class="weui-check"> <i class="weui-icon-checked"></i>蛀干虫害防治 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="28" class="weui-check"> <i class="weui-icon-checked"></i>草坪播种 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="29" class="weui-check"> <i class="weui-icon-checked"></i>草坪铺植 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="30" class="weui-check"> <i class="weui-icon-checked"></i>宿根栽植 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="31" class="weui-check"> <i class="weui-icon-checked"></i>花卉栽植 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="32" class="weui-check"> <i class="weui-icon-checked"></i>苗木栽植 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="15" class="weui-check"> <i class="weui-icon-checked"></i>树堰修葺 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="33" class="weui-check"> <i class="weui-icon-checked"></i>草坪切边 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="34" class="weui-check"> <i class="weui-icon-checked"></i>除草/除蘖 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="35" class="weui-check"> <i class="weui-icon-checked"></i>落叶清理 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="6" class="weui-check"> <i class="weui-icon-checked"></i>绿地保洁 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox" style="display: table;width: 100%;">
            <label class="workitem"> 
                <input type="radio" name="work" value="36" class="weui-check"> <i class="weui-icon-checked"></i>涂白 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="37" class="weui-check"> <i class="weui-icon-checked"></i>裹干 
            </label>
            <label class="workitem"> 
                <input type="radio" name="work" value="38" class="weui-check"> <i class="weui-icon-checked"></i>搭防寒障 
            </label>
        </div>
        <div class="weui-cell weui-cells_checkbox">
            <label class="weui-label">
                    <input type="radio" name="work" value="8" class="weui-check">
                    <i class="weui-icon-checked"></i>其他
            </label>
            <input id="otherwork" class="weui-input" type="text" maxlength="10" placeholder="请输入自定义养护项">
        </div>
    </div>


    <div class="weui-cells">
        <div class="weui-cell weui-cells_checkbox">
            <label class="weui-label" data-id="8">养护人数</label>
            <input id="peoples" class="weui-input" type="number" max="50" min="1" value="1" placeholder="请输入养护人数">
        </div>
    </div>

    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">图片上传</p>
                    </div>
                    <div class="weui-uploader__bd photolist">
                        <ul class="weui-uploader__files" style="width: 100%" id="uploaderFiles"></ul>
                        <ul class="input-box">
                            <div class="weui-uploader__input-box h5-upload none" onclick="alert(1)">
                                <input id="uploaderInput" onclick="alert(2)" class="weui-uploader__input" type="file" multiple/>
                            </div>
                            <div class="weui-uploader__input-box weui-upload android-input-box none">多张大图</div>
                            <div class="weui-uploader__input-box weui-upload weui-uploader__camera none" data-type="camera"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="uploading" class="alert">正在上传，请勿退出！</div>

<div class="weui-gallery" id="gallery">
    <span class="weui-gallery__img" id="galleryImg"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:;" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>

<div class="js_dialog" id="iosDialog1" style="display: none;">
    <div class="weui-mask"></div>
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">删除确认</strong></div>
        <div class="weui-dialog__bd"></div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
        </div>
    </div>
</div>

<script id="dot_workitem" type="text/x-dot-template">
    {{for(var key in it) { }}
        <label class="workitem">
            <input type="radio" name="work" value="{{=key}}" class="weui-check">
            <i class="weui-icon-checked"></i>{{=it[key]}}
        </label>
    {{ } }}
</script>          

<script src="js/zepto.min.js"></script>
<script src="js/doT.min.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="js/lrz.bundle.js?t=20170302"></script>
<script src="js/gps.min.js?t=20170302"></script>
<script src="js/fastclick.min.js"></script>




<script type="text/javascript">
function urlRequest(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);  
    return match && decodeURIComponent(match[1].replace(/\+/g, ' ')); 
}
function getcookie(name) {
    for(var i = 0, list = document.cookie.split("; "), len = list.length; i < len; i ++) {
        var cookie = list[i].split("=");
        if(cookie[0] == name) return unescape(cookie[1]);
    } 
}

function string2Milliseconds(str) {
    str = str.replace(/-/g,"/"); 
    str = str.replace(':','/'); 
    str = str.replace(':','/'); 
    var time = new Date(str).getTime(); //ms   
    return time;
}

function loadJS(url, id) {
    if (id) {
        var v = localStorage['v_'+id];
        if (v) url += '?v=' + v;
    }

    var js = document.createElement("script");
    js.src = url;
    document.getElementsByTagName("HEAD").item(0).appendChild(js);
}


var record, localIds, localIdsIndex, gps, uploadIndex, uploadData;

var tmpl2 = '<li id="#id#" class="weui-uploader__file" style="background-image:url(#url#)"></li>',
    tmpl = '<li id="upload#id#" class="weui-uploader__file"><img style="width:100%;height:100%;opacity:0.6" src="#url#"></li>',
    tmpl1 = '<li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(#url#)"><div id="progress#id#" class="weui-uploader__file-content" style="display:none">1%</div></li>',
    $gallery = $("#gallery"), 
    $galleryImg = $("#galleryImg"),
    $uploaderInput = $("#uploaderInput"),
    $uploaderFiles = $("#uploaderFiles");

            
// 检查权限，获取当前养护区、养护记录
function checkArea(areaid) {
    record = null;
    $.getJSON('com/area.check.php', 
        {areaid:areaid, userid:user.userid, role:user.role, flagid:user.flagid, projectid:user.projectid}, 
        function(data) {
        if (data) {
            var area = data.area;
            $('#areanumber').html(area.number);
            $('#projectname').html(area.project);

            // 有今日养护记录
            if (data.record) {
                setRecord(data.record);
            }           
        } else {
            $('#areanumber').html('✘无权限！');
            $('#projectname').html('');
        }
    });
}


checkArea(areaid);

    function setRecord(data) {
        record = data;

        // 养护类型
        $("#workitems input[value='"+record.type+"']").prop("checked",'checked');
        if (record.type==8) $('#otherwork').val(record.work);

        $('#peoples').val(record.peoples);

        var photos = record.photo.split(';');
        for(var i in photos){
            $uploaderFiles.append($(tmpl2.replace('#id#',record.id+'-'+photos[i]).replace('#url#', 'photos/m/'+photos[i]+'.jpg')));
        }
    }

    $('#otherwork').on('focus', function(e) {
        $("#workitems input[value='8']").prop("checked",'checked');
    });


    $("#workitems input").on('click', function() { 
        // 养护项变更后，重新获取该养护项的养护日志
        var worktype = parseInt($("#workitems input:checked").val());
        if (!record || record.type!=worktype) {
            checkAreaWork(areaid, worktype);
        }
    }); 

    function checkAreaWork(areaid, type) {
        $('#uploaderFiles').html('');
        record = null;

        if (type==8) type = $('#otherwork').val();

        $.getJSON('com/area.checkwork.php', {userid: user.userid, areaid: areaid, type: type}, function(data) {
            if (data) {
                setRecord(data);
            }
        });    
    }

    function deletePhoto() {
        var id = $gallery.fadeOut(100).data('id');
        $('#'+id).remove();

        $.post('/com/record.delete.photo.php', {id: id}, function(result){
            $galleryImg.attr("style", '');
        });
    }


    function deleteRecord() {
        $.post('com/record.delete.php', {id: record.id});
        $('#uploaderFiles').html('');
        
        record = null;  
        $galleryImg.attr("style", '');   
    }

    function uploadPhoto() {
        if (uploadIndex < $uploaderInput[0].files.length) {
            var file = $uploaderInput[0].files[uploadIndex++];
            // alert(uploadIndex+': '+file.type);

            // if (file.type.indexOf('image') == 0) {
                lrz(file, {
                    width: 1280,
                    height: 1280
                }).then(function(rst) {
                    // if (rst.origin.exifdata.DateTime) {
                    // uploadSource = rst;

                    // console.log(rst);
                    // 显示图片
                    $uploaderFiles.append($(tmpl1.replace('#id#', uploadIndex).replace('#url#', rst.base64)));

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'com/record.upload.php');

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // 上传成功, 移除进度条
                            if (!record) {
                                record = {
                                    id: xhr.response.split('-')[0]
                                };
                            }
                            $('#progress' + uploadIndex).parent().removeClass('weui-uploader__file_status').attr('id', xhr.response);
                            $('#progress' + uploadIndex).remove();
                        } else {
                            // 处理错误
                            $('#progress' + uploadIndex).parent().remove();
                            alert('上传失败, 请重新上传');
                            // alert(xhr.response);
                            // 上传失败
                        }
                        // 删除上传对象，释放资源
                        // foreach()
                        // 
                        // 开始下一个
                        uploadPhoto();
                    };

                    if (xhr.upload) {
                        try {
                            xhr.upload.addEventListener('progress', function(e) {
                                if (!e.lengthComputable) return false;
                                // 上传进度
                                $('#progress' + uploadIndex).html(Math.round(((e.loaded / e.total) || 0) * 100) + '%');
                            });
                        } catch (err) {
                            // console.error('进度展示出错了,似乎不支持此特性?', err);
                        }
                    }

                    ///gps = '';
                    var exif = rst.origin.exifdata;

                    var time = exif.DateTime ? string2Milliseconds(exif.DateTime) : rst.origin.lastModified;
                    time = parseInt(time / 1000);
                    rst.formData.append('time', time);

                    if (exif.GPSLatitude && exif.GPSLongitude) {
                        gps = GPS.qqGps(exif.GPSLatitude.toString(), exif.GPSLatitudeRef, exif.GPSLongitude.toString(), exif.GPSLongitudeRef).toString();
                        rst.formData.append('gps', gps);
                    } else {
                        var now = new Date().getTime()/1000;
                        if (gps && now-time<8) {
                            rst.formData.append('gps', gps);
                        }
                    }


                    // 添加参数
                    rst.formData.append('type', uploadData.worktype);
                    rst.formData.append('work', uploadData.workname);
                    rst.formData.append('peoples', uploadData.peoples);
                    rst.formData.append('userid', user.userid);
                    rst.formData.append('flagid', user.flagid);
                    rst.formData.append('role', user.role);
                    rst.formData.append('projectid', user.projectid);
                    rst.formData.append('areaid', areaid);

                    // 触发上传
                    xhr.send(rst.formData);
                    // } else {
                    // 截屏照片
                    // alert('必须使用现场拍照!\n不能使用截屏或下载的图片');
                    // }               
                });
            // } else {
                // alert(file.type);
            // }
        } else {
            // 传完啦
            $uploaderInput.val('');
            uploadData = null;
            $('#uploading').hide();
        }
    }



$(function(){
    $uploaderFiles.on("click", "li", function(){
        console.log($('#iosDialog1 .weui-dialog__btn_primary'));
        $('#iosDialog1 .weui-dialog__bd').html('您确定要删除当前养护照片？');
        $('#iosDialog1 .weui-dialog__btn_primary').attr('href', 'javascript:deletePhoto()');

        var img = this.getAttribute("style");
        if (img.length<100) {
            img = img.replace('/m/', '/o/');
        }
        $galleryImg.attr("style", img);
        $gallery.data('id', this.id).fadeIn(100);
    });
    $gallery.on("click", 'span', function(){
        $gallery.fadeOut(100);
        $galleryImg.attr("style", '');
    });
    $gallery.on("click", '.weui-gallery__del', function(){
        $('#iosDialog1').fadeIn(200);
    });
    // h5压缩上传
    $uploaderInput.on("change", function(e) {
        if (e.target.files.length == 0) return;
        // 先检查养护项 是否设置
        var worktype = $("#workitems input:checked").val();
        if (!worktype) {
            alert('必须先选定当前养护项');
            $uploaderInput.val('');
            return;
        }
        if (worktype == '8' && $.trim($('#otherwork').val()) == '') {
            alert('请填写其他项的内容');
            $uploaderInput.val('');
            return;
        }
        var peoples = $.trim($('#peoples').val());
        if (!peoples || parseInt(peoples) < 1) {
            alert('请输入养护人数');
            $uploaderInput.val('');
            return;
        }

        // 取gps                
        wx.getLocation({
            type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                gps = res.latitude + ',' + res.longitude;
            }
        }); 

        var workname = worktype == '8' ? $.trim($('#otherwork').val()) : dicttionary_work[worktype];

        uploadData = {
            worktype: worktype,
            workname: workname,
            peoples: peoples
        };

        $('#uploading').show();
        uploadIndex = 0;
        uploadPhoto();
    });

    function uploadImage(i) {
        wx.uploadImage({
            localId: localIds[i],
            isShowProgressTips: 1,
            success: function (res) {
                // 服务器端处理
                $.post('com/record.upload2.php',
                    {
                        type: uploadData.worktype,
                        work: uploadData.workname,
                        peoples: uploadData.peoples,
                        userid: user.userid,
                        flagid: user.flagid,
                        role: user.role,
                        projectid: user.projectid,
                        areaid: areaid,
                        mediaId: res.serverId,
                        gps: gps,
                        index: i  // 计数
                    },

                    function (result) {
                        result = result.split('-');

                        // 上传成功
                        if (!record) {
                            record = {
                                id: result[1]
                            };
                        }

 
                        $('#upload'+parseInt(result[0])).html('')
                                                        .css('background-image', 'url(photos/m/'+result[2]+'.jpg)')
                                                        .attr('id', result[1] + '-' + result[2]);
                    }
                );

                uploadIndex++;
                if (uploadIndex < localIds.length) {
                    uploadImage(uploadIndex);
                } else {
                    $('#uploading').hide();
                }
            }
        });
    }

    // 微信接口上传
    $('.weui-upload').on('click', function () {
        // 先检查养护项 是否设置
        var worktype = $("#workitems input:checked").val();
        if (!worktype) {
            alert('必须先选定当前养护项');
            return;
        }
        if (worktype=='8' && $.trim($('#otherwork').val())=='') {
            alert('请填写其他项的内容');
            return;
        }
        var peoples = $.trim($('#peoples').val());
        if (!peoples || parseInt(peoples)<1) {
            alert('请输入养护人数');
            return;
        }

        var workname = worktype=='8' ? $.trim($('#otherwork').val()) : dicttionary_work[worktype];
        
        uploadData = {worktype: worktype, workname: workname, peoples: peoples};
        uploadIndex = 0;

        gps = '';
        var isCamera = $(this).data('type')=='camera';
        if (isCamera){
            // 取gps                
            wx.getLocation({
                type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    gps = res.latitude + ',' + res.longitude;
                }
            }); 
        }

        // 选择图片
        wx.chooseImage({
            sizeType: isCamera?['compressed']:['original'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: isCamera?['camera']:['album'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                $('#uploading').show();

                localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                // 预览图片
                for(var i in localIds){
                    $uploaderFiles.append($(tmpl.replace('#id#',i).replace('#url#', localIds[i])));                
                }

                // 逐一上传图片
                uploadImage(0);                
            }
        });
    });

    // 延迟加载
    setTimeout(function() {
        // 绑定事件
        $('#scanQRCode').on('click', function(){
            wx.scanQRCode();
        });     
        $('#viewRecord').on('click', function(){
            location.href = 'http://www.yangshuwang.com/m.html?where={"flagid":'+flagid+',"areaid":'+areaid+'}';
        });
        $('#setArea').on('click', function(){
            location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxcfe6d72f270910e8&redirect_uri=http://www.yangshuwang.com/setarea.php?response_type=code&scope=snsapi_base&state="+areaid;
        });
        $('#deleteRecord').on('click', function(){
            $('#iosDialog1 .weui-dialog__bd').html('您确定要删除当前养护日志？');
            $('#iosDialog1 .weui-dialog__btn_primary').attr('href', 'javascript:deleteRecord()');
            $('#iosDialog1').fadeIn(200);
        });
        // 隐藏对话框
        $('#iosDialog1').on('click', '.weui-dialog__btn', function(){
            $(this).parents('.js_dialog').fadeOut(200);
        });

                    // document.getElementById('uploaderInput').multiple = '';
                    // console.log(document.getElementById('uploaderInput').multiple);
                    // $uploaderInput.css('multiple','multiple');

        // loadJS('js/lrz.bundle.js?t=20170302');
        // loadJS('js/gps.min.js?t=20170302');
        // loadJS('js/fastclick.min.js');

        if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
            // loadJS('https://res.wx.qq.com/open/js/jweixin-1.1.0.js');

            function setWechatJSSDK(res){
                wx.config({
                    debug: false,
                    appId: res.appId,
                    timestamp: res.timestamp,
                    nonceStr: res.nonceStr,
                    signature: res.signature,
                    jsApiList: [
                        'hideMenuItems',
                        'chooseImage',
                        'uploadImage',
                        'scanQRCode'
                    ]
                });

                wx.ready(function () {
                    var u = navigator.userAgent;
                    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

                    if (isiOS) {   
                        $('.h5-upload').css('display','inline-block').append('多张小图');                    
                        $('.weui-uploader__camera').css('display','inline-block');
                    } else {
                        $('.weui-upload').css('display','inline-block');
                        $('.h5-upload').css('display','inline-block').append('单张小图');
                        document.getElementById('uploaderInput').multiple = '';
                        

                    }

                    alert(isiOS);



                  // $('.input-box').show();
                  wx.hideMenuItems({
                      menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                  });
                  // prepareShare();
                });
            }

            function loadWechatJSSDK() {
                $.getJSON('/com/wechat.jssdk.php?url=' + encodeURIComponent(location.href.split('#')[0]), function (res) {
                    setWechatJSSDK(res);
                });
            }
            loadWechatJSSDK();
        } 
    },10);
});

</script>
<!-- 项目养护地图 -->

</body></html>