<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/7
 * Time: 15:16
 */
$first_user_phone=$_POST['first_user_phone'];

search_user($first_user_phone);

function search_user($first_user_phone='',$second_user_phone=''){

    include "../com/db.php";

        if($first_user_phone==''&& $second_user_phone==''){

           echo 1;

        }else if($first_user_phone==''){

            $where="phone =$second_user_phone";

        }else{

            $where="phone =$first_user_phone";

        }

        $db=new db();

        $sql="select userid from user where ".$where;
//        var_dump($sql);
        $userid=$db->query($sql);

        $userid=$userid['0']['userid'];

        $sqli="select a.shopname  from user as a ,user_bank as b where a.userid=b.userid and a.userid=$userid";

        $result=$db->query($sqli);

         echo json_encode($result);
}