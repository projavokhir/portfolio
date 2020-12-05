<?php

class Search_view extends View{

protected $key;
protected $all_params;
private $title;
private $meta_desc;
private $meta_key;
private $params;
private $products_count = 9;

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->all_params = $params;
	$this->key = array_shift($params);
}

public function getResults(){
	$query = trim(htmlspecialchars($_GET["q"]));
	$this->title = "Результаты поиска: ".$query." | ".SITE_NAME;
	$this->meta_desc = "Результат по поиску ".$query.", ".$query;
	$this->meta_key = $query;
	$result = $this->products->searchProduct($query);
	$text = $this->getContent("no_result");
	
	if(count($result) != 0){
		$text = "";
		for($i = 0; $i < count($result); $i++){
			$desc = (strlen($result[$i]["description"]) > 120) ? substr(strip_tags($result[$i]["description"]), 0, 120)."..." : $result[$i]["description"];
			$sr["name"] =  '';
			$sr["desc"] = $desc;
			$sr["alias"] = $result[$i]["alias"];
			$text .= $this->getReplacedContent($sr, "search_results");
		}
	}

$rs["query"] = $query;
$rs["results"] = $text;
$cont = $this->getReplacedContent($rs, "search_cont");
$this->Render($this->title, $this->meta_desc, $this->meta_key, $cont);
return;
}


}
?>