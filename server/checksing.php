<?php  
	include './aes.php';

	//检测秘钥
	try {
		if(empty($_GET['sing'])) {
			throw new Exception('加密签名不存在');
		}

		check($_GET['sing']);

	}catch(Exception $e) {
		echo resp([],401,$e->getMessage());
		exit;
	}

	//校验签名
	function check($sing) {
		//使用方法
		$aes = new AESMcrypt($bit = 128, $key = 'abcdef1234567890', $iv = '0987654321fedcba', $mode = 'cbc');
		
		$sing = str_replace(' ', '+', $sing);
		// echo $sing.'<br>'
		$sing_tmp = $aes->decrypt($sing);
		$sing_arr = explode('/', $sing_tmp);

		if($sing_arr[0]!=Token) {
			throw new Exception('加密签名不正确');
		}

		//防止api暴露
		if((time()-$sing_arr[1]) > 5) {
			throw new Exception("sing 失败");
		}
	}

	


?>