<?php 
	require_once "../../public/conn.php";
	$uname = $_POST['name'];
	$sql = "select id from baijia_author where username ='{$uname}'";

	$pdostmt=$pdo->query($sql);
	if($pdostmt->rowCount()>0){
		echo 1;
	}else{
		echo 0;
	}
 ?>