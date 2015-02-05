<html>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<!--style></style-->	
		<!--link rel=stylesheet type="text/css" href="css/home-style.css"-->
		<title>JD's Blog</title>
		<script type="text/javascript">
			function createXMLHttp(){                                     //创建XMLHttpRequest的函数
				var browser = navigator.appName;                          //得到当前浏览器
				if(browser == "Microsoft Internet Explorer"){             //IE浏览器
					var xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
					return xmlHttp;
				}
				else{                                                    //非IE浏览器
					var xmlHttp = new XMLHttpRequest;
					return xmlHttp;
				}
			}

			var req = createXMLHttp();                                    //定义XMLHttpRequest变量
			
			function checkuser(){
				var user= document.regdata.user.value;
				var url = "doCheck.php?user="+user;                       //跳转路径
				req.open("GET",url,true);                                 //跳转
				req.onreadystatechange = checkResult;                     //设置回调函数为checkResult
				req.send();                                               //将请求发送
			}
			
			function checkResult(){
				if(req.readyState == 4){                                  //判断XMLHtppRquest状态
					document.getElementById('userstat').innerHTML = req.responseText;//在div标签中显示相应返回值
				}
			}
	</script>
	</head>
	<body>
		<form name = 'regdata' method = 'POST'>
			姓名：<input type = 'text' name = 'user' onblur="checkuser()"><div id ='userstat'></div></br>
			昵称：<input type = 'text' name = 'nickname'></br>
			密码：<input type = 'password' name = 'pwd'></br> 
			邮箱：<input type = 'text' name = 'email' ></br>
			<input type = 'submit' name = 'submit' value = '确定'>	<input type = 'reset' value = '重置'>
		</form>
	</body>
<html>

<?php
	if (!isset($_POST['submit'])) {
		//echo "<script>alert('Illegal Action');location.href='reg.html';</script>";
		exit();
	}

	//echo 'hello';

	//echo $_POST['user'].$_POST['pwd'].$_POST['email'].$_POST['nickname'];

	@$username=$_POST['user'];
	@$password=$_POST['pwd'];
	@$email=$_POST['email'];
	@$nickname=$_POST['nickname'];

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

	$password = MD5($password);

	/*echo $username;
	echo $password;
	echo $email;*/

	$sql = "INSERT into userdata(name,pwd,email,nickname) values('$username','$password','$email','$nickname')";
	
	if(mysqli_query($dbindex,$sql)){
	    echo "<script>alert('注册成功，请登录！');location.href = 'login.php';</script>";
	} else {
	    echo '抱歉！添加数据失败：',mysqli_error($dbindex),'<br />';
	    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	    exit();
	}
?>


	