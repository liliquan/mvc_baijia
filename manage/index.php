<?php
session_start();
	require_once "../public/conn.php";
	if(isset($_POST['flag'])){
		$username = $_POST['username'];
		$passwd = md5($_POST['passwd']);
		$sql = "select * from baijia_users where username='{$username}' and passwd = '{$passwd}'";

		$pdostmt = $pdo->query($sql);
		if($pdostmt!=false){
			if($pdostmt->rowCount()>0){
				$_SESSION['user_name']=$username;
				$arr = $pdostmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['user_id']=$arr['id'];
				$_SESSION['user_type']=$arr['user_type'];
				echo "<script>alert('登录成功!');location.href='main.php';</script>";
			}else{
				echo "<script>alert('登录失败!,密码或账号错误');location.href='index.php';</script>";
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>用户登录</title>
	<link rel="stylesheet" href="css/base.css" />
	<link rel="stylesheet" href="css/login.css" />
	<script src="js/jquery.min.js"></script>
</head>
<body>
<div class="superlogin"></div>
<div class="loginBox">
	<div class="logo"><img src="images/logo_login.png"/></div>
	<div class="loginMain">
		<div class="tabwrap">
		<form action="" id="loginForm" method="post">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr><td class="title">用户名：</td><td><input type="text" id="username" name="username" class="form-control txt" /></td></tr>
			<tr><td class="title">密   码：</td><td><input type="password" id="passwd" name="passwd" class="form-control txt" /></td></tr>
			<tr><td class="title">验证码：</td><td><input type="text" id="validateCode" class="form-control txt txt2" /><span class="yzm"><img src="images/yzm.jpg"/></span></td></tr>
			<tr class="errortd"><td>&nbsp;</td><td><i class="ico-error"></i><span class="errorword">用户名或密码错误，请重新输入！</span></td></tr>		
			<tr><td>&nbsp;</td><td>
				
				<input type="button" id="btn_login" class="loginbtn" value="登录" />
				<input type="button" class="resetbtn" value="重置" onclick="location.href='loginA.html'"/>
				<input type="hidden" value="1" name="flag">
			</td></tr>

			<tr><td>&nbsp;</td><td class="forgetpsw"><a href="login_forgetb.html">忘记密码？</a></td></tr>	
		</table>
		</form>
		</div>
	</div>
</div>
<div class="footer">Copyright © 2016-2017 传智专修学院  All Rights Reserved.</div>
</body>
</html>

<script language="javascript" type="text/javascript">
$(function(){
	
	//手动验证表单各项值是否为空
	$("#btn_login").click(function(){
		
		if($("#username").val()==""){
			alert("用户名不能为空!");
			$("#username").focus();
			
		}else if($("#passwd").val()==""){
			alert("密码不能为空!");
			$("#passwd").focus();
			
		}else if($("#validateCode").val()==""){
			alert("验证码不能为空!");
			$("#validateCode").focus();
			
		}
		else{
		//此处应该做用户名、密码验证
		$("#loginForm").submit();
			
		}
		
	});
	
});
</script>
