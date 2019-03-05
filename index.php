<?php 
require_once "public/conn.php";
require_once "public/functions.php";
$sql = "select be.*,br.nicheng from baijia_article be,baijia_author br where be.author_id = br.id order by id desc limit 10";
$pdostmt = $pdo->query($sql);
$articleArrs = array();
if($pdostmt!=false){
	$articleArrs = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
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

$sql="select id,title,article_img,article_content from baijia_article where is_top=1 order by id desc limit 4";
$pdostmt=$pdo->query($sql);
$art4Arr= array();
if($pdostmt!=false){
	$art4Arr=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>百家号-首页（传智专修学院出品）</title>
	<!-- 引入公共的css文件 common.css -->
	<link rel="stylesheet" href="static/css/common.css">
	<!-- 引入清除默认样式的css文件  reset.css-->
	<link rel="stylesheet" href="static/css/reset.css">
	<!-- 引入首页对应的css文件      index.css-->
	<link rel="stylesheet" href="static/css/index.css">
	<link rel="stylesheet" href="static/css/style.css">
	<script src="static/js/koala.min.1.5.js"></script>
<style>

	/*html{
		
		filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
		-webkit-filter:grayscale(100%);
	}*/

</style>

</head>
<body>
	
	<!-- 百家号首页header 部分 S -->
	<div class="header">
		<!-- 居中盒子 -->
		<div class="container">
			<!-- 左left -->
			<div class="left">
				<img src="static/images/logo.png" alt="">
				<a href="index.php" class="active">首页</a>
				<?php for($i=0;$i<count($typeArr);$i++){
					echo "<a href='channer.php?cet=".$typeArr[$i]['id']."'>".$typeArr[$i]['article_typename']."</a>";
				} ?>
				

			</div>
			<!-- 右right -->
			<div class="right">
				<a href="#">进入百家号写作平台</a>
				<a href="protal/login/login.php">登录</a>
				<a href="#">百度首页</a>
			</div>
		</div>
	</div>
	<!-- 百家号首页header 部分 E -->


	<!-- 百家号首页百家争鸣bjzm 部分 S -->
	<div class="bjzm">
		<div class="container">
			<!-- 左边 幻灯（焦点） -->
			<div class="left">
				<!-- 放置图片 -->
				<div id="fsD1" class="focus">

	<div id="D1pic1" class="fPic">
		<?php 
		for($i=0;$i<count($art4Arr);$i++){
			$imgStr="";
			if($art4Arr[$i]['article_img']!=""){
				$imgStr="public/upload/".$art4Arr[$i]['article_img'];
			}else{
				$img="";
				$img = getImgs($art4Arr[$i]['article_content'],0);
				if($img!=""){
					$imgStr=$img;
				}else{
					$imgStr="public/upload/img_5a658a0fafc19.jpg";
				}
			}


		 ?>
		<div class="fcon">
			<a href="protal/content.php?id=<?php echo $art4Arr[$i]['id'] ?>"><img src="<?php echo $imgStr ?>" /></a>
			<span class="shadow"><a href="protal/content.php?id=<?php echo $art4Arr[$i]['id'] ?>"><?php echo $art4Arr[$i]['title']; ?></a></span>
		</div>
		<?php } ?>
	</div>
	
	<div class="fbg">
		<div class="D1fBt" id="D1fBt">
			<a href="javascript:void(0)" class="current"><i>1</i></a>
			<a href="javascript:void(0)"><i>2</i></a>
			<a href="javascript:void(0)"><i>3</i></a>
			<a href="javascript:void(0)"><i>4</i></a>
		</div>
	</div>
	
	<span class="prev"></span>
	<span class="next"></span>
	
</div>

	<script type="text/javascript">
	Qfast.add('widgets', { path: "static/js/terminator2.2.min.js", type: "js", requires: ['fx'] });  
	Qfast(false, 'widgets', function () {
		K.tabs({
			id: 'fsD1',   //焦点图包裹id  
			conId: "D1pic1",  //** 大图域包裹id  
			tabId:"D1fBt",  
			tabTn:"a",
			conCn: '.fcon', //** 大图域配置class       
			auto: 1,   //自动播放 1或0
			effect: 'fade',   //效果配置
			eType: 'click', //** 鼠标事件
			pageBt:true,//是否有按钮切换页码
			bns: ['.prev', '.next'],//** 前后按钮配置class                          
			interval: 3000  //** 停顿时间  
		}) 
	})  
	</script>
			</div>
			<!-- 右边 百家争鸣  -->
			<div class="right">
				<!-- 透明的遮罩效果 -->
				<img class="bgimg" src="static/images/3ac79f3df8dcd10016d2c088788b4710b8122fc8.jpg" alt="">
				<div class="vsbox">
					<!-- 往期专题 -->
					<div class="wqzt">
						<a href="#">往期专题></a>
					</div>
					<!-- 百家争鸣的图片 -->
					<div class="bjzmimg">
						<img src="static/images/topiclogo_c3fb241.png" alt="">
					</div>
					<!-- 标题 -->
					<a href="protal/vs.html"><h2>王者荣耀是毒药？</h2></a>
					<!-- vs的数据 -->
					<div class="duibi">
						<!-- 左边的数字 -->
						<div class="fl">
							<span>75%</span><br>
							严肃惩治
						</div>
						<!-- 右边的数字 -->
						<div class="fr">
							<span>25%</span><br>
							不应苛刻
						</div>
						<!-- 中间的线 -->
						<div class="line">
							<div class="blueline"></div>
						</div>
						<!-- vs的小图片 -->
						<div class="vsimg">
							<img src="static/images/topic_vs_ef1a221.png" alt="">
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 百家号首页百家争鸣bjzm 部分 E -->

	<!-- 百家号首页新闻列表news 部分 S -->
	<div class="news">
		<div class="container">
			<div class="left">
				<!-- 新闻列表 -->
				<ul>
					 <?php for($i=0;$i<count($articleArrs);$i++){

					 $imgArrs = getImgs($articleArrs[$i]['article_content']);

					 if($articleArrs[$i]['article_img']!=""){ ?>
					<li>
						<!-- 标题 -->
						<h3><a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['title'] ?></a></h3>
						<!-- 图片 -->
						<div>
							<!-- 三张图片 -->
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><img src="/public/upload/<?php echo $articleArrs[$i]['article_img'] ?>" alt=""></a>
							<!-- 查看详情 -->
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>" class="more">查看详情></a>
						</div>
						<!-- 作者 发布时间 -->
						<p>
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['nicheng'] ?></a>   <?php echo substr($articleArrs[$i]['add_time'],-8,5) ?>     阅读 (<?php echo $articleArrs[$i]['read_num'] ?>) # 分享 # # #
						</p>
					</li>
					<?php }else if(count($imgArrs)<3){ ?>


					<li class="singleimg clearfix">
						<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><img src="/public/upload/img_5a658a0fafc19.jpg" alt=""></a>
						<!-- 标题 -->
						<h3><a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['title'] ?></a></h3>
						<!-- 作者 发布时间 -->
						<p>
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['nicheng'] ?></a>   <?php echo substr($articleArrs[$i]['add_time'],-8,5) ?>      阅读 (<?php echo $articleArrs[$i]['read_num'] ?>) # 分享 # # #
						</p>
					</li>
					<?php }else{ ?>

					<li>
						<!-- 标题 -->
						<h3><a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['title'] ?></a></h3>
						<!-- 图片 -->
						<div>
							<!-- 三张图片 -->
							<?php for($j=0;$j<3;$j++){ ?>
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><img src="<?php echo $imgArrs[$j]; ?>" alt=""></a>
							<?php } ?>
							<!-- 查看详情 -->
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>" class="more">查看详情></a>
						</div>
						<!-- 作者 发布时间 -->
						<p>
							<a href="protal/content.php?id=<?php echo $articleArrs[$i]['id'] ?>"><?php echo $articleArrs[$i]['nicheng'] ?></a> <?php echo substr($articleArrs[$i]['add_time'],-8,5) ?>  阅读 (<?php echo $articleArrs[$i]['read_num'] ?>) # 分享 # # #
						</p>
					</li>

			<?php
				
			}	
		} ?>

				</ul>

			</div>
			<div class="right">

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
					<img src="static/images/notice_4adae79.jpg" alt="">
				</div>
			</div>
		</div>
	</div>

	<!-- 百家号首页百家列表news 部分 E -->

	<!-- 百家号首页新闻更多morenews 部分 S -->
	<div class="container clearfix">
		<div class="viewmore">
				<a href="#">查看更多</a>
		</div>
	</div>
	<!-- 百家号首页百家列表morenews 部分 E -->

	<!-- 百家号首页footer 部分 S -->
	<div class="footer">
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
							<img src="static/images/news-qrcode_8fe3c4d.png" alt="">
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
						<a href="#"><img src="static/images/icon-arrow-up_3a9a52a.png" alt=""></a>
					</div>
				</div>
		</div>
	<!-- 二维码开始E -->

</body>
</html>