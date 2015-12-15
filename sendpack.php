<?php
/**
 * 微信红包测试例子
 */
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
require_once "./lib/WxPay.RedPack.php";
require_once "./lib/WxPay.RedPack.Api.php";

$openid = 'o9WpmxEqZMZNtjHEoN8vuuFHb12I';//kangyu

$act_name = '活动名称';//活动名称，少于32字符
$wishing = '祝福语';//祝福语
$send_name = '活动方名称';//发放红包的活动方名称,少于32字符
$remark = '微信支付开发测试';//备注
// $money = 2.56;//单位：元
$money = mt_rand(100,500);//单位 分


$input = new WxPayRedPack();
$input->SetRe_openid($openid);
$input->SetTotal_num();
$input->SetAct_name($act_name);
$input->SetWishing($wishing);
$input->SetSend_name($send_name);
$input->SetRemark($remark);
$input->SetTotal_amount($money);

$result = WxPayRedPackApi::sendRedpack($input);
var_dump($result);
