<?php
	if(empty($_GET['p'])||$_GET['edit'] != 1){
		echo "<script>alert('参数错误！');window.location.href = 'index.php';close();</script>";
		exit();
	}

	include('toolbar.php');

	if($loginstat != 1) {
		echo "<script>alert('请登录！');window.location.href = 'login.php';close();</script>";
		exit();
	}

	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

	$pid = $_GET['p'];
	//echo $pid;

	$patch = file_get_contents("$DOCUMENT_ROOT/PHPstudy/blog/page/$pid");

	$content = str_replace("</br>","\r\n",$patch);

	include("config.php");

	$sql = "SELECT aname,atag,astat from article_list where aid = $pid";

	$result = mysqli_query($dbindex,$sql);

	$result1 = mysqli_fetch_array($result);

	$title = $result1['aname'];
	$tag = $result1['atag'];
	$stat = $result1['astat'];

?>

<HTML>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<style>
			/*<!--p:-->*/
		</style>
		<link rel=stylesheet type="text/css" href="css/post-style.css">	
		<link rel=stylesheet type="text/css" href="css/common.css">	
		<title>JD's Blog</title>
	</head>
	<body>
		<form method = 'POST'>
			<div id = 'page-head'>
				<div id = 'title-input'><textarea name = 'title'/><?php echo $title;?></textarea></div>
				<div id = 'stat-select'><select name = 'stat'>
					<option value="private" <?php if ($stat =='private') {?>selected = 'seclected' <?php }?> >private</option>
					<option value="public" <?php if ($stat =='public') {?>selected = 'seclected' <?php }?> >public</option>
				</select></div>
			</div>
			<div id = 'article-content'><textarea name = 'content'><?php echo $content;?></textarea></div>
			<div id = 'tag-submit'>
				<div id = 'tag'><textarea name = 'tag'><?php echo $tag;?></textarea></div>
				<div id = 'submit-button'><input type = 'submit' name = 'submit' value ='修改'/></div>
			</div>
		</form>
	</body>
</html>	

<?php 

	if(!isset($_POST['submit']))
	{
		exit();
	}

	$etitle = htmlspecialchars($_POST['title'],ENT_QUOTES);
	$estat = htmlspecialchars($_POST['stat'],ENT_QUOTES);
	$epatch = $_POST['content'];
	$econtent = str_replace("\r\n","</br>",$epatch); //\r\n 代表输入时候的空格以及到下一行的光标
	$etag = htmlspecialchars($_POST['tag'],ENT_QUOTES);
	//aid aname atag astat apdate aedate
	$sql = "UPDATE article_list SET aname = '$etitle' ,atag = '$etag' ,astat = '$estat' where aid = '$pid'";
	mysqli_query($dbindex,$sql);

	if(!$dbindex){
		die(mysqli_error($dbindex));
	}
	//$file = fopen("$_SERVER['DOCUMENT_ROOT']/phpstudy/blog/page/'$getID'","w+");
	file_put_contents("$DOCUMENT_ROOT/PHPstudy/blog/page/$pid", $econtent);

	echo "<script>alert('修改成功！');window.location.href = 'page.php?p=$pid';close();</script>";

	exit();
?>