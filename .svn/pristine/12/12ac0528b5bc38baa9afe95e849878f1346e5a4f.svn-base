<?php 

	//获取access_token 
	class Token
	{
		//静态成员属性
		static public $TokenFile = '/token.txt'; //缓存token 的文件
		static public $TokenTime = 7000;//缓存有效时间

		//获取token
		static public function getToken()
		{
			//如果本地token存在并且没有过期,就在本地读取后返回
			if(self::checkTokenFile() && self::checkTime()){
				//直接读取后返回
				return self::readToken();
			}else{
				// 如果本地没有token或过期了,重新去请求token 并且缓存
				$res = self::requestToken();
				// 写入
				self::writeToken($res);
				// 并返回结果
				return $res;
			}

		}

		//请求token 通过接口去请求新的token
		static public function requestToken()
		{
			//请求地址
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx400fa6a12644f696&secret=f29f23074b3e749550de6e85798c4737';
			//发送请求
			$res = get($url);
			//解析返回结果
			// {"access_token":"ACCESS_TOKEN","expires_in":7200}
			// {"errcode":40013,"errmsg":"invalid appid"}
			$data = json_decode($res,true);
			if(empty($data['access_token'])){
				//返回结果不正确
				return false;
			}else{
				//将正确结果 返回
				return $data['access_token'];
			}
		}

		//将token写入缓存文件
		public static function writeToken($res)
		{
			//写入
			file_put_contents(self::$TokenFile,$res);
		}

		//读取缓存文件中的token
		static public function readToken()
		{
			//读取
			return file_get_contents(self::$TokenFile);
		}

		//检测缓存文件是否存在
		static public function checkTokenFile()
		{
			//检测文件是否存在
			return file_exists(self::$TokenFile);
		}

		//检测缓存是否过期
		static public function checkTime()
		{
			//文件最后修改时间 + 缓存时间 
			// 123 + 100 = 223 > 250
			return filemtime(self::$TokenFile) + self::$TokenTime > time();
		}

	}





 ?>