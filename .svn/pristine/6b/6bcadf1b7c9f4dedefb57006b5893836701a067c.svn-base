<?php
require 'wechat.class.php';

sendMessage();
function sendMessage($wechatid, $first, $keyword, $remark, $url){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'DAKZ3tVDtYDaV_GnX3TR03HtB7S5I9wl4tXoEc8GWh4',
	               'url' => 'http://www.cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $keyword
	                       ),
	                       'keyword2'=>array(
	                           'value '=>date('Y-m-d H:i:s')
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);
 
	$weObj = new Wechat();

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}