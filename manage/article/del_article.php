<?php 
	require_once "../../public/conn.php";
	if(isset($_GET['article_id'])){
		$article_id=$_GET['article_id'];
		// $page=$_GET['page'];
		$sql="delete from baijia_article where id=".$article_id;
		$num = $pdo->exec($sql);
		if($num!=false){
			echo "<script>alert('修改成功');location.href='list_article.php';</script>";
		}
		else{
			echo "<script>alert('删除失败！');</script>";
		}
	}
 ?>