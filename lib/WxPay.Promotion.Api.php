<?php
/**
 * 企业付款类
 */
require_once "WxPay.Api.php";

/**
 * 微信企业付款类
 * @author kangyu
 */
class WxPayPromotionApi extends WxPayApi {
	/**
	 * [微信企业支付]
	 * @param  WxPayPromotion  $inputObj [微信企业支付输入对象]
	 * @param  integer $timeOut  [description]
	 * @return [type]            [description]
	 */
	public static function promotionTransfers($inputObj, $timeOut = 6)
	{
		$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
		//检测必填参数
		if(!$inputObj->IsOpenidSet()){
			throw new WxPayException("缺少企业付款支付接口必填参数openid！");
		}else if(!$inputObj->IsAmountSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数amount！");
		}else if(!$inputObj->IsDescSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数desc！");
		}else if(!$inputObj->IsCheck_nameSet()) {
			throw new WxPayException("缺少企业付款支付接口必填参数check_name！");
		}
		
		//关联参数
		if(($inputObj->GetCheck_name() == "FORCE_CHECK" || $inputObj->GetCheck_name() == "OPTION_CHECK" )&& !$inputObj->IsRe_user_nameSet()) {
			throw new WxPayException("企业付款支付接口中，缺少必填参数re_user_name！check_name为FORCE_CHECK或OPTION_CHECK时，re_user_name为必填参数！");
		}
		
		//异步通知url未设置，则使用配置文件中的url
		// if(!$inputObj->IsNotify_urlSet()){
		// 	$inputObj->SetNotify_url(WxPayConfig::NOTIFY_URL);//异步通知url
		// }

		$inputObj->SetMch_appid(WxPayConfig::APPID);//公众账号ID
		$inputObj->SetMchid(WxPayConfig::MCHID);//商户号
		$inputObj->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);//终端ip	  
		//$inputObj->SetSpbill_create_ip("1.1.1.1");  	    
		$inputObj->SetNonce_str(self::getNonceStr());//随机字符串
		// $inputObj->SetPartner_trade_no(WxPayConfig::MCHID.date("YmdHis").mt_rand(1000,9999));//生成商户订单号
		$inputObj->SetPartner_trade_no(WxPayConfig::MCHID.date("YmdHis").substr(microtime(), 2, 4));//生成商户订单号
		
		
		//签名
		$inputObj->SetSign();
		$xml = $inputObj->ToXml();
		var_dump($xml);

		$response = self::postXmlCurl($xml, $url, true, $timeOut);
		// $result = WxPayResults::Init($response);
		// self::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
		
		$result = $inputObj->FromXml($response);

		return $result;
	}

	public static function curl_post_ssl($vars, $url, $second=30,$aHeader=array())
	{
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		
		//以下两种方式需选择一种
		
		// 第一种方法，cert 与 key 分别属于两个.pem文件
		// 默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT, getcwd().WxPayConfig::SSLCERT_PATH);
		// 默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY, getcwd().WxPayConfig::SSLKEY_PATH);
		
		//第二种方式，两个文件合成一个.pem文件
		// curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
	 
		if( count($aHeader) >= 1 ){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
	 
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		if($data){
			curl_close($ch);
			return $data;
		}
		else { 
			$error = curl_errno($ch);
			echo "call faild, errorCode:$error\n"; 
			curl_close($ch);
			return false;
		}
	}
}