<?php
	require('comment.php');

	$dbop = new dbop();
	$dbop->info = array('domain' => 'localhost' , 'username' => 'root' , 'password' => '' , 'dbname' => 'test' ); 
	$dbindex = $dbop->connect_db();
	$uresult = $dbop->ulogin($dbindex);

	$com = new comment();
	$com->dbindex = $dbindex;
	$com->table_name = 'c_comment';

	$ustr = mlist($dbindex,0);

	echo $ustr;

?>

<HTML>
	<body>


		<form type = 'POST'>
			<div id='origin-content'></div>
			<p><?php  echo $uresult['username'] ?></p>
			<div id = 'content' contentEditable = 'true' style = 'height:200px;width:300px;border:1px solid gray' ></div>
			<p><button id = 'input' >提交</button>
		</form>
	</body>
</HTML>