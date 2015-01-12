<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	if (!isset($_GET['submit'])) {
		echo "<script>alert('Illegal Access!');location.href ='index.php';</script>";
		exit();
	}
	
	include('config.php');

	session_start();

	$auth = $_SESSION['auth'];

	if ($auth == 1) {
		echo "<script>alert('You don't have enough permission!');location.href ='index.php';</script>";
		exit();
	}

	$username = $_SESSION['username'];

	$comid = $_GET['select'];

	$select_com = "select * from content where id = '$comid'";
	$select_result = mysqli_query($dbindex,$select_com);
	$row = mysqli_fetch_array($select_result);
	$content = str_replace("</br>","\r\n",$row['content']);

	if ($auth == 2) {
		if (!($username == $row['name'])) {
			echo "<script>alert('你无权修改他人内容！');close();</script>";
			exit();
		}
	}
	
?>

<html>
	<body>
		<table align="center" width="800" >
			<tr>
				<td>
					<form method="POST" >
						<p><a href = "user.php"><?php echo $username; ?></a></p>
						<p>
							<textarea name="content"  cols="45" rows="5" ><?php echo $content ?></textarea>
						</p>
						<p>
							<input type="submit" name="modify"  value="提交">
							<input type="reset" name="button2"  value="重置">
							<input type="submit" name="delete"  value="删除">
						</p>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>

<?php
	if (!(isset($_POST['modify'])||isset($_POST['delete']))) {
		exit();
	}
	elseif (isset($_POST['modify'])) {
		$modcom = str_replace("\r\n","</br>",$_POST['content']);
		$sql = " UPDATE content SET content = '$modcom' WHERE id = '$comid'" ;
		mysqli_query($dbindex,$sql);
		echo "<script>alert('修改成功！返回首页。');location.href='index.php';</script>";
		exit();
	}
	elseif (isset($_POST['delete'])) {
		$sql = "DELETE FROM content WHERE id = '$comid' " ;
		mysqli_query($dbindex,$sql);
		echo "<script>alert('删除成功！返回首页。');location.href='index.php';</script>";
		exit();
	}
	else {
		exit();
	}
?>