<?php
	function makecoffee($types = array("cappuccino"), $coffeeMaker = NULL)
	{
		$device = is_null($coffeeMaker) ? "hands" : $coffeeMaker;
		return "Making a cup of ".join(", ", $types)." with $device.\n";
	}
	echo makecoffee();
	echo makecoffee(array("cappuccino", "lavazza"), "teapot");
?> 

<?php
	function small_numbers()
	{
		return array (0, 1, 2);
	}
	list ($zero, $one, $two) = small_numbers();
	
	echo $one;
?> 

<HTML>
	<Form method = POST >
	<p>type:<input TYPE = 'TEXT' name = 'argu1'></p>
	<p>method:<input TYPE = 'TEXT' name = 'argu2'></p>
	<!--p><input TYPE = 'TEXT' name = 'argu3'></p-->
	<p><input type = 'submit' name = 'submit' value = 'POST'></p>
</HTML>

<?php
	if(!isset($_POST['submit'])){
		echo 'Please input your argument.' ;
		exit();
	}
	
	$argu1 = $_POST['argu1'];
	
	echo makecoffee(array("$argu1"),$_POST['argu2']);
	
	//echo `$argu1`;
?>