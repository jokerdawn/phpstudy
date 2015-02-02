<?php
	if((!isset($_GET['p']))||(empty($_GET['p']))){
		echo "<script>alert('参数错误');location.href= 'main.php';close();</script>";
		exit();
	}

	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	//echo $DOCUMENT_ROOT;

	$pid = $_GET['p'];

	$content = file_get_contents("$DOCUMENT_ROOT/PHPstudy/blog/page/$pid");

	include("config.php");

	$sql = "SELECT * from article_list where aid = $pid";

	$result = mysqli_query($dbindex,$sql);

	$result1 = mysqli_fetch_array($result);

	$title = $result1['aname'];
	$tag = $result1['atag'];
	$stat = $result1['astat'];
	$pdate = $result1['apdate'];
	$edate = $result1['aedate'];
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
		<title><?php echo $title.'-' ;?>JD's Blog</title>
	</head>
	<body>
		<h1><?php echo $title ;?></h1></br>
		<p><?php echo $content ;?></P></br>
		<?php echo '标签：'.$tag.'        '.'状态：'.$stat.'</br>'.'发布时间：'.$pdate.'        '.'最后编辑时间：'.$edate ;?>
	</body>
</html>
