<?php
//先包含配置文件
require_once "config.php";

try{
	$dsn="mysql:host=".HOST.";dbname=".DBNAME;
	$pdo=new PDO($dsn,USER,PWD);
	$pdo -> exec('set names utf8');
}catch(PDOException $e){
	echo "数据库连接失败!".$e->getMessage();
};

?>