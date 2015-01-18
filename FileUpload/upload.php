<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />    <!-- MAX_FILE_SIZE must precede the file input field -->
    Send this file: <input name="userfile" type="file" accept = 'TEXT/*' />    <!-- Name of input element determines name in $_FILES array -->
    <input type="submit" value="Send File" />
</form>

<?php
if(isset($_FILES['userfile'])){
	$uploaddir = "D:/xampp/htdocs/Test/files/uploads/";  //Needs the complete route of Address
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		echo "File is valid, and was successfully uploaded.\n";
	}
	else {
    echo "File upload failed!\n";
	}
}

//echo '<pre>';
//echo 'Here is some more debugging info:';
//print_r($_FILES);

//print "</pre>";

?> 