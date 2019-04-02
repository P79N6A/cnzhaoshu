<?php
/**
 * @Author: lizhongyang
 * @Date:   2018-11-23 10:08:37
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-12-25 13:56:24
 * 首次绑定二维码接口
 */
require "../../com/db.php";
require "./public_function.php";
include "./Loginterface.php";
Access_Header(); // header头信息

$data = $_POST;

$qrcode = $data['qrcode'];

$tender_order_id = $data['tender_order_id'];
//生成日志文件
Loginterface::start( 'insert-qrcode' );

$requestData = date('Y-m-d H:i:s').':  '.json_encode($data);

Loginterface::add( $requestData);

unset($data);

if($qrcode && $tender_order_id){

    $db = new db();

    // 查找项目id，树id，用户id
    $sql="select project,tender_tree_id,tender_user_id from tender_order where tender_order_id = '".$tender_order_id."' and provider_status = 1";

    $data=$db->query($sql);

    $userid = $data[0]['tender_user_id'];
    // 创建时间
    $create_time = date('Y-m-d H:i:s');
    //查询投标树木规格
    $tree_info_sql = "select tree_name,plant_height,dbh,ground_diameter,crown,remarks,company,high_branch_point from new_tree_order where tree_order_id = ( select tender_tree_id from tender_order where tender_order_id=$tender_order_id)";

    $tree_info = $db->query($tree_info_sql)[0];

    $sql = 'select id,userid from maps where userid = ? and order_id = ?';

    $result = $db->prepare_query($sql,array($userid,$tender_order_id));

    if($result){
        // 如果有就曲里面的id
        $result = $result[0]['id'];
    }
    // 把树牌ID 循环输出到数组里面
    foreach ($qrcode as $key => $val) {
        // 检查二维码是否已经绑定过
        $sql = "select * from maps_order where qrcode = '".$val."'";
        $check = $db->query($sql);
        if($check){
            $uninsert[] = $val;
        }else{
            $newdata[$key]['userid']    = $userid;
            $newdata[$key]['map_id']    = $result;
            $newdata[$key]['qrcode']    = $val;
            $newdata[$key]['tree_name']    = $tree_info['tree_name'];
            $newdata[$key]['plant_height']    = $tree_info['plant_height'];
            $newdata[$key]['dbh']    = $tree_info['dbh'];
            $newdata[$key]['ground_diameter']    = $tree_info['ground_diameter'];
            $newdata[$key]['crown']    = $tree_info['crown'];
            $newdata[$key]['tree_attribute']    = $tree_info['remarks'];
            $newdata[$key]['company']    = $tree_info['company'];
            $newdata[$key]['high_branch_point']    = $tree_info['high_branch_point'];
            $newdata[$key]['time']    = date('Y-m-d H:i:s',time());

        }
    }
    // 统计重复的二维码
    $unsum = count($uninsert);

    if($newdata){
        // 需要添加的字段
        $fields = array('userid','map_id','qrcode','tree_name','plant_height','dbh','ground_diameter','crown','tree_attribute','company','high_branch_point','time');
        // 转化成一条添加sql语句
        $sql = warpSqlByData('maps_order',$newdata,$fields);
        //生成日志文件
        $requestData = date('Y-m-d H:i:s').':'.json_encode($sql);

        Loginterface::add( $requestData);

        $res = $db->insert($sql);

        unset($sql);

        if($res){
            // 添加完成之后，统计一共添加了多少二维码编号
            $sql = 'select count(id) from maps_order where map_id=?';

            $count = $db->prepare_query($sql,array($result));

            $content['status'] = 0;

            $content['msg'] = $count[0]['count(id)'];

            $content['unsum'] = $unsum;

            $content['uninsert'] = $uninsert;
            //生成日志文件
            $requestData = date('Y-m-d H:i:s').':'.json_encode($content);

            Loginterface::add( $requestData);

            Loginterface::end();

            echo json_encode($content);

        }else{
            $content['status'] = 1;

            $content['msg'] = '绑定失败,请重新绑定！';

            $content['unsum'] = $unsum;

            $content['uninsert'] = $uninsert;

            //生成日志文件
            $requestData = date('Y-m-d H:i:s').':'.json_encode($content);

            Loginterface::add( $requestData);

            Loginterface::end();

            echo json_encode($content);
        }
    }else{

        $content['status'] = 1;

        $content['msg'] = '树牌已经绑定';

        $content['unsum'] = $unsum;

        $content['uninsert'] = $uninsert;
        //生成日志文件
        $requestData = date('Y-m-d H:i:s').':'.json_encode($content);

        Loginterface::add( $requestData);

        Loginterface::end();

        echo json_encode($content);

    }

    unset($db);
}


