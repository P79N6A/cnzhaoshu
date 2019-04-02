<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<style type="text/css">
	.title{
		width:90%;
		float:left;
		font-size: 20px;
		height:40px;
		line-height: 40px;
	}
	.options{
		width:100%;
		float: left;
	}
	.options .allconditions{
		width:18%;
		margin-right: 1%;
		margin-top: 5px;
		float:left;
		background:#aaa;
		text-align: center;
		border:1px solid #eee;
		border-radius: 3px;
		height:25px;
		line-height: 25px;
	}
	.options .conditions{
		width:18%;
		margin-right: 1%;
		margin-top: 5px;
		float:left;
		background:#eee;
		text-align: center;
		border:1px solid #eee;
		border-radius: 3px;
		height:25px;
		line-height: 25px;
	}
	.contentbox{
		width:100%;
		float: left;
		margin-top: 5px;
	}
	.contentbox .info{
		float: left;
		width:100%;
		line-height:25px;
	}
	.contentbox .content .order{
		width:10%;
		float: left;
	}
	.contentbox .content .name{
		width:60%;
		float: left;
	}
	.contentbox .content .count{
		width:20%;
		float: left;
	}
	.contentbox .content{
		width:97%;
		margin-top: 5px;
		padding: 3px 1%;
		float: left;
		border:1px solid #ccc;
	}
	.contentbox .contentfoot{
		margin: 10px 0 0 2px;
		float: left;
	}
	.foot{
		width:100%;
		margin-top: 20px;
		float: left;
		line-height: 40px;
	}
	.foot div{
		margin-left: 35%;
		width:30%;
		height:40px;
		border-radius: 3px;
		float: left;
		text-align: center;
		background:#28dd28;
		border: 1px solid transparent;
		color:#fff;
	}
</style>

</head>
<body>
	<div class="title">共有12家店比中,群发消息可开始招标</div>
	<div class="options">
		<div class="allconditions">全部</div>
		<div class="conditions">河北</div>
		<div class="conditions">北京</div>
		<div class="conditions">供应商</div>
		<div class="conditions">旗舰店</div>
		<div class="conditions">已认证</div>
		<div class="conditions">普通店</div>
		<div class="conditions">有发票</div>
	</div>
	<div class="contentbox">
		<div class="content">
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
			<div class="info"><div class="order">1.</div><div class="name">国槐</div><div class="count">5家</div></div>
		</div>
		<div class="contentfoot">共有9家店铺被选中(需付费10元)</div>
	</div>
	<div class="foot">
		<div>群发付费</div>
	</div>

	<script src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
		$('.conditions').click(function(){
			var mark = $(this).attr('mark');
			if(mark){
				$(this).css('background','#eee');
				$(this).attr('mark','');
				var nomark = false;
				$('.conditions').each(function() {
					var marks = $(this).attr('mark');
					if(marks){
						nomark = true;
					}
				});
				if(!nomark) $('.allconditions').css('background','#aaa');

			}else{
				$(this).css('background','#aaa');
				$(this).attr('mark','1');
				$('.allconditions').css('background','#eee');
			}
		})

		$('.allconditions').click(function(){
			$('.allconditions').css('background','#aaa');
			$('.conditions').css('background','#eee');
			$('.conditions').attr('mark','');
		})


	</script>
</body>