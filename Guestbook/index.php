<?php
	session_start();

	if (!isset($_SESSION['uid'])) {
		$username = '游客';
		$unlog = True;
	}
	else{
		@$username = $_SESSION['username'];
	}

	include("config.php"); //include config 
	$sql = "select * from content"; //select the form
	$result = mysqli_query($dbindex,$sql);
?>

<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<body>
		<table width="678" align="center">
			<tr>
				<td colspan="2"><h1>Gusetbook</h1></td>
			</tr>
			<tr>
				<td width="586"><a href="index.php">Mainpage</a> <?php if (!isset($unlog)) { ?>| <a href = 'login.php?action=logout'>Logout</a> <?php } ?>  </td> 
			</tr>
		</table>
		<form action = "modify.php" method = "GET" target="_blank"> <!--target blank new html-->
			<p>
				<?php
					while($row=mysqli_fetch_array($result))
					{   //start
				?>
			</p>
			<table width="800" border="1" align="center" cellpadding="1" cellspacing="1" style = "border:0px;">
				<tr>
					<td width="25%" >Name:<br/><?php echo $row['name']; ?></td>
					<td width="70%" >Content:<br/><?php echo $row['content']; ?></td>
					<?php if (!isset($unlog)) { ?> <td width="5%" style = "border:0px"><input type="radio" name="select" value = "<?php echo $row['id']; ?>"  /></td> <?php } ?>
				</tr>
			</table>			
		<?php
			}  //end
		?>
		<p align = "center"><input type = "submit" value = "管理" name = "submit" /><p/>
		</form>	
	</body>
</html>


<?php
	if (isset($unlog)) {
		echo '<br/>'.'欢迎你'.$username.',如需留言请登录。';
		echo "<HTML><form method = 'POST' action = 'login.php'><p>用户名:<input name = 'username' type = 'TEXT' />   密码：<input name = 'password' type= 'password' />  <input name = 'Login' type = 'submit' value = '登录' /></form></HTML>";
	}
	else {
		include "comment.php";
	}
?>