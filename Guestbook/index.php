<?php
	session_start();

	if (!isset($_SESSION['uid'])) {
		$username = '游客';
		$unlog = True;
	}
	else{
		@$username = $_SESSION['username'];
	}

	@$auth = $_SESSION['auth'];

	include("config.php"); //include config 

?>

<html>
	<head>
		<!--script type="text/javascript">
			function getvalues (index) {
				var values = index;
				//alert(values.innerHTML)
				if (values == 1) {
					<?php 
						//$sql = "select * from content where auth = '1'";
						//$result = mysqli_query($dbindex,$sql);
					?>;
					location.reload();
				}
				else if (values == 2) { 
					<?php 
						//$sql = "select * from content where auth = '2'";
						//$result = mysqli_query($dbindex,$sql);
					?>;
					location.reload();
				}
				else if ( values == 3 ){
					<?php 
						//$sql = "select * from content where auth = '3'";
						//$result = mysqli_query($dbindex,$sql);
					?>;
					location.reload();
				}
				else {
					<?php
						//$sql = "select * from content"; //select the form
						//$result = mysqli_query($dbindex,$sql);
					?>;
					location.reload();
				};
			}
		</script-->	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<table width="678" align="center">
			<tr>
				<td colspan="2"><h1>Gusetbook</h1></td>
			</tr>
			<tr>
				<td width="586"><a href="index.php">Mainpage</a> <?php if (!isset($unlog)) { ?>| <a href = 'login.php?action=logout'>Logout</a> <?php } ?>  </td> 
				<td>
					<form method = 'POST'>
						<select name="group" onchange = 'javascript:this.form.submit()'><!--id = 'myselect' onchange="javascript:getvalues(this.value)"-->
							<option value="all" >All</option>
							<option value="1" >新手</option>
							<option value="2">用户</option>
							<option value="3">管理员</option>
						</select>
					</form>
				</td>
			</tr>
		</table>
		<?php 
			@$selection = $_POST['group'];
			//echo $selection;
			unset($_POST);

			if ($selection == 1) {
				$sql = "select username from userdata where auth = '1'";
				$sqlr = mysqli_query($dbindex,$sql);
				$udata = mysqli_fetch_array($sqlr);
				$udata_tmp = $udata['username'];
				$sql2 = "select * from content where name = '$udata_tmp'";
				$result = mysqli_query($dbindex,$sql2);
			}
			elseif ($selection == 2) {
				$sql = "select username from userdata where auth = '2'";
				$sqlr = mysqli_query($dbindex,$sql);
				$udata = mysqli_fetch_array($sqlr);
				$udata_tmp = $udata['username'];
				$sql2 = "select * from content where name = '$udata_tmp'";
				$result = mysqli_query($dbindex,$sql2);
			}
			elseif ($selection == 3) {
				$sql = "select username from userdata where auth = '3'";
				$sqlr = mysqli_query($dbindex,$sql);
				$udata = mysqli_fetch_array($sqlr);
				$udata_tmp = $udata['username'];
				$sql2 = "select * from content where name = '$udata_tmp'";
				$result = mysqli_query($dbindex,$sql2);
			}
			else{
				$sql = "select * from content";
				$result = mysqli_query($dbindex,$sql);
			}
		?>
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
					<?php if (!isset($unlog)) { ?>
						<?php if (($auth == 2)||($auth == 3)) { ?>
							<td width="5%" style = "border:0px"><input type="radio" name="select" value = "<?php echo $row['id']; ?>"  /></td> 
						<?php } ?>
					<?php } ?>
				</tr>
			</table>			
		<?php
			}  //end
		?>
		<?php if (!isset($unlog)) { ?>
			<?php if (($auth == 2)||($auth == 3)) { ?>
				<p align = "center"><input type = "submit" value = "管理" name = "submit" /><p/>
			<?php } ?>
		<?php } ?>
		</form>	
	</body>
</html>


<?php
	if (isset($unlog)) {
		echo '<br/>'.'欢迎你'.$username.',如需留言请登录。'."或者点击 <a href = 'reg.html'>注册</a> 。";
		echo "<HTML><form method = 'POST' action = 'login.php'><p>用户名:<input name = 'username' type = 'TEXT' />   密码：<input name = 'password' type= 'password' />  <input name = 'Login' type = 'submit' value = '登录' /></form></HTML>";
	}
	else {
		include "comment.php";
	}
?>