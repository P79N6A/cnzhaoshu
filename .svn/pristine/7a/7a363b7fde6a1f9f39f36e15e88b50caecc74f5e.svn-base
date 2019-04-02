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
<title>招标筛选</title>
<style type="text/css">
	#title{
		width:98%;
		float:left;
		font-size: 17px;
		min-height:40px;
		line-height: 40px;
	}
	#options{
		width:100%;
		float: left;
		border-top: 1px solid #eee;
		padding:5px 0;
	}
	#options .allconditions{
		min-width:13%;
		padding: 1px 6px;
		margin-right: 2%;
		margin-top: 5px;
		float:left;
		background:#eee;
		border:1px solid #eee;
		border-radius: 3px;
		height:30px;
		line-height: 30px;
	}
	#options .conditions{
		padding: 1px 6px;
		min-width:15%;
		margin-right: 2%;
		margin-top: 5px;
		float:left;
		background:#eee;
		border:1px solid #eee;
		border-radius: 3px;
		height:30px;
		line-height: 30px;
	}
	.contentbox{
		width:100%;
		float: left;
	}
	.contentbox .info{
		float: left;
		width:100%;
		line-height:30px;
		margin: 3px 0;
		background: #eee;
		border-radius: 3px;
	}
	.contentbox #content .order{
		width:10%;
		float: left;
	}
	.contentbox #content .name{
		width:60%;
		float: left;
	}
	.contentbox #content .count{
		width:20%;
		float: left;
	}
	.contentbox #content{
		width:97%;
		margin-top: 8px;
		padding: 5px 1%;
		float: left;
		border:1px solid #eee;
		border-radius: 3px;
	}
	.contentbox #contentfoot{
		margin: 10px 0 0 2px;
		float: left;
	}
	.foot{
		width:100%;
		margin-top: 40px;
		float: left;
		line-height: 35px;
		margin-bottom: 20px;
	}
	.to_pay{
		width:80%;
		height:35px;
		border-radius: 4px;
		margin: 0 10%;
		float: left;
		text-align: center;
		background:#1AAD19;
		color:#fff;
	}
	.condition_name{
		float: left
	}
	.condition_button{
		float: right;
		font-size: 23px;
		padding: 0 5px;
		color:#888;
	}
	.companycount_name,.companycount_count{
		display: none;
	}
	.on .companycount{
		float: left;
		width: 100%;
		line-height: 20px;
		background: #fff;
	}
	.on .companycount_name{
		float: left;
		width: 40%;
		padding-left: 30%;
		display: block;
	}
	.on .companycount_count{
		float: left;
		width: 20%;
		display: block;
	}
</style>

</head>
<body>

	<div id="title"></div>
	<div id="options">
		<div class="allconditions"><div class="condition_name">全部</div></div>
		<div class="conditions"><div class="condition_name">非供应商</div><a class="condition_button">×</a></div>
		<div class="conditions"><div class="condition_name">未认证</div><a class="condition_button">×</a></div>
	</div>
	<div class="contentbox">
		<div id="content">
		</div>
		<div id="contentfoot"></div>
	</div>
	<div class="foot">
		<div class="to_pay">群发消息</div>
	</div>

	<script id="dot_showinfo" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="info" data-id="{{=it[i].id}}">
		        <div class="order">{{=addone(i)}}</div>
		        <div class="name">{{=it[i].name}}</div>
		        <div class="count">{{=it[i].count}}家</div>
		        <div class="companycount">
		        </div>
	        </div>
	    {{ } }}
	</script>

	<script id="dot_showconditions" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="conditions"><div class="condition_name">{{=it[i]}}</div><a class="condition_button">×</a></div>
	    {{ } }}
	</script>

	<script id="dot_typecompany" type="text/x-dot-template">
	    {{ for(var i in it) { }}
	        <div class="companycount_name">{{=it[i].name}}</div><div class="companycount_count">{{=it[i].count}}家</div>
	    {{ } }}
	</script>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script src="./js/doT.min.js"></script>
	<script type="text/javascript">
		var dot_showinfo = doT.template($("#dot_showinfo").text());
		var dot_typecompany = doT.template($("#dot_typecompany").text());
		var dot_showconditions = doT.template($("#dot_showconditions").text());
		var authenticate = false;
		var tree_allcompany = [];
		var alldata = [];
		var showalldata = [];
		var allcompany = [];
		var orderinfo = [];
		var finaldata = [];
		var addresses = [];
		var supplierid = [];
		var orderid = getQueryString("orderid");
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

		function loadqualifiedcompany(){
			$.getJSON('/com/search_tendering_order.php',{orderid:orderid,userid:user.userid},function(json){
				if(json){
					addresses = json['alladdress'];
					supplierid = json['supplierid'];
					alldata = json['company'];
					showalldata = json['company'];
					orderinfo = json['orderinfo'];
					showall_company(json['company']);
					$('#options').append(dot_showconditions(json['alladdress']));
				}
			})
		}

		function addone(one){
			var a = 1+parseInt(one);
			return a+'.';
		}

		function showall_company(json){
			allcompany = [];
			finaldata = json;
			for (var i = 0; i < json.length; i++) {
				if(!tree_allcompany[i]) tree_allcompany[i] = {};
				if(json[i].data){
					var tree_info = json[i];
					tree_allcompany[i].id  = tree_info.id;
					tree_allcompany[i].number  = tree_info.numbern;
					tree_allcompany[i].name  = tree_info.treename;

					var countshop = [];
					for (var g = 0; g < tree_info.data.length; g++) {
						var shopid = tree_info.data[g].shopid;
						var isinshop = true;
						if(countshop.length){
							for (var t = 0; t < countshop.length; t++) {
								if(countshop[t] == shopid){
									isinshop = false;
								}
							}							
						}
						if(isinshop) countshop[countshop.length] = shopid;
					}

					tree_allcompany[i].count  = countshop.length;
					tree_allcompany[i].type  = [];
					var tree_allinfo = tree_info.data;
					var type = [];
					for (var j = 0; j < tree_allinfo.length; j++) {
						for (var k = 0; k < addresses.length; k++) {
							if((addresses[k] == tree_allinfo[j].city) || (addresses[k] == tree_allinfo[j].province)){
								var mark = true;
								for (var b = 0; b < type.length; b++) {
									if(type[b].name == addresses[k]){
										type[b].count += 1;
										mark = false;
									}
								}
								if(mark){
									var lengths =type.length; 
									type[lengths] = {};
									type[lengths].name = addresses[k];
									type[lengths].count = 1;
								}
							}
						}
						if(tree_allinfo[j].userisrenzheng){
							var mark = true;
							for (var b = 0; b < type.length; b++) {
								if(type[b].name == '认证店'){
									type[b].count += 1;
									mark = false;
								}
							}
							if(mark){
								var lengths = type.length; 
								type[lengths] = {};
								type[lengths].name = '认证店';
								type[lengths].count = 1;
							}
						}
						if(supplierid){
							for (var k = 0; k < supplierid.length; k++) {
								if(supplierid[k].supplier_id == tree_allinfo[j].userid){
									var mark = true;
									for (var b = 0; b < type.length; b++) {
										if(type[b].name == '供应商'){
											type[b].count += 1;
											mark = false;
										}
									}
									if(mark){
										var lengths =type.length; 
										type[lengths] = {};
										type[lengths].name = '供应商';
										type[lengths].count = 1;
									}
								}
							}
						}
							
						var have = true;
						if(!allcompany.length){
							allcompany[allcompany.length] = tree_allinfo[j].shopid;
							continue;
						}
						for (var m = 0; m < allcompany.length; m++) {
							if(allcompany[m] == tree_allinfo[j].shopid){
								have = false;
							}
						}
						if(have) allcompany[allcompany.length] = tree_allinfo[j].shopid;
					}
					tree_allcompany[i].type  = type;
				}else{
					var tree_info = json[i];
					tree_allcompany[i].number  = tree_info.numbern;
					tree_allcompany[i].name  = tree_info.treename;
					tree_allcompany[i].count  = 0;
					tree_allcompany[i].type  = null;
				}
			}
			if(!$('#title').html()){
				$('#title').html('共有'+allcompany.length+'家店比中,群发消息可开始招标!');
			}

			$('#content').html(dot_showinfo(tree_allcompany));
		}

		function select_company(conditionname){
			var selectdata = [];
			for (var i = 0; i < showalldata.length; i++) {
				var onedata = showalldata[i].data;
				var lengths = selectdata.length;
				if(showalldata[i].data){
					selectdata[lengths] = {};
					selectdata[lengths].numbern = showalldata[i].numbern;
					selectdata[lengths].treename = showalldata[i].treename;
					selectdata[lengths].data = [];
					for (var j = 0; j < onedata.length; j++) {
						if(onedata[j]){
							if(conditionname == '未认证'){
								if(onedata[j].userisrenzheng == 1){
									var lengthss = selectdata[lengths]['data'].length;
									selectdata[lengths]['data'][lengthss] = onedata[j];
								}
							}else if(conditionname == '非供应商'){
								
								for (var k = 0; k < supplierid.length; k++) {
									if(supplierid[k].supplier_id == onedata[j].userid){
										var lengthss = selectdata[lengths]['data'].length;
										selectdata[lengths]['data'][lengthss] = onedata[j];
									}
								}

							}else if((conditionname != onedata[j].city) && (conditionname != onedata[j].province)){
								var lengthss = selectdata[lengths]['data'].length;
								selectdata[lengths]['data'][lengthss] = onedata[j];
							}
						}
					}
				}else{
					selectdata[lengths] = {};
					selectdata[lengths].numbern = showalldata[i].numbern;
					selectdata[lengths].treename = showalldata[i].treename;
					selectdata[lengths].data = null;
				}
			}
			showalldata = selectdata;
			showall_company(showalldata);
		}

		// 合格苗木商家信息
		$('#content').on('click','.info',function(){
		    if($(this).hasClass('on')){
		        $(this).find('.companycount').animate({'height':'0'});
		        $(this).removeClass('on');
		    }else{
		        var id = String($(this).data('id'));
		        for (var i = 0; i < tree_allcompany.length; i++) {
		        	if(tree_allcompany[i].id == id){
		        		if(tree_allcompany[i].type){
		        			$(this).find('.companycount').html(dot_typecompany(tree_allcompany[i].type));
		        			var heights = tree_allcompany[i].type.length*20;
					        $(this).addClass('on');
					        $(this).find('.companycount').animate({'height':heights});
		        		}
		        	}
		        }
		    }
		})

		// 筛选
		$('#options').on('click','.condition_button',function(){
			$(this).parent().hide();
			var conditionname = $(this).prev().html();
			select_company(conditionname);
		})

		// 显示所有筛选条件
		$('#options').on('click','.allconditions',function(){
			$('.conditions').show();
			showalldata = alldata;
			showall_company(alldata);
		})

		// 群发消息
		$('.to_pay').click(function(){
			var to_tender = [];
			for (var j = 0; j < finaldata.length; j++) {
				if(finaldata[j].data){
					var datas = finaldata[j].data;
					for (var i = 0; i < datas.length; i++) {
						
						var lengths = to_tender.length;
						to_tender[lengths] = {};
						to_tender[lengths].id = finaldata[j].id;
						to_tender[lengths].orderid = orderinfo.id;
						to_tender[lengths].userid = datas[i].userid;
					}
				}
			}

			// 发送消息
			$.post('/com/tender_to_pay.php',{userid:orderinfo.userid,companyid:JSON.stringify(allcompany),orderid:orderid,to_tender:JSON.stringify(to_tender)},function(data){
				if(data){
					if(data == '-1'){
						alert('不可多次发布招标信息!');
					}else{
						alert('招标信息已发布成功!');
					}
				}
			})
		})

		loadqualifiedcompany();
	</script>
</body>