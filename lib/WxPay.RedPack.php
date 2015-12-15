<?php
/**
 * 2015-12-15 微信红包接口
 */
require_once "WxPay.Data.php";

/**
 *
 * 微信红包输入对象
 * @author kangyu 
 */

class WxPayRedPack extends WxPayDataBase {
	/**
	* 设置随机字符串，不长于32位。推荐随机数生成算法
	* @param string $value 
	**/
	public function SetNonce_str($value)
	{
		$this->values['nonce_str'] = $value;
	}
	/**
	* 获取随机字符串，不长于32位。推荐随机数生成算法的值
	* @return 值
	**/
	public function GetNonce_str()
	{
		return $this->values['nonce_str'];
	}
	/**
	* 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
	* @return true 或 false
	**/
	public function IsNonce_strSet()
	{
		return array_key_exists('nonce_str', $this->values);
	}

	/**
	* 设置商户系统内部的订单号mch_billno
	* 商户订单号（每个订单号必须唯一）
	* 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。
	* 接口根据商户订单号支持重入，如出现超时可再调用。
	* @param string $value 
	**/
	public function SetMch_billno($value)
	{
		$this->values['mch_billno'] = $value;
	}
	/**
	* 获取商户系统内部的订单号mch_billno
	* @return 值
	**/
	public function GetMch_billno()
	{
		return $this->values['mch_billno'];
	}
	/**
	* 判断商户系统内部的订单号mch_billno
	* @return true 或 false
	**/
	public function IsMch_billnoSet()
	{
		return array_key_exists('mch_billno', $this->values);
	}

	/**
	* 设置微信分配的商户号
	* @param string $value 
	**/
	public function SetMch_id($value)
	{
		$this->values['mch_id'] = $value;
	}
	/**
	* 获取微信分配的商户号的值
	* @return 值
	**/
	public function GetMch_id()
	{
		return $this->values['mch_id'];
	}
	/**
	* 判断微信分配的商户号是否存在
	* @return true 或 false
	**/
	public function IsMch_idSet()
	{
		return array_key_exists('mch_id', $this->values);
	}

	/**
	* 设置微信分配的公众账号ID
	* @param string $value 
	**/
	public function SetWxappid($value)
	{
		$this->values['wxappid'] = $value;
	}
	/**
	* 获取微信分配的公众账号ID的值
	* @return 值
	**/
	public function GetWxappid()
	{
		return $this->values['wxappid'];
	}
	/**
	* 判断微信分配的公众账号ID是否存在
	* @return true 或 false
	**/
	public function IsWxappidSet()
	{
		return array_key_exists('wxappid', $this->values);
	}

	/**
	* 设置商户名称
	* 红包发送者名称
	* @param string $value 
	**/
	public function SetSend_name($value)
	{
		$this->values['send_name'] = $value;
	}
	/**
	* 获取商户名称的值 少于32字符
	* @return 值
	**/
	public function GetSend_name()
	{
		return $this->values['send_name'];
	}
	/**
	* 判断商户名称是否存在
	* @return true 或 false
	**/
	public function IsSend_nameSet()
	{
		return array_key_exists('send_name', $this->values);
	}

	/**
	* 设置用户openid，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的openid。 
	* @param string $value 
	**/
	public function SetRe_openid($value)
	{
		$this->values['re_openid'] = $value;
	}
	/**
	* 获取用户openid，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的openid。 的值
	* @return 值
	**/
	public function GetRe_openid()
	{
		return $this->values['re_openid'];
	}
	/**
	* 判断用户openid，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的openid。 是否存在
	* @return true 或 false
	**/
	public function IsRe_openidSet()
	{
		return array_key_exists('re_openid', $this->values);
	}

	/**
	* 设置付款金额
	* 红包付款金额，单位为分
	* @param int $value 
	**/
	public function SetTotal_amount($value)
	{
		$this->values['total_amount'] = $value;
	}
	/**
	* 获取付款金额的值
	* @return 值
	**/
	public function GetTotal_amount()
	{
		return $this->values['total_amount'];
	}
	/**
	* 判断付款金额是否存在
	* @return true 或 false
	**/
	public function IsTotal_amountSet()
	{
		return array_key_exists('total_amount', $this->values);
	}

	/**
	* 设置红包发放总人数
	* 默认为1
	* @param int $value 
	**/
	public function SetTotal_num($value = 1)
	{
		$this->values['total_num'] = $value;
	}
	/**
	* 获取红包发放总人数的值
	* @return 值
	**/
	public function GetTotal_num()
	{
		return $this->values['total_num'];
	}
	/**
	* 判断红包发放总人数是否存在
	* @return true 或 false
	**/
	public function IsTotal_numSet()
	{
		return array_key_exists('total_num', $this->values);
	}

	/**
	* 设置红包祝福语
	* @param int $value 
	**/
	public function SetWishing($value)
	{
		$this->values['wishing'] = $value;
	}
	/**
	* 获取红包祝福语的值
	* @return 值
	**/
	public function GetWishing()
	{
		return $this->values['wishing'];
	}
	/**
	* 判断红包祝福语是否存在
	* @return true 或 false
	**/
	public function IsWishingSet()
	{
		return array_key_exists('wishing', $this->values);
	}

	/**
	* 设置微信调用接口的机器Ip地址
	* @param string $value 
	**/
	public function SetClient_ip($value)
	{
		$this->values['client_ip'] = $value;
	}
	/**
	* 获取微信调用接口的机器Ip地址的值
	* @return 值
	**/
	public function GetClient_ip()
	{
		return $this->values['client_ip'];
	}
	/**
	* 判断微信调用接口的机器Ip地址是否存在
	* @return true 或 false
	**/
	public function IsClient_ipSet()
	{
		return array_key_exists('client_ip', $this->values);
	}

	/**
	* 设置活动名称 少于32字符
	* @param int $value 
	**/
	public function SetAct_name($value)
	{
		$this->values['act_name'] = $value;
	}
	/**
	* 获取活动名称的值
	* @return 值
	**/
	public function GetAct_name()
	{
		return $this->values['act_name'];
	}
	/**
	* 判断活动名称是否存在
	* @return true 或 false
	**/
	public function IsAct_nameSet()
	{
		return array_key_exists('act_name', $this->values);
	}

	/**
	* 设置备注
	* @param int $value 
	**/
	public function SetRemark($value)
	{
		$this->values['remark'] = $value;
	}
	/**
	* 获取备注的值
	* @return 值
	**/
	public function GetRemark()
	{
		return $this->values['remark'];
	}
	/**
	* 判断备注是否存在
	* @return true 或 false
	**/
	public function IsRemarkSet()
	{
		return array_key_exists('remark', $this->values);
	}
}