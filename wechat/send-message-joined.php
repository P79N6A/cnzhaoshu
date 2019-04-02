<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/11/22
 * Time: 11:07
 * 合并店铺发送模板信息
 */

function send_message($touser="",$first="",$keyword1=""){
    require_once 'wechat.class.php';
    $data = array( 'touser' => $touser,
        'template_id' => 'bz2YWPbckV0_RvRYm6OSdMLVtANpi01-GuRgCeGg8E8',
        'url' => '#',
        'data'=>array(
            'first'=>array(
                'value' => $first
            ),
            'keyword1' => array(
                'value' => $keyword1
            ),
            'keyword2' => array(
                'value' => date('Y-m-d',time())
            ),
            'remark'=>array(
                'value'=> "找树网提供"
            )
        )
    );
//var_dump($data);
//    die;
    $weObj = new Wechat();

    echo $weObj->sendTemplateMessage($data);

    unset($weObj);
}




