<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/12/27
 * Time: 11:15
 * 发送支付通知
 */
function send_message($touser="",$first="",$orderMoneySum="",$orderProductName="",$remarks=""){
    require_once 'wechat.class.php';
    $data = array( 'touser' => $touser,
        'template_id' => 'nugbF-4XY8KDi6Ky4l1kNI2nn3rwMYxpWW9rg5z6naQ',
        'url' => '',
        'data'=>array(
            'first'=>array(
                'value' => $first
            ),
            'orderMoneySum' => array(
                'value' => $orderMoneySum
            ),
            'orderProductName' => array(
                'value' => $orderProductName
            ),
            'Remark'=>array(
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
