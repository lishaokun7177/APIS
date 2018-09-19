<?php  
	//客户端发起api请求

	include './vendor/autoload.php';
	include 'setsing.php';

	//定义秘钥
	$token = 'test';

	//生成一个加密签名
	$sing = setsing($token);

	$url = 'http://localhost/apis/server/server.php?sing='.$sing;
	echo $url.'<br>';

	$curl = new Curl\Curl();
	$curl->post($url, array(
	    'username' => 'zhangsan',
	    'password' => 'aaa',
	));

	if ($curl->error) {
	    echo $curl->error_code;
	}
	else {
	    echo $curl->response;
	}
	
?>