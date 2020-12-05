<?php

class Index extends View{

private $main_title = "The Registan — Журнал о людях, моде, культуре, бизнесе, спорте, истории успеха, и интересных событиях в Самарканде";
private $articles_count = 6;

public function __construct(){
	parent::__construct();
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

public function show_content(){
	$title = $this->main_title;
	$m_desc = "Главная страница, Главная, The Registan, PY, Parviz Yakhyayev, Parviz";
	$m_key = "главная, главная страница, страница, py, the registan";
	$contents = $this->getIndexContent();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

protected function getIndexContent(){
	$sr["content"] = $this->getNewArticles($this->articles_count);
	$sr["bottom"] = $this->getContent("journal");
	return $this->getReplacedContent($sr, "main_container");
}

private function getAds(){
	return $this->getContent("ads-left-block");
}

private function getNewArticles($limit){
	$articles = $this->article->getAllSByDLimit($limit);
	$text = "";
	if(count($articles) == 0 || gettype($articles) == "boolean"){
		$text = $this->getContent("no_article");
}
else{
for($i = 0; $i < count($articles); $i++){
		$full_text = strip_tags(substr($articles[$i]["full_text"], 0, strpos($articles[$i]["full_text"], "</p>")+4));
		$ar["link_article"] = $articles[$i]["alias"];
		$ar["image_link"] = $articles[$i]["cover_link"];
		$ar["title"] = $articles[$i]["title"];
		$ar["desc_text"] = $full_text;
		$text .= $this->getReplacedContent($ar, "article_inner");
	}
}
	$sr["article"] = $text;
	$sr["more"] = ($this->article->getAllCount_1() > $this->articles_count)?$this->getContent("more-btn"):"";
	return $this->getReplacedContent($sr, "main_article");
}

}
?>