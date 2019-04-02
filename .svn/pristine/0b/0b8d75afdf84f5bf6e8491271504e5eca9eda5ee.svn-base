<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

require '../../com/db2.php';

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

			$userid = substr($out_trade_no,14);
			$db = new db();

			if($money == 500){
				$gift = 100;
			}elseif($money == 1000){
				$gift = 200;
			}elseif($money == 2000){
				$gift = 500;
			}elseif($money == 5000){
				$gift = 2000;
			}elseif($money == 10000){
				$gift = 5000;
			}elseif($money == 20000){
				$gift = 15000;
			}

			$sql = 'select virtual_money,real_money from user where userid=?';
			$data = $db->prepare_query($sql,array($userid));

			$dianmi = ceil($money/100);

			$sql = 'update user set dianmi=dianmi+?,accumulate=accumulate+?,quarter=quarter+?,month=month+? where userid=?';
			$result = $db->prepare_exec( $sql, array($dianmi,$dianmi,$dianmi,$dianmi,$userid));

			$virtual_money = $gift + $data[0]['virtual_money'];
			$real_money = $money + $data[0]['real_money'];

			$sql = 'update user set virtual_money=? , real_money=? where userid=?';
			$result = $db->prepare_exec($sql,array($virtual_money,$real_money,$userid));

			$sql = 'insert into recharge_bill(userid,money) values(?,?)';
			$date = $db->prepare_insert($sql,array($userid,$money));

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

