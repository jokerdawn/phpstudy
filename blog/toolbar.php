<?php
	session_start();
	
	if((!isset($_SESSION['name']))||empty($_SESSION['name'])) {
		$loginstat = 0;
	}
	else{
		$loginstat = 1;
		$name = $_SESSION['name'];
	}

	$welcome = array('Hello','Halo','Bonjour','侬好','雷猴呀','Muraho','Buenos Dias');
	shuffle($welcome);
?>

<html>
	<head> 
		<META http-equiv="charset" content="UTF-8"/>
		<style>
			body {
				margin:0;
				padding:0;
				height:100%;
			}
			#function-button.toolbar {
				height: 36px;
				position: relative;
				width: 100%;
				background-color: rgb(106, 151, 203);
			}
			#function-button.toolbar button {
				font-family: 'Microsoft YaHei';
				height:36px;
				position:relative;
				float:left;
				font-size: 16px;
				border-radius:5px;
				border:1px solid rgba(0,0,0,0);
				background-color:rgba(0,0,0,0);
			}
			#function-button.toolbar button:hover {
				background-color:rgba(57, 120, 192, 1);
			}
		</style>
		<link rel=stylesheet type="text/css" href="css/common.css">
	</head>
	<body>
		<div id = 'function-button' class = 'toolbar' >
			<button onclick = "location.href = 'index.php';">主页</button>
			<?php if ($loginstat == 0) {
				?><button onclick = "location.href = 'login.php';">登录</button><?php
			} 
			else if ($loginstat == 1) { 
				?><button onclick= "location.href = 'login.php?unlog=unlog'">注销</button><button onclick = "location.href = 'new.php'">写新文章</button><?php
			} ?>
			<?php if ($loginstat == 1) { 
				?><button style = 'float:right' onclick = "location.href = 'user.php'"><?php echo $name;?></button>
				<img style = 'float:right;width:30px;padding-top:3px;' src="images/avatar.jpg"/><?php 
			}?>
		</div>
	</body>
</html>