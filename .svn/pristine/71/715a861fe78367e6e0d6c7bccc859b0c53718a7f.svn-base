<?php
//获取的内容消息
$arr=json_decode($_GET['arr'],true);
$title=json_decode($_GET['title'],true);
$field=json_decode($_GET['field'],true);
$filepath=$_GET['filepath'];
//var_dump($_GET['filepath']);die;
//var_dump($_GET['info']);die;
//$info=json_decode($_GET['info'],true);
//var_dump($info);die;
$info=$_GET['info'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <title>苗店设置-采购录入</title>
</head>
<body>
<form action="./excelinfo.php" method="post">
    <h1>采购信息</h1>
    <h2>项目名称：<input type="text" name="project" value="<?=$title?>" ></h2>
    <input type="hidden" name="filepath" value='<?php echo $filepath?>'>
    <table border="1">
        <?php foreach ($field as $k=>$v) {?>
            <th><?=$v?></th>
        <?php }?>
        <?php foreach ($arr as $key => $value){?>
        <tr>
            <?php ?>
            <td><input type="text" value="<?php echo $value[0]?>" name="number[]"></td>
            <td><input type="text" value="<?php echo $value[1]?>" name="tree_name[]"></td>
            <td><input type="text" value="<?php echo $value[2]?>" name="plant_height[]"></td>
            <td><input type="text" value="<?php echo $value[3]?>" name="dbh[]"></td>
            <td><input type="text" value="<?php echo $value[4]?>" name="diameter[]"></td>
            <td><input type="text" value="<?php echo $value[5]?>" name="crown[]"></td>
            <td><input type="text" value="<?php echo $value[6]?>" name="remarks[]"></td>
            <td><input type="text" value="<?php echo $value[7]?>" name="company[]"></td>
            <td><input type="text" value="<?php echo $value[8]?>" name="num[]"></td>
            <td><input type="text" value="<?php echo $value[9]?>" name="price[]"></td>
        </tr>
        <?php }?>
        <input type="hidden" value='<?php echo $info?>' name="info">
    </table>
    <input type="submit" value="提交">
</form>
</body>

</html>