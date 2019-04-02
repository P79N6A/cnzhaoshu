<?php
/**
 * @Author: anchen
 * @Date:   2018-12-03 10:42:13
 * @Last Modified by: mikey.zhaopeng
 * @Last Modified time: 2019-03-15 14:33:25
 * 上传监管信息图片接口
 */

require "../../com/db.php";
require './public_function.php';
require './imgcompress.php';
Access_Header(); // header头信息
$user=json_decode($_COOKIE['user2'],true);

$userid=isset($user['userid'])?$user['userid']:"";

$upFile = $_FILES['photo'];
// var_dump($upFile);die;
// 调取文件上传函数
$path = uploadFile($upFile);

// 返回错误信息
if(!$path['dest']){

    $content=[

        'status'=>1,   //状态码

        'msg' =>$path['mes'],

        'userid' =>$userid

    ];

    echo json_encode($content);

}
$tmp_path = '../'.ltrim($path['dest'],"/admin");

delImgOrientation($tmp_path);
// 读取图片的exif 信息
$exif = exif_read_data($tmp_path, 0, true);
//压缩图片
$percent = 0.5;
(new imgcompress($tmp_path,$percent))->compressImg($tmp_path);

// 读取图片的GPS
if ($exif) {

    if ($exif['GPS'] &&  $exif['GPS']['GPSLatitude']) {

        include_once '../../com/record/photogps2.php';

        $gps = PhotoGPS::qqGps($exif['GPS']);
        // 如果没有获取到GPS
        if(!$gps){

            $gps = '';

        }

    }

} else{
    // 如果没有exif信息
    $gps = '';

}

$content=[

    'status'=>0,   //状态码

    'photo'=>$path['dest'],    //图片路径

    'msg' =>$path['mes'],

    'userid' =>$userid,

    'gps' =>$gps   // 图片的GPS

];

echo json_encode($content);

/**
 * 处理带有Orientation图片翻转信息的JPEG图片
 * param $imagePath 图片资源路径
 * param $dscPath 目标路径
 * 照片中EXIF Orientation 参数让你随便照像但都可以看到正确方向的照片而无需手动旋转（前提要图片浏览器支持，Windows 自带的不支持）
 *
 * */
function delImgOrientation($imagePath, $dscPath = null)
{
    /* exif_imagetype($imagePath)返回2为JPGE,为可能数码相机拍摄的照片
    ，可能包含Orientation信息， 先判断图片资源存在且为JPEG*/
    if (!file_exists($imagePath) || exif_imagetype($imagePath) != 2) {
        return false;
    }
    //$exifInfo['Orientation']值1为不旋转 3为旋转180度 6为顺时针90度 8为逆时针90度
    $exifInfo = @read_exif_data($imagePath, 'EXIF', 0);//获取图片的exif信息
    if ($exifInfo && in_array($exifInfo['Orientation'], array(3, 6, 8))) { //如果图片Orientation翻转，拷贝图像
        $size = getimagesize($imagePath);
        $weight = $size[0];
        $height = $size[1];
        $srcImg = @imagecreatefromjpeg($imagePath);//读取源图像
        $dscPath = isset($dscPath) ? $dscPath : $imagePath;//如未设置目标图片路径覆盖原图片

        switch ($exifInfo['Orientation']) {
            case 3:
                $img_rotate = imagerotate($srcImg, 180, 0);
                break;
            case 6:
                $img_rotate = imagerotate($srcImg, -90, 0);
                break;
            case 8:
                $img_rotate = imagerotate($srcImg, 90, 0);
                break;
        }
        if ($img_rotate) {
            imagejpeg($img_rotate, $dscPath, 80);
            isset($img_rotate) && imagedestroy($img_rotate);
            imagedestroy($imgsource);
        }
    }
}

