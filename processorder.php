<html>
<head>
<title>
Bob`s atuo parts-order results
</title>
</head>
<body>
<h1>Bob</h1>
<h2>Order</h2>
<?php 
	$trieqty= $_REQUEST['tireqty'];
	$Oilqty= $_REQUEST['Oilqty'];
	$sparkqty= $_REQUEST['sparkqty'];

	$totalqty=$trieqty + $Oilqty +$sparkqty;
	if ($totalqty==0){
		echo '<p style = "color:red">';
		echo 'error';
		echo '</p>';
	}

	echo "<p>Order Processsed</p>";
	echo "<br/><br/><br/>";
	echo $_REQUEST['tireqty'].' tire<br />';
	echo $_REQUEST['Oilqty'].' oil<br />';
	echo $_REQUEST['sparkqty'].' spark<br />';
	echo "<br/><br/><br/>";
	$tireqty = NULL;
	//echo $tireqty;
	echo 'isset($tireqty):'.isset($tireqty).'<br />';
	echo 'isset($nothere):'.isset($nothere).'<br />';
	echo 'empty($tireqty):'.empty($tireqty).'<br />';
	echo 'empty($nothere):'.empty($nothere).'<br />';
?>
</body>
</html>