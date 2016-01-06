<?php
/**
 * 2015-12-15 微信红包测试例子
 * @author  kangyu
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


$input = new WxPayRedPack();//创建微信红包输入对象
$input->SetRe_openid($openid);//设置openid
$input->SetTotal_num();//设置默认total_num=1
$input->SetAct_name($act_name);//设置活动名称
$input->SetWishing($wishing);//设置祝福语
$input->SetSend_name($send_name);//设置活动方名称
$input->SetRemark($remark);//设置备注
$input->SetTotal_amount($money);//设置发送红包钱数，单位分

$result = WxPayRedPackApi::sendRedpack($input);//请求微信服务器发送红包，并获得返回结果

var_dump($result);
