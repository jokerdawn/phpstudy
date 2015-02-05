<?php
	if((!isset($_GET['p']))||(empty($_GET['p']))){
		echo "<script>alert('参数错误');location.href= 'index.php';close();</script>";
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
	echo $stat;
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
		<link rel=stylesheet type="text/css" href="css/page-style.css">	
		<title><?php echo $title.'-' ;?>JD's Blog</title>
	</head>
	<body>
		<div id = 'page-title'><h2><?php echo $title ;?></h2></div>
		<div style = 'margin-left: 20%;margin-right: 20%;font-size: 16px;text-align:right'><a href = '<?php echo "modify.php?p=$pid&edit=1"?>'>+修改</a></div>
		<div id = 'page-content'><?php echo $content ;?></div>
		<div id = 'page-tag'><?php echo '标签：'.$tag?></div>
		<div id = 'page-date' >
			<div style = 'float:left'><?php echo '发布时间:'.$pdate;?></div>
			<div style = 'float:right'><?php echo '最后编辑时间：'.$edate ;?></div>
		</div>	
	</body>
</html>
