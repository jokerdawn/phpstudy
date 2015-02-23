<?php
	
	class fontcolor {
		public $color;

		function CHGcolor (){
			echo "<font color = '$this->color'>Color</font>";
		} 
	}
?>

<HTML>
	<form method = 'GET'>
		<input type = 'text' name = 'color'/><input type = 'submit' name = 'submit'/>
	</form>
</HTML>

<?php 
	if(!isset($_GET['submit'])||empty($_GET['submit'])){
		echo 'please input color';
		exit();
	}

	$a = new fontcolor();
	$a->color = $_GET['color'];
	$a->CHGcolor();
?>