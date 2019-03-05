<?php 
session_start();
require_once "../../public/conn.php";
// $code = $_SESSION['code'];
// var_dump($code);
if(isset($_POST['flag'])){
	// $code = $_SESSION['code'];
	// var_dump($code);
	// $validateCode = $_POST['validateCode'];
	// if($code!=$validateCode){
	// 	// echo "<script>alert('验证码输入不正确');
	// 	// location.href='register.php';
	// 	// </script>";
	// }else{

		$name = $_POST['uname'];
		$pwd = md5($_POST['pwd']);
		$sql = "insert into baijia_author(uname,pwd) values('{$name}','{$pwd}')";
		$num = $pdo->exec($sql);
		if($num!=false){
			$_SESSION['author_name'] = $name;
			$_SESSION['author_id'] = $pdo->lastInsertId();
			header("Location:register_success.php");
		}

	// }
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
	<style>
		.ColorRed{
			color: red;
		}
		.ColorGreen{
			color: green;
		}
	</style>
</head>
<body>
<div class="superlogin"></div>
<div class="loginBox">
	<div class="logo"><img src="images/logo_login.png"/></div>
	<div class="loginMain">
		<div class="tabwrap">
		<form action="" id="loginForm" method="post">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr><td class="title">用户名：</td><td><input type="text" id="username" name="uname" class="form-control txt" /><span id="info"></span></td></tr>
			<tr><td class="title">密   码：</td><td><input type="password" id="passwd" name="pwd" class="form-control txt" /></td></tr>
			<!-- <tr><td class="title">验证码：</td><td><input type="text" name="validateCode" id="validateCode" class="form-control txt txt2" /><span class="yzm"><img src="../../public/img2.php" onclick="this.src='../../public/img2.php'"/></span></td></tr> -->
			<tr class="errortd"><td>&nbsp;</td><td><i class="ico-error"></i><span class="errorword">用户名或密码错误，请重新输入！</span></td></tr>		
			<tr><td>&nbsp;</td><td>
				<input type="hidden" value="1" name="flag">
				<input type="button" id="btn_login" class="loginbtn" value="我要注册" />
				<input type="button" class="resetbtn" value="重置"/></td></tr>
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
	
	
	$(".resetbtn").click(function(){
		
		$("#username").val("");
		$("#passwd").val("");
		$("#validateCode").val("");
		
	});
	
	$("#username").blur(function(){
		var uname=$(this).val();
		if(uname!=""){
			$.post("ajax-checkName.php",{name:uname,r:Math.random()},function(data){
				if(data*1){
					$("#info").html("用户名已经存在!").attr("class","ColorRed");
					$("#btn_login").attr("disabled",true);
				}else{
					$("#info").html("用户名可以使用!").attr("class","ColorGreen");
					$("#btn_login").attr("disabled",false);
				}
			});
		}
	});

});


</script>
