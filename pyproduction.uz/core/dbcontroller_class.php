<?php

class DBController{

private $db;
public static $ins;
private $services = "services";
private $cats = "services_categories";
private $clients = "clients";
private $projects = "projects";
private $portfolio = "portfolio";
private $vacs = "vacancies";
private $about = "about";
private $about_sections = "about_sections";

public function __construct($db){
$this->db = $db;
}

public static function getInstance($db = ""){
	if(self::$ins instanceof self)
		return self::$ins;
print_r(self::$ins);
	return self::$ins = new self($db);
}

public function getAllFrom($t_name){
	return $this->db->getAllSortById_Up($t_name);
}

public function getServices(){
	return $this->db->getAllSortbyField($this->services, "id");
}

public function getServicesByCat($cat){
	return $this->db->getAllByField($this->services, "`category`='".$cat."'");
}

public function getCategories(){
	return $this->db->getAllSortbyField($this->cats, "id");
}

public function getOther(){
	return $this->db->getAllSortbyField($this->about_sections, "id");
}

public function getAboutBlocks(){
	return $this->db->getAllSortbyField($this->about, "id");
}

public function getBrands(){
	return $this->db->getAllSortbyField($this->clients, "logo_order");
}

public function getProjects(){
	return $this->db->getAllSortById_Up($this->projects);
}

public function getOwnProjects(){
	return $this->db->getAllSortById_Up($this->portfolio);
}

public function getPortfolioData($c){
	return $this->db->getAllSortByIdUpLimit($this->projects, $c);
}

public function getAllCount($cat = ""){
	return count($this->db->getAllByFieldSortDate($this->table_name, "`category_alias` LIKE '%$cat%'"));
}

public function editServiceName($n, $id){
	return $this->db->edit($this->services, array("name" => $n), '`id`='.$id);
}

public function editPortImg($im, $id){
	return $this->db->edit($this->portfolio, array("logo_url" => $im), '`id`='.$id);
}

public function editPortURL($url, $id){
	return $this->db->edit($this->portfolio, array("project_link" => $url), '`id`='.$id);
}

public function editOtherH($h, $id){
	return $this->db->edit($this->about_sections, array("header" => $h), '`id`='.$id);
}

public function editOtherSecH($sh, $id){
	return $this->db->edit($this->about_sections, array("description" => $sh), '`id`='.$id);
}

public function editOtherFT($ft, $id){
	return $this->db->edit($this->about_sections, array("full_text" => $ft), '`id`='.$id);
}

public function editServicesDesc($l, $id){
	return $this->db->edit($this->services, array("description" => $l), '`id`='.$id);
}

public function editServicesCat($c, $id){
	return $this->db->edit($this->services, array("category" => $c), '`id`='.$id);
}

public function editPrCname($c, $id){
	return $this->db->edit($this->projects, array("description" => $c), '`id`='.$id);
}

public function editPrHeader($c, $id){
	return $this->db->edit($this->projects, array("header" => $c), '`id`='.$id);
}

public function editPrSHeader($c, $id){
	return $this->db->edit($this->projects, array("second_header" => $c), '`id`='.$id);
}

public function editPrTags($c, $id){
	return $this->db->edit($this->projects, array("hashtag" => $c), '`id`='.$id);
}

public function editPrcover($c, $id){
	return $this->db->edit($this->projects, array("img_cover" => $c), '`id`='.$id);
}

public function editPrImages($c, $id){
	return $this->db->edit($this->projects, array("images" => $c), '`id`='.$id);
}

public function editClLogo($d, $id){
	return $this->db->edit($this->clients, array("logo_url" => $d), '`id`='.$id);
}

public function editV($d, $id){
	return $this->db->edit($this->vacs, $d, '`id`='.$id);
}

public function getClOrder(){
	return $this->db->getMax($this->clients, "logo_order");
}

public function editClDesc($d, $id){
	return $this->db->edit($this->clients, array("logo_history" => $d), '`id`='.$id);
}

public function editAbout($text, $id){
	return $this->db->edit($this->about, array("full_text" => $text), '`id`='.$id);
}

public function getProject($id){
return $this->db->getItemByField($this->projects, "`id`='".$id."'");
}

public function getBrand($id){
return $this->db->getItemByField($this->portfolio, "`id`='".$id."'");
}

public function getOtherBlock($id){
return $this->db->getItemByField($this->about_sections, "`id`='".$id."'");
}

public function getAbout($id){
return $this->db->getItemByField($this->about, "`id`='".$id."'");
}

public function getClient($id){
return $this->db->getItemByField($this->clients, "`id`='".$id."'");
}

public function getService($id){
return $this->db->getItemByField($this->services, "`id`='".$id."'");
}

public function add($t, $fields){
	return $this->db->insert($this->$t, $fields);
}

public function getVacs(){
	return $this->db->getAllSortbyField($this->vacs, "id");
}

public function getVac($id){
	return $this->db->getItemByField($this->vacs, "`id`='".$id."'");
}

public function DeletePost($alias){
	return $this->db->delete($this->table_name, "`alias`='$alias'");
}

public function DeletePort($id){
	return $this->db->delete($this->portfolio, "`id`='$id'");
}

public function DeleteS($id){
	return $this->db->delete($this->services, "`id`='$id'");
}

public function DeleteProject($id){
	return $this->db->delete($this->projects, "`id`='$id'");
}

public function DeleteSection($id){
	return $this->db->delete($this->about_sections, "`id`='$id'");
}

public function DeleteVac($id){
	return $this->db->delete($this->vacs, "`id`='$id'");
}

public function DeleteC($id){
	return $this->db->delete($this->clients, "`id`='$id'");
}

}
?>