<?php

class Products{

private $table_name;
private $cattable_name;
private $gallery_table;
private $db;
public static $ins;

public function __construct($db){
$this->table_name = "products";
$this->cattable_name = "category";
$this->gallery_table = "gallery";
$this->db = $db;
}

public static function getInstance($db = ""){
	if(self::$ins instanceof self)
		return self::$ins;
print_r(self::$ins);
	return self::$ins = new self($db);
}

public function getAllSortByDate(){
return $this->db->getAllSortByDate_Up($this->table_name);
}

public function getAllSByDLimit($limit){
	return $this->db->getAllSortByDateUpLimit($this->table_name, $limit);
}

public function getAllByField($fields){
	return $this->db->getFieldAll($this->table_name, $fields);
}

public function updateViews($key){
	return $this->db->edit_without_quote($this->table_name, array("views" => "`views`+1"), "`id`='$key' OR `alias`='$key'");
}

public function getCategories(){
	return $this->db->getAllSortbyField($this->cattable_name, "id");
}

public function editProduct($fields, $where){
	return $this->db->edit($this->table_name, $fields, "`id`='$where' OR `alias`='$where'");
}

public function editGItem($fields, $where){
	return $this->db->edit($this->gallery_table, $fields, "`id`='".$where."'");
}

public function issetCategory($cat){
	return $this->db->getItemByField($this->cattable_name, "`alias`='$cat'");
}

public function getByCategory($category, $limit){
	return $this->db->getAllByFieldSortDateLimit($this->table_name, "`category_alias` LIKE "."'%".$category."%'", $limit);
}

public function getAllCount($cat = ""){
	return count($this->db->getAllByFieldSortDate($this->table_name, "`category_alias` LIKE '%$cat%'"));
}

public function getIndexGallery(){
	return $this->db->getAllSortById_Up($this->gallery_table);
}

public function getGItem($id){
	return $this->db->getItemByField($this->gallery_table, "`id`='".$id."'");
}

public function getProduct($id){
return $this->db->getItemByField($this->table_name, "`id`='".$id."' OR `alias`='".$id."'");
}

public function getInterestingProducts($key, $count){
$max_id = $this->db->getMax($this->table_name, "id");
$products = $this->db->getSortByField($this->table_name, "`id`<='$max_id'", "id", $count);
for($i = 0; $i < count($products); $i++)
	if($products[$i]["id"] === $key || $products[$i]["alias"] === $key){
 	unset($products[$i]);
 }
$products = array_values($products);
return $products;
}

public function add($fields){
	return $this->db->insert($this->table_name, $fields);
}

public function addGItem($fields){
	return $this->db->insert($this->gallery_table, $fields);
}

public function DeletePost($alias){
	return $this->db->delete($this->table_name, "`alias`='$alias'");
}

public function DeleteGItem($id){
	return $this->db->delete($this->gallery_table, "`id`='".$id."'");
}


public function searchProduct($query){
	if((strlen($query) < 2) && $query == "") return false;
	return $this->db->search($this->table_name, array("name", "description", "alias"), $query);
}

}

?>