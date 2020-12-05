<?php

class Index extends View{

private $main_title;
private $products_count = 8;

public function __construct(){
	$this->main_title = $this->getTitle();
	parent::__construct();
	$y = parse_ini_file(MAIN_DIR.'contents/youtube.ini');
	$s = parse_ini_file(MAIN_DIR.'contents/swipe-text.ini');
	define("MAIN_VIDEO", $y['t']);
	define("MAIN_SWIPE_TEXT", $s['t']);
}

public function show_content(){
	$title = $this->main_title;
	$m_desc = "PY PRODUCTION";
	$m_key = "py";
	$contents = $this->renderIndex();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

public function returnClass(){
	return "fp-main-cont";
}

private function renderIndex(){
	$t["main-slide-section"] = $this->getMainSlide();
	$t["about-slide-section"] = $this->getAboutSlide();
	$t["services-slide-section"] = $this->getServicesSlide();
	$t["partners-slide-section"] = $this->getPartnersSlide();
	$t["projects-slide-section"] = $this->getProjectsSlide();
	$t["own-projects-slide-section"] = $this->getOwnProjectsSlide();
	return $this->getReplacedContent($t, "main-content");
}

public function getLM(){
	return $this->getContent("main-menu-left");
}

public function returnStyels(){
	return $this->getContent("main-styles");
}

public function returnScripts(){
	return $this->getContent("main-scripts");
}

private function getMainSlide(){
	$t["video_url"] = MAIN_VIDEO;
	$t["main-logo"] = $this->getContent("main-logo");
	$t["swipe_text"] = MAIN_SWIPE_TEXT;
	return $this->getReplacedContent($t,"main-slide-section");
}

private function getVacancy(){
	$h = $this->getHeaders("vacancy");
	$t["header"] = $h["header"];
	$t["desc"] = $h["desc"];
	$t["contents"] = $h["desc"];
	return $this->getReplacedContent($t,"vacancies-slide-section");
}

private function getAboutSlide(){
	$ftext = $this->controller->getAllFrom("about");
	$h = $this->getHeaders("about");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$temp = "";
		for($i = 0; $i < 2; $i++){
			if($i == count($ftext)) break;
			$w["paragraphs"] = $ftext[$i]["full_text"];
			$temp .= $this->getReplacedContent($w, "about-fulltext");
		}
	$t["contents"] = $temp;
	return $this->getReplacedContent($t, "about-slide-section");
}

private function getServicesSlide(){
	$h = $this->getHeaders("services");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["services_block"] = $this->getServices();
	return $this->getReplacedContent($t, "services-slide-section");
}

private function getPartnersSlide(){
	$h = $this->getHeaders("clients");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["brands"] = $this->getClients();
	return $this->getReplacedContent($t, "clients-slide-section");
}

private function getProjectsSlide(){
	$h = $this->getHeaders("projects");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["projects"] = $this->getProjects("main");
	return $this->getReplacedContent($t,"projects-slide-section");
}

private function getOwnProjectsSlide(){
	$h = $this->getHeaders("projects");
	$h = $this->getHeaders("portfolio");
	$t["header"] = $this->security($h["header"]);
	$t["ownprojects"] = $this->getPortfolio();
	return $this->getReplacedContent($t,"ownprojects-slide-section");
}

private function getProducts(){
	$products = $this->products->getAllSByDLimit($this->products_count);
	$text = "";
	if(count($products) == 0 || gettype($products) == "boolean"){
		$text = $this->getContent("no_product");
}
else{
for($i = 0; $i < count($products); $i++){
	$cover = explode(",", $products[$i]["images"]);
	$cover = $cover[0];
		$ar["category"] = $products[$i]["category_alias"];
		$ar["if_new"] = ((time() - $products[$i]["time"]) < 3600*48) ? "label-new" : "";
		$ar["label_new"] = ((time() - $products[$i]["time"]) < 3600*48) ? 'data-label="New"' : "";
		$ar["link"] = $products[$i]["alias"];
		$ar["cover_link"] = $cover;
		$ar["name"] = $products[$i]["name"];
		$ar["price"] = number_format($products[$i]["price"], 0, "", " ");
		$text .= $this->getReplacedContent($ar, "product_review");
	}
}
	$sr["filters"] = $this->getFilter();
	$sr["products"] = $text;
	return $this->getReplacedContent($sr, "products_isotope");
}

}
?>