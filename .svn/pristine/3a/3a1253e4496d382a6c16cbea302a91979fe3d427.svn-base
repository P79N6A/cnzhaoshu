<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php

	include 'com/wechat_login.php';

	wechatLogin();

	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>上传招标信息</title>
	<style type="text/css">
		.input1{
			width:150px;
			height:20px;
		}
		.name{
			width:150px;
		}
		.btn{
			width:8%;
			height:30px;
			border-radius: 4px;
			background: #1AAD19;
			color:#fff;
			text-align: center;
			line-height: 30px;
			float: left;
		}
		.checkinfo{
			margin-left: 80%;
		}
		.uploadinfo{
			margin-left: 4%;
			display: none;
		}
		#phone{
			padding: 4px;
			float: left;
		}
		#address{
			padding: 4px;
			float: left;
			margin-left: 40px;
		}
		.type{
			float: left;
			margin-left: 40px;
		}
	</style>
</head>
<body>
	<div style="width:90%;padding: 10px 5%">
		<div style="height:50px">
			<input type="number" id="phone" placeholder="请输入电话">
			<input type="text" id="address" placeholder="请输入用苗地点">
			
		    <form action="" method="get" class="type"> 
			    <label><input name="type" type="radio" value="1" checked="checked">名称和规格未区分 </label> 
			    <label><input name="type" type="radio" value="2">名称和规格区分 </label>  
		    </form> 
		</div>
		<textarea class="uploadcontent" style="width: 100%;height:200px;">
		</textarea>
		<div style="height:50px;width:100%">
			<div class="btn checkinfo">校对</div>
			<div class="btn uploadinfo">提交</div>			
		</div>
		<div id="order"></div>
			
	</div>

	<script src="./js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
		var ordername;
		var allatrribute = [];
		var data=[];
		var iswriting = false;
		var tdhtml;
		var idnow;
		var classnow;
		var colses = [`trunk_diameter`, `ground_diameter`, `pot_diameter`,`plant_height`, `crown`,`branch_number`, `bough_number`, `age`, `branch_length`, `bough_length`, `branch_point_height`, `substrate`, `mark`];
		var colses1 = [ `胸径`, `地径`, `盆径`,`株高`, `冠幅`,`分枝数`, `主枝数`, `苗龄`, `条长`, `主枝长`, `分枝点高`, `基质`, `备注`];

		allatrribute['trunk_diameter'] = ['胸径','胸围','粗度'];
		allatrribute['ground_diameter'] = ['地径'];
		allatrribute['pot_diameter'] = ['盆径'];
		allatrribute['plant_height'] = ['株高','高度','H'];
		allatrribute['crown'] = ['冠幅'];
		allatrribute['branch_number'] = ['分枝数'];
		allatrribute['bough_number'] = ['主枝数'];
		allatrribute['age'] = ['苗龄'];
		allatrribute['branch_length'] = ['条长'];
		allatrribute['bough_length'] = ['主枝长','主蔓长'];
		allatrribute['branch_point_height'] = ['分枝点高'];
		allatrribute['substrate'] = ['基质'];
		allatrribute['mark'] = ['备注'];


		$('.checkinfo').click(function(){
			$('.uploadinfo').show();
			var type = $("input[type='radio']:checked").val();			
			var text = $('.uploadcontent').val();
			var worker = [];
			var lines = text.split("\n");
			var newuser = [];
			var truecolses = [];
			var rowname;
			var rowunit;
			var rowcount;
			var rowmark;
			if(type == 1){
				for (var a = 0; a < lines.length; a++) {
					if(lines[a]){
						lines[a] = $.trim(lines[a]);
						var cols = lines[a].split("\t");
						if(a < 2){
							for (var b = 0; b < cols.length; b++) {
								var row = cols[b];
								if((a == 0) && row){
									ordername = row;
								}else if( a == 1){
									var name = row.replace('名称','');
									var unit = row.replace('单位','');
									var count = row.replace('数量','');
									var mark = row.replace('备注','');
									if(name != row){
										rowname = b;
										continue;
									}
									if(unit != row){
										rowunit = b;
										continue;
									}
									if(count != row){
										rowcount = b;
										continue;
									}
									if(mark != row){
										rowmark = b;
										continue;
									}
								}
							}
						}else{
							var lengths = data.length;
							var truecols = false;
							for (var k = 0; k < cols.length; k++) {
								if(cols[k]){
									truecols = true;
								}							
							}
							if(truecols){
								data[lengths] = {};
								for (var b = 0; b < cols.length; b++) {
									if(b == rowname){
										var name = cols[b];
										name = name.split(' ');
										data[lengths].name = name[0];
										var attribute;
										for (var c = 0; c < name.length; c++) {
											if(name[c]){
												attribute = name[c];								
											}
										}
										var choose;
										for (var key in allatrribute) {
											for (var d = 0; d < allatrribute[key].length; d++) {
												choose = attribute.split(allatrribute[key][d]);
												if(choose.length > 1){
													truecolses[truecolses.length] = key;
													var numbera = parseInt(choose[1]);
													if(!isNaN(numbera)){
														var number = choose[1].replace(numbera+'-','');
														var numberb = parseInt(number);
														if(!isNaN(numberb)){
															var number = choose[1].replace(numbera+'-'+numberb+'m','');
															if(number != choose[1]){
																data[lengths][key] = 100*numbera+'-'+100*numberb;
															}else{
																data[lengths][key] = numbera+'-'+numberb;
															}
														}else{
															var number = choose[1].replace(numbera+'m','');
															if(number != choose[1]){
																data[lengths][key] = 100*numbera;
															}else{
																data[lengths][key] = numbera;
															}
														} 
													}
												}
											}
										}
									}else if(b == rowunit){
										data[lengths].unit = cols[b];
									}else if(b == rowcount){
										data[lengths].count = cols[b];
									}else if(b == rowmark){
										data[lengths].mark = cols[b];
									}
								}
							}
						}
					}
				} 
				var colsname1 = [];
				for (var e = 0; e < truecolses.length; e++) {
					var have = true;
					if(e == 0){
						colsname1[e] = truecolses[e];
					}else{
						for (var f = 0; f < colsname1.length; f++) {
							if(colsname1[f] == truecolses[e]){
								have = false;
							}						
						}
						if(have) colsname1[colsname1.length] = truecolses[e];			
					}
				}			
				var writename = [];
				var colsname = [];
				for (var g = 0; g < colses.length; g++) {				
					for (var h = 0; h < colsname1.length; h++) {
						if(colses[g] == colsname1[h]){
							colsname[colsname.length] = colses[g];
							writename[writename.length] = colses1[g];
						}					
					}
				}
				writedata(writename,colsname);
			}else{
				var writename = [];
				var colsname = [];
				var colsnumber = [];
				for (var a = 0; a < lines.length; a++) {
					if(lines[a]){
						lines[a] = $.trim(lines[a]);
						var cols = lines[a].split("\t");
						if(a < 2){
							for (var b = 0; b < cols.length; b++) {
								var row = cols[b];
								if((a == 0) && row){
									ordername = row;
								}else if( a == 1){
									var name = row.replace('名称','');
									var unit = row.replace('单位','');
									var count = row.replace('数量','');
									var mark = row.replace('备注','');
									if(name != row){
										rowname = b;
										continue;
									}
									if(unit != row){
										rowunit = b;
										continue;
									}
									if(count != row){
										rowcount = b;
										continue;
									}
									if(mark != row){
										rowmark = b;
										continue;
									}
									for (var key in allatrribute) {
										for (var c = 0; c < allatrribute[key].length; c++) {
											var attr = row.replace(allatrribute[key][c],'1');
											if(attr == 1){
												writename[writename.length] = allatrribute[key][c];
												colsname[colsname.length] = key;
												colsnumber[colsnumber.length] = b;
											}
										}
									}
								}
							}
						}else{
							var lengths = data.length;
							var truecols = false;
							for (var k = 0; k < cols.length; k++) {
								if(cols[k]){
									truecols = true;
								}							
							}
							if(truecols){
								data[lengths] = {};
								for (var d = 0; d < cols.length; d++) {

									if(d == rowname){
										data[lengths]['name'] = cols[d];
										continue;
									}
									if(d == rowunit){
										data[lengths]['unit'] = cols[d];
										continue;
									}
									if(d == rowcount){
										data[lengths]['count'] = cols[d];
										continue;
									}
									if(d == rowmark){
										data[lengths]['mark'] = cols[d];
										continue;
									}
									for (var e = 0; e < colsnumber.length; e++) {
										if(d == colsnumber[e]){
											data[lengths][colsname[e]] = cols[colsnumber[e]];
										}
									}
								}
							}

						}
					}
				} 
				writedata(writename,colsname)
			}				
		});

		function writedata(writename,colsname){
			console.log(data);
			var html = '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
			html += '<caption>'+ordername+'</caption>';
			html += '<tr data-id="title">';
			html += '<td>名称</td><td>数量</td><td>单位</td>';
			for (var i = 0; i < writename.length; i++) {
				html += '<td>'+writename[i]+'</td>'
			}
			html += '</tr>';
			for (var i = 0; i < data.length; i++) {
				html += '<tr data-id="'+i+'">';
				html += '<td class="name">'+(data[i].name ? data[i].name : '无')+'</td><td class="count">'+(data[i].count ? data[i].count : '0')+'</td><td class="unit">'+(data[i].unit ? data[i].unit : '无')+'</td>';
				for (var j = 0; j < colsname.length; j++) {
					if(data[i][colsname[j]]){
						html += '<td class="'+colsname[j]+'">'+data[i][colsname[j]]+'</td>';
					}else{
						html += '<td></td>';
					}
				}
				html += '</tr>';
			}
			html += '</table>';
			$('#order').html(html); 
		}
		
		$('#order').on('click','td',function(){
		    idnow = $(this).parent().data('id');
		    if(idnow != 'title'){
			    if(!iswriting){
			        iswriting = true;
			        classnow = $(this).attr('class');
			        tdhtml = $(this).html();
			        $(this).html('');
			        $('<input>').addClass('input1').attr('value',tdhtml).appendTo(this);
			        $('.input1').focus();
			    }
		    }
		}).on('blur','.input1',function(){
		    var newtdhtml = $('.input1').val();
		    if(newtdhtml && (tdhtml != newtdhtml)){
		        data[idnow][classnow] = newtdhtml;
		        $('.input1').parents('td').html(newtdhtml);
		    }else{
		        $('.input1').parents('td').html(tdhtml);
		    }
		    iswriting = false;
		});

		$('.uploadinfo').click(function(){
			for (var i = 0; i < data.length; i++) {
				for (var key in data[i]) {
					var oneattr = data[i][key].split('-');
					if(oneattr.length == 1){
						data[i][key] = oneattr[0];
					}else if(oneattr.length == 2){
						data[i][key] = oneattr[0]+','+oneattr[1];
					}
				}
			}
			var phone = $('#phone').val();
			var address = $('#address').val();
			$.post('/com/copy_excelorder.php',{phone:phone,address:address,ordername:ordername,data:JSON.stringify(data)},function(result){
				if(result) alert('上传成功!');
				ordername = '';
				allatrribute = [];
				data=[];
				iswriting = false;
				tdhtml = '';
				idnow = '';
				classnow = '';
				$('#order').html(''); 
				$('#phone').val('');
				$('#address').val('');
				$('.uploadcontent').val('');
			})
		})

	</script>
</body>
</html>