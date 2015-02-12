
<?php
	session_start();
	//检测是否登录，若没登录则转向登录界面
	if(!isset($_SESSION['uid'])){
	    header("Location:login.html");
	    exit();
	}

	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

	//包含数据库连接文件
	include('config.php');
	$userid = $_SESSION['uid'];
	$name = $_SESSION['name']; 
	$auth = $_SESSION['auth']; 
	$nickname = $_SESSION['nickname'];
	$email = $_SESSION['email'];

	/*echo '用户信息：<br />';
	echo '用户ID：'.$userid.'<br />';
	echo '用户名：'.$name.'<br />';
	echo '昵称：'.$nickname.'<br/>';
	echo '邮箱：'.$email.'<br />';
	echo '用户权限'.$auth.'<br />';*/

	$user_query = mysqli_query($dbindex,"SELECT regdate from userdata where uid=$userid limit 1");
	$row = mysqli_fetch_array($user_query);
	//echo '注册日期：'.date("Y年n月j日",strtotime($row['regdate'])).'<br />'; //strtotime — 将任何英文文本的日期时间描述解析为 Unix 时间戳
	//echo "<a href = 'index.php'>首页</a>          "."       <a href='login.php?action=logout'>注销</a>";
?>

<HTML>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">
			body{
			    margin:0;
			    padding:0;
			    width:100%;
			    height:100%;
			}
			#container {
			   	position:absolute;
			   	top:15%;
			   	left:22%;
			    width:56%;
			}
			#head {
				border: 1px solid black;
				height: 150px;
			}
			#avatar {
				float: left;				
			    margin-top: 25px;
			    margin-left: 8%;
			    padding-right: 5%;
			    border-right: 1px solid black;
			}
			#user-info{
				float: left;
				left: 35%;
				position: absolute;
				width:65%;
			}
			#user-info table{
				width:100%;
				margin-top: 25px;
			}
			#user-info td {
			    /* margin-bottom: 20px; */
			    padding-bottom: 3%;
			    padding-right: 4%;
			}
			#article-list {
    			border: 1px solid;
    			border-top: 0px;
			}
			#article-list table{
				padding-top: 3%;
				width:100%;
			}
		</style>
		<link rel=stylesheet type="text/css" href="css/common.css">
	</head>
	<body>
		<div id = 'container'>
			<div id = 'head'>
				<div id = 'avatar'><img src="images/avatar.jpg" style = 'height:100px;width:100px;'/></div>
				<div id = 'user-info'>
					<table cellspacing = '0'>
						<?php 
							echo '<tr><td>用户ID：'.$userid.'</td><td>用户名：'.$name.'</td></tr>';
							echo '<tr><td>昵称：'.$nickname.'</td><td>邮箱：'.$email.'</td></tr>';
							echo '<tr><td>用户权限'.$auth.'</td><td>注册日期：'.date("Y年n月j日",strtotime($row['regdate'])).'</td></tr>';
						?>
					</table>
				</div>
			</div>
			<div id = 'article-list'>
				<?php 
					$sql = "SELECT aname,aid from article_list where author = '$nickname'";
					$result = mysqli_query($dbindex,$sql);
					while ($result1 = mysqli_fetch_array($result))
						{ $pid = $result1['aid'];
				?>
				<table >
					<tr><td style ="color:"><h3 style="margin-bottom: 0px;margin-top: 0px;"><a href = <?php echo "page.php?p=$pid";?>><?php echo $result1['aname'];?></a></h3></td></tr>
					<tr style = 'background-color: gainsboro'><td>
						<?php 
							$fp = fopen("$DOCUMENT_ROOT/PHPstudy/blog/page/$pid",'r');
							$short_con = fgetss($fp,50,'<\br>');
							echo $short_con;
							fclose($fp);
						?>
					</tr></td>
				</table>
				<?php } ?>
			</div>
		</div>
	</body>
</HTML>