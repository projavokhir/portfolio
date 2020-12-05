<?php

class View extends Module{

protected $param;
protected $m_desc;
protected $m_key;

public function __construct(){
	parent::__construct();
	$this->m_desc = "PY WEAR – узбекский street-wear бренд основанный в 2015 году Парвизом Яхьяевым, как часть группы компаний PY. Это - первая отечественная марка, которая несёт за собой не только моду улиц, но и качество.";
	$this->m_key = "py wear, py prodcution";
}

public function Render($title = "", $m_desc = "", $m_key = "", $contents = ""){
	$styles = $this->getContent("styles", false);
	$scripts = $this->getContent("scripts", false);
	$sr["title"] = $title;
	$sr["meta_desc"] = $this->m_desc;
	$sr["meta_key"] = $this->m_key;
	$sr["styles"] = $styles;
	$sr["scripts"] = $scripts;
	$sr["time"] = time();
		$header["logo_svg"] = $this->getContent("logo_svg");
		$header["is_logged_in"] = $this->isLoggedIn();
	$sr["shopping_cart"] = $this->getShoppingCart();
	$sr["header"] = $this->getReplacedContent($header, "header");
	$sr["totop_btn"] = $this->getContent("totopbtn");
	$sr["footer"] = $this->getContent("footer");
	$sr["content"] = $contents;
	$this->main_tmpl = $this->getReplacedContent($sr, MAIN_LAYOUT);
	$this->v_control->register();
	echo $this->main_tmpl;
}

public function RenderCpanel($title = "", $contents = ""){
	
	$sr["title"] = $title;
	$sr["user"] = $this->getUserName();
	$sr["content"] = $contents;
	
	$this->main_tmpl = $this->getReplacedContent($sr, "admin_index");
	$this->v_control->register();
	echo $this->main_tmpl;
}

private function getUserName(){
	if(isset($_SESSION["user"]) && isset($_SESSION["password"])){
		$sr["username"] = $_SESSION["username"];
		return $this->getReplacedContent($sr, "admin_user");
	} else return "";

}

private function isLoggedIn(){
	if(isset($_SESSION["user"]) && isset($_SESSION["password"]) && isset($_SESSION["logged_in"])) return $this->getContent("user_l");
	return false;
}

private function getShoppingCart(){
	$text = "";
	$ids = (isset($_COOKIE["pr_id"])) ? explode(":", $_COOKIE["pr_id"]) : array();
	$ids = array_unique($ids);
	$ids = array_values($ids);
	$ids = $this->filter($ids);

	if(!isset($_COOKIE["pr_id"]) || $_COOKIE["pr_id"] == "" || count($ids) == 0){
		$text = $this->getContent("empty_cart");
		$sr["cart_items"] = $text;
		return $this->getReplacedContent($sr, "shopping_cart");
	}

	for($i = 0; $i < count($ids); $i++){
		$pr = $this->products->getProduct($ids[$i]);
		$c["name"] = $pr["name"];
		$c["price"] = number_format($pr["price"], 0, "", " ");
		$c["id"] = $pr["id"];
		$text .= $this->getReplacedContent($c, "cart_item");
	}

	$sr["cart_items"] = $text;
	return $this->getReplacedContent($sr, "shopping_cart");
}

private function filter($arr){
	for($i = 0; $i < count($arr); $i++){
		if($arr[$i] == ""){
			unset($arr[$i]);
			$arr = array_values($arr);
		}
	}
	return $arr;
}

protected function getFilter($cat = ""){

	$filters = $this->products->getCategories();
	$all["hover"] = (empty($cat) || !$cat) ? "how-active1" : "";
	$text = $this->getReplacedContent($all, "filter_all");
	for($i = 0; $i < count($filters); $i++){
		$fl["hover"] = ($filters[$i]["alias"] == $cat) ? "how-active1" : "";
		$fl["filter"] = $filters[$i]["alias"];
		$fl["filter_name"] = $filters[$i]["title"];
		$fl["how-active1"] = "";
		$text .= $this->getReplacedContent($fl, "filter_button");
	}
	$sr["filter_buttons"] = $text;
	return $this->getReplacedContent($sr, "filter_container");
}

private function getFrequentlyContent(){
$art = $this->article->getInterestingArticles("views", 5);
if(count($art) == 0) return $this->getContent("no_article");
$text = "";
for($i = 0; $i < count($art); $i++){
	$sr["link"] = $art[$i]["article_link"];
	$sr["image_link"] = $art[$i]["image_link"];
	$sr["title_article"] = $art[$i]["title"];
	$sr["desc"] = mb_substr(strip_tags($art[$i]["full_text"]), 0, 40)."...";
	$text .= $this->getReplacedcontent($sr, "fr-article-contents");
}

return $text;
}

private function getTopList($limit){
$models = $this->toplist->getTops($limit);
$text = "";
if(count($models) == 0) return $this->getContent("empty_toplist");
for($i = 0; $i < count($models); $i++){
	$sr["model"] = $models[$i]["model"];
	$sr["count"] = ($i+1);
	$sr["name"] = $models[$i]["name"];
	$sr["score"] = $models[$i]["score"];
	$text .= $this->getReplacedContent($sr, "device_info");
}
return $text;
}

public function notFound(){
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");
	$contents = $this->getContent("not_found");
	$title = "Запрощенная страницане найдена - ".SITE_NAME;
	$m_desc = "Запрощенная страницане найдена, 404, Страница не найдена";
	$m_key = "запрощенная страницане найдена, 404, страница не найдена, не найдена";
	$this->Render($title, $m_desc, $m_key, $contents);
	exit;
}
}


?>