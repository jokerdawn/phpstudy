<?php
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	//echo $DOCUMENT_ROOT;

	session_start();

	include('toolbar.php');
	
	include("config.php");

	$sql = "SELECT aname,aid from article_list";

	$result = mysqli_query($dbindex,$sql);

	$welcome = array('Hello','Halo','Bonjour','侬好','雷猴呀','Muraho','Buenos Dias');
	shuffle($welcome);
?>

<html>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<!--style></style-->	
		<link rel=stylesheet type="text/css" href="css/home-style.css">
		<link rel=stylesheet type="text/css" href="css/common.css">
		<title>JD's Blog</title>
	</head>
	<body>
		<h1 align = 'center' >JD's Blog</h1>
		<div id = 'function-button' >
			<div style = 'float:left'><?php if ($loginstat == 1) { echo $welcome[0].','."<a href = 'user.php'>$name</a>"; }?></div>
			<?php if ($loginstat == 0) { ?><a href = 'login.php'>登陆</a><?php } else if ($loginstat == 1) { ?><a href = 'login.php?unlog=unlog'>注销</a><?php } ?> | <a href = 'new.php'>写新文章</a>
		</div>
		<?php 
			while ($result1 = mysqli_fetch_array($result))
				{ $pid = $result1['aid'];
		?>
		<table width="800" align="center" style = 'margin-bottom: 20px;'>
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
	</body>
</html>	
