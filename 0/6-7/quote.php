<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'com/wechat_login.php';
wechatLogin();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
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
	#subscribe{
	    float: left;
	    width: 23%;
	    height: 25px;
	    line-height: 25px;
	    margin-top: 6px;
	    color:#999;
	    text-align: center;
	    border-radius: 15px;
	    font-size: 11px;
	    margin-left:2%;      
	}
	#howmany{
		width:68%;
	}
</style>

</head>
<body>
	<div class="title" id="howmany"></div>
	<div id="subscribe"></div>
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
	        					<div class="col2">{{=it[i].count}}株</div>
	        				</div>
	        				<div class="row1">
	        					<div class="col1">价格: </div>
	        					<input type="number" name="" value="{{=it[i].price ? (it[i].price/100) : ''}}" pattern="[0-9]*" class="price" placeholder="请输入价格">
	        				</div>
	        				<div class="row1">
	        					<div class="col1">数量: </div>
	        					<input type="number" name="" value="{{=it[i].number}}" pattern="[0-9]*" class="number" placeholder="请输入数量">
	        				</div>
	        			</div>
	        		</div>
	        		<div class="image" style="background-image: url('./bidimage/{{=it[i].tenderimage}}.png');"></div>
	        	</div>
        		<div class="container" style="float:left;margin-left:10.5%;width:89%">
        		  <div class="weui_cells_title">图片上传(最多可上传5张)</div>
        		  <div class="weui_cells weui_cells_form" style="float:left;width:100%">
        		    <div class="weui_cell">
        		      <div class="weui_cell_bd weui_cell_primary">
        		        <div class="weui_uploader">
        		          <div class="weui_uploader_bd">
        		            <ul class="weui_uploader_files">
        		            	
        		            	{{~it[i].image:value:index}}
        		            		<li class="weui_uploader_file weui_uploader_status" id="{{=value}}" style="background-image:url('./bidimage/{{=value}}.jpg')";
        		            		</li>
        		            	{{~}}
        		            </ul>
        		            <div class="weui_uploader_input_wrp">
        		            <div style="border-left:1px solid #ddd;width:50%;left:50%;position: absolute;height:60%;top:20%"></div>
        		            <div style="border-bottom:1px solid #ddd;width:60%;left:20%;position: absolute;top:50%"></div>
        		              <input class="weui_uploader_input js_file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple=""></div>
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
	<script type="text/javascript">
		var dot_infobox = doT.template($("#dot_infobox").text());
		var tender_userid;
		var bid_orderid;
		var imageid;
		var user = getcookie('user2');
		user = user ? JSON.parse(user) : null;
		function getQueryString(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
			var r = window.location.search.substr(1).match(reg);
			if (r != null) return unescape(r[2]); return null;
		} 

		function getcookie(name){//获取指定名称的cookie的值
		    var arrStr = document.cookie.split("; ");
		    for(var i = 0;i < arrStr.length;i ++){
		        var temp = arrStr[i].split("=");
		        if(temp[0] == name) return unescape(temp[1]);
		    } 
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
				tender_userid = json.orderinfo.userid;
				if(json.bidinfo.length > 1){
					$('.image').remove();
					$('.contentbox .infobox .info').css('width','95%');
					$('.container').css('margin-left','14.25%');
					$('.container').css('width','85%');
				}
			}
		})
		$('.tobid').click(function(){
			var data = [];
			$('#infobox .infobox').each(function() {
				var length = data.length;
				data[length] = {};
			    data[length].price = $(this).find('.price').val()*100;
			    data[length].number = $(this).find('.number').val();
			    data[length].id = this.id;
			});
			$.getJSON('/com/input_bidinfo.php',{orderid:orderid,data:JSON.stringify(data),userid:tender_userid},function(json){
				if(json){
					alert('报价完成 , 请耐心等待!');
					window.location = '/yusuanphone.php#bidhistory';
				}else{
					alert('已停止报价!');
				}
			})
			
		})

		$('#subscribe').click(function(){
		    var get_msg = $('#subscribe').attr('get_msg');
		    $.getJSON('/com/get_msg.php',{get_msg:get_msg,userid:user.userid},function(json){
		        if(json){
		            if(get_msg == 1){
		                $('#subscribe').html('取消订阅');
		                $('#subscribe').attr('get_msg','0');
		                $('#subscribe').css('color','#999');
		                $('#subscribe').css('border','1px solid #999');
		            }else{
		                $('#subscribe').html('订阅招标信息');
		                $('#subscribe').attr('get_msg','1');
		                $('#subscribe').css('color','#999');
		                $('#subscribe').css('border','1px solid #E64340');
		            }
		        }
		    })
		})

		function loadisget_msg(){
		    $.getJSON('/com/isget_msg.php',{userid:user.userid},function(json){
		        if(json){
		            $('#subscribe').html('取消订阅');
		            $('#subscribe').attr('get_msg','0');
		            $('#subscribe').css('color','#999');
		            $('#subscribe').css('border','1px solid #999');
		        }else{
		            $('#subscribe').html('订阅招标信息');
		            $('#subscribe').attr('get_msg','1');
		            $('#subscribe').css('color','#999');
		            $('#subscribe').css('border','1px solid #E64340');
		        }
		    })
		}

		function addone(one){
			var a = 1+parseInt(one);
			return a+'.';
		}
		  

		$.weui = {};  
		$.weui.alert = function(options){  
		  	options = $.extend({title: '警告', text: '警告内容'}, options);  
		  	var $alert = $('.weui_dialog_alert');  
		  	$alert.find('.weui_dialog_title').text(options.title);  
		  	$alert.find('.weui_dialog_bd').text(options.text);  
		  	$alert.on('touchend click', '.weui_btn_dialog', function(){  
		    	$alert.hide();  
		  	});  
		  	$alert.show();  
		};  
		
		$(function () {  
			// 允许上传的图片类型  
			var allowTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];  
			// 图片最大宽度  
			var maxWidth = 300;  
			// 最大上传图片数量  
			var maxCount = 5;  
			$('#infobox').on('change','.js_file', function (event) {  
			    var files = event.target.files;  

			    var thisid = $(this).parents('.infobox').attr('id');
			                
			               
			      // 如果没有选中文件，直接返回  
			      if (files.length === 0) {  
			        return;  
			      }  
			      
			    for (var i = 0, len = files.length; i < len; i++) {  
			        var file = files[i];  
			        var reader = new FileReader();  
			        // 如果类型不在允许的类型范围内  
			        if (allowTypes.indexOf(file.type) === -1) {  
			            $.weui.alert({text: '请上传图片'});  
			            continue;  
			        }  
			          
			        if (file.size > 10485760) {  
			            $.weui.alert({text: '图片太大，不允许上传'});  
			            continue;  
			        }  
			          
			        if ($('#'+thisid+' .weui_uploader_file').length >= maxCount) {   
			            return;  
			        }  

			        
			        reader.onload = function (e) {  
			            var img = new Image(); 
			            img.onload = function () {
			                // 不要超出最大宽度  
			                var w = Math.min(maxWidth, img.width);  
			                // 高度按比例计算  
			                var h = img.height * (w / img.width);  
			                var canvas = document.createElement('canvas');  
			                var ctx = canvas.getContext('2d');  
			                // 设置 canvas 的宽度和高度  
			                canvas.width = w;  
			                canvas.height = h;  
			                ctx.drawImage(img, 0, 0, w, h);  
			                var base64 = canvas.toDataURL('image/png');  
			                  
			                $.post('/com/uploadbid_images.php', {image: base64,id:thisid,userid:tender_userid,orderid:orderid}, function(data) {
			                	if(data){
					                // 插入到预览区   
					                var $preview = $('<li class="weui_uploader_file weui_uploader_status" id="onloaded" style="background-image:url(' + base64 + ')"></li>');  
					                $('#'+thisid+' .weui_uploader_files').append($preview);  
			                		$('#onloaded').attr('id',data);
			                	}else{
			                		alert('已停止报价!');
			                	}
			                });

	                    };  
			                    
	                    img.src = e.target.result; 
	                };  

	                reader.readAsDataURL(file);  
	            }  
			});  
		});  

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
            
            return attr;
		}

		var height = $(window).height();
		var width = $(window).width();
		
        $('#infobox').on("click", "li", function(){
            imageid = this.id;
            bid_orderid = $(this).parents('.infobox').attr('id');
            $('<img>').addClass('topimage').attr('src', './bidimage/'+imageid+'.jpg').appendTo('#topimage');
            
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
        
        $('#topimage').on('click','.delete',function(){
        	$('#topimage').fadeOut(100);
        	$('.topimage').remove();
        	$.post('/com/deletebid_image.php', {imageid: imageid,id:bid_orderid,userid:tender_userid,orderid:orderid}, function(data) {
        		if(data){
        			$('#'+imageid).remove();
        		}
        	});
        })

        loadisget_msg();
	</script>
</body>