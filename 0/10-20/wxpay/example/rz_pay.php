<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

require '../../com/db2.php';
require '../../com/user2.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{	
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);

		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{	
			// 商户订单号
			$out_trade_no = $result['out_trade_no'];
			// 微信支付订单号
			$transaction_id = $result['transaction_id'];
			// 订单金额
			$money = $result['total_fee']; 
			// 付款时间
			$time = $result['time_end'];
			$way = substr($out_trade_no,14,1);
			$userid = substr($out_trade_no,15);
			$db = new db();

			if($way == 1){
				$name = '开通认证店';
				$way = 3;
			}else{
				$name = '开通旗舰店';
				$way = 4;
			}

			$time = date('Y-m-d H:i:s',time());

			$sql = 'update user set isrenzheng = ?,rz_time=? where userid = ?';
			$result = $db->prepare_exec($sql,array($way,$time,$userid));

			$sql = 'insert into recharge_bill(userid,money,way) values(?,?,5)';
			$result = $db->prepare_exec($sql,array($userid,$money));

			$user = user::getUserByUserId($userid);

			$weObj = new Wechat();
			$first = '已收到您的付款，开始审核，请耐心等待: )';
			
			$money = $money/100;
			$remark = '欢迎加入找树网';
			$url = '';
			sendonetreepay($user['wechatid'], $first, $money, $name, $remark, $url, $weObj);

			$user1 = user::getUserByUserId(1);
			$first = '有用户申请认证请及时处理';
			$money = $money/100;
			$remark = '---找树网';
			$url = './certification.php';
			sendonetreepay($user1['wechatid'], $first, $money, $name, $remark, $url, $weObj);

			unset($weObj);
			unset($db);
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{	
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		$result = $this->Queryorder($data["transaction_id"]);
		if(!$result){
			$msg = "订单查询失败";
			return false;
		}

		return true;

	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);

