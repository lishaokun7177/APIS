<?php  
	//客户端发起api请求

	include './vendor/autoload.php';

	$url = 'http://localhost/apis/server/server.php';

	$curl = new Curl\Curl();
	$curl->get($url);

	if ($curl->error) {
	    echo $curl->error_code;
	}
	else {
	    echo $curl->response;
	}
	
?>