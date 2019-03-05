<?php 
session_start();
session_destroy();
setCookie("author_pwd","",time()-1);
setCookie("author_name","",time()-1);
header("location:login.php");
 ?>