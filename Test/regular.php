<?php
	//session_start();
	//echo @$_SESSION['name'].'</br>';
	//echo @$_SESSION['email'];
?>

<HTML>
	<FORM method = POST >
		<P>Name: <input type = 'TEXT' name = 'name'>   </p>
		<p>Email: <input type = 'TEXT' name = 'email'>    </p>
		<p>URL: <input type = 'TEXT' name = 'URL'>  </p>
		<p>REPEAT: <input type = 'TEXT' name = 'REPEAT'>  </p>
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
		if (preg_match('/^[a-zA-Z]+([a-zA-Z0-9]|[.])+@[a-zA-Z0-9]+(\\.[a-zA-Z0-9]+)([a-zA-Z0-9]|[.])+$/',$email)){
			echo $email.'</br>Success';
		}
		else {
			echo $email.'</br>Failed';
		}
	}

	if (isset($_POST['URL'])&&(!empty($_POST['URL']))) {
		$URL = $_POST['URL'];
		if (preg_match("/^((http|ftp|https):\/\/)(([a-zA-Z0-9\._-]+\.[a-zA-Z]{2,6})|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,4})*(\/[a-zA-Z0-9\&%_\.\/-~-]*)?$/",$URL)){
			echo $URL.'</br>Success';
		}
		else {
			echo $URL.'</br>Failed';
		}
	}

	if (isset($_POST['REPEAT'])&&(!empty($_POST['REPEAT']))) {
		$REPEAT = $_POST['REPEAT'];
		if (preg_match("/^a.*?b$/",$REPEAT)){
			echo $REPEAT.'</br>Success';
		}
		else {
			echo $REPEAT.'</br>Failed';
		}
	}

?>