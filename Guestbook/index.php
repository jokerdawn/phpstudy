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
			<tr align="center">
				<td colspan="2"><h1>Gusetbook</h1></td>
			</tr>
			<tr>
				<td width="30%"><a href="index.php">Mainpage</a> <?php if (!isset($unlog)) { ?>| <a href = 'login.php?action=logout'>Logout</a> <?php } ?>  </td> 
				<td width="40%"><form method = 'GET' action = 'search.php' target = '_blank' style="margin-bottom: 0px;"><input name = 'search_content' type = 'TEXT' /> <input name = 'search' type = 'submit' value = '搜索' /></form></td>
				<td>
					<form method = 'POST' style="margin-bottom: 0px;">
						<select name="group" onchange = 'javascript:this.form.submit()'><!--id = 'myselect' onchange="javascript:getvalues(this.value)"-->
							<option value="all" <?php if (isset($_POST['group'])||@$_POST['group']=='all') {?> selected="selected" <?php } ?> >All</option>
							<option value="1" <?php if (@$_POST['group'] == 1) {?> selected="selected" <?php } ?> >新手</option>
							<option value="2" <?php if (@$_POST['group'] == 2) {?> selected="selected" <?php } ?> >用户</option>
							<option value="3" <?php if (@$_POST['group'] == 3) {?> selected="selected" <?php } ?> >管理员</option>
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
				$sql = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '1'";
				$result = mysqli_query($dbindex,$sql);
			}
			elseif ($selection == 2) {
				$sql = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '2'";
				$result = mysqli_query($dbindex,$sql);
			}
			elseif ($selection == 3) {
				$sql = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '3'";
				$result = mysqli_query($dbindex,$sql);
			}
			else{
				$sql = "SELECT * FROM content";
				$result = mysqli_query($dbindex,$sql);
			}
		?>
		
		<?php
			$page = isset($_GET['page'])?intval($_GET['page']):1;
			$page_count = 5;
			$all_page_num = mysqli_num_rows($result);
			$pagenum = ceil($all_page_num/$page_count);
			If($page>$pagenum || $page == 0){
				echo "<script>alert('Error : Can Not Found The page.');location.href = 'index.php';</scripr>";
				Exit;
			}			
			
			$offset=($page-1)*$page_count;
			
			if ($selection == 1) {
				$sql1 = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '1' limit $offset,$page_count";
				$result1 = mysqli_query($dbindex,$sql1);
			}
			elseif ($selection == 2) {
				$sql1 = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '2' limit $offset,$page_count";
				$result1 = mysqli_query($dbindex,$sql1);
			}
			elseif ($selection == 3) {
				$sql1 = "SELECT content.id ,Content.name, content.content FROM content, userdata WHERE content.name = userdata.username and userdata.auth = '3' limit $offset,$page_count";
				$result1 = mysqli_query($dbindex,$sql1);
			}
			else{
				$sql1 = "SELECT * FROM content limit $offset,$page_count";
				$result1 = mysqli_query($dbindex,$sql1);
			}
		?>

		
		<form action = "modify.php" method = "GET" target="_blank"> <!--target blank new html-->
			<p>
				<?php
					while($row=mysqli_fetch_array($result1))
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

<div align = 'center'>
	<?php
		For($i=1;$i<=$pagenum;$i++){
			$show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";
			Echo $show." ";
		}
	?>
</div>

<?php
	if (isset($unlog)) {
		echo '<br/>'.'欢迎你'.$username.',如需留言请登录。'."或者点击 <a href = 'reg.html'>注册</a> 。";
		echo "<HTML><form method = 'POST' action = 'login.php'><p>用户名:<input name = 'username' type = 'TEXT' />   密码：<input name = 'password' type= 'password' />  <input name = 'Login' type = 'submit' value = '登录' /></form></HTML>";
	}
	else {
		include "comment.php";
	}
?>