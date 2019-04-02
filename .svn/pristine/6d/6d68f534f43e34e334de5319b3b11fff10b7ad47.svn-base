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

			$way = substr($out_trade_no,0,1);
			$db = new db();
			$weObj = new Wechat();
			if($way == 'd'){
				$serial_number = substr($out_trade_no,1,25);
				// 查询招标订单信息
				$sql = 'select a.tree_order_id,a.tender_userid,a.bid_userid,b.* from (select * from orders where serial_number=?) a left join (select * from tree_order) b on a.tender_userid=b.userid and a.tree_order_id=b.id';
				$orderinfo = $db->prepare_query($sql,array($serial_number))[0];
				// 修改订单
				$sql = 'update orders set deposit=? , deposit_time=? , deposit_switch=1 , state=2 where serial_number=?';
				$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

				$sql = 'update bid_order set state=4 where id=? and userid=?';
				$result = $db->prepare_exec($sql,array($orderinfo['tree_order_id'],$orderinfo['bid_userid']));

				$sql = 'insert into recharge_bill(userid,money,way) values(?,?,?)';
				$result = $db->prepare_insert($sql,array($orderinfo['tender_userid'],$money,2));

				$user = user::getUserByUserId($orderinfo['bid_userid']);
				$title = $user['name'].$user['phone'];
				$remark = $this->Ordersattribute($orderinfo).'----找树网';
				$url = './yusuanphone.php#bidhistory';
				$keyword1 = '编号：'.$serial_number;
				$keyword2 = '已付定金'.($money/100).'元';
				sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
				
			}elseif($way == 'q'){
				$serial_number = substr($out_trade_no,1,25);
				// 查询招标订单信息
				$sql = 'select a.tree_order_id,a.tender_userid,a.bid_userid,b.* from (select * from orders where serial_number=?) a left join (select * from tree_order) b on a.tender_userid=b.userid and a.tree_order_id=b.id';
				$orderinfo = $db->prepare_query($sql,array($serial_number))[0];
				// 修改订单
				$sql = 'update orders set fullamount=? , fullamount_time=? , state=5 where serial_number=?';
				$result = $db->prepare_exec($sql,array($money,$time,$serial_number));

				$sql = 'update bid_order set state=10 where id=? and userid=?';
				$result = $db->prepare_exec($sql,array($orderinfo['tree_order_id'],$orderinfo['bid_userid']));

				$sql = 'insert into recharge_bill(userid,money,way) values(?,?,?)';
				$result = $db->prepare_insert($sql,array($orderinfo['tender_userid'],$money,3));

				$user = user::getUserByUserId($orderinfo['bid_userid']);
				$title = $user['name'].$user['phone'];
				$remark = $this->Ordersattribute($orderinfo).'------找树网';
				$url = './yusuanphone.php#bidhistory';
				$keyword1 = '编号：'.$serial_number;
				$keyword2 = '已付全款'.($money/100).'元';
				sendbidMessage($user['wechatid'], $title, $keyword1, $keyword2, $remark, $url,$weObj);
			}

			unset($weObj);
			unset($db);
			return true;
		}
		return false;
	}

	public function Ordersattribute($attribute){
		$str = '';
		$attributename = ["trunk_diameter"=>"胸径","ground_diameter"=>"地径","plant_height"=>"株高","crown"=>"冠幅","branch_number"=>"分枝数","bough_number"=>"主枝数","age"=>"苗龄","branch_length"=>"条长","bough_length"=>"主蔓(枝)长","branch_point_height"=>"分枝点高","pot_diameter"=>"盆径","plant_height_cm"=>"株高","crown_cm"=>"冠幅","substrate"=>"基质","mark"=>"备注"];
		$attributeunit = ["trunk_diameter"=>"公分","ground_diameter"=>"公分","plant_height"=>"米","crown"=>"米","branch_number"=>"个","bough_number"=>"个","age"=>"年","branch_length"=>"米","bough_length"=>"米","branch_point_height"=>"米","pot_diameter"=>"公分","plant_height_cm"=>"公分","crown_cm"=>"公分","substrate"=>" ","mark"=>" "];
		if($attribute['name']) $str .= $attribute['name'].' ';
		if($attribute['count']) $str .= $attribute['count'].$attribute['unit'].' ';

		foreach ($attribute as $key => $value) {
			if($attributename[$key] && $value){
				$attr = str_replace(',','-',$value);
				$str .= $attributename[$key].':'.$attr.$attributeunit[$key].' ';
			}
		}
		return $str;
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

