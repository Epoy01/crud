<?php

class model{
	private $host="localhost";
	private $user="root";
	private $db="clifford";
	private $pass="";
	private $conn=null;
	private $limit=5;

	public function __construct(){
		try{
			$this->conn=new PDO("mysql:host={$this->host};dbname={$this->db}",$this->user,$this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function showData($table,$cur_page){
		try{
			$offset=0;
			$offset=($cur_page*$this->limit)-$this->limit;
			$sql="SELECT * FROM {$table} LIMIT {$this->limit} OFFSET {$offset}";
			$q=$this->conn->query($sql) or die("Query Failed");
			$data=[];

			if($q->rowCount()>0){
				while($result = $q->fetch(PDO::FETCH_ASSOC)){
					$data[]=$result;
				}
			}
			return $data;

		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function getById($id,$table){
		try{
			$sql="SELECT * FROM {$table} WHERE u_id=:id";
			$q=$this->conn->prepare($sql) or die("Query Failed");
			$q->execute(array('id'=>$id)) or die("Query Failed");
			$data=[];

			if($q->rowCount()>0){
				$data=$q->fetch(PDO::FETCH_ASSOC);
			}
			return $data;

		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function insert($id,$fname,$mname,$lname,$table){
		try{
			$sql="INSERT INTO {$table} SET u_id=:id,fname=:fname,mname=:mname,lname=:lname";
			$q=$this->conn->prepare($sql) or die("Query Failed");
			if($q->execute(array('id'=>$id,'fname'=>$fname,'mname'=>$mname,'lname'=>$lname)) or die("Query Failed")){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function update($id,$fname,$mname,$lname,$table){
		try{
			$sql="UPDATE {$table} SET fname=:fname,mname=:mname,lname=:lname WHERE u_id=:id";
			$q=$this->conn->prepare($sql) or die("Query Failed");
			if($q->execute(array('id'=>$id,'fname'=>$fname,'mname'=>$mname,'lname'=>$lname)) or die("Query Failed")){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function delete($id,$table){
		try{
			$sql="DELETE FROM {$table} WHERE u_id=:id";
			$q=$this->conn->prepare($sql) or die("Query Failed");
			if($q->execute(array('id'=>$id)) or die("Query Failed")){
				return true;
			}else{
				return false;
			}

		}catch(PDOException $err_msg){
			echo $err_msg;
		}
	}

	public function paginate($table,$cur_page){
		$sql=$this->conn->query("SELECT * FROM {$table}");
		$all=$sql->rowCount();
		$pages=ceil($all/$this->limit);
		$paginate_pages=null;
		$next_btn=null;
		$prev_btn=null;

		if($cur_page<=1){
			$prev_btn="disabled";
		}

		if($cur_page>=$pages){
			$next_btn="disabled";
		}

		$prev=$cur_page-1;
		$next=$cur_page+1;

		$paginate_pages=$paginate_pages."<a href='{$_SERVER['PHP_SELF']}?page=1'><input type='button' value='First'".$prev_btn."></a>
		&nbsp;<a href='{$_SERVER['PHP_SELF']}?page={$prev}'><input type='button' value='<<'".$prev_btn."></a>";

		for ($page=1; $page <= $pages ; $page++) {
			$active="none";
			if($page==$cur_page){
				$active="black";
			}

			$paginate_pages=$paginate_pages."&nbsp; <a href='{$_SERVER['PHP_SELF']}?page={$page}'><input type='button' value='{$page}' style='border-color:".$active."'></a>";
		}

		$paginate_pages=$paginate_pages."&nbsp;<a href='{$_SERVER['PHP_SELF']}?page={$next}'><input type='button' value='>>'".$next_btn."></a>&nbsp;<a href='{$_SERVER['PHP_SELF']}?page=$pages'><input type='button' value='Last'".$next_btn."></a>";

		echo $paginate_pages;

	}
}

?>