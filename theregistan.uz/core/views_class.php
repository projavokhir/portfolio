<?php


class Views{

private $db;
private $ips_table = "ips";
private $views_table = "views";

public function __construct($db){
$this->db = $db;
}

private function addIp($ip){
	return $this->db->insert($this->ips_table, array("ip_address" => $ip));
}
private function insertViews($date){
	return $this->db->insert($this->views_table, array("date" => $date, "views" => 1, "users" => 1));
}
private function updateHostViews($date){
	return $this->db->edit_without_quote($this->views_table, array("views" => "views+1", "users" => "users+1"), "`date`='$date'");
}
private function updateViews($date){
	return $this->db->edit_without_quote($this->views_table, array("views" => "views+1"), "`date`='$date'");
}
public function getTodaysViews($date){
	return $this->db->getAllByField($this->views_table, "`date`='$date'");
}
public function getAllViews(){
	return $this->db->getAllSortbyField($this->views_table, "date");
}
private function getIp($ip){
	return $this->db->getAllByField($this->ips_table, "`ip_address`='$ip'");
}
public function register(){
$ip = $_SERVER["REMOTE_ADDR"];
$date = date("d-m-Y", time());
$today = $this->getTodaysViews($date);
if(count($today) == 0){
	$r = $this->db->delete($this->ips_table);
	if($r) $this->insertViews($date);
	if($r) $this->addIp($ip);
} else {
	$ips = $this->getIp($ip);
	if(count($ips) == 0){
		$this->addIp($ip);
		$this->updateHostViews($date);
	} else {
		$this->updateViews($date);
	}
}
}


//the end of the class 
}
?>