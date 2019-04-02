<?php
/**
 * Created by PhpStorm.
 * User: Mrwang
 * Date: 2018/8/9
 * Time: 9:44
 */

class Define_tree_state
{
       public $tree_state=[
            "0"=>"未起树",
            "1"=>"起树",
            "2"=>"装车",
            "3"=>"发车",
            "4"=>"卸车",
            "5"=>"验收",
            "6"=>"未绑定",
        ];
        public $order_state=[
             "0"=>"未审核",
            "1"=>"审核通过",
            "2"=>"舍弃",
            "3"=>"采用",
            "4"=>"不采用",
            "5"=>"供应商",
            "6"=>"不是供应商",

        ];
}