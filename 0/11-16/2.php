<?php
// 二维码扫描入口
require 'com/db2.php';

$qrcodeid = $_REQUEST['ID'];
if (is_numeric($qrcodeid)) {
	$db = new db();

	// 监管二维码
	$map_tree = $db->query('select maporderid,userid,treeuserid,groupuser from v_map_order where find_in_set(\''.$qrcodeid.'\', qrcode)');
    if ($map_tree) {
    	$map_tree = $map_tree[0];

    	$user = $_COOKIE['user2'];
		if ( $user ) {
			$user = json_decode($user, true);
			$userid = $user['userid'];
			if ($userid==$map_tree['userid'] || $userid==$map_tree['treeuserid'] 
				|| in_array( (string)$userid, explode(',', $map_tree['groupuser'] ) ) ) {
				header('Location: http://www.cnzhaoshu.com/imagegps.php?maporderid='.$map_tree['maporderid']);
				exit;
			}
		}	
    }

	$supervision_id = $db->query('select id,tree_name from map_supervision where qrcode=?', array($qrcodeid));
    if ($supervision_id) {
    	$supervision_id = $supervision_id[0]['id'];
    	if($supervision_id[0]['tree_name']){
	    	header('Location: http://www.cnzhaoshu.com/imagegps.php?id='.$supervision_id);
	    	exit;
    	}else{
    		header('Location: http://www.cnzhaoshu.com/map_treeinfo.php?id='.$supervision_id);
    	}
    }

	$tree = $db->prepare_query('select treeid from tree where qrcodeid=?', array($qrcodeid));

	unset($db);
	
	if ($tree) {
		// 已有，显示数据
		header('Location: http://www.cnzhaoshu.com/tree.php?treeid='.$tree[0][treeid]);
	}else{
		switch (substr($qrcodeid, 0, 1)) {
			case '2':
				// 树牌没有使用，起始编号210101-210135 跳转到百度百科
				include 'com/baike.php';
				baike($qrcodeid);
				break;

			case '3':
				// 养护系统
				header('Location: http://www.yangshuwang.com/m.html?where={"flagid":'.substr($qrcodeid, 1, 4).'}');
				break;
			
			default:
				header('Content-type: text/html;charset=utf-8');
				echo '<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />';

				// 其他，提示到公众号上传苗木数据
				echo '<h3 style="position: absolute;width:100%;top:20%;text-align: center;color:green">
				树牌ID：'.$qrcodeid.'<br>此树牌尚未使用<br>请将该二维码照片发到找树网服务号<br><br><img src="img/wx.jpg" width=160></h3>';

				break;
		}
	}
}
?>