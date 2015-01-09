<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

	session_start();

    if (isset($_GET['action'])) {
        if($_GET['action'] == "logout"){  
            unset($_SESSION['uid']);
            unset($_SESSION['username']);
            echo "<script>alert('注销成功，返回首页。');location.href = 'index.php' ;</script>";
            exit;
        } 
    }

	if (isset($_POST['Reg'])) {
		echo "<script>location.href='reg.html';</script>";
	}

	if (!isset($_POST['Login'])) {
		echo "<script>alert('Illegal Access');location.href='login.html';</script>";
	}
	elseif (empty($_POST['username'])||empty($_POST['password'])) {
            echo "<script>alert('Illegal Input.');location.href='login.html';</script>";
    }
        
    $username = htmlspecialchars($_POST['username']);
    $password = MD5($_POST['password']);

    include('config.php');

    $select_uid=mysqli_query($dbindex,"select uid from userdata where username = '$username' and password = '$password' limit 1 ");

    if (@$result = mysqli_fetch_array($select_uid)) {
    	$_SESSION['uid'] = $result['0'];
    	$_SESSION['username'] = $username;
    	echo "<script>alert('Welcome Back $username');location.href = 'index.php';</script>";
    }
    else {
    	echo "<script>alert('Login Failed');location.href = 'login.html';</script>";
    }
?>