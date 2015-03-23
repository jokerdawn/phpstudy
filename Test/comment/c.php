<?php
	require('comment.php');

	$dbop = new dbop();
	$dbop->info = array('domain' => 'localhost' , 'username' => 'root' , 'password' => '' , 'dbname' => 'test' ); 
	$dbindex = $dbop->connect_db();
	$uresult = $dbop->ulogin($dbindex);

	$com = new comment();
	$com->dbindex = $dbindex;
	$com->table_name = 'c_comment';
	$ustr = $com->mlist(0);

	echo $ustr;

?>

<HTML>
	<body>
		<script type="text/javascript">
		function getminfo(id,replyid,level){
			console.log(id);
			document.getElementById('origin-content').innerHTML = document.getElementById(id).getElementsByTagName('span')[0].innerHTML;
			document.getElementById('origin-content').setAttribute('style','background-color:rgb(39, 161, 134);width:200px;padding:10 0 10 0');
			document.getElementById('replyid').innerHTML = replyid;
			document.getElementById('level').innerHTML = ++level;
		}
		</script>
		<form method = 'POST' style = 'margin-top:20px'>
			<div id='origin-content'></div><textarea id='replyid' name = 'rid' style = 'display:none'></textarea><textarea id='level' name = 'lv' style = 'display:none'></textarea>
			<p><?php  echo $uresult['username'] ?></p>
			<textarea name = 'content' style = 'height:200px;width:300px;border:1px solid gray;resize:none'></textarea>
			<p><button name = 'input' >提交</button>
		</form>
	</body>
</HTML>

<?php 
	if(!isset($_POST['input'])){
		exit();
	}
	if(empty($_POST['lv'])){
		$_POST['lv'] = '0';
	}
	if(empty($_POST['rid'])){
		$_POST['rid'] = '0';
	}
	$com->input = array('username' =>$uresult['username'] , 'level'=>$_POST['lv'],'replyid'=>$_POST['rid'],'content'=>$_POST['content'] );
	var_dump($com->input);
	$com->mwrite();
	echo '<script>alert("Succes!");close();window.location.href = "c.php";</script>'
?>