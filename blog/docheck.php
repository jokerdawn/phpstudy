<META http-equiv="charset" content="UTF-8"/>

<?php
	switch ($_GET['meta']) {
		case 'user':
			cuser($_GET['value']);
		break;

		case 'nickname':
			cname($_GET['value']);
		break;

		case 'pwd':
			cpwd($_GET['value']);
		break;

		case 'email':
			cemail($_GET['value']);
		break;

		default:
			# code...
		break;
	}

	function cuser($a) {
		//echo $a;
		include("config.php");
		$user = $a;
		
		if(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]|[._-]{2,15}$/', $user)){
		    echo "<font color='red'>不符合命名规则</font>"; 
		    exit();
		}

		$sql = "SELECT * FROM userdata WHERE name = '$user'";
		$query = mysqli_query($dbindex,$sql);
		$row = mysqli_fetch_row($query);
		if($row > 0 ){
		 	echo '<font color="red">该用户名已被使用</font>';
		}
		else{
		 	echo '<font color="green">该用户名可使用</font>';
		}
	}

	function cname($a) {
		//echo $a;
		include("config.php");
		$nickname = $a;

		if(strlen($nickname) < 3){
		    echo "<font color = 'red'>昵称太短</font>";
		    exit();
		}

		$sql = "SELECT * FROM userdata WHERE nickname = '$nickname'";
		$query = mysqli_query($dbindex,$sql);
		$row = mysqli_fetch_row($query);
		if($row > 0 ){
		 	echo '<font color="red">该昵称已被使用</font>';
		}
		else{
		 	echo '<font color="green">该昵称可使用</font>';
		}
	}

	function cpwd($a) {
		//echo $a;
		$pwd = $a;
		
		if(strlen($pwd) < 6){
		    echo "<font color = 'red'>密码太短</font>";
		}
		else{
			echo "<font color = 'green'>可使用</font>";
		}
	}

	function cemail($a) {
		//echo $a;
		include("config.php");
		$email = $a;
		
		if(!preg_match('/^[a-zA-Z]+([a-zA-Z0-9]|[.])+@[a-zA-Z0-9]+(\\.[a-zA-Z0-9]+)([a-zA-Z0-9]|[.])+$/',$email)){
		    echo "<font color = 'red'>电子邮件格式错误</font>";
		    exit();
		}

		$sql = "SELECT * FROM userdata WHERE email = '$email'";
		$query = mysqli_query($dbindex,$sql);
		$row = mysqli_fetch_row($query);
		if($row > 0 ){
		 	echo '<font color="red">该电子邮件已被注册</font>';
		}
		else{
		 	echo '<font color="green">该电子邮件可以注册</font>';
		}
	}

?>