<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require '../../com/checkhost.php';
require '../../com/db2.php';
require '../../com/user2.php';
require '../../com/message_attribute.php';
require '../../wechat/message.audit1.php';
require '../../wechat/wechat.class.php';
require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';


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
			// 付款时间
			$time = $result['time_end'];

			$way = substr($out_trade_no,0,1);
			$db = new db();
			$weObj = new Wechat();
			$Messageattrbute = new Messageattrbute();
			if($way == 'd'){
				$serial_number = substr($out_trade_no,1,24);
				// 查询单品订单信息
				$sql = 'select a.treeuserid,a.userid buyuserid,a.number,b.* from (select * from order_one where serial_number=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
				$orderinfo = $db->prepare_query($sql,array($serial_number))[0];

				$money = ceil(100*$orderinfo['number']*$orderinfo['price']*0.3);

				$sql = 'update order_one set state=2,deposit=?,deposit_switch=1,deposit_time=? where serial_number=?';
				$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

				$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
				$result = $db->prepare_insert($sql,array($orderinfo['buyuserid'],$money,2,$time));

				$userinfo = user::getUserByUserId($orderinfo['buyuserid']);
				$username = $userinfo['name'];

				$uname = mb_substr($username,0,3);
				$sql = 'insert into order_dynamic(content) values(?)';
				$content = $uname.'**  付定金  '.($money/100).'元';
				$result = $db->prepare_insert($sql,array($content));

				$user = user::getUserByUserId($orderinfo['treeuserid']);
				$title = '已付定金！'.$username.' '.$userinfo['phone'];
				$name = $Messageattrbute->Order_oneattribute($orderinfo);
				$remark = '来自找树网';
				$url = './yusuanphone.php?msway=2&msid='.$serial_number.'#managersell';
				sendonetreepay($user['wechatid'], $title, $money/100, $name, $remark, $url,$weObj);
				
			}elseif($way == 'q'){
				$serial_number = substr($out_trade_no,1,24);
				// 查询单品订单信息
				$sql = 'select a.treeuserid,a.userid buyuserid,a.number,a.deposit,b.* from (select * from order_one where serial_number=?) a left join (select * from tree) b on a.treeuserid=b.userid and a.treeid=b.treeid';
				$orderinfo = $db->prepare_query($sql,array($serial_number))[0];

				if($orderinfo['deposit'] > 0){
					$money = ceil(100*$orderinfo['number']*$orderinfo['price']*0.7);
				}else{
					$money = ceil(100*$orderinfo['number']*$orderinfo['price']);
				}

				$sql = 'update order_one set state=5,fullamount=?,fullamount_time=? where serial_number=?';
				$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

				$sql = 'insert into recharge_bill(userid,money,way,time) values(?,?,?,?)';
				$result = $db->prepare_insert($sql,array($orderinfo['buyuserid'],$money,3,$time));

				$userinfo = user::getUserByUserId($orderinfo['buyuserid']);
				$username = $userinfo['name'];

				$uname = mb_substr($username,0,3);
				$sql = 'insert into order_dynamic(content) values(?)';
				$content = $uname.'**  付全款  '.($money/100).'元';
				$result = $db->prepare_insert($sql,array($content));
				
				$user = user::getUserByUserId($orderinfo['treeuserid']);
				$title = '已付全款,希望您早日发货！'.$username.' '.$userinfo['phone'];
				$name = $Messageattrbute->Order_oneattribute($orderinfo);
				$remark = '来自找树网';
				$url = './yusuanphone.php?msway=2&msid='.$serial_number.'#managersell';
				sendonetreepay($user['wechatid'], $title, $money/100, $name, $remark, $url,$weObj);
			}

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
