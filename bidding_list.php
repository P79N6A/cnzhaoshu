<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/28
 * Time: 11:22
 * 投标大厅页面
 */
if($_SERVER['HTTP_HOST']=="test.cnzhaoshu.com"){
    header('Access-Control-Allow-Origin:*');
}
$user = json_decode($_COOKIE['user2'], true);

$user = isset($user['userid']) ? $user['userid'] : "";
//前台请求的页码
$page = isset($_POST['p']) ? $_POST['p'] : 1;
//树木id 返回一条数据
$tree_order_id = isset($_POST['tree_order_id']) ? $_POST['tree_order_id'] : "";
//传过来的项目id 返回多条
$project = isset($_POST['project']) ? $_POST['project'] : "";
//搜索条件返回 多条   条件
$address = isset($_POST['address']) ? $_POST['address'] : "";
//根据名称 返回多条   条件  条件可以拼写  原生分页
$tree_name = isset($_POST['name']) ? $_POST['name'] : "";
//根据传过来的苗木名称
$nursery_info = isset($_POST['nursery_info']) ? $_POST['nursery_info'] : "";

$project_id=isset($_GET['project_id'])?$_GET['project_id']:"";
bidding_search($page, $tree_order_id, $project, $address, $tree_name, $user, $nursery_info,$project_id);

function bidding_search($page = "", $tree_order_id = "", $project = "", $address = "", $tree_name = "", $user = "", $nursery_info = "",$project_id="")
{

    include "../com/db.php";

    $db = new db();
    //每页显示条数
    $page_num = 7;
    //计算当前总条数
    $where = '';

    if (!empty($tree_order_id)) {

        $where .= " and tree_order_id='" . $tree_order_id . "'";

    }

    if (!empty($project)) {

        $where .= " and project='" . $project . "'";

    }

    if(!empty($project_id)){

        $where .= " and project='" . $project_id . "'";

    }
    if (!empty($tree_name)) {

        if (is_array($tree_name)) {


            for ($i = 0; $i < count($tree_name); $i++) {

                $where .= " or tree_name like '" . '%' . $tree_name[$i] . '%' . "'";

            }

        } else {

            $where .= " and tree_name like '" . '%' . $tree_name . '%' . "'";

        }

    }
    if (!empty($address[0])) {
//            echo  1;die;
        if (is_array($address)) {

            for ($i = 0; $i < count($address); $i++) {

                if ($address[$i] == "北京" || $address[$i] == "天津") {

                    $address[$i] = $address[$i] . '_';

                    if (count($address) > 1) {

                        if ($i == 0) {

                            $where .= " and  ( hcity like'" . $address[$i] . "'";

                        } else {

                            $where .= " or hcity like'" . $address[$i] . "' ";

                        }

                    } else {

                        $where .= "  and hcity like'" . $address[$i] . "'";

                    }
                } else {
                    if (count($address) > 1) {
                        if($i == 0){
                            $where.= " and  (hcity like'" . $address[$i] . "'";
                        }else{
                            $where .= " or  hcity like'" . $address[$i] . "'";
                        }

                    } else {

                        $where .= "  and hcity like'" . $address[$i] . "'";

                    }
                }

            }

        } else if ($address == "北京" || $address == "天津") {

            $address = $address . '市';

            $where .= " and hcity like'" . $address . "'";

        } else {

            $where .= " and hcity like'" . $address . "'";

        }

    }
    //截掉第一个

//

    if (empty($nursery_info)) {

        if ($where != "") {

            $where = "status = 2 " . "  " . $where;

        } else {

            $where = "status = 2";

        }
        if (count($address) > 1) {
            $where .= ")";
        }


        $sql = "select  count(tree_order_id) as num from new_tree_order  where  $where and tree_order_id not in (select tender_tree_id from tender_order where tender_user_id = '" . $user . "') ";
//       var_dump($sql);die;
        $total = $db->query($sql)[0];
        $total_page = ceil($total['num'] / $page_num);

        $start = ($page - 1) * $page_num;

        $sqli = "select * from new_tree_order where $where and tree_order_id not in (select tender_tree_id from tender_order where tender_user_id = '" . $user . "') order by Up_time desc limit $start,$page_num  ";

        $result = $db->query($sqli);

    } else {
        //第二
        $e = 0;
        $u = 0;
        $count_nursery_info = count($nursery_info);

        for ($w = 0; $w < $count_nursery_info; $w++) {

            $where = "";

            $plant_height[] = $nursery_info[$w]['height'];

            if (!empty($plant_height[$w])) {

                if (strpos($plant_height[$w], "-")) {

                    $plant_max[] = strtok($plant_height[$w], '-');

                    $plant_min[] = substr($plant_height[$w], strripos($plant_height[$w], "-") + 1);

                } else {

                    $plant_max[] = $plant_height[$w];

                    $plant_min[] = $plant_height[$w];

                }

                $where .= " and plant_height between " . ($plant_min[$w] - 0.5) . " and  " . ($plant_max[$w] + 0.5) . " ";

            } else {

                $where .= "";

            }

            $crown[] = $nursery_info[$w]['crownwidth'];

            if (!empty($crown[$w])) {

                if (strpos($crown[$w], "-")) {

                    $crown_max[] = strtok($crown[$w], '-') ? 0 : strtok($crown[$w], '-');

                    $crown_min[] = substr($crown[$w], strripos($crown[$w], "-") + 1);

                } else {

                    $crown_max[] = $crown[$w];

                    $crown_min[] = $crown[$w];

                }

                $where .= " and crown between " . ($crown_min[$w] - 0.5) . "   and  " . ($crown_max[$w] + 0.5) . " ";

            } else {

                $where .= "";

            }

            $dbh[] = $nursery_info[$w]['dbh'];
            if (!empty($dbh[$w])) {

                if (strpos($dbh[$w], "-")) {

                    $dbh_max[] = strtok($dbh[$w], '-') ? 0 : strtok($dbh[$w], '-');

                    $dbh_min[] = substr($dbh[$w], strripos($dbh[$w], "-") + 1);

                } else {

                    $dbh_max[] = $dbh[$w];

                    $dbh_min[] = $dbh[$w];

                }

                $where .= " and dbh between " . ($dbh_min[$w] - 0.5) . "   and  " . ($dbh_max[$w] + 0.5) . " ";

            } else {

                $where .= "";

            }

            if (!empty($nursery_info['0']['name'])) {

                $where .= " and tree_name ='" . $nursery_info[$w]['name'] . "'";
            } else {
                $where .= "";
            }

            if (!empty($address[0])) {
//            echo  1;die;
                if (is_array($address)) {

                    for ($f = 0; $f < count($address); $f++) {
//                        var_dump(count($address));die;
                        if ($address[$f] == "北京" || $address[$f] == "天津") {

                            $address[$f] = $address[$f] . '_';

                            if (count($address) > 1) {

                                if ($f == 0) {

                                    $where .= " and  ( hcity like'" . $address[$f] . "'";

                                } else {

                                    $where .= " or hcity like'" . $address[$f] . "' ";

                                }

                            } else {

                                $where .= "  and hcity like'" . $address[$f] . "'";

                            }
                        } else {
                            if (count($address) > 1) {

                                if ($f == 0) {

                                    $where .= " and  ( hcity like'" . $address[$f] . "'";

                                } else {

                                    $where .= " or hcity like'" . $address[$f] . "' ";

                                }

                            } else {

                                $where .= "  and hcity like'" . $address[$f] . "'";

                            }
                        }

                    }

                } else if ($address == "北京" || $address == "天津") {

                    $address = $address . '市';

                    $where .= " and hcity like'" . $address . "'";

                } else {

                    $where .= " and hcity like'" . $address . "'";

                }

            }
            if (count($address) > 1) {
                $where .= ")";
            }

            if ($where != "") {

                $where = "status = 2 " . "  " . $where;

            } else {

                $where = "status = 2";

            }

            $sql = "select  count(tree_order_id) as num from new_tree_order  where $where and tree_order_id not in (select tender_tree_id from tender_order where tender_user_id = '" . $user . "') ";
//            var_dump($sql);die;
            $total = $db->query($sql)[0];
            $total_page = ceil($total['num'] / $page_num);
            $res[] = $db->query($sql)['0'];

            $start = ($page - 1) * $page_num;

            $sqli = "select * from new_tree_order where $where and tree_order_id not in (select tender_tree_id from tender_order where tender_user_id = '" . $user . "') order by Up_time desc limit $start,$page_num  ";

            $result[] = $db->query($sqli);

            if (empty($result[$w])) {

                unset($result[$w]);

            }

        }

        foreach ($res as $k => $v) {

            foreach ($v as $key => $val) {

                $info[$e] = $val;

                $e++;

            }
        }


        $result = array_merge($result);
        foreach ($result as $k => $v) {

            foreach ($v as $key => $val) {
                $result[$u] = $val;
                $u++;
            }
        }

    }

    for ($i = 0; $i < count($result); $i++) {

        $sqll = "select * from order_project where project_id='" . $result[$i]['project'] . "'";

        $sqls = "select partya_company_name from order_project where project_id='" . $result[$i]['project'] . "' ";

        $contract_info=$db->query($sqls)[0]['partya_company_name'];

//        var_dump($contract_info);
        $result[$i]['contract'] = $contract_info;
//        var_dump($contract_info[$i]['partya_company_name']);
        $sqle = "select  tel,contacts from contract_info where company_name='" .$contract_info . "'";
//        var_dump($sqle);
        $sqle_data = $db->query($sqle)[0];

        $result[$i]['tel'] = $sqle_data['tel'];

        $result[$i]['contacts'] = $sqle_data['contacts'];

        $result[$i]['project_info'] = $db->query($sqll)[0];

    }
//die;
//    var_dump($result);die;
    $subscribe_sql = "select get_msg from user where userid='" . $user . "'";

    $subscribe = $db->query($subscribe_sql)[0]['get_msg'];
//    var_dump(1);die;
    if (empty($result)) {

        $result = [];

    }

    $content = [

        'status' => 0,

        'data' => $result,

        'subscribe' => $subscribe,

        'p'=>$page,

        'total_page'=>$total_page

    ];
//    var_dump($content);die;
    echo json_encode($content);

}


