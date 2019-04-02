<!DOCTYPE html>
<html>
<head>
	<title>交易动态</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}
		.header{
			width: 100%;
			text-align: center;
			font-size: 23px;
			line-height: 55px;
			background: #eee;
			height: 46px;
		}
		#info{
			position: absolute;
			overflow-y: auto;
			width:100%;
			top:50px;
		}
		.time{
			width:24%;
			float: left;
			padding:8px 3%;
		}
		.content{
			width:66%;
			float: left;
			padding:8px 2%;
		}
		.row{
			float: left;
			width: 98%;
			margin: 0 1%;
			border-bottom: 1px dashed #eee;
		}
	</style>
</head>
<body>
	<div class="header">
		找树网交易动态
	</div>
	<div id="info">
	</div>
	<script id="dot_info" type="text/x-dot-template">
		{{ for(var i in it) { }}
			<div class="row">
				<div class="time">{{=changetime(it[i].time)}}</div>
				<div class="content">{{=it[i].content}}</div>
			</div>
		{{ } }}
	</script>
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="./js/doT.min.js"></script>
	<script type="text/javascript">
		var dot_info = doT.template($('#dot_info').text());
		var isloading = false;
		var isend = false;
		var width = $(window).width(); 
		var height = $(window).height(); 
		$('#info').css("height",height-52+'px');
		function changetime(time){
			var times = time.split(' ');
			times = times[0].split('-');
			time = times[1]+'月'+times[2]+'日';
			return time;
		}
		function loadmore(){
			if(isloading) return;
			isloading = true;
			var limit = $('#info tr').length + ',20';
			$.getJSON('/com/search_all_dynamic.php', {limit:limit}, function(json) {
				if(json){
					$('#info').append(dot_info(json));
				}else{
					isend = true;
				}
				isloading = false;
			});
		}
		$('#info').scroll(function() {
			if(isend) return;
			var scrllheight = $('#info').scrollTop();
			if(height-scrllheight < 280){
				loadmore();
			}
		});
		loadmore();
	</script>
</body>
</html>

