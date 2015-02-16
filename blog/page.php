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

	$sql2 = "SELECT aname,aid from article_list order by aid DESC";

	$result2 = mysqli_query($dbindex,$sql2);

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
				margin-left: 15%;
				margin-right: 15%;
			}

			#article {
				width:65%;
				border: 1px solid rgba(0,0,0,1);
			}

			#page-title {
				text-align: center;
			}

			#author {
				font-size: 18px;
			}
			
			#page-content {
				margin:15 0 15 0;
			}

			#sidebar {
				width :30%;
				height: 400px;
				border: 1px solid rgba(0,0,0,1);
				float:right;
				background-color: rgba(157, 231, 98, 0.38);
			}

			#sidebar h4 {
				padding-left: 20px;
			}

			.page-list {
				padding: 10 0 10 0;
			}

		</style>
		<link rel=stylesheet type="text/css" href="css/common.css">
		<title><?php echo $title;?>-JD's Blog</title>
	</head>	
	<body>
		<div id = 'container'>
			<div id = 'sidebar'>
				<h4>最近更新</h4>
				<ul>
					<?php 
						while ($result3 = mysqli_fetch_array($result2)){ 
								$pid = $result3['aid'];
								?><li class = 'page-list'><a href = <?php echo "page.php?p=$pid";?>><?php echo $result3['aname'];?></a></li>
					<?php } ?>
				</ul>	
			</div>
			<div id = 'article' >
				<div id = 'page-title'><h2><?php echo $title.'	' ; if($stat == 'private') {echo '<img style = "width:18px;" src="images/private.png"/>';}?></h2></div>
				<div style = 'height:21px;'>	
					<div id = 'author' style = 'float:left'><img style = 'width:18px;' src="images/avatar.jpg"/><?php echo $author.'	'.$pdate;?></div>
					<div style = 'float:right'>
						<?php 
							if($loginstat == 1){
							?><a href = '<?php echo "modify.php?p=$pid&edit=1"?>'><img style = 'width:18px;' src="images/edit.png"/></a><?php 
							}?>
					</div>		
				</div>
				<div id = 'page-content'><?php echo $content ;?></div>
				<div id = 'page-tag'><?php echo '标签：'.$tag?></div>
				<div id = 'page-date' ><?php echo '最后编辑时间：'.$edate ;?></div>
			</div>
		</div>	
	</body>
	<?php include('footer.php'); ?>
</html>
