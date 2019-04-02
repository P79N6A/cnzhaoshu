<?php
// 模版消息


require 'wechat.class.php';

$data = array( 'touser' => 'oM-qJjpvP_QfQb8ImuTa9YSnEfk4',
               'template_id' => 'bz2YWPbckV0_RvRYm6OSdMLVtANpi01-GuRgCeGg8E8',
               'url' => 'http://www.cnzhaoshu.com/shop.php',             
               'data'=>array(
                       'first'=>array(
                           'value' => 'first'
                       ),
                       'keyword1' => array(
                           'value' => 'keyword1'
                       ),
                       'keyword2' => array(
                           'value' => 'keyword2'
                       ),
                       'keyword3' => array(
                           'value' => 'keyword3'
                       ),
                       'remark'=>array(
                           'value'=> 'remark'
                       )
               )
);

//var_dump($data);die;
$weObj = new Wechat();

echo $weObj->sendTemplateMessage($data);

unset($weObj);





