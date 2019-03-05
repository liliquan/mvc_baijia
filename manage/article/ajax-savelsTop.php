<?php 
	require_once "../../public/conn.php";
	$laid = $_GET['laid'];
	$value =$_GET['value'];
	$sql = "update baijia_article set is_top= {$value} where id={$laid}";

	$num = $pdo->exec($sql);
	if($num!=false){
		echo $num;
	}else{
		echo 0;
	}
 ?>