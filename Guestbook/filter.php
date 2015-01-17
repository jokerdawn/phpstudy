<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	if(!isset($_GET['date_submit'])){
		echo "<script>alert('Illegal Access!');close();</script>";
		exit();
	}
	
	if (empty($_GET['start_date']||$_GET['end_date'])) {
		echo "<script>alert('日期为空，请从输入');close();</script>";
		exit();
	}
	
	include('config.php');
	
	$start_date =$_GET['start_date'];
	$end_date = $_GET['end_date'];
	
	//echo $start_date;
	//echo $end_date;
	
	if(isset($_GET['date_select'])){
		if($_GET['date_select'] == 1){
			$date_select = 'postdate';
			//echo $date_select;
		}
		else{
			$date_select = 'editdate';
			//echo $date_select;
		}
	}
	else {
		echo "<script>alert('请选择日期类型');close();</script>";
		exit ();
	}
	
	$sql = "SELECT * FROM content WHERE $date_select BETWEEN '$start_date%' AND '$end_date%'";
	
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
			<td width="20%" >Name:<br/><?php echo $row['name']; ?></td>
			<td width="60%" >Content:<br/><?php echo $row['content']; ?></td>
			<td width="10%" >发表时间:<br/><?php echo $row['postdate']; ?></td>
			<td width="10%" >最新修改时间:<br/><?php echo $row['editdate']; ?></td>
		</tr>
	</table>
	<?php
		}  //end
	?>
</HTML>