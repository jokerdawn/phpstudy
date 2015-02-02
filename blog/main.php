<?php
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	//echo $DOCUMENT_ROOT;

	include("config.php");

	$sql = "SELECT aname,aid from article_list";

	$result = mysqli_query($dbindex,$sql);
?>

<html>
	<HEAD>
		<META http-equiv="charset" content="UTF-8"/>
		<!--base href="http://www.w3school.com.cn/i/" />
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="theme.css"/-->
		<style></style>	
		<title>JD's Blog</title>
	</head>
	<body>
		<h1 align = 'center' >JD's Blog</h1>
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
