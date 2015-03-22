<?php
	echo '<script>alert("11111");</script>';
	$input = $_GET['input'];
	file_put_contents("$DOCUMENT_ROOT/PHPstudy/1.txt", $input);
?>


