<!DOCTYPE html>
<html>
<?php 
include 'com/wechat_login.php';
$user = wechatLogin(); //跳转文件名

$role = $user['role']; //9找树网管理员,100平台管理员

if ( $role==9 || $role==100 ) {

	if ($role==100) {
		include 'com/openplatform.php';
		
		$platforms = openplatform::getPlatformByUserID($user['userid']);
		if ($platforms) {
			$where_platforms = array();
			foreach ($platforms as $platform) {
				array_push($where_platforms,"'".$platform['platformid']."'");
			}
		}
	}

	$where_platform = $where_platforms ? ' and platformid in ('.join(',',$where_platforms).')' : '';

	$sql = 'select userid,shopid,username,userphone,userstate,treeid,qrcodeid,imgpath,name,ldname,pname,dbh,crownwidth,height,dbh_type,height_type,branch_point_height,branch_bough_number,age,unit,substrate,remark,price,count,x,y,province,district,collections,video,phototime,photogps,state,time from v_tree where state=0'.$where_platform.' order by time desc';
	
	include_once 'com/db2.php';
	$db = new db();
	$trees = $db->query($sql);
	$db = null;
	echo '<script type="text/javascript"> var trees=\''.json_encode($trees).'\';</script>';
}
?>

<head>
	<title>苗木审核</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />
	<meta name="format-detection" content="telephone=no"/>
	<link rel="stylesheet" href="/css/basic_m.css?t=20170304" type="text/css" /> 
</head>
<body>
<div id="title" class="title"></div>
<div id="treelist"></div>
<script src="/js/crypt.js"></script>
<script src="/js/fastclick.min.js?t=20161205"></script>
<script type="text/javascript">
var scrollTop;

function $(o){
	return document.getElementById(o);
}
function mORcm(m) {
	return m<1 ? Math.round(m*100)+'公分' : m+'米';
}

var xmlHttp;
var callback;   
function createXMLHttpRequest() {    
	if (window.ActiveXObject) {    
		return new ActiveXObject("Microsoft.XMLHTTP");    
	}else if (window.XMLHttpRequest) {    
		return new XMLHttpRequest();    
	}    
}
function ajax(url, call){
	callback = call;
	xmlHttp = createXMLHttpRequest();    

	xmlHttp.open("GET", url, true);    
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4) {
			if (xmlHttp.status==200 || xmlHttp.status==0) {
				callback(xmlHttp.responseText);
			}
		}
	};
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");    
	xmlHttp.send(null); 
	return true;   
}

function init () {
    // console.log(trees);
    // return
    // console.log(JSON.parse(trees));
    // return ;
	trees = trees!='null' ? JSON.parse(trees) : [];

	var treecount = 0;
	for(var i in trees) {
		treecount += trees[i].count*1; 
	}

	$('title').innerHTML = '待审核的树' + '<br><i id="total">' + trees.length + '项' + treecount + '株</i>';

	setTimeout(addTrees,10);
}

function addTrees () {
	for(var i in trees) {
		var tree = trees[i];
		if (tree.imgpath) 
			tree.imgpath = decodeImgpath(tree.imgpath);

		if (tree.phototime) {
			tree.phototime = tree.phototime.split(';');
			tree.photogps = tree.photogps.split(';');
		}		

		tree.price = Math.round(tree.price*100)/100;
		if (tree.price==0) tree.price = '议价';

		if (!tree.unit) tree.unit = '株';

		var attribute = [];
		if (tree.dbh) {
			tree.dbh = parseFloat(tree.dbh);
			tree.dbh && attribute.push('径'+tree.dbh+'公分'); 
		}
		if (tree.age) {
			tree.age = parseFloat(tree.dbh);
			tree.age && attribute.push('龄'+tree.age+'年'); 
		}
		if (tree.crownwidth) {
			tree.crownwidth = parseFloat(tree.crownwidth);
			tree.crownwidth && attribute.push('冠'+mORcm(tree.crownwidth)); 
		}
		if (tree.height) {
			tree.height = parseFloat(tree.height);
			tree.height && attribute.push('高'+mORcm(tree.height)); 
		}
		if (tree.branch_point_height) {
			tree.branch_point_height = parseFloat(tree.branch_point_height);
			tree.branch_point_height && attribute.push('分'+mORcm(tree.branch_point_height)); 
		}
		if (tree.branch_bough_number) {
			attribute.push('枝'+tree.branch_bough_number+'个'); 
		}

		if (tree.pname) {
			tree.name = tree.name.replace(tree.pname, "'"+tree.pname+"'");
		}

		var html = '<a href="javascript:showtree('+i+')">';
			html += tree.imgpath ? '<img src="/trees/s2/'+tree.imgpath[0]+'" />' : '<img alt=" no image">';

			if (tree.phototime) 
				html += '<div class="poi"></div>';

	  		html +=	'<h2>'+tree.name+'<span>¥'+tree.price + '</span></h2>';
			html +=	'<h3>'+attribute.join(' ')+'</h3>';
			html +=	'<h3>'+tree.username+'</h3>';
			html +=	'<h3>'+tree.province+tree.district + ' ' + tree.count+ tree.unit + '</h3></a>';
		var li = document.createElement('li');
		li.innerHTML = html;
		$('treelist').appendChild(li);
	}	
}

function showtree (i) {
	scrollTop = document.body.scrollTop;
	$('treelist').style.display = 'none';
	document.body.scrollTop=0;

	var attribute_name = {"5":"胸径","6":"地径","7":"盆径","10":"株高","11":"条长","12":"主蔓长","17":"株高"};
	var tree = trees[i];
	var html = '';
	
	var poi = '<a class="poi" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'+tree.x+','+tree.y+';title:'+tree.username+' '+tree.name+'&referer=geo"> </a>';

	html += '<div class="header"><a class="back" href="javascript:closeTreeView()">返回</a>'+poi+'</div>';
	
	html += '<table>';
	
	html += '<tr><th colspan="2">'+tree.name+'</th></tr>';
	if (tree.ldname)
		html += '<tr><td class="ldname" colspan="2">'+tree.ldname+'</td></tr>';

	html += '<tr><td class="field">上车单价：</td><td class="price">'+tree.price+'</td></th>';

	if (tree.qrcodeid) html += '<tr><td class="field">树牌：</td><td>'+tree.qrcodeid+'</td>';
	else html += '<tr><td class="field">编号：</td><td>'+tree.treeid+'</td>';

	if (tree.dbh)
		html += '<tr><td class="field">'+(tree.dbh_type?attribute_name[tree.dbh_type]:'胸径')+'：</td><td>'+tree.dbh+'公分</td>';
	if (tree.age)
		html += '<tr><td class="field">苗龄：</td><td>'+tree.age+'年</td>';
	if (tree.crownwidth)
		html += '<tr><td class="field">冠幅：</td><td>'+mORcm(tree.crownwidth)+'</td>';
	if (tree.height)
		html += '<tr><td class="field">'+(tree.height_type?attribute_name[tree.height_type]:'株高')+'：</td><td>'+mORcm(tree.height)+'</td>';
	if (tree.branch_point_height) 
		html += '<tr><td class="field">分枝点高：</td><td>'+mORcm(tree.branch_point_height)+'</td>';
	if (tree.branch_bough_number)
		html += '<tr><td class="field">分枝数：</td><td>'+tree.branch_bough_number+'个</td>';
	if (tree.substrate)
		html += '<tr><td class="field">基质：</td><td>'+tree.substrate+'</td>';
	if (tree.remark)
		html += '<tr><td class="field">备注：</td><td>'+tree.remark+'</td>';
	
	html += '<tr><td class="field">数量：</td><td>'+tree.count+tree.unit+'</td>';
	html += '<tr><td class="field">位置：</td><td>'+tree.province+' '+tree.district+'</td>';
	html += '<tr><td class="field">苗商：</td><td>'+tree.username+'</td>';
	html += '<tr><td class="field">联系电话：</td><td><a href="tel:'+tree.userphone+'">'+tree.userphone+'</a></td>';
	html += '<tr><td class="field">发布时间：</td><td>'+tree.time+'</td>';
	html += '</table>';
	
	if (tree.video) {
		html += '<video onplay="playVideo()" preload="none" controls="controls" poster="/trees/video/'+tree.video+'.jpg" width="100%" webkit-playsinline><source src="/trees/video/'+tree.video+'.mp4" type="video/mp4" /></video></div>';
	}

	if (tree.imgpath) for(var v in tree.imgpath) {
		if (tree.phototime && tree.phototime[v])
			html += '<div style="text-align:center;">';

		html += '<img src="trees/o2/'+tree.imgpath[v]+'" />';
		
		if (tree.phototime && tree.phototime[v]) 
			html += '<br><a class="poi2" href="http://apis.map.qq.com/uri/v1/marker?marker=coord:'
				    + tree.photogps[v] + ';title:'+tree.username+tree.name+'&referer=geo"></a><div class="phototime">'+tree.phototime[v]+'</div></div>';

	}	

	html += '<button onclick="approveTree('+i+')">审核通过</button>';
	html += '<button onclick="deleteTree('+i+')">删除苗木</button>';

	var treeview = document.createElement('div');
	treeview.id = 'treeview';
	treeview.innerHTML = html;
	document.body.appendChild(treeview);
}

function deleteTree (i) {
	if (confirm("确定要删除本条数据吗？")) {
		ajax('com/deletetree.php?treeid='+trees[i].treeid, function(){
			closeTree(i);
		});
	}
}

function approveTree (i) {
	ajax('com/approvetree.php?treeid='+trees[i].treeid, function(){
		closeTree(i);
	});
}

function closeTreeView() {
	$('treelist').style.display = 'block';
	document.body.removeChild($('treeview'));
	document.body.scrollTop = scrollTop;
}

function closeTree (i) {	
	var nodes = $('treelist').querySelectorAll('li');
	nodes[i].style.display = 'none';

	trees[i].isDeleted = true;
	var treecount = 0;
	var itemcount = 0;
	for(var v in trees) {
		var tree = trees[v];
		if (!tree.isDeleted) {
			treecount += tree.count*1; 
			itemcount++;
		}
	}
	$('total').innerHTML = itemcount + '项' + treecount + '株';

	closeTreeView();
}

init();	
</script>
</body></html>
