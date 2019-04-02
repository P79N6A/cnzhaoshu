<?php

// 微信登录
$code = $_REQUEST['code'];
if ($code) {
    include 'wechat/openid.php';

    $wechatid = openid::getOpenid( $code );
    
    if($wechatid){
        include 'com/db2.php';
        include 'com/user2.php';

        $user = user::getUserByWechatId( $wechatid );
        if (!$user) $user = user::init( $wechatid );  // 创建用户


        $user_cookie = array('userid'=>$user['userid'], 'userid'=>$user['shopid'], 'role'=>$user['role'], 'name'=>$user['name'], 'phone'=>$user['phone'], 'isrenzheng'=>$user['isrenzheng'], 'istrader'=>$user['istrader'], 'version'=>$user['version']);
        if ( file_exists($_SERVER['DOCUMENT_ROOT'].'/headimg/96/'.$user['userid'].'.jpg') ) $user_cookie['headimg'] = 1;

        setcookie('user2', json_encode( $user_cookie ), time() + 315360000, '/', 'cnzhaoshu.com');

        $hash = $_REQUEST['hash'] ? '#'.$_REQUEST['hash'] : '';
        header('Location: '.$_REQUEST['login_uri'].$hash);
    } else {
        echo 'error: no openid';
    }
} else {
    echo 'error: no code';
}