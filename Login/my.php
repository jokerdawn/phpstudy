<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	//检测是否登录，若没登录则转向登录界面
	if(!isset($_SESSION['userid'])){
	    header("Location:login.html");
	    exit();
	}

	//包含数据库连接文件
	include('conn.php');
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$user_query = mysqli_query($dbindex,"select * from userdata where userid=$userid limit 1");
	$row = mysqli_fetch_array($user_query);
	echo '用户信息：<br />';
	echo '用户ID：',$userid,'<br />';
	echo '用户名：',$username,'<br />';
	echo '邮箱：',$row['email'],'<br />';
	//echo $row['regdata'];
	echo '注册日期：',date("Y年n月j日",strtotime($row['regdata'])),'<br />'; //strtotime — 将任何英文文本的日期时间描述解析为 Unix 时间戳
	echo '<a href="login.php?action=logout">注销</a>';
?>