<?php
	require('comment.php');

	$db_connection = new db_connect();
	$db_connection->info = array('domain' => 'localhost' , 'username' => 'root' , 'password' => '' , 'dbname' => 'test' ); 
	$dbindex = $db_connection->connect_db();

	var_dump($dbindex);

?>