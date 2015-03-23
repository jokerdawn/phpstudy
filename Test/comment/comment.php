<?php

	class dbop{
		#init
		public $info = array('domain' => NULL , 'username' => NULL , 'password' => NULL , 'dbname' => NULL );
		public $usertable = array('tablename'=>'c_user','username'=> 'test','password'=>'test');

		function connect_db(){
			$dbindex = mysqli_connect ($this->info['domain'],$this->info['username'],$this->info['password'],$this->info['dbname']);
			if(!$dbindex){
				die('Could not connect: ' . mysqli_error());
			}
			mysqli_query ($dbindex,"set names utf8");
			return $dbindex;
		}

		function ulogin($dbindex){
			$tablename = $this->usertable['tablename'];
			$username = $this->usertable['username'];
			$password = $this->usertable['password'];

			$sql = "SELECT uid,username from $tablename where username = '$username' and password = '$password'";
			$result=mysqli_query($dbindex,$sql);
			$row = mysqli_fetch_array($result);
			return $row;
		}

	}

	class comment{

		public $dbindex;
		public $table_name;
		public $input = array('username' =>NULL ,'level' =>0, 'replyid'=>NULL, 'content'=>NULL );

		function mwrite(){
			$table = $this->table_name;
			$a = $this->input['username'];
			$b = $this->input['level'];
			$c = $this->input['replyid'];
			$d = $this->input['content'];

			$sql = "INSERT INTO $table(username,level,replyid,content) value('$a','$b','$c','$d')";								
			mysqli_query($this->dbindex,$sql);
			if(!$this->dbindex){
				die('Could not connect: ' . mysqli_error($this->dbindex));
			}
		}

		function mlist($id = 0) { 
		    global $str;
		    $dbindex = $this->dbindex;

		    $sql = "SELECT * from c_comment where replyid= $id";  
		    $result = mysqli_query($dbindex,$sql);//查询pid的子类的分类 
		    if($result && mysqli_affected_rows($dbindex)){//如果有子类 
		        while ($row = mysqli_fetch_array($result)) { //循环记录集 
		        	$level = $row["level"];
		        	$mid = $row['id'];
		        	$str .= "<div style='margin:20px'>"; 
		        	if($level!=0){
		        		$str .= "<div id = 'mid$mid' class = 'level$level'  style='border-left: 5px solid gray;padding-left: 5px;'>".'<p>'. $row['username'] .'	#'.$level."</br>" .'<span >'.  $row['content'] .'</span>'. "</br>".$row['time']." <u style = 'font-color:blue' onclick = 'getminfo(\"mid$mid\",\"$mid\",\"$level\")'>reply</u>".'</p>'.'</div>'; //构建字符串 
		        	}else{
		        		$str .= "<div id = 'mid$mid' class = 'level$level' >". '<p>'. $row['username'] .'	#'.$level."</br>" .'<span >'. $row['content'] .'</span>'."</br>".$row['time']." <u style = 'font-color:blue' onclick = 'getminfo(\"mid$mid\",\"$mid\",\"$level\")'>reply</u>".'</p>'."</div>"; //构建字符串 
		        	}		            
		            $this->mlist($row['id']); //调用，将记录集中的id参数传入函数中，继续查询下级 
		            $str .= '</div>'; 
		        } 
			} 
		    return $str; 
		} 
	}
?>