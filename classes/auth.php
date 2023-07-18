<?php
require_once 'db.php';

class Auth extends Db {
	//register user
	public function register($firstname,$lastnname, $username, $password, $level, $position){
		$sql = "INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `level`, `position`) 
		VALUES (NULL, ?, ?, ?, ?, ?, ?);";
		$stmt = $this ->conn->prepare($sql);
		$stmt->execute([$firstname, $lastnname, $username, $password, $level, $position]);
		return true;
	}
	
	//check if exists
	public function user_exist ($username) {
		$sql = "Select username from users where username = :username";
		$stmt = $this ->conn->prepare($sql);
		$stmt->execute(['username' =>$username]);
		$result = $stmt->fetch();
		return $result;
		
	}
	// login existing user
	public function login ($username) {
		$sql = "SELECT id,username, password from users where username = ? and status != 0";
		$stmt = $this ->conn->prepare($sql);
		$stmt -> execute([$username]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	//Session 
	public function currentUser ($username) {
		$sql = "Select * from users where username = ?";
		$stms = $this -> conn -> prepare($sql);
		$stms -> execute ([$username]);
		$row = $stms -> fetch(PDO::FETCH_ASSOC);
		return $row; 
	}
	//Display all Users
	public function showUsers ($status) {
		$sql = "Select * from users where status = ? " ;
		$stms = $this -> conn ->prepare($sql);
		 $stms ->execute([$status]);
		$result = $stms->fetchAll(PDO::FETCH_ASSOC);
		return $result;
		
	}
	//Edit Users 
	public function edit_user($id) {
		$sql = "Select * from users where id = ? ";
		$stmt = $this -> conn -> prepare($sql);
		$stmt ->execute([$id]);
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		return $row;
		
	}
	//Update User
	public function update_user($firstname,$lastname, $level, $position, $password, $id) {
		$sql = "Update users set firstname = :firstname, lastname = :lastname, level = :level, position = :position, password = :password where id = :id ";
		$hpass = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $this -> conn -> prepare($sql);
		$stmt ->execute(['firstname'=>$firstname,'lastname'=>$lastname,'level'=>$level,'position'=>$position, 'password' => $hpass, 'id'=>$id]);
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		return $row;
		
	}
		//Change Status User
	public function change_status($id, $status) {
		$sql = "Update users set status = :status where id = :id ";
		$stmt = $this -> conn -> prepare($sql);
		$stmt ->execute(['status'=>$status,'id'=>$id]);
		$row = $stmt -> fetch();
		return $row;
		
	}
	//View User Logs
	public function view_user_logs($id){
		$sql = "Select * from user_logs where uid = :id order by date DESC LIMIT 50";
		$stmt = $this->conn->prepare($sql);
		$stmt ->execute(['id'=>$id]);
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	//Add User logs from Tools
	public function add_user_logs($user_id,$string) {
		$sql = "INSERT INTO `user_logs` (`id`, `uid`, `description`, `date`) VALUES (NULL, :id, :string, current_timestamp())";
		$stmt = $this->conn->prepare($sql);
		$result = $stmt ->execute(['id'=>$user_id, 'string'=>$string]);
		return $result;
		
	}
	// Notification Count
		public function count_notif($user_id) {
		$sql = "SELECT COUNT(id) as count from `notification` WHERE user_id = :user_id and notif_status = 0 ";
		$stmt = $this->conn->prepare($sql);
		$result = $stmt ->execute(['user_id'=>$user_id]);
		$row = $stmt -> fetch();
		return $row['count'];
		
	}
	
	
}

?>