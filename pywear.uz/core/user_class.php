<?php

class User{

private $table_name;
private $db;

public function __construct($db){
$this->table_name = "moderators";
$this->db = $db;
}

public function getAllUsers(){
return $this->db->getAll($this->table_name);
}

public function getUser($login, $password){
return $this->db->getItemByField($this->table_name, "`login`='".$login."' AND `password`='".$password."'");
}

public function getUserByLogin($login, $email){
return $this->db->getItemByField($this->table_name, "`login`='".$login."' OR `email`='$email'");
}

public function getUserByEmail($email){
return $this->db->getItemByField($this->table_name, "`email`='$email'");
}

public function getAllSByDLimit($limit){
	return $this->db->getAllSortByDateUpLimit($this->table_name, $limit);
}

public function addUser($fields){
	if(!$fields) return false;
	return $this->db->insert($this->table_name, $fields);
}

public function updatePass($password, $email){
	if(empty($email)) return false;
	return $this->db->edit($this->table_name, array("password" => $password), "`email`='$email'");
}

}
?>