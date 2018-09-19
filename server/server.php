<?php  
	//服务器端接收api请求 响应  json 
	
	$pdo = new PDO('mysql:host=localhost;dbname=api;charset=utf8','root','');

	$stmt = $pdo->query('select * from user');

	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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