<?php 
session_start();
$utype=$_SESSION['user_type'];
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
				<?php if($utype=='文章管理员' || $utype=='超级管理员'){ ?>
				<li class="on"><a href="../article/list_article.php" target="Mainindex"><i class="ico-1"></i>文章管理</a></li>
				<?php }
				if($utype=='作家管理员' || $utype=='超级管理员'){
				 ?>
				<li><a href="../author/list_author.html" target="Mainindex"><i class="ico-2"></i>作家管理</a></li>
				<?php }
				if($utype=='评论管理员' || $utype=='超级管理员'){
				 ?>
				
				<li><a href="../comment/list_comment.html" target="Mainindex"><i class="ico-4"></i>评论管理</a></li>
				<?php }
				if($utype=='超级管理员'){
				 ?>
				
				<li><a href="../users/list_users.php" target="Mainindex"><i class="ico-3"></i>用户管理</a></li>
				<li><a href="xitong_set.html" target="Mainindex"><i class="ico-7"></i>系统设置</a></li>
				<?php } ?>
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