<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/12/4
 * Time: 15:27
 * 给其他店铺发送模板信息
 */

function send_message_other($touser="",$first="",$keyword1="",$remarks=""){
    require_once 'wechat.class.php';
    $data = array( 'touser' => $touser,
        'template_id' => 'PeR7aqjF_ciyQJvOOKX1eXixFYxUlQJ91ljpKmcWme8',
        'url' => '',
        'data'=>array(
            'first'=>array(
                'value' => $first
            ),
            'keyword1' => array(
                'value' => $keyword1
            ),
            'keyword2' => array(
                'value' => date("Y-m-d",time())
            ),
            'remark'=>array(
                'value'=> $remarks
            )
        )
    );
//var_dump($data);
//    die;
    $weObj = new Wechat();

    $weObj->sendTemplateMessage($data);

    unset($weObj);
}




