<?php
	session_start();
	$name = $_SESSION['username'];
	header("content-Type: text/html; charset=utf-8");
	include("config.php");
	$patch = $_POST['content'];
	$content = str_replace("\r\n","</br>",$patch); //\r\n 代表输入时候的空格以及到下一行的光标
	$sql = "insert into content (name,content) values ('$name','$content')";
	mysqli_query($dbindex,$sql);
	echo "<script>alert('提交成功！返回首页。');location.href='index.php';</script>";
?>