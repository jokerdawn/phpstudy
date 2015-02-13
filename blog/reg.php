<?php
	session_start();
	if(isset($_SESSION['uid'])) {
		$name = $_SESSION['name'];
		echo "<script>alert('用户 $name 您已经登录了，按确定返回主页');window.location.href = 'index.php';close();</script>";
		exit();
	}
?>


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
			#reg-panel {
			   	position:absolute;
			   	top:30%;
			   	left:32%;
			    width:36%;
			    height:20%;
			}
			#reg-panel form {
				border: 1px solid gray;
				padding: 20px 0px 20px 10px;
			}
			#reg-panel input {
				padding: 0;
				margin:0;
				
			}
			#reg-elem {
				text-align: left;
				margin-right:10%;
				margin-bottom:3%;
			}
		</style>
		<link rel=stylesheet type="text/css" href="css/common.css">	
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
			submit_stat = new Array();

			function checkuser(){
				var user= document.regdata.user.value;
				var url = "doCheck.php?meta=user&value="+user;                       //跳转路径
				req.open("GET",url,true);                                 //跳转
				req.onreadystatechange = function(){checkResult('id_user')};   //设置回调函数为checkResult
				req.send();                                      //将请求发送
			}

			function checknickname(){
				var nickname= document.regdata.nickname.value;
				var url = "doCheck.php?meta=nickname&value="+nickname;                       //跳转路径
				req.open("GET",url,true);                                 //跳转
				req.onreadystatechange = function(){checkResult('id_nickname')};  //设置回调函数为checkResult
				req.send();                                               //将请求发送
			}

			function checkpwd(){
				var pwd= document.regdata.pwd.value;
				var url = "doCheck.php?meta=pwd&value="+pwd;                       //跳转路径
				req.open("GET",url,true);                                 //跳转
				req.onreadystatechange = function(){checkResult('id_pwd')};   //设置回调函数为checkResult
				req.send();  //将请求发送                                      
			}

			function checkemail(){
				var email= document.regdata.email.value;
				var url = "doCheck.php?meta=email&value="+email;                       //跳转路径
				req.open("GET",url,true);                                 //跳转
				req.onreadystatechange = function(){checkResult('id_email')};       //设置回调函数为checkResult
				req.send();                                               //将请求发送
			}
			
			function checkResult(elem){

				if(req.readyState == 4){ //判断XMLHtppRquest状态

					var div_id = req.responseText;
					var submit_value = document.getElementsByName('submit');
				
					if(div_id.match("green")){
						//submit_value[0].disabled = '';
						submit_stat[elem] = 1;
					}else {
						submit_stat[elem] = 0;
					}

					if(submit_stat['id_user']&&submit_stat['id_nickname']&&submit_stat['id_pwd']&&
						submit_stat['id_email']) {
						submit_value[0].disabled = '';
					}else {
						submit_value[0].disabled = 'disabled';
					}

		     		document.getElementById(elem).innerHTML = req.responseText;//在div标签中显示相应返回值                       					
				}

			}	
		</script>
	</head>
	<body>
		<div id ='reg-panel'>
			<form name = 'regdata' method = 'POST'>
				<div id = 'reg-elem' style = 'height:20px;'>
					<div style = 'float:left'>姓名：<input type = 'text' name = 'user' onblur="checkuser();"/></div>
					<div id ='id_user' style = 'float:right'></div>
				</div>
				<div id = 'reg-elem' style = 'height:20px;'>
					<div style = 'float:left'>昵称：<input type = 'text' name = 'nickname' onblur="checknickname()"/></div>
					<div id ='id_nickname' style = 'float:right'></div>
				</div>
				<div id = 'reg-elem' style = 'height:20px;'>
					<div style = 'float:left'>密码：<input type = 'password' name = 'pwd' onblur="checkpwd()"/></div>
					<div id ='id_pwd' style = 'float:right'></div>
				</div>
				<div id = 'reg-elem' style = 'height:20px;'>
					<div style = 'float:left'>邮箱：<input type = 'text' name = 'email' onblur="checkemail()"/></div>
					<div id ='id_email' style = 'float:right'></div>
				</div>					
				<div style = 'text-align:center'>
					<input style = 'width:25%' type = 'submit' name = 'submit' value = '确定' disabled = "disabled" />	
					<button style = 'width:25%;padding:0;' type = 'button' name = 'login' onclick = "location.href='login.php';">登录</button>
				</div>
			</form>
		</div>
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

/*	if(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]|[._-]{1,15}$/', $username)){
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
	}*/

	@include('config.php'); //消除头文件错误

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


	