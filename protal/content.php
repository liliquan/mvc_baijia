<?php 
	require_once "../public/conn.php";
	$id=isset($_GET['id'])?$_GET['id']:1;
	$sql = "update baijia_article set read_num = read_num+1 where id=".$id;
	$pdo->exec($sql);
	$sql = "select be.*,br.nicheng from baijia_article be,baijia_author br where be.author_id=br.id and be.id=".$id;
	$pdostmt = $pdo->query($sql);
	$articleArr = array();
	if($pdostmt!=false){
		$articleArr = $pdostmt->fetch(PDO::FETCH_ASSOC);
	}

	$sql = "select be.id,be.title,be.description,br.nicheng from baijia_article be,baijia_author br where be.author_id = br.id order by read_num desc limit 10";
	$pdostmt = $pdo->query($sql);
	$topArticleArrs = array();
	if($pdostmt!=false){
		$topArticleArrs = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
	}

	$sql="select * from baijia_article_type limit 5";
	$pdostmt=$pdo->query($sql);
	$typeArr= array();
	if($pdostmt!=false){
		$typeArr=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>百家号-内容页（传智专修学院出品）</title>
	<!-- 引入公共的css文件 common.css -->
	<link rel="stylesheet" href="../static/css/common.css">
	<!-- 引入清除默认样式的css文件  reset.css-->
	<link rel="stylesheet" href="../static/css/reset.css">
	<!-- 引入首页对应的css文件      index.css-->
	<link rel="stylesheet" href="../static/css/content.css">
</head>
<body>
	
	<!-- 百家号首页header 部分 S -->
	<div class="header">
		<!-- 居中盒子 -->
		<div class="container">
			<!-- 左left -->
			<div class="left">
				<img src="../static/images/logo.png" alt="">
				<a href="../index.php">首页</a>
				<?php for($i=0;$i<count($typeArr);$i++){
					$cur="";
					if($articleArr['article_type_id']==$typeArr[$i]['id']){
						$cur = "class = 'active'";
					}
					echo "<a href='../channer.php?cet=".$typeArr[$i]['id']."' {$cur}>".$typeArr[$i]['article_typename']."</a>";
				} ?>
			</div>
			<!-- 右right -->
			<div class="right">
				<a href="#">进入百家号写作平台</a>
				<a href="#">登录</a>
				<a href="#">百度首页</a>
			</div>
		</div>
	</div>
	<!-- 百家号首页header 部分 E -->

	<!-- 百家号首页新闻列表news 部分 S -->
	<div class="news clearfix">
		<div class="container">
			<div class="left">
				<!-- 新闻列表 -->
				<ul>
					<li>
						<!-- 标题 -->
						<h3><?php echo $articleArr['title']; ?></h3>
						<p class="artinfo">
							<a href=""><?php echo $articleArr['nicheng'] ?></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo substr($articleArr['add_time'],0,16) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>阅读: <?php echo $articleArr['read_num'] ?></span>
						</p>
						<p class="desc">
							<?php echo $articleArr['description']; ?>
						</p>
						<!-- 文章内容 -->
						<div class="content">

						<?php echo $articleArr['article_content'] ?>
						</div>

						<!-- 版权声明S -->
						<div class="bqsm">
							<h4>版权声明</h4>
							<p>本文仅代表作者观点，不代表百度立场。</p>
							<p>本文系作者授权百度百家发表，未经许可，不得转载。</p>
						</div>
						<!-- 版权声明E -->

						<!-- 阅读量S -->
						<div class="ydl">
							<div class="yleft">
								阅读量：<span>9999</span>
							</div>
							<div class="yright">
								赞：4 |  差评: 88
							</div>
						</div>
						<!-- 阅读量E -->

						<!-- 文章的分享 -->
						<div class="share">
							<div class="sleft">
								<p>分享:</p>
								<a href="#"><img src="../static/images/icon_weixin_06abe38.png" alt=""></a>
								<a href="#"><img src="../static/images/icon_weibo_4b06ea1.png" alt=""></a>
								<a href="#"><img src="../static/images/icon_qq_0e1effb.png" alt=""></a>
								<a href="#"><img src="../static/images/icon_qqzone_145d2ed.png" alt=""></a>
								<a href="#"><img src="../static/images/icon_more_c537d39.png" alt=""></a>
							</div>

							<div class="sright">
								<!-- 二维码图片 -->
								<img src="../static/images/news-qrcode_8fe3c4d.png" alt="">
								<!-- 放置文字 -->
								<br>
								<span>扫一扫在手机阅读、分享本文</span>
								<!-- 顶部的小图标 -->
								<img class="hat" src="../static/images/qrcode-top_072360e.png" alt="">
							</div>
						</div>

					</li>

					
				</ul>

			</div>
			<div class="right">

				<!-- 右侧上方 的文章排行 -->
				<div class="authornews">
					<div class="info">
						<!-- 放一张作者的头像 -->
						<img src="../static/images/author.jpg" alt="">
						<!-- 作者的名称 -->
						<a href="home.html" target="_blank">小刀马</a><br>
						<!-- 作者的简介 -->
						<p>洞察行业趋势 洞悉企业策略 洞见产业未来</p>
					</div>
					<div class="artlist">

					    <ul>
							<li>
								<!-- 序号 -->
								<span></span>
								<!-- 文字，标题 -->
								<a href="" class="title">联发科坏消息连连，市场份额下滑或再遭三星弃用</a>
							</li>

							<li>
								<!-- 序号 -->
								<span></span>
								<!-- 文字，标题 -->
								<a href="" class="title">联发科坏消息连连，市场份额下滑或再遭三星弃用</a>
							</li>

							<li>
								<!-- 序号 -->
								<span></span>
								<!-- 文字，标题 -->
								<a href="" class="title">联发科坏消息连连，市场份额下滑或再遭三星弃用</a>
							</li>

							<li>
								<!-- 序号 -->
								<span></span>
								<!-- 文字，标题 -->
								<a href="" class="title">联发科坏消息连连，市场份额下滑或再遭三星弃用</a>
							</li>

							<li>
								<!-- 文字，标题 -->
								<a href="" class="title">更多文章></a>
							</li>
																		
					    </ul>

					</div>
				</div>

				<!-- 右侧上方 的文章排行 -->
				<div class="artph">
					<h3>文章排行</h3>
					<div class="artlist">
					    <div class="artbtn">
							<a href="" class="active">日榜</a>
							<a href="">周榜</a>
					    </div>

					   <ul>
					    	<?php for($i=0;$i<count($topArticleArrs);$i++){ 
					    		if($i==0){
					    		?>

							<li>
								<span class="num1"><?php echo $i+1 ?></span>
								<a href=""><?php echo $topArticleArrs[$i]['title']; ?></a>
								<span class="desc">	
									<?php echo $topArticleArrs[$i]['description']; ?>
								</span>
							</li>
							<?php }else{ ?>
							<li>
								<!-- 序号 -->
								<span><?php echo $i+1 ?></span>
								<!-- 文字，标题 -->
								<a href="" class="title"><?php echo $topArticleArrs[$i]['title']; ?></a>
								<!-- 作者 -->
								<a href="" class="author"><?php echo $topArticleArrs[$i]['nicheng']; ?></a>
							</li>
							<?php 
							}
						} ?>														
					    </ul>

					</div>
				</div>


				<!-- 右侧下方 的合并公告的图片 -->
				<div class="notice">
					<img src="../static/images/notice_4adae79.jpg" alt="">
				</div>
			</div>
		</div>
	</div>

	<!-- 百家号首页百家列表news 部分 E -->
	<!-- <div style="clear: both;"></div> -->

	<!-- 百家号首页footer 部分 S -->
	<div class="footer clearfix">
		<div class="container">
			<p class="textbox">相关频道：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新闻首页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新闻首页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新闻首页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;新闻首页</p>
			<p>
				京公网安备11000002000001号 互联网新闻信息服务许可 ©2017 Baidu 使用百度前必读 百家协议
			</p>
		</div>
	</div>
	<!-- 百家号首页footer 部分 E -->

	<!-- 二维码开始S -->
		<div class="qrcodebox container">
				<div class="box">
					<!-- 二维码图片 -->
					<div class="qrcode">
						<!-- 当鼠标移动到二维码盒子上，弹出子盒子 -->
						<div class="sm">
							<img src="../static/images/news-qrcode_8fe3c4d.png" alt="">
							<h3>百家号作者平台APP</h3>
							<ul>
								<li>使用客户端管理更便捷</li>
								<li>使用客户端管理更便捷</li>
								<li>使用客户端管理更便捷</li>
							</ul>
						</div>
					</div>
					<!-- 向上的箭头 -->
					<div class="topindex">
						<a href="#"><img src="../static/images/icon-arrow-up_3a9a52a.png" alt=""></a>
					</div>
				</div>
		</div>
	<!-- 二维码开始E -->

</body>
</html>