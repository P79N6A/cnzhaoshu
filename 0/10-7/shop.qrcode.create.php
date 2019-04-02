<?php
// 创建旗舰店二维码
require 'checkhost.php';
require 'shop.qrcode.php';

$shopid = $_GET['shopid'];
if ($shopid) {
  $shopQrcode = new ShopQrcode();
  $shopQrcode->create($shopid);
  unset($shopQrcode);
}