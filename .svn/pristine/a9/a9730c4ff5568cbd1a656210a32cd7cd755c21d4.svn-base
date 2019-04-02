<?php
// 模版消息


require 'wechat.class.php';

$data = array( 'touser' => 'oM-qJjgKTkq2SYpRL7ct_Ics3YoU',
    'template_id' => 'bz2YWPbckV0_RvRYm6OSdMLVtANpi01-GuRgCeGg8E8',
    'url' => 'http://www.cnzhaoshu.com/shop.php',
    'data'=>array(
        'first'=>array(
            'value' => '您苗圃中的槐树已中选'
        ),
        'keyword1' => array(
            'value' => '北方远景采购单'
        ),
        'keyword2' => array(
            'value' => '雪薇'
        ),
        'keyword3' => array(
            'value' => date('Y-m-d',time())
        ),
        'remark'=>array(
            'value'=> '点击此处进行投标'
        )
    )
);

$weObj = new Wechat();

echo $weObj->sendTemplateMessage($data);

unset($weObj);





