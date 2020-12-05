<?php

class Article_view extends View{

public $articles;
private $article_id;
protected $key;
protected $all_params;
private $title;
private $meta_desc;
private $meta_key;
private $params;
private $cop = 6;

public function __construct($params){
	parent::__construct();
	$this->params = $params;
	$this->all_params = $params;
	$this->key = array_shift($params);
}

public function showArticles(){
if($this->all_params[0] == "cat") $this->getAllContent();
else if(count($this->all_params) == 1) $this->show_article();
}

public function getMainAjaxContent($limit){
	$post = $this->news->getLastPosts($limit);
	$cont = "";
	if(!$post || count($post) == 0){echo "err"; return;}
	for($i = 0; $i < count($post); $i++){
		$sr = [];
		$cont .= $this->getReplacedContent($sr, "article_inner", true);
	}
	return $cont;
}

private function getAllContent(){
$cat = $this->all_params[1];
if(isset($cat)){
	if(!$this->article->issetCategory($cat)) $this->notFound();
	$catname = $this->article->issetCategory($cat)["namecat"];
	$title = SITE_NAME."&nbsp;|&nbsp;".$catname;

}
$meta_desc = "";
$meta_key = "";
$cont = "";

$articles = $this->article->getByCategory($cat, $this->cop);
if(count($articles)  == 0){
	$cont = $this->getContent("no_article");
	$this->Render($title, "Нет ни одной публикации", "Нет ни одной публикации", $cont);
	return false;
}
for($i = 0; $i < count($articles); $i++){
	$full_text = strip_tags(substr($articles[$i]["full_text"], 0, strpos($articles[$i]["full_text"], "</p>")+4));
	$ar["link_article"] = $articles[$i]["alias"];
	$ar["image_link"] = $articles[$i]["cover_link"];
	$ar["title"] = $articles[$i]["title"];
	$ar["desc_text"] = $full_text;
	$ar["link_article"] = $articles[$i]["alias"];
	$cont .= $this->getReplacedContent($ar, "article_inner");
}
$sr["article"] = $cont;
$mr["cat"] = $cat;
$sr["more"] = ($this->article->getAllCount($cat) > $this->cop)?$this->getReplacedContent($mr, "more-btn-cat"):"";
$more["cat"] = $cat;
$t = $this->getReplacedContent($sr, "main_article");
$this->Render($title, $meta_desc, $meta_key, $t, true);
return;
}

public function show_article(){
	$sr["article"] = $this->getArticleBlock();
	$this->article->updateViews($this->key);
	$content = $this->getReplacedContent($sr, "article_content");
	$this->Render($this->title, $this->meta_desc, $this->meta_key, $content);
}

private function getArticleBlock(){
	$article = $this->article->getArticle($this->key);
	if(!$article) $this->notFound();
	$this->meta_desc = $article["description"];
	$this->meta_key = mb_strtolower($article["keywords"]);
	$this->title = SITE_NAME."&nbsp;|&nbsp;".$article["title"];
	$ar["title"] = $article["title"];
	$ar["date"] = $this->formatDate($article["time"]);
	$ar["views"] = $article["views"];
	$ar["cover_image"] = $article["cover_link"];
	$ar["categories"] = $this->getCategories($article["category"]);
	$ar["full_text"] = $article["full_text"];
	return $this->getReplacedContent($ar, "article_blog_inner");
}

private function getCategories($cat){

$categories = explode(",", $cat);
$text = "";

for($i = 0; $i < count($categories); $i++){
	$sr["category"] = $categories[$i];
	$text .= $this->getReplacedContent($sr, "article_categories");
}
return $text;
}

private function getInterestingContent(){
$interesting = $this->article->getInterestingArticles($this->key, 4);
if(!$interesting) $text = $this->getContent("no_interesting");
else{ $temp = "";
for($i = 0; $i < count($interesting); $i++){
	$sr["link"] = $interesting[$i]["article_link"];
	$sr["img_link"] = $interesting[$i]["image_link"];
	$sr["title"] = $interesting[$i]["title"];
	$sr["text"] = stripslashes(substr(strip_tags($interesting[$i]["full_text"]), 0, 200));
	$temp .= $this->getReplacedContent($sr, "interesting_article");
}
$ss["interesting_article"] = $temp;
$text = $this->getReplacedContent($ss, "interesting_articles_content");
}
return $text;

}

private function getComments(){
	return "There should be the content of comments!";
}



}

?>