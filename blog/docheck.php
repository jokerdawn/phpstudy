<META http-equiv="charset" content="UTF-8"/>

<?php
	include("config.php");
	$user = $_GET['user'];
	$sql = "SELECT * FROM userdata WHERE name = '$user'";
	$query = mysqli_query($dbindex,$sql);
	$row = mysqli_fetch_row($query);
	if($row > 0 ){
	 	echo "<font color=red>对不起，该用户名已存在</font>";
	}
	else{
	 	echo "<font color=green>恭喜，可以使用</font>";
	}
?>