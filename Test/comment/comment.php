<?php

	class db_connect{
		#init
		public $info = array('domain' => NULL , 'username' => NULL , 'password' => NULL , 'dbname' => NULL );

		function connect_db(){
			$dbindex = mysqli_connect ($this->info['domain'],$this->info['username'],$this->info['password'],$this->info['dbname']);
			if(!$dbindex){
				die('Could not connect: ' . mysqli_error());
			}
			mysqli_query ($dbindex,"set names utf8");
			return $dbindex;
		}
	}

	class comment{

		public $dbindex;
		public $table_name;
		public $input = array('username' =>NULL ,'level' =>0, 'replyid'=>NULL, 'content'=>NULL );

		function write(){
			$table = $this->table_name;
			$a = $this->input['username'];
			$b = $this->input['level'];
			$c = $this->input['replyid'];
			$d = $this->input['content'];

			$sql = "INSERT INTO $(username,level,replyid,content) value('$a','$b','$c','$d')";								
			mysqli_query($this->dbindex,$sql);
			if(!$dbindex){
				die('Could not connect: ' . mysqli_error($dbindex));
			}
		}

			function mlist($id = 0) { 
			    global $str; 
			    $table = $this->table_name;

			    $sql = "SELECT * from $table where replyid= $id";  
			    $result = mysqli_query($sql);//查询pid的子类的分类 
			    if($result && mysqli_affected_rows()){//如果有子类 
			        $str .= '<ul>'; 
			        while ($row = mysqli_fetch_array($result)) { //循环记录集 
			            $str .= "<li>" . $row['username'] . "</br>" . $row['content'] . "</br>".$row['time']."</li>"; //构建字符串 
			            mlist($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
			        } 
			        $str .= '</ul>'; 
			    } 
			    return $str; 
			} 
	}
?>