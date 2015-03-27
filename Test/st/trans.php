<?php
	if(!isset($_GET['content'])||empty($_GET['content'])){
		echo "alert('content is empty!');window.location.href = 'st.html';";
		exit();
	}

	$content = $_GET['content'];
	$end_time = '60:00:00,000';
	
	//echo $content;

	//str format
	//1   //No.
	//hh:mm:ss,XXX -> hh:mm:ss,XXX  //Timeline
	//Content
	//1</br>hh:mm:ss -> hh:mm:ss,XXX  //HTML format

	preg_match_all('/\d{1,4}:\d{1,2}/', $content,$matches);
	//var_dump($matches);
	$qunti = count($matches[0]);
	/*//echo $qunti;

	for ($i = 0;$i < $qunti ;$i++){
		echo $matches[0][$i].'</br>';
	}*/
	$patch = array();

	for($i = 0;$i<$qunti;$i++){
		if(strlen($matches[0][$i])<5){
			$patch[$i] = '00:0'.$matches[0][$i].',000';
		}else{
			$patch[$i] = '00:'.$matches[0][$i].',000';
		}
	}
	
	for($c = 0;$c<$qunti-1;$c++){
		$b = $c +1;
		$str[$c] = ($b).'</br>'.$patch[$c].'->'.$patch[$b];
	}

	$str[$qunti-1] = $qunti.'</br>'.$patch[$c].'->'.$end_time;

	var_dump($str);

	for ($i = 0;$i < $qunti ;$i++){
		echo $str[$i].'</br>';
	}
	//preg_replace('/\d{1,4}:\d{1,2}/', replacement, subject)
	

?>