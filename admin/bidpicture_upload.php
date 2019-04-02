<?php

require "./supervise/public_function.php";

Access_Header();

$upFile =$_FILES['img'];

$path = uploadFile($upFile);

$content = [

    'status' => 1,

    'data'=>$path['dest'],    //图片路径

    'msg' =>$path['mes'],

];

exit(json_encode($content,JSON_UNESCAPED_UNICODE));

/**
 * 创建文件夹函数,用于创建保存文件的文件夹
 * @param str $dirPath 文件夹名称
 * @return str $dirPath 文件夹名称
 * 投标大厅图片上传
 */
//function creaDir($dirPath){
//
//    $curPath = dirname(__FILE__);
//
//    $path = $curPath.'\\'.$dirPath;
//
//    if (is_dir($path) || mkdir($path,0777,true)) {
//
//        return $dirPath;
//
//    }
//
//}
//
////判断文件是否为空或者出错
//if ($upFile['error']==0 && !empty($upFile)) {
//
//    $dirpath = creaDir('upload');
//
//    $filename = $upFile['name'];
////检测上传文件的文件类型
////    var_dump($filename);die;
//    if($filename == "blob"){
//        $ext = "jpg";
//    }else{
//        $ext=getExt($upFile['name']);//得到上传文件的后缀
//    }
////    var_dump($ext);die;
//    // 获取唯一文件名
//    $uniName=getUniName();
//    // 拼接移动的路径
//    $destination='/admin/'.$dirpath.'/'.$uniName.'.'.$ext;
//
//    if(move_uploaded_file($upFile['tmp_name'],$destination)){
////		    echo 1;die;
//
//    }
//}

?>