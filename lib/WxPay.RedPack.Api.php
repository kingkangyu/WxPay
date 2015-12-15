<?php
/**
 * 2015-12-15 红包类
 */
require_once "WxPay.Api.php";

/**
 * 微信支付红包类
 * @author kangyu
 */
class WxPayRedPackApi extends WxPayApi {
	/**
	 * [微信支付红包类]
	 * @param  WxPayRedPack  $inputObj [微信红包输入对象]
	 * @param  integer $timeOut  [description]
	 * @return [type]            [description]
	 */
	public static function sendRedpack($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
		//检测必填参数
		if(!$inputObj->IsRe_openidSet()){
			throw new WxPayException("缺少企业付款支付接口必填参数re_openid！");
		}else if(!$inputObj->IsTotal_amountSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数total_amount！");
		}else if(!$inputObj->IsTotal_numSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数total_num！");
		}else if(!$inputObj->IsSend_nameSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数send_name！");
		}else if(!$inputObj->IsWishingSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数wishing！");
		}else if(!$inputObj->IsAct_nameSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数act_name！");
		}else if(!$inputObj->IsRemarkSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数remark！");
		}
		
		//异步通知url未设置，则使用配置文件中的url
		// if(!$inputObj->IsNotify_urlSet()){
		// 	$inputObj->SetNotify_url(WxPayConfig::NOTIFY_URL);//异步通知url
		// }

		$inputObj->SetWxappid(WxPayConfig::APPID);//公众账号ID
		$inputObj->SetMch_id(WxPayConfig::MCHID);//商户号
		$inputObj->SetClient_ip($_SERVER['REMOTE_ADDR']);//终端ip	  
		//$inputObj->SetSpbill_create_ip("1.1.1.1");  	    
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串
		// $inputObj->SetPartner_trade_no(WxPayConfig::MCHID.date("YmdHis").mt_rand(1000,9999));//生成商户订单号
		$inputObj->SetMch_billno(WxPayConfig::MCHID.date("YmdHis").substr(microtime(), 2, 4));//生成商户订单号
		
		
		//签名，必须坐在所有待传参数都设置完毕才可以进行签名
		$inputObj->SetSign();
		$xml = $inputObj->ToXml();

		$response = self::postXmlCurl($xml, $url, true, $timeOut);
		// $result = WxPayResults::Init($response);
		// self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
		
		$result = $inputObj->FromXml($response);
		
		return $result;
	}
}