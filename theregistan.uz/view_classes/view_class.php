<?php

class View extends Module{

protected $param;

public function __construct(){
	parent::__construct();
}

public function Render($title = "", $m_desc = "", $m_key = "", $contents = "", $is_main = false, $gallery = false){
	$styles = $this->getContent("styles", false);
	$scripts = $this->getContent("scripts", false);

	$sr["title"] = $title;
	$sr["time"] = time();
	$sr["meta_desc"] = $m_desc;
	$sr["meta_key"] = $m_key;
	$sr["styles"] = $styles;
	$sr["scripts"] = $scripts;
	$sr["navbar_top"] = $this->getNavTop();
	$sr["container"] = $contents;
	$sr["id_main"] = ($is_main) ? "main-content" : "";
	$sr["gallery"] = ($gallery) ? $this->getGallery("gallery") : "";
	$sr["footer"] = $this->getContent("footer");
	
	$this->main_tmpl = $this->getReplacedContent($sr, MAIN_LAYOUT);
	echo $this->main_tmpl;
}

public function RenderCpanel($title = "", $contents = ""){
	
	$sr["title"] = $title;
	$sr["user"] = $this->getUserName();
	$sr["content"] = $contents;
	
	$this->main_tmpl = $this->getReplacedContent($sr, "admin_index");
	echo $this->main_tmpl;
}

private function getGallery($tmp){
	$f = file_get_contents("./core/ini_files/slider.txt");
	$sr["link"] = $f;
	return $this->getReplaCedcontent($sr, $tmp);
}

private function getUserName(){
	if(isset($_SESSION["user"]) && isset($_SESSION["password"])){
		$sr["username"] = $_SESSION["username"];
		return $this->getReplacedContent($sr, "admin_user");
	} else return "";

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

private function getNavTop(){
	$cat = $this->article->getCategories();
	$text = "";
	for($i = 0; $i < count($cat); $i++){
		$sr["link"] = $cat[$i]["alias"];
		$sr["name"] = $cat[$i]["namecat"];
		$text .= $this->getReplacedContent($sr, "cat_item");
	}
	$bb["cat_item"] = $text;
	return $this->getReplacedcontent($bb, "navbar_top");
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