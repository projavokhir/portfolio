<?php


class DB{

private $mysqli;
protected $table_prefix = "pymag_";
public static $ins;

private function __construct(){
	$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
}

public static function getInstance(){
	if(self::$ins instanceof self)
		return self::$ins;
	return self::$ins = new self;
}

private function query($q){
	$this->mysqli->query("SET NAMES utf8");
	return $this->mysqli->query($q);
}

private function select($table_name, $fields, $where = "", $limit = "", $sort = "", $up = false, $max = false){
	$table_name = $this->table_prefix.$table_name;

	$f = "";
	if(strpos($fields[0], "*") === 0) $f = "*  ";
	else
		for($i = 0; $i < count($fields); $i++){
			if(count($fields) == 1 && $fields[$i] == "*") $f = "*";
			else $f .= "`".addslashes($fields[$i])."`,";
		}
	$f = ($max) ? $max : substr($f, 0, -1);
	$query = "SELECT $f FROM `$table_name`";
if($where) $query .= " WHERE $where";
if($sort) $query .= " ORDER BY `$sort`";
if($up) $query .= "  DESC";
if($limit) $query .= " LIMIT  $limit";
$res = (!$this->query($query)) ? false : $this->query($query);
if(!$res) return false;
	$r = [];

	for($i = 0; $i < $res->num_rows; $i++){
		$r[$i] = $res->fetch_assoc();
	}
	return $r;
}

public function insert($table_name, $fields){
	$table_name = $this->table_prefix.$table_name;
	$f = "";
	foreach($fields as $k => $v) $f .= "`".addslashes($k)."`='".addslashes($v)."',";
	$f = substr($f, 0, -1);
	$q = ("INSERT INTO `$table_name` SET $f");
	return $this->query($q);
}

public function edit($table_name, $fields, $where = ""){
	if(!$where) return false;
	$table_name = $this->table_prefix.$table_name;
	$f = "";
	foreach($fields as $k => $v) $f .= "`".addslashes($k)."`='".addslashes($v)."',";
	$f = substr($f, 0, -1);
	$q = "UPDATE `$table_name` SET $f WHERE $where";
	return $this->query($q);
}

public function edit_without_quote($table_name, $fields, $where = ""){
	if(!$where) return false;
	$table_name = $this->table_prefix.$table_name;
	$f = "";
	foreach($fields as $k => $v) $f .= "`".addslashes($k)."`=".addslashes($v).",";
	$f = substr($f, 0, -1);
	$q = "UPDATE `$table_name` SET $f WHERE $where";
	return $this->query($q);
}

public function delete($table_name, $where){
	$table_name = $this->table_prefix.$table_name;
	if(empty($where)) return false;
	return $q = $this->query("DELETE FROM `$table_name` WHERE $where");
}

public function getAll($table_name){
	return $this->select($table_name, array("*"));
}

public function getAllSortbyField($table_name, $sortby){
	return $this->select($table_name, array("*"), "", 0, $sortby);
}

public function getAllByField($table_name, $where){
	return $this->select($table_name, array("*"), $where);
}

public function getAllByFieldSortDate($table_name, $where){
	return $this->select($table_name, array("*"), $where, 0, "time", true);
}

public function getAllByFieldSortDateLimit($table_name, $where, $limit){
	return $this->select($table_name, array("*"), $where, $limit, "time", true);
}

public function getAllSortByDate_Up($table_name){
	return $this->select($table_name, array("*"), "", "", "time", true);
}
public function getAllSortByDateUpLimit($table_name, $limit){
	return $this->select($table_name, array("*"), "", $limit, "time", true);
}

public function getByFieldLimit($table_name, $where, $limit){
	return $this->select($table_name, array("*"), $where, $limit);
}

public function getAllSortById_Up($table_name){
	return $this->select($table_name, array("*"), "", "", "id", true);
}

public function getFieldAll($table_name, $fields){
	return $this->select($table_name, $fields);
}

public function getSortByField($table_name, $where, $field, $limit){
	return $this->select($table_name, array("*"), $where, $limit, $field, true);
}

public function getItemByField($table_name, $where){
	$q = $this->select($table_name, array("*"), $where);
	return (isset($q[0])) ? $q[0] : false;
}

public function getMax($table_name, $field){
	$max =  $this->select($table_name, array("*"), "", "", "","", "MAX($field)");
	return ($max) ? $max[0]["MAX($field)"] : false;
}

public function __destruct(){
	$this->mysqli->close();
}

}


?>