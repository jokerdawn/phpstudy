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
				<div id = 'title-input'><textarea name = 'title'/></textarea></div>
				<div id = 'stat-select'><select name = 'stat'>
					<option value="private">private</option>
					<option value="public">public</option>
				</select></div>
			</div>
			<div id = 'article-content'><textarea name = 'content'></textarea></div>
			<div id = 'tag-submit'>
				<div id = 'tag'><textarea name = 'tag'></textarea></div>
				<div id = 'submit-button'><input type = 'submit' name = 'submit'/></div>
			</div>
		</form>
	</body>
</html>	

<?php 
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	//echo $DOCUMENT_ROOT;

	session_start();


	if(!isset($_POST['submit']))
	{
		exit();
	}

	include("config.php");

	$nickname = $_SESSION['nickname'];
	$title = $_POST['title'];
	$stat = $_POST['stat'];
	$patch = $_POST['content'];
	$content = str_replace("\r\n","</br>",$patch); //\r\n 代表输入时候的空格以及到下一行的光标
	$tag = $_POST['tag'];
	//aid aname atag astat apdate aedate
	$sql = "INSERT INTO article_list (aname,atag,astat,author) value ('$title','$tag','$stat','$nickname')";
	mysqli_query($dbindex,$sql);
	if(!$dbindex){
		die('Could not connect: ' . mysqli_error($dbindex));
	}

	$getID = mysqli_insert_id($dbindex);

	//$file = fopen("$_SERVER['DOCUMENT_ROOT']/phpstudy/blog/page/'$getID'","w+");
	file_put_contents("$DOCUMENT_ROOT/PHPstudy/blog/page/$getID", $content);

	echo "<script>alert('发布成功！');window.location.href = 'page.php?p=$getID';close();</script>";

	exit();
?>