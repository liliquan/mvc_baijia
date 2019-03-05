<?php 

	$host = "www.q.com";
	$port = 80;
	$link = fsockopen($host,$port);
	

	/*	POST /www/baijia/protal/member/register.php HTTP/1.1
	Host: www.q.com
	Connection: keep-alive
	Content-Length: 39
	Cache-Control: max-age=0
	Origin: http://www.q.com
	Upgrade-Insecure-Requests: 1
	Content-Type: application/x-www-form-urlencoded
	User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36
	Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*//*;q=0.8
	Referer: http://www.q.com/www/baijia/protal/member/register.php
	Accept-Encoding: gzip, deflate
	Accept-Language: zh-CN,zh;q=0.9
	Cookie: PHPSESSID=m7j1vuk7rhm55asdmq6thqgo93*/
// username:qqw123123
// passwd:123213
// flag:1
	define("CRLF", "\r\n");
	$i = 0;
	while($i<=100){

	$requesrData = "POST /www/baijia/protal/member/register.php HTTP/1.1".CRLF;
	$requesrData .= "Host: www.d.com".CRLF;
	$requesrData .= "Connection: keep-alive".CRLF;

	$data = "uname=qqw".$i."&pwd=box".$i."&flag=1";

	$requesrData .= "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36".CRLF;
	$requesrData .= "Content-Type: application/x-www-form-urlencoded".CRLF;


	$requesrData .= "Content-Length: ".strlen($data).CRLF;
	$requesrData .=CRLF;
	$requesrData .=$data;
	fwrite($link, $requesrData);

	while ($str = fgets($link)){
		echo iconv("utf-8", "gbk", $str);   //
	}
		$i++;

	}


	fclose($link);

 ?>