<?php
// 二维码扫描入口
require 'com/db.php';
session_start();
$user=json_decode($_COOKIE['user2'],true);
$userid=isset($user['userid'])?$user['userid']:"";
$qrcodeid = $_GET['ID'];

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

    // 查询有没有绑码
	$map_order = $db->query('select id,tree_name,map_id,state,status,binding_status from maps_order where qrcode='.$qrcodeid)[0];

    if ($map_order) {
        // 验证是否是甲方
        $sql = "select d.userid from maps a left join order_project b on a.project_id=b.project_id left join contract_info d on b.partya_company_name = d.company_name WHERE a.id = '".$map_order['map_id']."'";
        $companya_id = $db->query($sql)[0]['userid'];
        $type = $db->query('select type from maps_record where map_order_id='.$map_order['id']);
        foreach ($type as $key => $val) {

            $newtype[] = $val['type'];

        }
    	$supervision_id = $map_order['id'];
        // 上传记录
        // 如果上传完所有监管信息
        if(  $map_order['state'] == '5' && in_array('5',$newtype) ){
            //监管详情页面
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/treeInfo/'.$supervision_id);
            exit;
        }
        // 不是甲方并且是是卸车 验收
        if($userid !=$companya_id && ( $map_order['state'] == '4' || $map_order['state'] == '5' ) && $map_order['binding_status'] == '2'){
            //监管详情页面
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/treeInfo/'.$supervision_id);
            exit;
        }
        // 是甲方并且不是卸车 验收
        if($userid ==$companya_id && ( $map_order['state'] == '1' || $map_order['state'] == '2' || $map_order['state'] == '3') && $map_order['binding_status'] == '2'){
            //监管详情页面
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/treeInfo/'.$supervision_id);
            exit;
        }
        // 如果有树名称，证明已经进行了二次绑码
    	if($map_order['binding_status'] == '2'){
            //上传监管信息
	    	header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/postSuperviseInfo/'.$supervision_id);
	    	exit;
    	}else{
            //完善数据
    		header('Location: http://'.$_SERVER['HTTP_HOST'].'/admin/mobile/zhaoshu/index.html#/confirmSupervise/'.$supervision_id);
    		exit;
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
				include 'wechat/wechat.class.php';

                $weObj = new Wechat();
                $qrcode = $weObj->getQRCode($qrcodeid);
                $ticket = $qrcode['ticket'];
                $url = $weObj->getQRUrl($ticket);

                unset($weObj);

                header('Content-type: text/html;charset=utf-8');
                echo '<meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width" />';
                echo '<style>body{margin:0;padding:0}</style>';

                // 其他，提示到公众号上传苗木数据
                echo '<h3 style="position: absolute;width:100%;top:20%;text-align: center;color:green">
                树牌ID：'.$qrcodeid.'<br>长按并识别二维码，上传数据<br><br><img src="'.$url.'" width=200></h3>';
				break;
		}
	}
}
?>