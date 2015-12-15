<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
require_once "./lib/WxPay.Promotion.php";
require_once "./lib/WxPay.Promotion.Api.php";

$openid = 'o9WpmxEqZMZNtjHEoN8vuuFHb12I';//kangyu

$input = new WxPayPromotion();
$input->SetOpenid($openid);
$input->SetCheck_name();
$money = 1.62;//单位：元
$input->SetAmount($money*100);
$input->SetDesc('微信支付开发测试');
$result = WxPayPromotionApi::promotionTransfers($input);
var_dump($result);
