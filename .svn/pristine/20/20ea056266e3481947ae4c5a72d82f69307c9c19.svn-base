<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';
require_once '../../com/db2.php';
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
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}

		if ($data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS') {
			// 商户订单号
			$out_trade_no = $data['out_trade_no'];
			// 微信支付订单号
			$transaction_id = $data['transaction_id'];
			// 订单金额
			$money = $data['total_fee']; 
			// 付款时间
			$time = $data['time_end'];

			$way = substr($out_trade_no,0,1);

			$weObj = new Wechat();

			if($way == 'd'){
				// 付定金
				if(strlen($out_trade_no) == 26){
					$serial_number = substr($out_trade_no,1,25);
					// 查询次订单信息
					$sql = 'select * from orders where serial_number=?';
					$orderinfo = $db->prepare_query($sql,array($serial_number))[0];
					// 修改订单
					$sql = 'update orders set deposit=? , deposit_time=? , deposit_switch=1 , state=2 where serial_number=?';
					$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

					$sql = 'update bid_order set state=4 where id=? and userid=?';
					$result = $db->prepare_exec($sql,array($orderinfo['tree_order_id'],$orderinfo['bid_userid']));

					$sql = 'insert into recharge_bill(userid,money,way) values(?,?,?)';
					$result = $db->prepare_insert($sql,array($orderinfo['tender_userid'],$money,2));

					$user = user::getUserByUserId($orderinfo['bid_userid']);
					$title = '投标结果信息';
					$remark = '找树网';
					$url = './yusuanphone.php#bidhistory';
					$keyword1 = $orderinfo['tree_order_id'];
					$keyword2 = '买家已付定金'.($money/100).'元';
					sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);

				}else{
					$serial_number = substr($out_trade_no,1,24);
					// 查询次订单信息
					$sql = 'select * from order_one where serial_number=?';
					$orderinfo = $db->prepare_query($sql,array($serial_number))[0];

					$sql = 'update order_one set state=2,deposit=?,deposit_switch=1,deposit_time=? where serial_number=?';
					$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

					$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
					$result = $db->prepare_insert($sql,array($orderinfo['userid'],$money,2,$time));

					$userinfo = user::getUserByUserId($orderinfo['userid']);
					$username = $userinfo['name'];
					$user = user::getUserByUserId($orderinfo['treeuserid']);
					$title = $username.'已付定金！';
					$remark = '来自找树网';
					$url = './yusuanphone.php#managersell';
					sendonetreepay($user['wechatid'], $title, $money/100, $name, $remark, $url,$weObj);

				}
			}elseif($way == 'q'){
				// 付全款
				if(strlen($out_trade_no) == 26){
					$serial_number = substr($out_trade_no,1,25);
					// 查询次订单信息
					$sql = 'select * from orders where serial_number=?';
					$orderinfo = $db->prepare_query($sql,array($serial_number))[0];
					// 修改订单
					$sql = 'update orders set fullamount=? , fullamount_time=? , state=5 where serial_number=?';
					$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

					$sql = 'update bid_order set state=10 where id=? and userid=?';
					$result = $db->prepare_exec($sql,array($orderinfo['tree_order_id'],$orderinfo['bid_userid']));

					$sql = 'insert into recharge_bill(userid,money,way) values(?,?,?)';
					$result = $db->prepare_insert($sql,array($orderinfo['tender_userid'],$money,3));

					$user = user::getUserByUserId($orderinfo['bid_userid']);
					$title = '投标结果信息';
					$remark = '找树网';
					$url = './yusuanphone.php#bidhistory';
					$keyword1 = $orderinfo['tree_order_id'];
					$keyword2 = '买家已付全款'.($money/100).'元';
					sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);

				}else{
					$serial_number = substr($out_trade_no,1,24);
					// 查询次订单信息
					$sql = 'select * from order_one where serial_number=?';
					$orderinfo = $db->prepare_query($sql,array($serial_number))[0];

					$sql = 'update order_one set state=5,fullamount=?,fullamount_time=? where serial_number=?';
					$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

					$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
					$result = $db->prepare_insert($sql,array($orderinfo['userid'],$money,3,$time));

					$userinfo = user::getUserByUserId($orderinfo['userid']);
					$username = $userinfo['name'];
					$user = user::getUserByUserId($orderinfo['treeuserid']);
					$title = $username.'已付全款,希望您早日发货！';
					$remark = '来自找树网';
					$url = './yusuanphone.php#managersell';
					sendonetreepay($user['wechatid'], $title, $money/100, $name, $remark, $url,$weObj);
				}
			}else{
				// 充值
				$userid = substr($out_trade_no,14);

				switch ($money) {
					case 500:
						$gift = 100;
						return $gift;
						break;
					case 1000:
						$gift = 200;
						return $gift;
						break;
					case 2000:
						$gift = 500;
						return $gift;
						break;
					case 5000:
						$gift = 2000;
						return $gift;
						break;
					case 10000:
						$gift = 5000;
						return $gift;
						break;
					case 20000:
						$gift = 15000;
						return $gift;
						break;
					default:
						break;
				}

				$sql = 'select virtual_money,real_money from user where userid=?';
				$data = $db->prepare_query($sql,array($userid));

				$virtual_money = $gift + $data[0]['virtual_money'];
				$real_money = $money + $data[0]['real_money'];

				$sql = 'update user set virtual_money=? , real_money=? where userid=?';
				$result = $db->prepare_exec($sql,array($virtual_money,$real_money,$userid));

				$sql = 'insert into recharge_bill(userid,money) values(?,?)';
				$date = $db->prepare_insert($sql,array($userid,$money));
			}

		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
