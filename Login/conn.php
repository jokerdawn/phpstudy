<?php
	/*****************************
	*数据库连接
	*****************************/
	$dbindex = mysqli_connect("localhost","root","");
	if (!$dbindex){
	    die("连接数据库失败：" . mysql_error());
	}
	mysqli_query($dbindex,"use reglogin");
	mysqli_query($dbindex,"set names utf8");
?>