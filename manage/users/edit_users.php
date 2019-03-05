<?php 
	require_once "../../public/conn.php";
	session_start();
	if(isset($_GET['id'])){

		$id = $_GET['id'];
		$sql = "select * from baijia_users where id = ".$id;
		$pdostmt = $pdo->query($sql);
		$Arrs= array();
		if($pdostmt!=false){
			$Arrs = $pdostmt->fetch(PDO::FETCH_ASSOC);
		}

		if(isset($_POST['flag'])){
			$userType = $_POST['userType'];
			$passwd = $_POST['passwd']="" ? $Arrs['passwd'] : md5($_POST['passwd']);
			$uname = $_SESSION['uname'];
			$userName = $_SESSION['user_name'];
		
			$sql = "update baijia_article set 
					user_type = {$userType},
					passwd = '{$passwd}',
					username = '{$uname}',
					last_update_time= now(),
					last_update_user = '{$userName}'

					where id = {$id}";
			$num = $pdo->exec($sql);
			if($num!=false){
				echo "<script>alert('修改成功');location.href='list_users.php';</script>";
			}else {
				echo "<script>alert('删除失败！');</script>";
			}
		}
	}
 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>用户信息修改</title>
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript" src="../js/jquery.selectui.js"></script>
	<link rel="stylesheet" type="text/css" href="../js/webuploader/webuploader.css">    
    <link rel="stylesheet" type="text/css" href="../js/webuploader/demo.css">
	
	<script>	
	function check(){
		
		if($("#userType").val()==0){
				
			alert("请选择用户类型！");
			$("#userType").focus();
			return false;
				
		}else{
			return true;
		}	
	}
	$(function($) {
		
		$("select").selectui({
			// 是否自动计算宽度
			autoWidth: true,
			// 是否启用定时器刷新文本和宽度
			interval: true
		});

	});
	</script>
	
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->

	</head>

<body style="background: rgb(246, 245, 250);">
	<!--content S-->
	<div class="super-content">
		
		<div class="superCtab">
			<div class="publishArt">
				<h4>个人信息修改</h4>
				<div class="pubMain">
					<a href="javascript:history.go(-1)" class="backlistBtn"><i class="ico-back"></i>返回列表</a>
					<form action="" method="post" onSubmit="return check();">
						<h5 class="pubtitle">选择权限类型</h5>
						<div class="pubselect">
							<span class="select_ui"><span class="select_text_ui" style="min-width: 6em;">请选择分类</span><b class="select_arrow"></b>
							<select name="userType" id="userType">
								<option value="0">--请选择分类--</option>
								<option value="文章管理员" <?php if($Arrs['user_type']=="文章管理员") echo "selected" ?>>文章管理员</option>
								<option value="作家管理员" <?php if($Arrs['user_type']=="作家管理员") echo "selected" ?>>作家管理员</option>
								<option value="评论管理员" <?php if($Arrs['user_type']=="评论管理员") echo "selected" ?>>评论管理员</option>
								<option value="超级管理员" <?php if($Arrs['user_type']=="超级管理员") echo "selected" ?>>超级管理员</option>
							</select></span>
						</div>
						
						
						<h5 class="pubtitle">用户名</h5>
						<div class="pub-txt-bar">
							<input type="text" name="uname" class="shuruTxt"  value="<?php echo $Arrs['username'] ?>">
						</div>
						
						<h5 class="pubtitle">密码</h5>
						<div class="pub-txt-bar">
							<input type="text" name="passwd" class="shuruTxt" placeholder="如不需要修改密码，此处不用填写任何内容">
						</div>
						
						
						<div class="pub-btn">
							<input type="hidden" name="flag" value="1">
							<input type="submit" value="保存" class="saveBtn">
						</div>
					</form>
				</div>
			</div>
		
		</div>
		<!--main-->
		
	</div>
	<!--content E-->	

<script type="text/javascript">
// 添加全局站点信息
var BASE_URL = '/webuploader';
</script>
<!--引入JS-->
<script type="text/javascript" src="../js/webuploader/webuploader.js"></script>
<script type="text/javascript" src="../js/webuploader/demo.js"></script>
<script type="text/javascript" src="../js/zxxFile.js" ></script>
<script>
var params = {
	fileInput: $("#fileImage").get(0),
	upButton: $("#fileSubmit").get(0),
	url: $("#uploadForm").attr("action"),
	filter: function(files) {
		var arrFiles = [];
		for (var i = 0, file; file = files[i]; i++) {
			if (file.type.indexOf("image") == 0) {
				if (file.size >= 512000) {
					alert('您这张"'+ file.name +'"图片大小过大，应小于500k');	
				} else {
					arrFiles.push(file);	
				}			
			} else {
				alert('文件"' + file.name + '"不是图片。');	
			}
		}
		return arrFiles;
	},
	onSelect: function(files) {
		var html = '', i = 0;
		$("#preview").html('<div class="upload_loading"></div>');
		var funAppendImage = function() {
			file = files[i];
			if (file) {
				var reader = new FileReader()
				reader.onload = function(e) {
					html = html +'<div class="Thumb_li"><div class="bg"><a href="javascript:" class="Thumb_delete" title="删除" data-index="'+ i +'">删除</a></div>' +
						'<img id="uploadImage_' + i + '" src="' + e.target.result + '" class="upload_image" />'+ 
					'</div>';
					
					i++;
					funAppendImage();
					$('.Thumb_li').hover(function(){
				    	$(this).children('.bg').fadeIn();
				    },function(){
				    	$(this).children('.bg').fadeOut();
				    });
				    $(".Thumb_delete").click(function(){
				    	$(this).parent().parent('.Thumb_li').remove();
				    });
				}
				reader.readAsDataURL(file);
			} else {
				$("#preview").html(html);
				if (html) {
					//删除方法
					$(".Thumb_delete").click(function() {
						ZXXFILE.funDeleteFile(files[parseInt($(this).attr("data-index"))]);
						return false;	
					});
					//提交按钮显示
					$("#fileSubmit").show();	
				} else {
					//提交按钮隐藏
					$("#fileSubmit").hide();	
				}
			}
		};
		funAppendImage();		
	},
	onDelete: function(file) {
		$("#uploadList_" + file.index).fadeOut();
	},
	onDragOver: function() {
		$(this).addClass("upload_drag_hover");
	},
	onDragLeave: function() {
		$(this).removeClass("upload_drag_hover");
	},
	onProgress: function(file, loaded, total) {
		var eleProgress = $("#uploadProgress_" + file.index), percent = (loaded / total * 100).toFixed(2) + '%';
		eleProgress.show().html(percent);
	},
	onSuccess: function(file, response) {
		$("#uploadInf").append("<p>上传成功，图片地址是：" + response + "</p>");
	},
	onFailure: function(file) {
		$("#uploadInf").append("<p>图片" + file.name + "上传失败！</p>");	
		$("#uploadImage_" + file.index).css("opacity", 0.2);
	},
	onComplete: function() {
		//提交按钮隐藏
		$("#fileSubmit").hide();
		//file控件value置空
		$("#fileImage").val("");
		$("#uploadInf").append("<p>当前图片全部上传完毕，可继续添加上传。</p>");
	}
};
ZXXFILE = $.extend(ZXXFILE, params);
ZXXFILE.init();
</script>

</body></html>