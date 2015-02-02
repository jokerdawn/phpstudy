<HTML>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<style>
			/*<!--p:-->*/
		</style>		
		<title>JD's Blog</title>
	</head>
	<body>
		<form method = 'POST'>
			<table width = '100%'>
				<tr>
					<td><h1 align = 'center'><input type = 'TEXT' name = 'title'/></h1></td>
					<td>
						<select name = 'stat'>
							<option value="private">private</option>
							<option value="public">public</option>
						</select>
					</td>
				</tr>
				<tr><td align = 'center' colspan="2"><textarea name = 'content' rows="10" cols="30"></textarea></td></tr>
				<tr>
					<td><input type = 'TEXT' name = 'tag'/></td>
					<td><input type = 'submit' name = 'submit'/></td>
				</tr>
			</table>
		</form>
	</body>
</html>	

<?php 
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	echo $DOCUMENT_ROOT;

	if(!isset($_POST['submit']))
	{
		exit();
	}

	include("config.php");

	$title = $_POST['title'];
	$stat = $_POST['stat'];
	$patch = $_POST['content'];
	$content = str_replace("\r\n","</br>",$patch); //\r\n 代表输入时候的空格以及到下一行的光标
	$tag = $_POST['tag'];
	//aid aname atag astat apdate aedate
	$sql = "INSERT INTO article_list (aname,atag,astat) value ('$title','$tag','$stat')";
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