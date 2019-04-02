<?php


$upFile =$_FILES['file'];

//var_dump($_FILES);die;
/**
 * 创建文件夹函数,用于创建保存文件的文件夹
 * @param str $dirPath 文件夹名称
 * @return str $dirPath 文件夹名称
 *  合同图集图片上传接口
 */
function creaDir($dirPath){

    $curPath = dirname(__FILE__);

    $path = $curPath.'\\'.$dirPath;

    if (is_dir($path) || mkdir($path,0777,true)) {
		
        return $dirPath;
		
    }
}

//判断文件是否为空或者出错
if ($upFile['error']==0 && !empty($upFile)) {
	
    $dirpath = creaDir('upload');
	
    $filename = $upFile['name'];
	
    $queryPath = './'.$dirpath.'/'.$filename;

    if(move_uploaded_file($upFile['tmp_name'],$queryPath)){
		
        $content=[
		
            'status'=>0,
			
            'data'=>$queryPath
			
        ];
		
        echo json_encode($content);
    }
}

?>