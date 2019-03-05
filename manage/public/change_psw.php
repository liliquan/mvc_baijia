<?php 	
	session_start();
	require_once "../../public/conn.php";

	if(isset($_POST['flag'])){
		$user_id = $_SESSION['user_id'];
		// 1，根据id查询当前用户的密码是多少
		$sql = "select passwd from baijia_users where id = ".$user_id;
		$pdostmt = $pdo->query($sql);
		//定义变量保存旧的密码
		$oldpwd = "";
		if($pdostmt!=false){
			$arr = $pdostmt->fetch(PDO::FETCH_ASSOC);
			$oldpwd = $arr['passwd'];
		}

		// 2，拿用户输入的密码和查询的密码比较，如果相等表示 原密码输入正确
		//    1) 获取表单输入的内容
		    $inputOldPwd = $_POST['oldPasswd'];  //123
		    $newpwd = md5($_POST['newPasswd2']); //456

		// 判断密码是否相当
		if($oldpwd == md5($inputOldPwd)){

			// 3，获取用户输入的新的密码
			//    update 语句，更新用户的密码
			$sql = "update baijia_users set passwd = '{$newpwd}' where id = ".$user_id;
			// echo $sql;
			$num = $pdo->exec($sql);
			//判断是否执行成功!
			if($num!=false){
				echo "<script>alert('密码修改成功！'); top.location.href='../index.php';</script>";
			}

		}
		
	}

 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>修改密码</title>
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript">		
	var a=1,b=1,c=1,d=1;
	function checkPassword(){

		if($("#oldPasswd").val()==""){
			
			if(a){
				$('#oldPasswd').closest('.pub-txt-bar').append("<b class='error'></b><div class='errorBox'>请输入旧密码！</div>");
				a=0;
			}
			$('#oldPasswd').focus();
			
			//<b class="error"></b><div class="errorBox" id="newPasswd2ErrorBox"></div>
			return false;
		}else if($("#newPasswd1").val()==""){
			if(b){
				$('#newPasswd1').closest('.pub-txt-bar').append("<b class='error'></b><div class='errorBox'>请输入新密码！</div>");
				b=0;
				$('#oldPasswd').closest('.pub-txt-bar').children(".error").remove();
				$('#oldPasswd').closest('.pub-txt-bar').children(".errorBox").remove();
			}
			return false;
		}else if($("#newPasswd2").val()==""){
			if(c){
				$('#newPasswd2').closest('.pub-txt-bar').append("<b class='error'></b><div class='errorBox'>请输入确认密码！</div>");
				c=0;
				$('#newPasswd1').closest('.pub-txt-bar').children(".error").remove();
				$('#newPasswd1').closest('.pub-txt-bar').children(".errorBox").remove();
			}
			return false;
			
		}else if($("#newPasswd1").val()!=$("#newPasswd2").val()){
			
			
			if(d){
				$('#newPasswd2').closest('.pub-txt-bar').children(".error").remove();
				$('#newPasswd2').closest('.pub-txt-bar').children(".errorBox").remove();
				$('#newPasswd2').closest('.pub-txt-bar').append("<b class='error'></b><div class='errorBox'>新密码和确认密码输入不一致！</div>");
				
				d=0;
			}
			
			return false;
		}else{
			$('#newPasswd2').closest('.pub-txt-bar').children(".error").remove();
			$('#newPasswd2').closest('.pub-txt-bar').children(".errorBox").remove();
			return true;
		}
	}
	</script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body style="background: #f6f5fa;">
	<!--content S-->
	<div class="super-content">
		<div class="superCtab">
			<div class="publishArt">
				<h4>修改密码</h4>
				<form action="" method="post" onSubmit="return checkPassword();">
				<div class="pubMain">
					<h5 class="pubtitle">旧密码</h5>
					<div class="pub-txt-bar">
						<input type="password" id="oldPasswd" name="oldPasswd" class="shuruTxt shuruTxt2">
					</div>
					<h5 class="pubtitle">新密码<span>（数字、字母、符号组合，最少8个字符）</span></h5>
					<div class="pub-txt-bar">
						<input type="password" id="newPasswd1" name="newPasswd1" class="shuruTxt shuruTxt2">
					</div>
					<h5 class="pubtitle">确认密码</h5>
					<div class="pub-txt-bar">
						<input type="password" id="newPasswd2" name="newPasswd2" class="shuruTxt shuruTxt2">
					</div>
					<div class="pub-btn">
						<input type="hidden" name="flag" value="1">
						<input type="submit" id="" value="确定" class="saveBtn">
						<input type="reset" id="" value="重置" class="resetBtn">
					</div>
				</div>
				</form>
			</div>
		
		</div>
		<!--main-->
		
	</div>
	<!--content E-->
	


</body></html>