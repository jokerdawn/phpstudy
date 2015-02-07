<META http-equiv="charset" content="UTF-8"/>

<?php
	include("config.php");
	$user = $_GET['user'];
	$sql = "SELECT * FROM userdata WHERE name = '$user'";
	$query = mysqli_query($dbindex,$sql);
	$row = mysqli_fetch_row($query);
	if($row > 0 ){
	 	echo "<font color=red>2</font>";
	}
	else{
	 	echo "<font color=green>1</font>";
	}
?>