<!DOCTYPE html>
<html>
<?php
include 'com/wechat_login.php';
$visitor = wechatLogin('m2');
include_once 'com/db2.php';
include_once 'com/user2.php';

// The shop user
$where = json_decode($_REQUEST['where'], true);

$userid = $where['userid'] ? $where['userid'] : $_REQUEST['userid'];


if ($userid) {
    $user = user::getUserByUserId($userid);
} else {
    $wechatid = $_REQUEST['id'];
    if ($wechatid) {
        $user = user::getUserByWechatId($wechatid);
    } else {
        $user = $visitor;
    }
}
$db = new db();
$user_info_sql = "select  userid,wechatid,member_level,role,isrenzheng,first_authentication_time,member_paid_time from user where userid='" . $user['userid'] . "' ";
//	var_dump($user_info_sql);die;
$user_info = $db->query($user_info_sql)[0];
//	var_dump($user_info);die;
$first_authentication_time = isset($user_info['first_authentication_time']) ? $user_info['first_authentication_time'] : 0;
$member_paid_time = isset($user_info['member_paid_time']) ? $user_info['member_paid_time'] : 0;

if($user_info['first_authentication_time']!=""){
    $user_info['open_time'] = ceil((time() - $first_authentication_time) / 86400);
    $user_info['remaining_time'] =86400*365/86400-$user_info['open_time'];
}else{
    $user_info['open_time'] ="";
    $user_info['remaining_time'] ="";
}

unset($db);

if (isset($visitor) && $visitor['userid'] == $user['userid']) {
    // 自己店，查看和编辑自己的数据
    // $wherestate = 'userid=?';
    // $sql_array = array($user['userid']);
    $wherestate = 'shopid=?';
    $sql_array = array($user['shopid']);
} else {
    $wherestate = 'shopid=? and state>0 and imgpath is not null';
    $sql_array = array($user['shopid']);
}

if ($user['userid'] != $user['shopid']) {
    $shop = user::getUserByUserId($user['shopid']);

    $shop['userid'] = $user['userid'];
    $shop['phone'] = $user['phone'];
    $user = $shop;

}

if ($userid && in_array($user['role'], [101, 100, 9])) {
    header('Location: http://www.cnzhaoshu.com/qjd.php?shopid=' . $user['userid']);
    exit;
} else {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/headimg/96/' . $user['shopid'] . '.jpg')) {
        $user['headimg'] = 1;
    }

    $db = new db();

    $sql = 'select userid,shopid,top,username,userphone,userrole,userstate,treeid,qrcodeid,imgpath,name,ldname,pname,type,dbh,crownwidth,height,dbh_type,height_type,branch_point_height,branch_bough_number,age,unit,substrate,remark,price,count,x,y,province,district,collections,video,phototime,photogps,state,invoice,time from v_tree where ' . $wherestate . ' order by top desc, CONVERT(name USING gbk),price desc';
    $trees = $db->prepare_query($sql, $sql_array);

    $sql = 'select * from ( select @rownum := @rownum + 1 as `index`, user.userid,user.dianmi from (select @rownum := 0) r, user order by dianmi desc )a where a.userid=?';
    $order = $db->prepare_query($sql, array($user['shopid']));
    $user['dianmiOrder'] = $order[0]['index'];

   $collect_info_sql="select  allcollect,  allvisit, allshare from zsq_record where userid=?";
//   var_dump($collect_info_sql);die;
    $collect_info = $db->prepare_query($collect_info_sql, array($user['userid']))[0];
//    var_dump($collect_info);die;
    unset($db);

    $user['introduction'] = str_replace('"', '\"', $user['introduction']);
    echo '<script type="text/javascript">var state=1;var trees=\'' . json_encode($trees) . '\';var user=\'' . json_encode($user) . '\';</script>';

}
?>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1, width=device-width"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="/css/basic_m.css?t=20170425" type="text/css"/>
    <link rel="stylesheet" href="/css/weui.min.css">
    <script>var isShop = true;</script>
</head>
<body>

<div id="title" class="title"></div>
<?php if ($user_info['role'] == 101 || $user_info['member_level'] == 2) { ?>

        <div id="authentication" style="position:relative;">
            <div style="text-align: center;margin-top: 20px; margin-bottom:20px;margin-left: 5px">
                <p style="color: #333;">尊贵的旗舰店会员您好：</p>
                <p style="margin-top: 5px;color: #666">旗舰店开通时长：<span style="color:#0bb20c"><?= $user_info['open_time'] ?></span>天</p>
                <p style="margin-bottom: 5px;color: #666">旗舰店剩余时间：<span style="color: #0bb20c"><?= $user_info['remaining_time'] ?> </span>天</p>
                <p style="margin-bottom: -10px; color: #999;">
                    <img src="./images/liulan-xian1.png" alt="" style="float: left"><span style="text-align: left;float: left ; padding-left: 3%"><?=$collect_info['allvisit']?></span>
                    <img src="./images/icon-test1.png" alt="" style="margin-left:30% ;float: left"><span style="margin-left: -34%;padding-left: 4%"><?=$collect_info['allcollect']?></span>
                    <span style="text-align: right ;float: right; margin-right: 5%;"> <?=$collect_info['allshare']?></span><img src="./images/zhuanfa1.png" alt="" style="float: right; margin-right: 2%">
                </p>
            </div>
            <a href="javascript: alertwarp()">   <i class="weui-icon-info-circle" id="showIOSDialog2" style="position: absolute;right: 10px;top:5px"></i>  </a>
        </div>
<?php } else if ($user_info['isrenzheng'] == 1 || $user_info['member_level'] == 1) { ?>
    <div id="authentication" style="position:relative;">
        <div style="text-align: center;margin-top: 20px; margin-bottom:20px;margin-left: 5px">
            <p style="color: #333;">尊贵的认证店会员您好：</p>
            <p style="margin-top: 5px;color: #666">认证店开通时长：<span style="color:#0bb20c"><?= $user_info['open_time'] ?></span>天</p>
            <p style="margin-bottom: 5px;color: #666">认证店剩余时间：<span style="color: #0bb20c"><?= $user_info['remaining_time'] ?> </span>天</p>
            <p style="margin-bottom: -10px; color: #999;">
                <img src="./images/liulan-xian1.png" alt="" style="float: left"><span style="text-align: left;float: left ; padding-left: 3%"><?=$collect_info['allvisit']?></span>
                <img src="./images/icon-test1.png" alt="" style="margin-left:30% ;float: left"><span style="margin-left: -34%;padding-left: 4%"><?=$collect_info['allcollect']?></span>
                <span style="text-align: right ;float: right; margin-right: 5%;"> <?=$collect_info['allshare']?></span><img src="./images/zhuanfa1.png" alt="" style="float: right; margin-right: 2%">
            </p>
        </div>
        <a href="javascript: alertwarp2()">   <i class="weui-icon-info-circle" id="showIOSDialog2" style="position: absolute;right: 10px;top:10px"></i>  </a>
    </div>

<?php } else { ?>
    <div id="authentication" style="padding-left: 20px; padding-top: 20px;padding-right: 20px;">
        <a href="http://cnzhaoshu.com/pay_certification.php" class="weui-btn weui-btn_primary weui-btn_loading"
           style="background-color: #44a92f ;margin-bottom: -40px">认证服务</a>
        <br>
        <br>
        <?php if($collect_info['allvisit']=="" &&$collect_info['allshare']=="" &&$collect_info['allcollect']=="" ) {?>
            <p style="text-align: center; margin-bottom: -40px"> 亲! 您的店铺还没有被人发现，请积极转发哦!</p>
        <?php } else{ ?>
            <p style="margin-bottom: -10px; color: #999;">
                <img src="./images/liulan-xian1.png" alt="访问" style="float: left"><span style="text-align: left;float: left ; padding-left: 3%"><?=$collect_info['allvisit']?></span>
                <img src="./images/icon-test1.png" alt="收藏" style="margin-left:30% ;float: left"><span style="margin-left: -34%;padding-left: 36%"><?=$collect_info['allcollect']?></span>
                <span style="text-align: right ;float: right; margin-right: 5%;"> <?=$collect_info['allshare']?></span><img src="./images/zhuanfa1.png" alt="转发" style="float: right; margin-right: 2%">
            </p>
        <?php }?>
    </div>
<?php } ?>
<div id="treelist"></div>
<div id="footer"></div>

<!-- 底部菜单 -->
<div id="footer_menu" class="h_0100_1" style="display: block;">
    <a href="m.php">
        <li>
            <i class="nav_1"></i>
            <span>首页</span>
        </li>
    </a>
    <a href="yusuanphone.php">
        <li>
            <i class="nav_5"></i>
            <span>招投标</span>
        </li>
    </a>
    <a id="nav_cart" href="cart.php">
        <li>
            <i class="nav_3"></i>
            <span>找树车</span>
        </li>
    </a>
    <a id="nav_moments" href="zsq.php">
        <li>
            <i class="nav_2"></i>
            <span>找树圈</span>
        </li>
    </a>
    <a href="/admin/">
        <li>
            <i id="headImage" class="nav_4"></i>
            <span>我</span>
        </li>
    </a>
</div>
<script src="/js/alertshopinfo.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="/js/crypt.js?t=201811052"></script>
<script src="/js/basic_m2.js?t=201801026"></script>
<script src="/js/TouchSlide.1.1.js"></script>
</body>
</html>