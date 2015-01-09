<?php
	$dbindex = mysqli_connect("localhost","root","");
	if(!$dbindex){
		die('Could not connect: ' . mysqli_error());
	}
	mysqli_query($dbindex,"set names utf8"); //use utf8 read db
	mysqli_query($dbindex,"use guestbook"); //db
?>