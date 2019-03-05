<?php 
	require_once "../../public/conn.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		// $page=$_GET['page'];
		$sql="delete from baijia_users where id=".$id;
		$num = $pdo->exec($sql);
		if($num!=false){
			echo "<script>alert('修改成功');location.href='list_users.php';</script>";
		}
		else{
			echo "<script>alert('删除失败！');</script>";
		}
	}
 ?>