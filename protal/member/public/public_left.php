<?php 
session_start();
require_once "../../../public/conn.php";
	$author_id = $_SESSION['author_id'];
	$sql = "select author_state from baijia_author where id=".$author_id;
	$pdostmt = $pdo->query($sql);
	$authorArr = array();
	if($pdostmt!=false){
		$authorArr = $pdostmt->fetch(PDO::FETCH_ASSOC);
	}
 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>公共侧边栏</title>
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body>
	<!--side S-->
	<div class="super-side-menu">
		<div class="logo"><a href="public_super_cg.html" target="_parent"><img src="../images/logo.png"></a></div>
		
	<div class="side-menu">
		<ul>
			
			<li class="on"><a href="../article/list_article.php" target="Mainindex"><i class="ico-1"></i>文章管理</a></li>
			<?php if($authorArr['author_state']!=3){ ?>
			<li><a href="../register_step2.html" target="Mainindex"><i class="ico-3"></i>成为作家</a></li>
			<?php } ?>
			<li><a href="../perfect_info.php" target="Mainindex"><i class="ico-2"></i>个人信息完善</a></li>
			<li><a href="change_psw.php" target="Mainindex"><i class="ico-3"></i>修改密码</a></li>
			<li><a href="../loginout.html" target="_parent"><i class="ico-3"></i>退出系统</a></li>
		</ul>
	</div>
	</div>
	<!--side E-->

<script type="text/javascript">
	$(function(){
		$('.side-menu li').click(function(){
			$(this).addClass('on').siblings().removeClass('on');
		})
	})
</script>

</body></html>