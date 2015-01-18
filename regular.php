<?php
	//session_start();
	//echo @$_SESSION['name'].'</br>';
	//echo @$_SESSION['email'];
?>

<HTML>
	<FORM method = POST >
		<P>Name: <input type = 'TEXT' name = 'name'>   </p>
		<p>Email: <input type = 'TEXT' name = 'email'>    </p>
		<p><input type = 'submit' name = 'submit' value = 'post'></p>
</HTML>

<?php
	//if(isset($_POST['']))

	if(isset($_POST['name'])&&(!empty($_POST['name']))) {
		$name = $_POST['name'];
		if (preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]|[._-]{1,15}$/', $name)){
			echo $name.'</br>Success';
		}
		else {
			echo $name.'</br>Failed';
		}
	}
	
	if (isset($_POST['email'])&&(!empty($_POST['email']))) {
		$email = $_POST['email'];
		if (0){
			echo $email.'</br>Success';
		}
		else {
			echo $email.'</br>Failed';
		}
	}

?>