<?php
// 模版消息



function send_message($touser="",$url_id="",$first="",$keyword1="",$keyword2="",$keyword3="",$remark=""){
    require_once 'wechat.class.php';
$data = array( 'touser' => $touser,
               'template_id' => 'bz2YWPbckV0_RvRYm6OSdMLVtANpi01-GuRgCeGg8E8',
               'url' => 'test.cnzhaoshu.com/admin/m_bid.html#bidinfo&tree_id='.$url_id,
               'data'=>array(
                       'first'=>array(
                           'value' => $first
                       ),
                       'keyword1' => array(
                           'value' => $keyword1
                       ),
                       'keyword2' => array(
                           'value' => $keyword2
                       ),
                       'keyword3' => array(
                           'value' => $keyword3
                       ),
                       'remark'=>array(
                           'value'=> $remark
                       )
               )
);
//var_dump($data);
//    die;
$weObj = new Wechat();

$weObj->sendTemplateMessage($data);

unset($weObj);
}




