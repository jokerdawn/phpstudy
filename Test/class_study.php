<?php
	
	class fontcolor {
		public $color = array('R'=>0,'G'=>0,'B'=>0);

		function CHGcolor (){
			$B = $this->color['B'];
			$R = $this->color['R'];
			$G = $this->color['G'];
			echo "<font style = 'color:rgb($R,$G,$B)'>Color</font>";
		} 
	}

	class transparent extends fontcolor {
		public $Alpha = 1;

		function CHGcolor(){
			$B = $this->color['B'];
			$R = $this->color['R'];
			$G = $this->color['G'];
			echo "<font style = 'color:rgba($R,$G,$B,$this->Alpha)'>Color</font>";
		} 
	}
?>

<HTML>
	<form method = 'GET'>
		R <input type = 'text' name = 'R' style="width:30px" value = '0'/>  G <input type = 'text' name = 'G' style="width:30px" value = '0'/> B <input type = 'text' name = 'B' style="width:30px" value = '0'/></br>
		<input type = 'checkbox' name = 'tp' value="half-color"></br>
		<input type = 'submit' name = 'submit'/>

	</form>
</HTML>
 
<?php 
	if(!isset($_GET['submit'])||empty($_GET['submit'])){
		echo 'please input color';
		exit();
	}

	//var_dump($_GET);

	$a = new transparent();
	$a->color['R'] = $_GET['R'];
	$a->color['G'] = $_GET['G'];
	$a->color['B'] = $_GET['B'];
	if(isset($_GET['tp'])&&($_GET['tp'] == 'half-color')) {
		$a->Alpha = 0.5;
	}else{
		$a->Alpha = 1;
	}
	$a->CHGcolor();
?>