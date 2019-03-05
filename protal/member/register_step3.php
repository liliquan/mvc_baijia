<?php 
session_start();
require_once "../../public/conn.php";
require_once "../../public/functions.php";
  if(isset($_POST['flag'])){
    $domain = $_POST['domain'];
    $name = $_POST['name'];
    $qianming = $_POST['qianming'];
    $phonenum = $_POST['phonenum']; 
    $province = $_POST['province'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $yunyingname = $_POST['yunyingname'];
    $yunyingid = $_POST['yunyingid'];
    $yaoqingma = $_POST['yaoqingma'];


    $uname = $_SESSION['author_name'];
    $author_id = $_SESSION['author_id'];
    $type = $_GET['type'];


    $fhead = ($_FILES['headimg']);
    $fidcardimg = ($_FILES['idcardimg']);


    $uploadDir = "../../public/upload/";
    $headimg = "";
    $idcardimg = "";
    if(!(uploadSingle($fhead,$uploadDir,$headimg) && uploadSingle($fidcardimg,$uploadDir,$idcardimg))){
      echo "上传失败~";
      exit();
    };

    $sql = "update baijia_author set 
    user_type = '{$type}',
    author_domain = '{$domain}',
    nicheng = '{$name}',
    head_img = '{$headimg}',
    personal_introduction = '{$qianming}',
    province = '{$province}',
    city = '{$city}',
    county = '{$county}',
    phone_num = '{$phonenum}',
    invite_code = '{$yunyingname}',
    operator_name = '{$yunyingname}',
    operator_ids = '{$yunyingid}',
    operatorer_img = '{$idcardimg}',
    last_update_time = now(),
    last_update_user = '{$uname}',
    author_state = 3
    where id = {$author_id}
    ";
    $num = $pdo->exec($sql);
    if($num!=false){
      echo "<script>alert('恭喜您升级为作家!');
      location.href='main.php';</script>";
    }else{
      echo "<script>alert('更新失败! 请重新提交!');
      location.href='register_step3.php?type={$type}';</script>";
    }

  };
 ?>

<!DOCTYPE html>
<html><head>
  <meta charset="UTF-8">
  <meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>成为作家（STEP2）</title>
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/login.css">
  <script src="js/jquery.min.js"></script>
	<style>
		.text1{
			font-size: 10px;
		}
		.trHeight{
			height: 30px;
			
		}
	</style>
  <script>
    $(function(){
      $(".loginbtn").click(function(){
        $("#registerForm").submit();
      });
    });
  </script>
</head>
<body>
<div class="superlogin"></div>
<form action="" id="registerForm" method="post" enctype="multipart/form-data">
<div class="loginBox">
	<div class="resetpsw">成为作家</div>
	<div class="stepBar">
		<img src="images/login_step_2.png">
	</div>
	<div class="loginMain loginMain2" style="width: 50%;height: 900px;">
		<div class="tabwrap">
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tbody>
			<tr>
			  <td><i class="ico-error"></i><span class="errorword">STEP2 填写必要信息：</span></p>
		      <p>&nbsp;</p></td></tr>
			<tr>
			  <td class="title2">
				
			  <table width="100%" align="center" border="0">
  <tbody>
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>领域:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left">
        <select name="domain" id="domain" style="height: 37px;width: 150px;">
              <option value="0">--请选择领域--</option>
              <option value="新闻" >新闻</option>
              <option value="娱乐" >娱乐</option>
              <option value="体育" >体育</option>
              <option value="财经" >财经</option>
              <option value="军事" >军事</option>
              <option value="人文" >人文</option>
              <option value="科技" >科技</option>
              <option value="互联网" >互联网</option>
              <option value="数码" >数码</option>
              <option value="社会" >社会</option>
              <option value="汽车" >汽车</option>
              <option value="房产" >房产</option>
              <option value="旅游" >旅游</option>
              <option value="女人" >女人</option>
              <option value="情感" >情感</option>
              <option value="时尚" >时尚</option>
              <option value="星座" >星座</option>
              <option value="美食" >美食</option>
              <option value="生活" >生活</option>
              <option value="育儿" >育儿</option>
              <option value="影视" >影视</option>
              <option value="音乐" >音乐</option>
              <option value="动漫" >动漫</option>
              <option value="搞笑" >搞笑</option>
              <option value="教育" >教育</option>
              <option value="文化" >文化</option>
              <option value="宠物" >宠物</option>
              <option value="游戏" >游戏</option>
              <option value="家居" >家居</option>
              <option value="悦读" >悦读</option>
              <option value="艺术" >艺术</option>
              <option value="摄影" >摄影</option>
              <option value="健康" >健康</option>
              <option value="养生" >养生</option>
              <option value="科学" >科学</option>
              <option value="三农" >三农</option>
              <option value="政务" >政务</option>
              <option value="职场" >职场</option>
              <option value="综合" >综合</option>
              </select>
              <br>
      <span class="text1">领域提交后不可修改，明确擅长的创作领域，发文和所选领域一致有助于提高作者等级</span>
      </td>
    </tr>
   
   <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>百家号名称:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="name" class="form-control txt">
      <span class="text1">2~10个字，使用与发文领域相关名称，能有效提升读者点击量。示例，昧姐说电影百家号命名规范</span></td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>百家号签名:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="qianming" class="form-control txt">
      <span class="text1">10~20个字，将显示在个人主页。签名准确描述文章风格，有助于加强读者对您的了解。示例，专注科幻电影解说</span>
      </td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>设置头像:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="file" name="headimg" class="form-control txt">
      <span class="text1">上传跟领域相关的头像，有助于建立您的百家号品牌，要求清晰、健康、代表品牌形象；
请勿使用二维码、政治敏感及色情图片；
图片格式支持bmp,jpeg,jpg,png；200X200像素，不可大于5MB</span>
      </td>
    </tr>
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>所在地:</p>
        </td>
      <td width="80%" align="left">
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

      </td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>邀请码:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="yaoqingma" class="form-control txt"><span class="text1">没有可不写</span></td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>运营者姓名:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="yunyingname" class="form-control txt">
      <span class="text1">请与身份证姓名保持一致，如果名字包含分隔号"."，请勿忽略</span></td>
    </tr>

    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>手机号码:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="phonenum" class="form-control txt">
      <span class="text1">请输入您的手机号,保持手机畅通</span></td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>运营者身份证:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="text" name="yunyingid" class="form-control txt">
      <span class="text1">请确保身份证号和身份证姓名对应，同一个身份证号允许申请3个百家号</span>
      </td>
    </tr>
    
    <tr>
      <td width="20%" align="center" valign="top" class="title2"><p>手持身份证:</p>
        <p>&nbsp;</p></td>
      <td width="80%" align="left"><input type="file" name="idcardimg" class="form-control txt">
      <span class="text1">请拍摄免冠正面照，身份证单手举在面部右侧，请勿用前置摄像头
高度过肩，勿遮挡面部和身份证有效信息
确保包括身份证号在内的图片信息清晰可见，大小不超过5MB 上传
</span></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <br><br>
      <input type="hidden" value="1" name="flag">
      <input type="button" class="loginbtn" value="提交"></td>
      </tr>
  </tbody>
</table></td></tr>
			
					
		</tbody></table>
		</div>
	</div>
</div>
</form>
<div class="footer">Copyright © 2010-2015 uimaker  All Rights Reserved.</div>


</body></html>