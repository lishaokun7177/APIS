<?php  
	//服务器端接收api请求 响应  json 

	error_reporting('E_ALL & ~E_NOTICE');

	//处理服务器未知异常
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');

		$stmt = $pdo->query('select * from user');

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}catch(Exception $e) {
		echo resp([],401,$e->getMessage());
		exit;
	}

	//业务逻辑异常
	try {
		if(empty($_POST['username'])) {
			throw new Exception('缺失username必填');
		}

		if(empty($_POST['password'])) {
			throw new Exception('缺失password必填');
		}
	}catch(Exception $e) {
		echo resp([],401,$e->getMessage());
		exit;
	}

	//定义标准化产出数据格式函数
	function resp($data,$status,$message) {

		$res = [
			'status'=>$status, //服务器响应状态码
			'message'=>$message,
			'data'=>$data //此次api请求的描述

		];

		return json_encode($res,JSON_UNESCAPED_UNICODE);
	}

	echo resp($data,200,'success');
?>