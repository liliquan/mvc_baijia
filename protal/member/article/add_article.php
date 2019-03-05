<?php 
session_start();
require_once "../../../public/conn.php";
require_once "../../../public/functions.php";
$sql = "select * from baijia_article_type";
$pdostmt = $pdo->query($sql);
$typeArr = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['flag'])){
	$type_id = $_POST['type_id'];
	$title = $_POST['title'];
	$tags= $_POST['tags'];
	$video_url = $_POST['video_url'];
	$desc = $_POST['desc'];

	$state = $_POST['state'];
	$content = $_POST['content'];
	$author_id = $_SESSION['author_id'];

	$artImg = $_FILES['file'];
	$uploadDir = "../../../public/upload/";
	$srtImgName = "";

	uploadSingle($artImg,$uploadDir,$srtImgName);
		$sql="insert into baijia_article(article_type_id,author_id,title,description,article_content,tags,article_img,video_url,add_time)
		values({$type_id},{$author_id},'{$title}','{$desc}','{$content}','{$tags}','{$srtImgName}','{$video_url}',now())";
		$num = $pdo->exec($sql);
		if($num!=false){
			echo "<script>alert('发表成功!');top.location.href='add_article.php';</script>";
		}else{
			echo "<script>alert('发表失败!');</script>";
		}
}

 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>文章发布-发布</title>
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
	$(function($) {
		$("select").selectui({
			// 是否自动计算宽度
			autoWidth: true,
			// 是否启用定时器刷新文本和宽度
			interval: true
		});
	});
		
	function DrawImage(ImgD,iwidth,iheight){    
    //参数(图片,允许的宽度,允许的高度)    
    var image=new Image();    
    image.src=ImgD.src;    
    if(image.width>0 && image.height>0){    
      if(image.width/image.height>= iwidth/iheight){    
          if(image.width>iwidth){      
              ImgD.width=iwidth;    
              ImgD.height=(image.height*iwidth)/image.width;    
          }else{    
              ImgD.width=image.width;      
              ImgD.height=image.height;    
          }    
      }else{    
          if(image.height>iheight){      
              ImgD.height=iheight;    
              ImgD.width=(image.width*iheight)/image.height;            
          }else{    
              ImgD.width=image.width;      
              ImgD.height=image.height;    
          }    
      }    
     }    
	} 
	</script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
<link href="../js/utf8-jsp/themes/default/css/ueditor.css" type="text/css" rel="stylesheet">
<script src="../js/utf8-jsp/third-party/codemirror/codemirror.js" type="text/javascript" defer></script>
<link rel="stylesheet" type="text/css" href="../js/utf8-jsp/third-party/codemirror/codemirror.css">
<script src="../js/utf8-jsp/third-party/zeroclipboard/ZeroClipboard.js" type="text/javascript" defer></script></head>

<body style="background: rgb(246, 245, 250);">
	<!--content S-->
	<div class="super-content">
		
		<div class="superCtab">
			<div class="publishArt">
				<h4>发布文章</h4>
				<div class="pubMain">
					<a href="javascript:history.go(-1)" class="backlistBtn"><i class="ico-back"></i>返回列表</a>
					<form action="" method="post" enctype="multipart/form-data">
						<h5 class="pubtitle">选择分类</h5>
						<div class="pubselect">
							<span class="select_ui"><span class="select_text_ui" style="min-width: 6em;">请选择分类</span><b class="select_arrow"></b>
							<select name="type_id">
								<?php for($i=0;$i<count($typeArr);$i++){
									echo "<option value=".$typeArr[$i]['id'].">".$typeArr[$i]['article_typename']."</option>";
								} ?>

							</select></span>
						</div>
						<h5 class="pubtitle">文章标题</h5>
						<div class="pub-txt-bar">
							<input type="text" name="title" class="shuruTxt">
						</div>
						<div class="pub-addflbtn"><a href="javascript:;" class="greenbtn add sp-add">添加标签</a></div>
						<h5 class="pubtitle">文章关键字</h5>
						<div class="pub-txt-bar">
							<input type="text" name="tags" class="shuruTxt">
						</div>
						<h5 class="pubtitle">文章封面图片</h5>
						<div class="pub-txt-bar">
							<input id="fileImage" type="file" size="30" name="file" onChange="showImg(this)" multiple>
							<br>
							<img id="uploadShow" onload="javascript:DrawImage(this,700,400)">
						</div>
						
						
						<h5 class="pubtitle">视频地址</h5>
						<div class="pub-txt-bar">
							<input type="text" class="shuruTxt" name="video_url"  placeholder="http://">
						</div>
						<h5 class="pubtitle">文章简介</h5>
						<div class="pub-area-bar">
							<textarea name="desc" rows="" cols="3"></textarea>
						</div>
						<h5 class="pubtitle">文章状态</h5>
						<div class="pub-area-bar">
							<input type="radio" name="state" value="1" checked >显示 <input type="radio" name="state" value="0">隐藏
						</div>
						<h5 class="pubtitle">文章内容</h5>
						<div class="pub-article-cont">
						<!-- 加载UEEdtior编辑器的容器 -->
						
						
						<script id="container" name="content" type="text/plain">
							在此处编辑文章正文
						</script>
						<!-- 配置文件 -->
						<script type="text/javascript" src="../js/utf8-php/ueditor.config.js"></script>
						<!-- 编辑器源码文件 -->
						<script type="text/javascript" src="../js/utf8-php/ueditor.all.js"></script>
						<!-- 实例化编辑器 -->
						<script type="text/javascript">
							var ue = UE.getEditor('container',{
        					//initialFrameWidth : 600,
        					initialFrameHeight: 400
    						});
						</script>
						
							
						<!-- 加载UEEdtior编辑器的容器结束 -->	
						</div>
						<div class="pub-btn">
							<input type="hidden" name="flag" value="1">
							<input type="submit" value="发布" class="saveBtn">
						</div>
					</form>
				</div>
			</div>
		
		</div>
		<!--main-->
		
	</div>
	<!--content E-->
	<!--点击修改弹出层-->
	<div class="layuiBg"></div><!--公共遮罩-->
	<!--点击添加标签弹出-->
	<div class="addFeileibox addSortBox layuiBox">
		<div class="layer-title clearfix"><h2>添加标签</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="addSortMain clearfix">
				<span>保险</span><span data-id="lb1">保险</span><span data-id="lb2">保</span><span data-id="lb2">保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span><span>保险</span>
			</div>
			<div class="addSortBtn"><input type="button" value="保存" class="saveBtn FuncsaveBtn"></div>
		</div>
	</div>
	

<script type="text/javascript">
function showImg(imgObj){	
	$("#uploadShow").attr("src",getObjectURL(imgObj.files[0]));	
}
function getObjectURL(file) {
	
	var url = null ;
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}

</script>

</body></html>