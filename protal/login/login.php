<?php 
session_start();
require_once "../../public/conn.php";
function toLogin($pdo,$name,$pwd){
	$sql = "select * from baijia_author where username='{$name}' and passwd='{$pwd}'";
	$pdostmt = $pdo->query($sql);
	if($pdostmt->rowCount()>0){
		$_SESSION['author_name']=$name;
		$arr = $pdostmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['author_id']=$arr['id'];
		return true;
	}else{
		return false;
	}
};
if(isset($_POST['flag'])){
	$name = $_POST['username'];
	$pwd = md5($_POST['password']);
	$remember = $_POST['remember'];

	if(toLogin($pdo,$name,$pwd)){
		setCookie("author_name",$name,time()+$remember);
		setCookie("author_pwd",$pwd,time()+$remember);
		echo "<script>alert('登陆成功~');location='../member/main.php';</script>";
	}else{
		echo "<script>alert('账户或密码错误~');location.href='login.php';</script>";
	}
}else if(isset($_COOKIE['author_name']) && isset($_COOKIE['author_pwd'])){
	if(toLogin($pdo,$_COOKIE['author_name'],$_COOKIE['author_pwd'])){
		echo "<script>location.href='../member/main.php'</script>";
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>百家号-登录页</title>
	<!-- 链接外部的css文件 common.css -->
	<link rel="stylesheet" href="../../static/css/common.css">
	<!-- 链接外部css文件   reset.css -->
	<link rel="stylesheet" href="../../static/css/reset.css">
	<!-- 链接外部css文件   login.css -->
	<link rel="stylesheet" href="../../static/css/login.css">
	<!-- 设置网页的icon -->
	<link rel="shortcut icon" href="../../czxy.ico">
</head>
<body>
	<!-- 顶部logo header S-->
	<div class="header">
		<!-- 居中的子盒子 -->
		<div class="container">
			<div class="logo">
				<a href="../../index.html"><img src="../../static/images/logo.png" alt=""></a>
			</div>
			<div class="right">
				<img src="../../static/images/khfwrx.png" alt="">
			</div>
		</div>
	</div>
	<!-- 顶部logo header E-->


	<!-- 主体main S-->
	<div class="main">
		<div class="container">
			<div class="left">
				<img src="../../static/images/bg01.png" alt="">
			</div>
			<form action="" method="post">
			<div class="right">
				<h2>账户登录</h2>
				<!-- 用户名的输入框 -->
				<div class="username">
					<div><i class="tb-member"></i></div>
					<input type="text" name="username" id="" placeholder ="用户名">
				</div>
				<!-- 密码输入框 -->
				<div class="password">
					<div><i class="tb-lock"></i></div>
					<input type="password" name="password" id="" placeholder ="密码">
				</div>

				<!-- 记住密码 -->
				<div class="remember">
					记住密码？
					<input type="radio" name="remember" id="" value="0" checked="checked">不记密码
					<input type="radio" name="remember" id="" value="604800">一周
					<input type="radio" name="remember" id="" value="259200">一月 
				</div>

				<!-- 放置按钮 -->
				<div class="loginbtn">
					<input type="hidden" value="1" name="flag">
					<input type="submit" value="登           录">
				</div>
				     
				<div class="register">
				    	<a href="../member/register.php">没有账号？点击注册</a>
				</div>  
			</div>
			</form>
		</div>
	</div>
	<!-- 主体main E-->


	<!-- 底部footer S-->
	<div class="lfooter">
		<div class="container">
			
			<div class="left">
					@2007-2017 传智专修学院全栈1班版权所有
			</div>
			<div class="right">
					<a href="">网站地图</a>
					<a href="">法律声明</a>
					<a href="">友情链接</a>
			</div>
			
		</div>
	</div>
	<!-- 底部footer E-->
</body>
</html>