<HTML>
	<!-- The data encoding type, enctype, MUST be specified as below -->
	<form  enctype = "multipart/form-data" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="30000" />    <!-- MAX_FILE_SIZE must precede the file input field -->
		Read this file: <input name="userfile" type="file" accept = 'TEXT/*' />    <!-- Name of input element determines name in $_FILES array -->
		<input type="submit" value="Read File" name ='Rfile'/>
	</form>
</HTML>

<?php
if(isset($_FILES['userfile'])){
	$file = fopen($_FILES['userfile']['tmp_name'],"r");
	//echo readfile($_FILES['userfile']['tmp_name']);  This will output the count of stream
	while (!feof($file)){
		echo fgets($file);
	}
	fclose($file);
}
?>