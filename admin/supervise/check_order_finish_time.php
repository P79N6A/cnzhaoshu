<?php
/**
 * @Author: anchen
 * @Date:   2018-12-04 13:56:42
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 09:42:12
 * 判断所有项目的截止时间，如果到了截止时间更改状态并给所有投标的用户发送消息
 */
// $t1 = microtime(true);

require "../../com/db.php";
require "../define_attr/Define_tree_state.php";
include "./Loginterface.php";
include "./public_function.php";
Access_Header(); // header头信息
$db = new db();
Loginterface::start( 'finishorder' ); //开启日志

$tree_atate = new Define_tree_state();
// 查找所有项目
$sql = "select
project_id,project_name,partya_company_name,partyb_company_name,order_num,create_time
from order_project where state = 1 and status <>3";

$data = $db->query($sql);

// 设置当前时间
$current_time = time();

foreach ($data as $key => $val) {
    // 把添加时间转换成为一个月之后的时间戳
    $time = strtotime($val['create_time']);

    $finish_time =strtotime('+1 month',$time);
    // 循环判断，如果当前时间大于或者等于转换后的时间，则入一个新的数组
    if($current_time >= $finish_time ){

        $newdata[] = $val;
        // var_dump(date('Y-m-d H:i:s',$finish_time));
    }
}

//生成日志文件
$requestData = '项目结束时间：'.date('Y-m-d H:i:s').'  所有结束项目：'.json_encode($newdata);

Loginterface::add( $requestData);

Loginterface::end();

unset($data);

foreach ($newdata as $k => $v) {
    // 更改状态值
    $sql = "update order_project set state=2,status=3 where project_id=? ";
    $state = $db->prepare_exec($sql,array($v['project_id']));
    // 查找项目里所有的投标信息
    $new_sql = "select tender_order_id,tender_user_id,tender_status,remarks,adoption_status,provider_status,state from tender_order where project = '".$v['project_id']."'";

    $result = $db->query($new_sql);

    if($result){
        // 循环查出来的数组处理成一个数组
        foreach ($result as $j => $p) {
            $newresult[] = $p;
        }
    }

}

unset($newdata);
// 投标用户的状态处理
foreach ($newresult as $ke => $va) {
    // 判断投标的状态
    if($va['tender_status'] == 1){
        // 未审核
        $tender_order[$ke]['status'] = $tree_atate->order_state[0];

        $tender_order[$ke]['remarks'] = '';

        $tender_order[$ke]['content'] = '请不要气馁，或许还有更好的采购单在等着你';

    }elseif ($va['tender_status'] == 3) {
         //舍弃
        $tender_order[$ke]['status'] = $tree_atate->order_state[2];

        $tender_order[$ke]['remarks'] = $va['remarks'];

        $tender_order[$ke]['content'] = '请不要气馁，或许还有更好的采购单在等着你';

    }elseif ($va['tender_status'] == 2) {
        // 审核通过
        if($va['adoption_status'] == 0){
            // 甲方不采用
            $tender_order[$ke]['status'] = $tree_atate->order_state[4];

            $tender_order[$ke]['content'] = '请不要气馁，或许还有更好的采购单在等着你';

        }elseif ($va['adoption_status'] == 1) {
            // 甲方采用
            if($va['provider_status'] == 0){
                // 不是供应商
                $tender_order[$ke]['status'] = $tree_atate->order_state[6];

                $tender_order[$ke]['content'] = '请不要气馁，或许还有更好的采购单在等着你';

            }elseif ($va['provider_status'] == 1) {
                // 是供应商
                $tender_order[$ke]['status'] = $tree_atate->order_state[5];

                $tender_order[$ke]['content'] = '祝贺你成为供应商，希望合作愉快！！';
            }
        }
    }

    $tender_order[$ke]['tender_user_id'] = $va['tender_user_id'];

    $tender_order[$ke]['order_num'] = $v['order_num'];

    $tender_order[$ke]['project_name'] = $v['project_name'];
}

unset($tree_atate);
// 统计数组长度
$count = count($tender_order);
// 获取用户的wechatid，并推送模板
for ($i=0; $i < $count; $i++) {

    $final_sql = "select userid,wechatid from user where userid='".$tender_order[$i]['tender_user_id']."'";

    $wechatid = $db->query($final_sql)[0]['wechatid'];

    // 设置模板标题
    $first = '你好，你所投的'.$v['project_name'].'采购单已经截止';

    send_message_tender_result($wechatid,$first,$tender_order[$i]['order_num'],$tender_order[$i]['status'],$tender_order[$i]['content']);

}

unset($db);
unset($tender_order);
// $t2 = microtime(true);
// echo '耗时'.round($t2-$t1,3).'秒<br>';
// echo 'Now memory_get_usage: ' . memory_get_usage() . '<br />';

/**
 * 投标结束之后，向用户推送投标结果
 * @param  string $touser   用户的wechatid
 * @param  string $first    模板标题
 * @param  string $keyword1 项目编号
 * @param  string $keyword2 投标结果
 * @param  string $remark   备注
 * @return [type]           [description]
 */
function send_message_tender_result($touser="",$first="",$keyword1="",$keyword2="",$remark=""){
    include "../../wechat/wechat.class.php";
    $data = array( 'touser' => $touser,
        'template_id' => 'CrD5IRQ7dI6ZViIR6l-meCG3BLOQ_AAIPlnmJeh8du8',
        'url' => '',
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
            'remark'=>array(
                'value'=> $remark
            )
        )
    );

    $weObj = new Wechat();

    $weObj->sendTemplateMessage($data);

    unset($weObj);
}