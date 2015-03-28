<?php
	if(!isset($_POST['content'])||empty($_POST['content'])){
		echo "content is empty!";
		exit();
	}
	if(!isset($_POST['endtime'])||empty($_POST['endtime'])){
		echo 'Please input endtime.';
		exit();
	}

	$content = $_POST['content'];
	$end_time = $_POST['endtime'];

	//srt format
	//1   //No.
	//hh:mm:ss,XXX -> hh:mm:ss,XXX  //Timeline
	//Content
	//1</br>hh:mm:ss -> hh:mm:ss,XXX  //HTML format

	preg_match_all('/\d{1,4}:\d{1,2}/', $content,$matches);
	if(empty($matches[0])){
		exit();
	}
	$qunti = count($matches[0]);

	$patch = array();

	for($i = 0;$i<$qunti;$i++){
		if(strlen($matches[0][$i])<5){
			$patch[$i] = '00:0'.$matches[0][$i].',000';
		}else{
			$patch[$i] = '00:'.$matches[0][$i].',000';
		}
	}
	
	for($c = 0;$c<$qunti-1;$c++){  //No.1~12, so qunti need`s minus 1
		$b = $c +1;
		$str[$c] = ($b).'</br>'.$patch[$c].'->'.$patch[$b].'<';
	}
	$str[$qunti-1] = $qunti.'</br>'.$patch[$c].'->'.$end_time.'<';

	for ($j = 0,$match_patt = array();$j < $qunti-1 ;$j++){
		$match_patt[$j] = '/\b'.$matches[0][$j].'\b\</';
	}
	$match_patt[$qunti-1] = '/\b'.$matches[0][$j].'\b\</';


	$trans = preg_replace($match_patt, $str, $content);
	echo $trans;
?>