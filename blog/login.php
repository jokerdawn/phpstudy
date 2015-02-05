<html>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<!--style></style-->	
		<!--link rel=stylesheet type="text/css" href="css/home-style.css"-->
		<title>JD's Blog</title>
	</head>
	<body>
		<form method = 'POST'>
			用户名：<input type = 'text' name = 'name'></br>
			密码：<input type = 'password' name = 'pwd'></br> 
			<input type = 'submit' value = '登录' name = 'submit'>
		</form>
	</body>
<html>

<?php 
	//echo MD5('test123');
	session_start();

	include("config.php");

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