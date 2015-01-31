<?php
	header("Content-Type: text/html; charset=UTF-8");
	$dbindex = mysqli_connect ("localhost","root","","blog");
	if(!$dbindex){
		die('Could not connect: ' . mysqli_error());
	}
	mysqli_query ($dbindex,"set names utf8"); //use utf8 read db
	//aid aname atag astat apdate aedate
?>



