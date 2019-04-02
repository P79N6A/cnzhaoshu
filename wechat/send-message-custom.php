<?php
// 客服消息

require 'wechat.class.php';

$weObj = new Wechat();

$data = array(
    'touser' => 'oM-qJjma6Evlm74pACda0vmEW7g0',//三木
    'msgtype' => 'text',
    'text' => array('content' => 'test')
);

echo $weObj->sendCustomMessage($data);


unset($weObj);





