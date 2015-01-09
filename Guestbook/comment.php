<html>
	</br></br></br>
	<body>
		<table align="center" width="678">
			<tr>
				<td>
					<form name="form1" method="post" action="post.php">
						<p><a href = "user.php"><?php echo $username; ?></a></p> <!--id used by CSS-->
						<p>Comment: </p>
						<p>
							<textarea name="content"  cols="45" rows="5"></textarea>
						</p>
						<p>
							<input type="submit" name="button"  value="submit">
							<input type="reset" name="button2"  value="reset">
						</p>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>