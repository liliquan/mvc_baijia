<?php 
session_start();
require_once "../../public/conn.php";
require_once "../../public/functions.php";
$author_id = $_SESSION['author_id'];
$sql = "select * from baijia_author where id=".$author_id;
$pdostmt = $pdo->query($sql);
$authorArr = array();
if($pdostmt!=false){
	$authorArr = $pdostmt->fetch(PDO::FETCH_ASSOC);
	$headimg = $authorArr['operatorer_img'];
}
if(isset($_POST['flag'])){
	$nicheng = $_POST['nicheng'];
	$province = $_POST['province'];
	$city = $_POST['city'];
	$count = $_POST['county'];
	$phoneNum = $_POST['phoneNum'];
	$headImg = $_FILES['headImg'];
	$uploadDir = "../../public/upload/";
	$headImgName = "";

	uploadSingle($headImg,$uploadDir,$headImgName);

	$headImgName = ($headImgName=="") ? $authorArr['head_img'] : $headImgName;


	$author_name = $_SESSION['author_name'];




	$sql = "update baijia_author set 
	nicheng = '{$nicheng}',
	head_img = '{$headImgName}',
	province = '{$province}',
	city = '{$city}',
	county = '{$count}',
	phone_num = '{$phoneNum}',
	last_update_time=now(),
	last_update_user = '{$author_name}'";

	if($authorArr['author_state']==3){
		$operatorName = $_POST['operatorName'];
		$personalIntroduction = $_POST['personalIntroduction'];
		$operatorerImg = $_FILES['operatorerImg'];
		$operatorerImgName = "";
		uploadSingle($operatorerImg,$uploadDir,$operatorerImgName);
		$operatorerImgName = ($operatorerImgName=="") ? $authorArr['operatorer_img'] : $operatorerImgName;

		$sql .= ",operator_name = '{$operatorName}',
		operatorer_img = '{$operatorerImgName}',
		personal_introduction = '{$personalIntroduction}'";
	}

	$sql .= " where id ={$author_id}";
	$num = $pdo->exec($sql);
	if($num!=false){
		echo "<script>alert('修改成功');
		top.location.href='perfect_info.php';</script>";
	}
}

 ?>
<!DOCTYPE html>
<html class=" js csstransforms3d">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>个人信息修改</title>
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/page.css">
	<!--[if lte IE 8]>
	<link href="css/ie8.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.selectui.js"></script>
	<link rel="stylesheet" type="text/css" href="js/webuploader/webuploader.css">    
    <link rel="stylesheet" type="text/css" href="js/webuploader/demo.css">
	
	<script>
		
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
		
	function check(){
		
		if($("#author_type").val()==0){
				
			alert("请选择用户类型！");
			$("#author_type").focus();
			return false;
				
		}else{
			return true;
		}
	
		
		
	}
		
		
	function ajaxLoadData(selectStr,id){
 			
 			//发送ajax请求，获取所有县的数据
 				$.post("ajax-getCityDatas.php",{"pid":id},function(reJson){
 				
 				//alert(reJson);
 				//把json字符串转换为对象
 				var obj = eval("("+reJson+")");
 				//找到县的下拉菜单，默认先添加一个 “--请选择--” 的option
 				$("#"+selectStr).html("<option value=''>--请选择--</option>");
 				//遍历服务器端返回的结果集，通过append方法插入多个选项
 				$.each(obj,function(){
 					//把获取的数据组装显示出来
 					$("#"+selectStr).append("<option value='"+this.id+"'>"+this.name+"</option>");
 					
 				});

 				});
 			
 	}
		
	$(function($) {
		
		$("select").selectui({
			// 是否自动计算宽度
			autoWidth: true,
			// 是否启用定时器刷新文本和宽度
			interval: true
		});
		
		
		//默认获取所有的省
 		ajaxLoadData("provinceSelectId",0)
 			
 		//监听下拉菜单 省的change事件
 		$("#provinceSelectId").change(function(){
 				
 			ajaxLoadData("citySelectId",$(this).val())
 		});
 			
 		//监听下拉菜单 市的change事件
 		$("#citySelectId").change(function(){
 			ajaxLoadData("countySelectId",$(this).val())
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
				<h4>个人信息完善</h4>
				<div class="pubMain">
					<a href="javascript:history.go(-1)" class="backlistBtn"><i class="ico-back"></i>返回列表</a>
					<form action="" method="post" enctype="multipart/form-data">
						
						
						<h5 class="pubtitle">我的昵称</h5>
						<div class="pub-txt-bar">
							<input type="text" name="nicheng" class="shuruTxt"  value="<?php echo $authorArr['username']; ?>">
						</div>
						
						

						<h5 class="pubtitle">我的头像</h5>
						<input type="file" class="shuruTxt" name="headImg">
						<br><br>
						<div class="pub-txt-bar">
							<img src="images/<?php echo "upload/$headimg" ?>" onload="javascript:DrawImage(this,400,400)" >
						</div>
						

						<h5 class="pubtitle">所属地区</h5>

						<div>
						<table>
			              <tr>
			              <td>
			                <div class="pubselect">
			                <select name="province"  id="provinceSelectId" style="height: 37px;width: 140px;">
			                <option value="">--请选择省--</option>
			                <option value="湖南省">--湖南省--</option>
			                <option value="江苏省">--江苏省--</option>
			                </select>
			                </div>
			              </td>
			              <td><span class="select_text_ui" style="min-width: 6em;"> 省 </span></td>

			              <td>
			                <div class="pubselect">
			                <select name="city" id="citySelectId" style="height: 37px;width: 140px;">
			                <option value="">--请选择市--</option>
			                <option value="岳阳">--岳阳--</option>
			                <option value="宿迁">--宿迁--</option>
			                </select>
			                </div>

			              </td>
			              <td><span class="select_text_ui" style="min-width: 6em;"> 市 </span></td>
			              <td>
			                <div class="pubselect">
			                <select name="county" id="countySelectId" style="height: 37px;width: 140px;">
			                  <option value="">--请选择县--</option>
			                  <option value="岳阳县">--岳阳县--</option>
			                  <option value="沭阳县">--沭阳县--</option>
			                </select>
			                </div>
			              </td>
			              <td><span class="select_text_ui" style="min-width: 6em;"> 县 </span></td>
			              </tr>
			            </table>

						</div>
						
						<h5 class="pubtitle">我的电话号码</h5>
						<div class="pub-txt-bar">
							<input type="text" name="phoneNum" class="shuruTxt"  value="<?php echo $authorArr['phone_num']; ?>">
						</div>
						
						<?php if($authorArr['author_state']==3){ ?>
						<h5 class="pubtitle">运营者姓名</h5>
						<div class="pub-txt-bar">
							<input type="text" name="operatorName" class="shuruTxt"  value="<?php echo $authorArr['operator_name']; ?>">
						</div>
						
						<h5 class="pubtitle">运营者证件号码</h5>
						<div class="pub-txt-bar">
							<input type="text" name="operatorIds" readonly class="shuruTxt" value="<?php echo $authorArr['operator_ids']; ?>">
						</div>
						
						<h5 class="pubtitle">运营者证件照片</h5>
						<input type="file" class="shuruTxt" name="operatorerImg">
						<br><br>
						<div class="pub-txt-bar">
							<img src="images/<?php echo "upload/$headimg" ?>" onload="javascript:DrawImage(this,400,400)" >
						</div>
						
						<h5 class="pubtitle">作家签名</h5>
						<div class="pub-article-cont">
						
						<textarea name="personalIntroduction" class="form-control txt" style="border: 1px solid #ccc; width: 62%; padding: 10px;" cols="45" rows="5"><?php echo $authorArr['personal_introduction']; ?></textarea>
						
						</div>
						
						<h5 class="pubtitle">我的邀请码</h5>
						<div class="pub-txt-bar">
							<input type="text" name="inviteCode" class="shuruTxt" readonly value="xxxxxxxx">
						</div>
						<?php } ?>
						
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

<script type="text/javascript">
// 添加全局站点信息
var BASE_URL = '/webuploader';
</script>
<!--引入JS-->
<script type="text/javascript" src="js/webuploader/webuploader.js"></script>
<script type="text/javascript" src="js/webuploader/demo.js"></script>
<script type="text/javascript" src="js/zxxFile.js" ></script>
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