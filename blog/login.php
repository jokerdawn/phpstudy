<html>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<style>
			body{
			    margin:0;
			    padding:0;
			    width:100%;
			    height:100%;
			}
			#login-panel {
			   	position:absolute;
			   	top:34%;
			   	left:38%;
			    width:24%;
			    height:16%;
			}
			#login-panel form {
				border: 1px solid gray;
				padding: 20px 0px 20px 10px;
			}
			#login-panel input {
				padding: 0;
				margin:0;
			}
		</style>	
		<script type="text/javascript">
		</script>
		<link rel=stylesheet type="text/css" href="css/common.css">
		<title>JD's Blog</title>
	</head>
	<body>
		<div id = 'login-panel'>
			<form method = 'POST'>
				<div style = 'float:right;margin-right:20%;margin-bottom:5%'>用户名：<input type = 'text' name = 'name'></div>
				<div style = 'float:right;margin-right:20%;margin-bottom:5%'>密码：  <input type = 'password' name = 'pwd'></div>
				<div style = 'text-align:center'>
					<input style = 'width:25%' type = 'submit' value = '登录' name = 'submit'>
					<button style = 'width:25%;padding:0;' type = 'button' name = 'reg' onclick = "location.href='reg.php';">注册</button>
				</div>
			</form>
		</div>
	</body>
<html>

<?php 
	session_start();

	include("config.php");

	if(@$_GET['unlog'] == 'unlog'){
		session_unset();
		echo "<script>location.href='index.php';</script>";
	}

	if(!isset($_POST['submit'])){
		exit();
	}

	if(empty($_POST['name'])) {
		echo "<script>alert('请输入用户名');</script>";
		exit();
	}

	if(empty($_POST['pwd'])) {
		echo "<script>alert('请输入用户名');</script>";
		exit();
	}

	$name = $_POST['name'];
    $password = MD5($_POST['pwd']);

    //echo $name.'	'.$password;

	$sql = "SELECT uid,auth,nickname,email from userdata where name = '$name' and pwd = '$password'";

	$result = mysqli_query($dbindex,$sql);

	if ($result = mysqli_fetch_array($result)) {
    	$_SESSION['uid'] = $result['uid'];
    	$_SESSION['name'] = $name;
        $_SESSION['auth'] = $result['auth'];
        $_SESSION['nickname'] = $result['nickname'];
        $_SESSION['email'] = $result['email'];
    	echo "<script>alert('欢迎回来 $name');window.location.href ='index.php';close();</script>";
    	exit();
    }
    else {
    	echo mysqli_error($dbindex);
    	echo "<script>alert('登录失败，用户名或者密码错误！');history.back();</script>";
    	exit();
    }