<?php
	ob_start();//不加这个是不行的(貌似不加可以)
	echo "1";
	ob_end_clean();
	echo "2";
?>

<HTML>
	<form method = "post">
		<table>
			<tr>
				<td>NUMBER</td>
				<td><input type="Text" name = "Origin" value = 
					"<?php 
					if (isset($_POST['Origin'])) {
						echo $_POST['Origin'];
					}
					else echo '0'; 
					?>" />
				</td>
				<td colspan="2" ><input name = "Submit" type = "Submit" value="Input" /></td>
				<td><input name = "Bin" type ="Submit" value="Bin" /></td>
				<td><input name = "Oct" type ="Submit" value="Oct" /></td>
				<td><input name = "Hex" type ="Submit" value="Hex" /></td>
			</tr>
			
		</table>
	</form>
</HTML>

<?php
	if(isset($_POST['Submit'])||isset($_POST['Bin'])||isset($_POST['Oct'])||isset($_POST['Hex'])){
		$origin=(int)($_POST['Origin']);
		echo 'Input:'.$origin;
		if (isset($_POST['Bin'])){
			echo '</br>'.'Bin:'.decbin($origin);
		}
		if (isset($_POST['Oct'])) {
			echo '</br>'.'Oct:'.decoct($origin);
		}
		if (isset($_POST['Hex'])) {
			echo '</br>'.'Hex:'.dechex($origin);
		}
	}
?>



<!-- Bottom Line -->
<?php
	echo '</br>'.'</br>';
	echo $_SERVER['HTTP_USER_AGENT'];