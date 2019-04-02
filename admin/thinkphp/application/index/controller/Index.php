<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller{
    public function index()
    {
           var_dump($_SERVER);
    }
    public function ccc(){
        echo 1;
    }
}
