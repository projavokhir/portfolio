<?php

class Article{

private $table_name;
private $cattable_name;
private $db;
public static $ins;

public function __construct($db){
$this->table_name = "newsblog";
$this->cattable_name = "categories";
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
	return $this->db->getAllSortbyField($this->cattable_name, "c_order");
}

public function editPost($fields, $where){
	return $this->db->edit($this->table_name, $fields, "`id`='$where' OR `alias`='$where'");
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

public function getAllCount_1(){
	return count($this->db->getAll($this->table_name));
}

public function getArticle($id){
return $this->db->getItemByField($this->table_name, "`id`='".$id."' OR `alias`='".$id."'");
}

public function getInterestingArticles($key, $count){
$max_views = $this->db->getMax($this->table_name, "views");
$articles = $this->db->getSortByField($this->table_name, "`views`<='$max_views'", "views", $count);
for($i = 0; $i < count($articles); $i++)
	if($articles[$i]["id"] === $key || $articles[$i]["alias"] === $key){
 	unset($articles[$i]);
 }
$articles = array_values($articles);
return $articles;
}

public function getInterestingLimit($limit){
$max_views = $this->db->getMax($this->table_name, "views");
return $this->db->getByFieldLimit($this->table_name, "`views`<='$max_views'", $limit);
}

public function add($fields){
	return $this->db->insert($this->table_name, $fields);
}

public function DeletePost($alias){
	return $this->db->delete($this->table_name, "`alias`='$alias'");
}

}

?>