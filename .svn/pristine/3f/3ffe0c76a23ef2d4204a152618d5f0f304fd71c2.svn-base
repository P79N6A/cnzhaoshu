<?php


function sendMessage($wechatid, $first, $keyword, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'DAKZ3tVDtYDaV_GnX3TR03HtB7S5I9wl4tXoEc8GWh4',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $keyword
	                       ),
	                       'keyword2'=>array(
	                           'value'=>date('Y-m-d H:i:s')
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

function takemoney($wechatid, $title, $name, $money, $way, $desc, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'OLrMwyrjTfHx8WyVUQ8ZZ9TBbFGcJLTSTHLFjuSG9JQ',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $title
	                       ),
	                       'keyword1' => array(
	                           'value' => $name
	                       ),
	                       'keyword2'=>array(
	                           'value'=>date('Y-m-d H:i:s')
	                       ),
	                       'keyword3'=>array(
	                           'value'=>$money
	                       ),
	                       'keyword4'=>array(
	                           'value'=>$way
	                       ),
	                       'remark'=>array(
	                           'value'=>$desc
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

function sendbidMessage($wechatid, $first, $keyword1, $keyword2, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'ut_1GkiueF-i04TZlxPIJfxoVwHMiTfJktqztAIqOiA',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $keyword1
	                       ),
	                       'keyword2'=>array(
	                           'value'=> $keyword2
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

function sendselectedMessage($wechatid, $first, $keyword1, $keyword2, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'bz2YWPbckV0_RvRYm6OSdMLVtANpi01-GuRgCeGg8E8',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $keyword1
	                       ),
	                       'keyword2'=>array(
	                           'value'=> $keyword2
	                       ),
	                       'keyword3'=>array(
	                           'value'=>date('Y-m-d H:i:s')
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}


function post($url,$data){
	//实例化对象
	$curl = new Curl();
	//调用方法
	$res = $curl->post($url,$data);
	//返回结果
	return $res;
}

function geturl($weObj){

	$weObj->deleteAccessToken();
	$weObj->checkAuth();
	$token = $weObj->getAccessToken();

	$url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$token.'&type=image'; 
	return $url;
}


function sendImage($wechatid,$media_id,$weObj){

	$data = array( 'touser' => $wechatid,
	               'msgtype' =>  'image',
	               'image' =>array(
	               		'media_id'=> $media_id
	               	)
	);

	if(!$weObj->sendCustomMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendCustomMessage($data);
	}
}


function sendonetreepay($wechatid, $first, $money, $name, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'nugbF-4XY8KDi6Ky4l1kNI2nn3rwMYxpWW9rg5z6naQ',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'orderMoneySum' => array(
	                           'value' => $money.'元'
	                       ),
	                       'orderProductName'=>array(
	                           'value'=>$name
	                       ),
	                       'Remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

function sendorderstop($wechatid, $first, $name, $number, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'zFMn1I5uY3r-ehdxuXCXVecFeQWDUzdPmydELrDH9zo',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $name
	                       ),
	                       'keyword2'=>array(
	                           'value'=>$number
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

function shipping($wechatid, $first, $name, $number, $remark, $url,$weObj){
	$data = array( 'touser' => $wechatid,
	               'template_id' => 'zFMn1I5uY3r-ehdxuXCXVecFeQWDUzdPmydELrDH9zo',
	               'url' => 'http://cnzhaoshu.com/'.$url,                 
	               'data'=>array(
	                       'first'=>array(
	                           'value' => $first
	                       ),
	                       'keyword1' => array(
	                           'value' => $name
	                       ),
	                       'keyword2'=>array(
	                           'value'=>$number
	                       ),
	                       'keyword3'=>array(
	                           'value'=>'找树网'
	                       ),
	                       'remark'=>array(
	                           'value'=> $remark
	                       )
	               )
	);

	if(!$weObj->sendTemplateMessage($data)){
	    $weObj->deleteAccessToken();
	    echo $weObj->sendTemplateMessage($data);
	}
}

