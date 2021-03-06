<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="./css/weui.min.css"/>
<title>投标</title>
<style type="text/css">
    body{
    	margin: 0;  
		padding:0;  
		border: 0;  
		font: inherit;  
		font-size: 100%;  
		vertical-align: baseline;  
    }
	.title{
		width:90%;
		float:left;
		font-size: 18px;
		height:24px;
		margin-left:3%;
		line-height: 24px;
	}
	#howmany{
		margin-top: 10px;
	}
	.contentbox{
		width:96%;
		float: left;
		padding: 5px 2%;
	}
	.contentbox .infobox{
		width:100%;
		float: left;
		margin-top: 2px;
		border-top: 1px solid #ccc;
	}
	.contentbox .infobox .info{
		width:70%;
		float: left;
	}
	.contentbox .infobox .info .order{
		width:15%;
		float: left;
		height: 20px;
		line-height: 20px;
	}
	.contentbox .infobox .info .box{
		width:84%;
		float: left;
	}
	.contentbox .infobox .info .box .row{
		width:100%;
		float: left;
		margin-bottom: 5px;
	}
	.contentbox .infobox .info .box .row1{
		width:100%;
		float: left;
		margin-bottom: 8px;
	}
	.onename{
		width:90%;
		float: left;
		margin-bottom: 10px;
		font-size: 18px;
	}
	.contentbox .infobox .info .box .row .col1{
		width:25%;
		float: left;
		height: 1.41176471em;
		line-height: 1.41176471;
	}
	.contentbox .infobox .info .box .row .col2{
		width:75%;
		float: left;
		line-height: 1.41176471;
	}
	.contentbox .infobox .info .box .row1 .col1{
		width:25%;
		float: left;
		height: 1.7em;
		line-height: 1.7;
	}
	.price,.number{
		width:60%;
		float: left;
		border: 0;
		outline: 0;
		-webkit-appearance: none;
		background-color: transparent;
		font-size: 18px;
		height: 1.7em;
		line-height: 1.7;
	}
	.contentbox .infobox .image{
		width:30%;
		float: left;
	    background-position: center center;
	    background-repeat: no-repeat;
	    background-size: cover;
	    overflow: hidden;
		height:100px;
	}
	.tobid{
		width:94%;
		margin: 20px 3%;
		float: left;
		height:40px;
		line-height: 40px;
		border-radius: 4px;
		font-size: 20px;
		text-align: center;
		background:#1AAD19;
		color:#fff;
	}
	.treeimage{
		float: left;
		width:100%;
		margin-left: 7%;
		margin-top:10px
	}
	.treeimage div{
		float: left;
		width:100%;
	}
	.treeimage img{
		float: left;
		width:30%;
		margin-right: 3%
	}
	.treeinfo{
		float: left;
		width:100%;
		margin-top: 10px
	}
	.weui_cell {
	    padding: 0px 2px;
	    position: relative;
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-align: center;
	    -webkit-align-items: center;
	    -ms-flex-align: center;
	    align-items: center;
	}
	.weui_cell_primary {
	    -webkit-box-flex: 1;
	    -webkit-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	}
	.weui_uploader_files {
	    list-style: none;
	}
	.weui_uploader_bd {
	    margin-bottom: -4px;
	    margin-right: -9px;
	    overflow: hidden;
	}
	.weui_uploader_input_wrp {
	    float: left;
	    position: relative;
	    margin-right: 9px;
	    margin-bottom: 9px;
	    width: 77px;
	    height: 77px;
	    border: 1px solid #D9D9D9;
	}
	.weui_uploader_input {
	    position: absolute;
	    z-index: 1;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    opacity: 0;
	    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	}
	ul{
	    display: block;
	    list-style-type: disc;
	    -webkit-margin-before: 1em;
	    -webkit-margin-after: 1em;
	    -webkit-margin-start: 0px;
	    -webkit-margin-end: 0px;
	    -webkit-padding-start: 0px;
	}
	.weui_uploader_file {
	    float: left;
	    margin-right: 9px;
	    margin-bottom: 9px;
	    width: 79px;
	    height: 79px;
	    background: no-repeat center center;
	    background-size: cover;
	}
	#topimage{
		background:#fff;
		width:100%;
		height:100%;
		z-index: 1000;
		position: fixed;
		display: none;
	}
	.topimage{
		width:100%;
		height:auto;
		position: absolute;
	}
	.delete{
		width:94%;
		position: absolute;
		margin: 0 3%;
		bottom: 5px;
		height:40px;
		line-height: 40px;
		border-radius: 5px;
		float: left;
		text-align: center;
		background:#E64340;
		color:#fff;
		z-index: 1001;
		font-size: 20px;
	}
	.mark{
	    width: 100%;
	    height: 60px;
	    margin: 2px 0;
	    padding: 4px;
	    border-radius: 3px;
	    float: left;
	    font-size: 16px;
	    line-height: 1.3;
	    border: 1px solid #888;
	    resize: none;
	}
	.lineh{
	    border-left:1px solid #ddd;
	    width:50%;
	    left:50%;
	    position: absolute;
	    height:60%;
	    top:20%
	}
	.lines{
	    border-bottom:1px solid #ddd;
	    width:60%;
	    left:20%;
	    position: absolute;
	    top:50%
	}
	#uploading{
        display: none; 
        position: fixed; 
        top: 0; 
        width: 100%;
        height: 55px; 
        background-color: red;
        color: #fff; 
        line-height: 55px; 
        text-align: center;
        z-index: 1000;
    }
</style>

</head>
<body>
	<div class="title" id="howmany"></div>
	<div class="title">请及时报价并上传苗木图片</div>
	<div class="title" id="address"></div>
	<div class="title" id="time"></div>
	<div class="contentbox" id="infobox">
	</div>
	<div class="weui_dialog_alert" style="display: none;">
	  	<div class="weui_mask"></div>
	  	<div class="weui_dialog">
	    	<div class="weui_dialog_hd"> <strong class="weui_dialog_title">警告</strong>
	    	</div>
	    	<div class="weui_dialog_bd">弹窗内容，告知当前页面信息等</div>
	    	<div class="weui_dialog_ft">
	      		<a href="javascript:;" class="weui_btn_dialog primary">确定</a>
	    	</div>
	  	</div>
	</div>
	<div id="topimage">
		<div class="delete">删除</div>
	</div>
	<div class="tobid">报价</div>
	<div id="uploading">正在上传，请勿退出！</div>

	<script id="dot_infobox" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="infobox" id="{{=it[i].id}}">
	        	<div class="treeinfo">
	        		<div class="info">
	        			<div class="order">{{=addone(i)}}</div>
	        			<div class="box">
	        				<div class="onename">{{=it[i].name}}</div>
	        				<div class="row">
	        					<div class="col1">规格: </div>
	        					<div class="col2">{{=guige(it[i])}}</div>
	        				</div>
	        				<div class="row">
	        					<div class="col1">数量: </div>
	        					<div class="col2">{{=it[i].count ? it[i].count : ''}}株</div>
	        				</div>
	        				<div class="row1">
	        					<div class="col1">价格: </div>
	        					<input type="number" name="" value="{{=it[i].price}}" pattern="[0-9]*" class="price" placeholder="请输入价格">
	        				</div>
	        				<div class="row1">
	        					<div class="col1">数量: </div>
	        					<input type="number" name="" value="{{=it[i].number}}" pattern="[0-9]*" class="number" placeholder="请输入数量">
	        				</div>
	        				<textarea class="mark" placeholder="可填写备注" type="text" maxlength="250">{{=it[i].bmark ? it[i].bmark : ''}}</textarea>
	        			</div>
	        		</div>
	        		<div class="image" style="background-image: url('./bidimage/{{=it[i].tenderimage}}.png');"></div>
	        	</div>
        		<div class="container" style="float:left;margin-left:10.5%;width:85%">
        		  <div class="weui_cells_title">图片上传(最多可上传5张)</div>
        		  <div class="weui_cells weui_cells_form">
        		    <div class="weui_cell">
        		      <div class="weui_cell_bd weui_cell_primary">
        		        <div class="weui_uploader">
        		          <div class="weui_uploader_bd">
        		            <ul class="weui_uploader_files" id="images{{=it[i].id}}">
        		            	{{~it[i].image:value:index}}
        		            		<li class="weui_uploader_file weui_uploader_status" id="{{=value}}" style="background-image:url('tenderphoto/m/{{=value}}.jpg')"
        		            		</li>
        		            	{{~}}
        		            </ul>
        		            <div class="weui_uploader_input_wrp">
        		                <div class="lineh"></div>
        		                <div class="lines"></div>
        		                <div class="weui_uploader_input js_file uploadphoto"></div>
        		            </div>
        		          </div>
        		        </div>
        		      </div>
        		    </div>
        		  </div>
        		</div>
        	</div>
	    {{ } }}
	</script>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script src="./js/doT.min.js"></script>
	<script src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
	<script src="./js/zepto.min.js"></script>
	<script type="text/javascript">
		var dot_infobox = doT.template($("#dot_infobox").text());
		var bid_orderid;
		var imageid;

		var user = getcookie('user2');
		user = user ? JSON.parse(user) : null;

		function getcookie(name){//获取指定名称的cookie的值
		    var arrStr = document.cookie.split("; ");
		    for(var i = 0;i < arrStr.length;i ++){
		        var temp = arrStr[i].split("=");
		        if(temp[0] == name) return unescape(temp[1]);
		    } 
		}

		function getQueryString(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
			var r = window.location.search.substr(1).match(reg);
			if (r != null) return unescape(r[2]); return null;
		} 

		var orderid = getQueryString("orderid");

		$.getJSON('/com/search_bidinfo.php',{orderid:orderid,userid:user.userid},function(json){
			if(json){
				for (var i = 0; i < json.bidinfo.length; i++) {
					if(json.bidinfo[i].image) json.bidinfo[i].image = json.bidinfo[i].image.split(',');
				}
				$('#howmany').html('您有'+json.bidinfo.length+'条符合要求');
				if(json.orderinfo.address){
					$('#address').html('用 苗 地: '+json.orderinfo.address);
				}else{
					$('#address').remove();
				}
				$('#infobox').html(dot_infobox(json.bidinfo));
				$('#time').html('截止时间: '+json.orderinfo.expiration_date);
				if(json.bidinfo.length > 1){
					$('.image').remove();
					$('.contentbox .infobox .info').css('width','95%');
					$('.container').css('margin-left','14.25%');
				}
			}
		})
		$('.tobid').click(function(){
			var data = [];
			$('#infobox .infobox').each(function() {
				var length = data.length;
				data[length] = {};
			    data[length].price = $(this).find('.price').val();
			    data[length].number = $(this).find('.number').val();
			    data[length].mark = $(this).find('.mark').val();
			    data[length].id = this.id;
			});
			$.getJSON('/com/input_bidinfo.php',{orderid:orderid,data:JSON.stringify(data),userid:user.userid},function(json){
				if(json){
					alert('报价完成 , 请耐心等待!');
					window.location = './yusuanphone.php#bidhistory';
				}else{
					alert('已停止报价!');
				}
			})	
		})

		function addone(one){
			var a = 1+parseInt(one);
			return a+'.';
		}

		function guige(data_attribute){
		    var attr = '';
            if(data_attribute.trunk_diameter){
                var at = data_attribute.trunk_diameter.replace(',','-');
                attr += '胸径:'+at+'公分 ';
            }
            if(data_attribute.ground_diameter){
                var at = data_attribute.ground_diameter.replace(',','-');
                attr += '地径:'+at+'公分 ';
            }
            if(data_attribute.pot_diameter){
                var at = data_attribute.pot_diameter.replace(',','-');
                attr += '盆径:'+at+'公分 ';
            }
            if(data_attribute.plant_height){
                var at = data_attribute.plant_height.replace(',','-');
                attr += '株高:'+at+'米 ';
            }
            if(data_attribute.plant_height_cm){
                var at = data_attribute.plant_height_cm.replace(',','-');
                attr += '株高:'+at+'公分 ';
            }
            if(data_attribute.crown){
                var at = data_attribute.crown.replace(',','-');
                attr += '冠幅:'+at+'米 ';
            }
            if(data_attribute.crown_cm){
                var at = data_attribute.crown_cm.replace(',','-');
                attr += '冠幅:'+at+'公分 ';
            }
            if(data_attribute.branch_number){
                var at = data_attribute.branch_number.replace(',','-');
                attr += '分枝数:'+at+'个 ';
            }
            if(data_attribute.bough_number){
                var at = data_attribute.bough_number.replace(',','-');
                attr += '主枝数:'+at+'个 ';
            }
            if(data_attribute.age){
                var at = data_attribute.age.replace(',','-');
                attr += '苗龄:'+at+'年 ';
            }
            if(data_attribute.branch_length){
                var at = data_attribute.branch_length.replace(',','-');
                attr += '条长:'+at+'米 ';
            }
            if(data_attribute.bough_length){
                var at = data_attribute.bough_length.replace(',','-');
                attr += '主蔓(枝)长:'+at+'米 ';
            }
            if(data_attribute.branch_point_height){
                var at = data_attribute.branch_point_height.replace(',','-');
                attr += '分枝点高:'+at+'米 ';
            }
            if(data_attribute.substrate){
                var at = data_attribute.substrate;
                attr += '基质:'+at;
            }
            if(data_attribute.tmark){
                var at = data_attribute.tmark;
                attr += '备注:'+at;
            }
            
            return attr;
		}

		var height = $(window).height();
		var width = $(window).width();
		
        $('#infobox').on("click", "li", function(){
            imageid = this.id;
            bid_orderid = $(this).parents('.infobox').attr('id');
            $('<img>').addClass('topimage').attr('src', 'tenderphoto/o/'+imageid+'.jpg').appendTo('#topimage');
            
            $("#topimage img").on('load', function(){
                $('#topimage').fadeIn(100);
                loadcss();
            });
        });

        $('#topimage').on('click','.topimage',function(){
        	$('#topimage').hide();
        	$('.topimage').remove();
        })

        function loadcss(){
            var imagewidth = $('#topimage img').width();
            var imageheight = $('#topimage img').height();
 
            var i = imagewidth/imageheight;
            var j = width/height;
            var w,h;
            if(imagewidth>imageheight){
                if(i>j){
                    w = width;
                    h = imageheight*(width/imagewidth);
                }else{
                    w = imagewidth*(height/imageheight);
                    h = height;
                }
            }else{
                if(i>j){
                    w = width;
                    h = imageheight*(imagewidth/width);
                }else{
                    w = imagewidth*(height/imageheight);
                    h = height;
                }
            }
            $('#topimage img').css({"height":h+'px',"width":w+'px',"margin-top": -(h/2)+'px',"margin-left": -(w/2)+'px',"top": "50%", "left": "50%"});
        }

        var uploadIndex, uploadData,localIds,chooseid;
        
    	$('#infobox').on('click','.uploadphoto',function () {
            chooseid = $(this).parents('.infobox').attr('id');

    		var a = $("#images"+chooseid+" li").length;

    		if(a == 0){
    			uploadIndex = 0;
    		}else if(a >= 5){
                return;
            }
    		
            // 选择图片
            wx.chooseImage({
                count: 5-a,
                sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'],// 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                	$('#uploading').show();
                    localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    // 预览图片
                    for(var i in localIds){
                        $("#images"+chooseid).append($(tmpl.replace('#id#',i).replace('#url#', localIds[i])));                
                    }
                    // 逐一上传图片
                    uploadImage(0);                
                }
            });
        });

        // 微信上传
        function uploadImage(i) {
            wx.uploadImage({
                localId: localIds[i],
                isShowProgressTips: 1,
                success: function (res) {
                    // 服务器端处理
                    $.post('com/uploadbid_images.php',{id:chooseid,userid:user.userid,orderid:orderid,mediaId: res.serverId,index: i},function (result){
                            result = result.split('-');
                            $('#upload'+parseInt(result[0])).html('').css('background-image', 'url(tenderphoto/m/'+result[1]+'.jpg)').attr('id',result[1]);
                    });
                    uploadIndex++;
                    if(uploadIndex < localIds.length){
                        uploadImage(uploadIndex);
                    }else{
                        $('#uploading').hide();
                    }
                }
            });
        }
        
        var tmpl = '<li id="upload#id#" class="weui-uploader__file"><img style="width:100%;height:100%;opacity:0.6" src="#url#"></li>';
        // 延迟加载
        setTimeout(function() {
            if (navigator.userAgent.indexOf("MicroMessenger") > 0) {
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
                        wx.hideMenuItems({
                            menuList: ['menuItem:copyUrl'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                        });
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

        $('#topimage').on('click','.delete',function(){
        	$('#topimage').fadeOut(100);
        	$('.topimage').remove();
        	$.post('/com/uploadbid_images_delete.php', {imageid: imageid,id:bid_orderid,userid:user.userid,orderid:orderid}, function(data) {
        		if(data){
        			$('#'+imageid).remove();
        		}
        	});
        })

	</script>
</body>