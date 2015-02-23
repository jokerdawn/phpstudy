<?php
	class cal {
		public $num = array();
		public $para = array();
		public $array_num;

		function extract_parameter() {
			$str = $this->formula;
			echo $str;
			//preg_match('/^[?<=<(\w+)>]$/', $this->formula,$para); 匹配算法符号
			//preg_match('/^(?<=({}))\w{0,1}(?=(}))$/', $this->formula,$matches);
			if(preg_match('/^\S*{x}\S*$/', $str)){
				echo 'ture';
			}else {
				echo 'false';
			}

			var_dump($matches);
			$array_num = count($matches);
		}

//		function calc(){


//		}

	}

	$a = new cal();
	$a->formula = '{x}+{y}' ;//formula but not equation.
	//echo $a->formula;
	//var_dump($a->formula);
	$a->extract_parameter();
	//var_dump($a->para);
	//var_dump($a->array_num);
	echo $a->array_num;
?>