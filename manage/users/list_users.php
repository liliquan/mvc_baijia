<?php 
	session_start();
	require_once "../../public/conn.php";

	/********处理搜索的逻辑开始 *******/
	$likeStr = "";
	$keyword = "";
	if(isset($_GET['keyword'])){
		//接收用户输入的关键字
		$keyword = $_GET['keyword'];
		//把关键字连接到sql语句中
		$likeStr .= " and (username like '%{$keyword}%'  or user_type like '%{$keyword}%')";

	}
	/********处理搜索的逻辑结束 *******/

	/******分页代码开始********/
	// 当前页 $nowPage 
	$nowPage = isset($_GET['page'])?$_GET['page']:1;
	// 总记录数：$totalCount
	$sql = "select id from baijia_users where 1=1 ".$likeStr;	

	$pdostmt = $pdo->query($sql);
	$totalCount = $pdostmt->rowCount();
	
	// 每页大小：config 文件 PAGESIZE 常量
	// 总页数：$pages = 上取整(总记录数/每页大小)
	$pages = ceil($totalCount / PAGESIZE);
	// limit   ($nowPage-1)*$pageSize , $pageSize;
	$limitStr = " limit ".($nowPage-1)*PAGESIZE." , ".PAGESIZE;
	/******分页代码结束********/

	$sql = "select * from baijia_users where 1 = 1 ".$likeStr." order by id desc";
	//把当前的sql语句连接上limit语句，实现限制记录数
	$sql = $sql.$limitStr;


	$pdostmt = $pdo->query($sql);
	//定义$list 数组保存查询结果
	$lists = array();
	//判断是否查询成功
	if($pdostmt != false){
		$lists = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
	}
 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d"><head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>用户列表</title>
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/modernizr.js"></script>
	<script type="text/javascript">
		//ajax异步保存置顶状态	
		function saveState(user_id,state){
		$.post("ajax_saveState.php",{"s":state,"user_id":user_id,"r":Math.random()},function(reText){
			
				if(reText*1){
					
					alert("操作成功！");
				   if(state){
						$("#Top"+user_id).attr("onClick","javascript:saveState("+user_id+",1)");
						$("#Top"+user_id).html("解禁");
					  
					}else{
						$("#Top"+user_id).attr("onClick","javascript:saveState("+user_id+",0)");
						$("#Top"+user_id).html("禁用");
						
					}
	
				}	
					   
			});
		}	
		
		function comfirmDel(user_id){
			
			if(confirm("您确定要删除数据吗？")){
				
				location.href="del_users.php?id="+user_id;
				
			}
			
		}
	</script>
	<!--[if IE]>
	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>

<body style="background: #f6f5fa;">

	<!--content S-->
	<div class="super-content RightMain" id="RightMain">
		
		<!--header-->
		<div class="superCtab">
			<div class="ctab-title clearfix"><h3>用户管理</h3><a href="javascript:;" class="sp-column"><i class="ico-mng"></i>栏目管理</a></div>
			
			<div class="ctab-Main">
				<div class="ctab-Main-title">
				
					<ul class="clearfix">
						
						
						<li class="cur">用户列表</li>
						
						
					</ul>
				</div>
				
				<div class="ctab-Mian-cont">
					<div class="Mian-cont-btn clearfix">
						<div class="operateBtn">
							<a href="add_users.php" class="greenbtn publish">添加用户</a>
						
						</div>
						<!-- 关键字搜索 -S -->
						<div class="searchBar">
							<form action="" method="get">
							<input type="text" name="keyword" class="form-control srhTxt" placeholder="输入标题关键字搜索">
							<input type="submit" class="srhBtn" value="">
							</form>
						</div>
						<!-- 关键字搜索 -E-->
					</div>
					
					
					<div class="Mian-cont-wrap">
					<div class="defaultTab-T">
						<table border="0" cellspacing="0" cellpadding="0" class="defaultTable">
							<tbody><tr><th class="t_1">ID</th><th class="t_1">账号名称</th><th class="t_1">类型</th><th class="t_3">注册时间</th><th class="t_4">操作</th></tr>
						</tbody></table>
					</div>
					<table border="0" cellspacing="0" cellpadding="0" class="defaultTable defaultTable2">
						<tbody>
						<?php 
							for($i=0;$i<count($lists);$i++){
						 ?>
						<tr>
							<td class="t_1"><?php echo $lists[$i]['id']; ?></td>
							<td class="t_1"><a href="#"><?php echo $lists[$i]['username']; ?></a></td>
							<td class="t_1"><?php echo $lists[$i]['user_type']; ?></td>
							<td class="t_3"><?php echo $lists[$i]['add_time']; ?></td>
							<td class="t_4"><div class="btn">
							<?php if($lists[$i]['user_state']==1){ ?>
							<a class="Top" id="Top5" onClick="javascript:saveState(5)">禁用</a>
							<?php }else{ ?>
							<a class="Top" id="xx" onClick="javascript:saveState(5,0)">解禁</a>
							<?php } ?>
							<a href="edit_users.php?id=<?php echo $lists[$i]['id']; ?>" class="modify">修改</a><a href="javascript:comfirmDel(<?php echo $lists[$i]['id']; ?>)" class="delete">删除</a></div></td>
						</tr>

						<?php 
							}
						 ?>

					</tbody></table>
						<!--pages S-->
						
						<div class="pageSelect">
							<span>共 <b><?php echo $totalCount; ?></b> 条 每页 <b><?php echo PAGESIZE; ?></b> 条   <?php echo $nowPage; ?>/<?php echo $pages; ?></span>
							<div class="pageWrap">
								<!-- 上一页 -->
								<?php if($nowPage!=1){ ?>
								<a class="pagePre" href="list_users.php?page=<?php echo $nowPage-1; ?>&keyword=<?php echo $keyword; ?>"><i class="ico-pre">&nbsp;</i></a>
								<?php 
								}
								//循环遍历输出页码
								for($i=1;$i<=$pages && $i<=10;$i++){ 

								?>
								<a href="list_users.php?page=<?php echo $i; ?>&keyword=<?php echo $keyword; ?>" class="pagenumb <?php if($i==$nowPage) echo 'cur'; ?>"><?php echo $i; ?></a>
								<?php 
							    }
 								
							    if($nowPage<$pages){
							     ?>
								<!-- 下一页 -->
							<a href="list_users.php?page=<?php echo $nowPage+1; ?>&keyword=<?php echo $keyword; ?>" class="pagenext"><i class="ico-next">&nbsp;</i></a>
							<?php
							 }
							 ?>
							
							</div>
						</div>
						<!--pages E-->
					</div>
				
				</div>
			</div>
		</div>
		<!--main-->
		
	</div>
	<!--content E-->
	
	<div class="layuiBg"></div><!--公共遮罩-->
	<!--点击修改弹出层-->
	<div class="imgXgbox layuiBox">
		<div class="layer-title clearfix"><h2>修改栏目图片</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="XgfileImg"><img src="../images/bg_img_sc.jpg"><input id="fileImage" class="fileImageSlect" type="file" size="30" name="fileselect[]"></div>
			<p class="onclktip">（点击图片可重新上传）</p>
			<div class="Xgimglink clearfix"><span>图片链接：</span><input type="text" value=""></div>
			<div class="XgBtn"><input type="button" value="保存" class="saveBtn"></div>
		</div>
	</div>
	<!--点击添加分类弹出-->
	<div class="addFeileibox layuiBox">
		<div class="layer-title clearfix"><h2>添加分类</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="aFllink clearfix"><span>上级栏目：</span><h5>根级目录</h5></div>
			<div class="aFllink clearfix"><span>二级栏目：</span><input type="text" id="articleTypeName" value=""></div>
			<div class="aFlBtn"><input type="button" value="保存" id="saveArticleTypeBtn" class="saveBtn"></div>
		</div>
	</div>
	<!--栏目管理-->
	<div class="Columnbox layuiBox">
		<div class="layer-title clearfix"><h2>栏目管理</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<ul class="colu-title clearfix">
				<li class="li-1">栏目名称</li><li class="li-2">英文名称</li><li class="li-3">操作</li><li class="li-4">同步开关</li>
			</ul>
			<div class="colu-list">
				<ul class="colu-cont clearfix active">
					<li class="li-1"><i class="ico"></i>新闻动态</li><li class="li-2">life</li><li class="li-3"><a href="javascript:;" class="colu-xg" data-id="xg1">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d1" class="chk_4"><label for="checkbox_d1"></label></li>
				</ul>
				<div class="colunext" style="display: block;">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg" data-id="xg2">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--新闻动态-->
			<div class="colu-list">
				<ul class="colu-cont clearfix">
					<li class="li-1"><i class="ico"></i>品尚生活</li><li class="li-2">news</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d2" class="chk_4"><label for="checkbox_d2"></label></li>
				</ul>
				<div class="colunext">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--品尚生活-->
			<div class="colu-list">
				<ul class="colu-cont clearfix">
					<li class="li-1"><i class="ico"></i>卓越联盟</li><li class="li-2">allance</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d3" class="chk_4"><label for="checkbox_d3"></label></li>
				</ul>
				<div class="colunext">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--卓越联盟-->
			<div class="colu-list">
				<ul class="colu-cont clearfix">
					<li class="li-1"><i class="ico"></i>招贤纳士</li><li class="li-2">managers</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d4" class="chk_4" checked=""><label for="checkbox_d4"></label></li>
				</ul>
				<div class="colunext">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--招贤纳士-->
			<div class="colu-list">
				<ul class="colu-cont clearfix">
					<li class="li-1"><i class="ico"></i>客户见证</li><li class="li-2">witness</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d5" class="chk_4" checked=""><label for="checkbox_d5"></label></li>
				</ul>
				<div class="colunext">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--客户见证-->
			<div class="colu-list">
				<ul class="colu-cont clearfix">
					<li class="li-1"><i class="ico"></i>热门产品</li><li class="li-2">product</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"><input type="checkbox" id="checkbox_d6" class="chk_4" checked=""><label for="checkbox_d6"></label></li>
				</ul>
				<div class="colunext">
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
					<ul class="colu-next clearfix">
						<li class="li-1"><i class="ico"></i>行业新闻</li><li class="li-2"></li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li>
					</ul>
				</div>
			</div><!--热门产品-->
			<div class="colu-list">
				<ul class="clearfix colu-cont-no">
					<li class="li-1"><i class="ico"></i>关于我们</li><li class="li-2">about</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"></li>
				</ul>
			</div><!--关于我们-->
			<div class="colu-list">
				<ul class="clearfix colu-cont-no">
					<li class="li-1"><i class="ico"></i>联系方式</li><li class="li-2">contact</li><li class="li-3"><a href="javascript:;" class="colu-xg">修改</a></li><li class="li-4"></li>
				</ul>
			</div><!--联系方式-->
			
		</div>
	</div>
	<!--栏目管理－修改-->
	<div class="ColumnXgbox layuiBox">
		<div class="layer-title clearfix"><h2>添加分类</h2><span class="layerClose"></span></div>
		<div class="layer-content">
			<div class="aFllink clearfix"><span>修改名称：</span><input type="text" value=""></div>
			<div class="aFllink clearfix"><span>英文名称：</span><input type="text" value=""></div>
			<div class="aFlBtn"><input type="button" value="保存" class="saveBtn"></div>
		</div>
	</div>

<script>
	//ajax异步保存文章分类内容
	$(function(){
		
		$("#saveArticleTypeBtn").click(function(){
			//发送ajax异步请求
			$.post("ajax_saveArticleType.php",{"typeName":$("#articleTypeName").val()},function(reText){
				//判断返回值是否>0,如果大于0表示保存成功
				if(reText*1){
					
					alert("新类别保存成功！");
				}
			});
		});
		
	});
</script>

</body></html>