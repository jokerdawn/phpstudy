<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></html>

<?php
	if (!isset($_POST['submit'])) {
		echo "<script>alert('Illegal Action');location.href='reg.html';</script>";
		exit();
	}

	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];

	if(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]|[._-]{1,15}$/', $username)){
	    echo "<script>alert('错误：用户名不符合规定！');history.back(-1);</script>";
	    exit();
	}
	if(strlen($password) < 6){
	    echo "<script>alert('错误：密码长度不符合规定！');history.back(-1);</script>";
	    exit();
	}
	if(!preg_match('/^[a-zA-Z]+([a-zA-Z0-9]|[.])+@[a-zA-Z0-9]+(\\.[a-zA-Z0-9]+)([a-zA-Z0-9]|[.])+$/',$email)){
	    echo "<script>alert('错误：电子邮箱格式错误！');history.back(-1);</script>";
	    exit();
	}

	include('config.php');

	$check_query = mysqli_query($dbindex,"select * from userdata where username='$username' limit 1");
	
	if(@mysqli_fetch_array($check_query)){
	   	echo "<script>alert('用户名已存在！');history.back(-1);</script>";
	    exit();
	}

	$password = MD5($password);

	/*echo $username;
	echo $password;
	echo $email;*/

	$sql = "insert into userdata(username,password,email) values('$username','$password','$email')";
	
	if(mysqli_query($dbindex,$sql)){
	    echo "<script>alert('注册成功，请登录！');location.href = 'login.html';</script>";
	} else {
	    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
	    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	    exit();
	}
?>