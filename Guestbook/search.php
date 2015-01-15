<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	if (!isset($_GET['search_content'])) {
		echo "<script>alert('Illegal Access!');close();</script>";
		exit();
	}

	if (empty($_GET['search_content'])) {
		echo "<script>alert('关键字为空，请从新搜索');close();</script>";
		exit();
	}
 
	$search_con = $_GET['search_content'];

	include('config.php');

	$sql = "SELECT * FROM content where content like '%$search_con%'";
	$result = mysqli_query($dbindex,$sql);
?>

<HTML>
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
		</tr>
	</table>
	<?php
		}  //end
	?>
</HTML>