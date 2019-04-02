<?php 

require 'db2.php';
require 'qrcode.create.php';
require 'create.tenderimage.php';
require 'create.orderqrcodeimage.php';
require 'create.oneqrcodeimage.php';
require '../wechat/wechat.class.php';
require '../wechat/message.audit1.php';
require 'Curl.class.php';

$db = new db();


$phone = $_POST['phone'];
$address = $_POST['address'];
$ordername = $_POST['ordername'];
$data = $_POST['data'];
$datas = json_decode($data,true);


$sql = 'select userid,wechatid,accesstime from user where phone=?';
$userinfo = $db->prepare_query($sql,array($phone))[0];
$userid = $userinfo['userid'];

$attribute = ['trunk_diameter','ground_diameter','pot_diameter','plant_height','crown','branch_number','bough_number','age','branch_length','bough_length','branch_point_height','substrate','name','count','mark'];

if($datas){
    
    $expiration_date = date("Y-m-d",strtotime("$date1 +30 day"));
    $sql = 'insert into tree_order_index(userid,ordername,state,review_state,tendering,expiration_date,address) values(?,?,1,1,1,?,?)';
    $orderid = $db->prepare_insert($sql,array($userid,$ordername,$expiration_date,$address));

    $dictionary = $db->query('select * from dictionary_attribute order by CONVERT(name USING gbk)');

    for ($i=0; $i < count($datas); $i++) { 
        $keydatas = array();
        $nkeydatas = array();
        $valuedatas = array();
        foreach ($datas[$i] as $key => $value) {
            if($key == 'name'){
                for ($m=0; $m < count($dictionary); $m++) { 
                    if($dictionary[$m]['name'] == $value){
                        array_push($keydatas, 'type');
                        array_push($nkeydatas, '?');
                        array_push($valuedatas, $dictionary[$m]['type']);
                        array_push($keydatas, 'typename');
                        array_push($nkeydatas, '?');
                        array_push($valuedatas, $dictionary[$m]['typename']);
                        if(!$datas[$i]['unit']){
                            array_push($keydatas, 'unit');
                            array_push($nkeydatas, '?');
                            array_push($valuedatas, $dictionary[$m]['unit']);                            
                        }else{
                            array_push($keydatas, 'unit');
                            array_push($nkeydatas, '?');
                            array_push($valuedatas, $datas[$i]['unit']); 
                        }
                    }
                }
                if(!in_array("type", $keydatas)){
                    array_push($keydatas, 'type');
                    array_push($nkeydatas, '?');
                    array_push($valuedatas, 11);
                    array_push($keydatas, 'typename');
                    array_push($nkeydatas, '?');
                    array_push($valuedatas, '无');
                    if(!$datas[$i]['unit']){
                        array_push($keydatas, 'unit');
                        array_push($nkeydatas, '?');
                        array_push($valuedatas, '株');                            
                    }else{
                        array_push($keydatas, 'unit');
                        array_push($nkeydatas, '?');
                        array_push($valuedatas, $datas[$i]['unit']); 
                    }
                }
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                array_push($valuedatas, $value);
            }elseif($key == 'count'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                array_push($valuedatas, (int)$value);
            }elseif($key == 'mark'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                array_push($valuedatas, $value);
            }elseif($key == 'trunk_diameter'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                $valuearr = explode('-', $value);
                for ($k=0; $k < count($valuearr); $k++) { 
                    $valuearr[$k] = floatval($valuearr[$k]);
                }
                $values = implode(',', $valuearr);
                array_push($valuedatas, $values);
            }elseif($key == 'ground_diameter'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                $valuearr = explode('-', $value);
                for ($k=0; $k < count($valuearr); $k++) { 
                    $valuearr[$k] = floatval($valuearr[$k]);
                }
                $values = implode(',', $valuearr);
                array_push($valuedatas, $values);
            }elseif($key == 'pot_diameter'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                $valuearr = explode('-', $value);
                for ($k=0; $k < count($valuearr); $k++) { 
                    $valuearr[$k] = floatval($valuearr[$k]);
                }
                $values = implode(',', $valuearr);
                array_push($valuedatas, $values);
            }elseif($key != 'unit'){
                array_push($keydatas, $key);
                array_push($nkeydatas, '?');
                $valuearr = explode('-', $value);
                for ($k=0; $k < count($valuearr); $k++) { 
                    $valuearr[$k] = floatval($valuearr[$k]);
                    if($valuearr[$k] > 15){
                        $valuearr[$k] = $valuearr[$k]/100;
                    }
                }
                $values = implode(',', $valuearr);
                array_push($valuedatas, $values);
            }
        }
        array_push($keydatas, 'orderid');
        array_push($nkeydatas, '?');
        array_push($valuedatas, (int)$orderid);

        array_push($keydatas, 'userid');
        array_push($nkeydatas, '?');
        array_push($valuedatas, $userid);

        array_push($keydatas, 'id');
        array_push($nkeydatas, '?');
        $values = date("YmdHis",time()).($i+100);
        array_push($valuedatas, $values);

        $sql = 'insert into tree_order('.join(',',$keydatas).') values('.join(',',$nkeydatas).')';

        $result = $db->prepare_exec($sql,$valuedatas);
    }

    $wechatid = $userinfo['wechatid'];
    $weObj = new Wechat();

    if(count($datas) == 1){
        $name = Createoneimage::create($orderid);
    }else{
        $name = Createimage::create($orderid);
    }

    $qrcodeid = $name;
    $qrcodeimg = QRcodeCreate::permission($qrcodeid);
    imagejpeg($qrcodeimg, '../permissionqrcode/'.$qrcodeid.'.jpg');

    $accesstime = strtotime($userinfo['accesstime']);
    $nowtime = time();

    $oldtonow = $nowtime - $accesstime;

    $names = $name.'.jpg';
    $data = array('media'=>'@../tenderimage/'.$names);

    $url = geturl($weObj);

    $res = post($url,$data);

    $arr = json_decode($res,true);
    $media_id = $arr['media_id'];

    $sql = 'update tree_order_index set media_id=? where id=?';
    $result = $db->prepare_exec($sql,array($media_id,$orderid));

    if($oldtonow >= 48*60*60){
        $title = '审核信息';
        $remark = '找树网';
        $url = 'qrcodeimage.html?image='.$name;
        $keyword = '您的清单开始招标了,点击获取招标图片!';
        sendMessage($wechatid , $title, $keyword, $remark, $url,$weObj);
    }else{
        sendImage($wechatid, $media_id,$weObj);
    }

}

unset($db);
echo $result;
