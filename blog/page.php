<?php
	if((!isset($_GET['p']))||(empty($_GET['p']))){
		echo "<script>alert('参数错误');location.href= 'index.php';close();</script>";
		exit();
	}

	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

	$pid = $_GET['p'];

	$content = file_get_contents("$DOCUMENT_ROOT/PHPstudy/blog/page/$pid");

	include("config.php");
	include('toolbar.php');

	$sql = "SELECT * from article_list where aid = $pid";

	$result = mysqli_query($dbindex,$sql);

	$result1 = mysqli_fetch_array($result);

	$title = $result1['aname'];
	$tag = $result1['atag'];
	$stat = $result1['astat'];
	$author = $result1['author'];
	$pdate =date("Y.n.j",strtotime($result1['apdate']));
	$edate =date("Y.n.j",strtotime($result1['aedate']));
?>

<html>
	<HEAD>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<!--style></style-->	
		<style>
			#container {
				margin-top: 40px;
				margin-left: 20%;
				margin-right: 20%;
			}

			#article {
				width:70%;
				border: 1px solid black;
			}

			#page-title {
				text-align: center;
			}

			#author {
				font-size: 18px;
			}

		</style>
		<link rel=stylesheet type="text/css" href="css/common.css">
		<title><?php echo $title;?>-JD's Blog</title>
	</head>	
	<body>
		<div id = 'container'>
			<div id = 'article' >
				<div id = 'page-title'><h2><?php echo $title.'	' ; if($stat == 'private') {echo '<img style = "width:18px;" src="images/private.png"/>';}?></h2></div>
				<div style = 'height:21px;'>	
					<div id = 'author' style = 'float:left'><img style = 'width:21px;' src="images/avatar.jpg"/><?php echo $author.'	'.$pdate;?></div>
					<div style = 'text-align:right'><a href = '<?php echo "modify.php?p=$pid&edit=1"?>'><img style = 'width:18px;' src="images/edit.png"/></a></div>
				</div>
				<div id = 'page-content'><?php echo $content ;?></div>
				<div id = 'page-tag'><?php echo '标签：'.$tag?></div>
				<div id = 'page-date' >
					<div style = 'float:right'><?php echo '最后编辑时间：'.$edate ;?></div>
				</div>
			</div>
			<div id = 'sidebar'></div>
		</div>	
	</body>
</html>
