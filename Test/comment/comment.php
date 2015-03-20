<?php
	class db_connect{
		#init
		protected $info = array('domain' => NULL , 'username' => NULL , 'password' => NULL , 'dbname' => NULL );

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

		protected $dbindex;
		protected $table_name;
		protected $input = array('username' =>NULL ,'replystat' =>NULL, 'lastreplyid'=>NULL, 'content'=>NULL );
		//protected $output = array('username' =>NULL ,'replystat' =>NULL, 'lastreplyid'=>NULL, 'content'=>NULL ,'' );

		function write(){
			$table = $this->table_name;
			$a = $this->input['username'];
			$b = $this->input['replystat'];
			$c = $this->input['lastreplyid'];
			$d = $this->input['content'];

			$sql = "INSERT INTO $table(username,replystat,lastreplyid,content) value('$a','$b','$c','$d')";								
			mysqli_query($this->dbindex,$sql);
			if(!$dbindex){
				die('Could not connect: ' . mysqli_error($dbindex));
			}
		}

		
	}
?>