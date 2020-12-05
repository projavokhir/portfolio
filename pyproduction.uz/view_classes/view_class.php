<?php

class View extends Module{

protected $param;
protected $m_desc;
protected $m_key;

public function __construct(){
	parent::__construct();
	$this->m_desc = 'PY PRODUCTION — продакшн компания полного цикла, которая cоздает продукт, помогающий развивать бизнес. Компания PY образована режиссером и фотографом Парвизом Яхьяевым в 2012 году. PY PRODUCTION – молодая продакшн компания, работающая в сфере кино, телевидения, музыкальных клипов и рекламы.';
	$this->m_key = 'py production, продакшн компания';
}

public function Render($title = "", $m_desc = "", $m_key = "", $contents = ""){
	$sr["title"] = $title;
	$sr["meta_desc"] = $this->m_desc;
	$sr["meta_key"] = $this->m_key;
	$sr["fp_main"] = $this->returnClass();
	$sr["other_styles"] = $this->returnStyels();
	$sr["other_scripts"] = $this->returnScripts();
	$sr["time"] = time();
	$sr["content"] = $contents;
	$sr["main-left-menu"] = $this->getLM();
	$sr["sidebar"] = $this->getSidebar();
	$sr["footer"] = $this->getFooter();
	$sr["py_facebook"] = PY_FB;
	$sr["py_instagram"] = PY_IG;
	$sr["py_vk"] = PY_VK;
	$sr["py_youtube"] = PY_YT;
	$sr["py_tg"] = PY_TG;
	$this->main_tmpl = $this->getReplacedContent($sr, MAIN_LAYOUT);
	echo $this->main_tmpl;
}

private function getFooter(){
	$v = $this->controller->getVacs();
	$t = '';
	for($i = 0; $i < 6; $i++){
		if($i >= count($v)) break;
		$p['name'] = $v[$i]["category"];
		$t .= $this->getReplacedContent($p, "footer_vac_item");
	}
	$file = parse_ini_file(MAIN_DIR."contents/pdf_url.ini");
	$y['vacancies'] = $t;
	$y['pdf_link'] = $file["f"];
	return $this->getReplacedContent($y, "footer");
}

public function getSidebar(){
	$file = parse_ini_file(MAIN_DIR."contents/pdf_url.ini");
	$y['pdf_url'] = $file["f"];
	return $this->getReplacedContent($y, "sidebar");
}

protected function getHeaders($alias){
	$f = parse_ini_file("./".MAIN_DIR."contents/contents.ini", true);
	return (isset($f[$alias])) ? $f[$alias] : false;
}

protected function security($t){
	return preg_match("#(\<script\>)|(\<\/script\>)#", $t) ? htmlspecialchars($t) : $t;
}

protected function getServices(){
	$c = $this->controller->getCategories();
	$temp = "";
	for($i = 0; $i < count($c); $i++){
		$t['service_header'] = $c[$i]["service_name"];
		$t['services_list'] = $this->getListServices($c[$i]["service_name"]);
		$temp .= $this->getReplacedContent($t, "services-block");
	}
	return $temp;
}

private function getListServices($cat){
	$arr = $this->controller->getServicesByCat($cat);
	$l = "";
	for($i = 0; $i < count($arr); $i++){
		$l .= "<p>".$arr[$i]["name"]."</p>";
	}
	return $l;
}

protected function getClients(){
	$s = $this->controller->getBrands();
	$temp = "";
	for($i = 0; $i < count($s); $i++){
		$t["img_link"] = $s[$i]["logo_url"];
		$temp .= $this->getReplacedContent($t, "brand-logo");
	}
	return $temp;
}

protected function getProjects($page){
	$s = $this->controller->getProjects();
	$p = $page == "main" ? 2 : count($s);
	$temp = "";
	for($i = 0; $i < $p; $i++){
		$t["id"] = $this->toLatin($s[$i]["header"])."-id-".$s[$i]["id"];
		$t["is_front"] = $page == "main" ? "front-page" : "";
		$t["pr_header"] = $s[$i]["header"];
		$t["pr_desc"] = $s[$i]["description"];
		$t["hashtags"] = $s[$i]["hashtag"];
		$t["cover"] = $s[$i]["img_cover"];
		$temp .= $this->getReplacedContent($t, "project-block");
	}
	return $temp;
}

protected function getPortfolio(){
	$s = $this->controller->getOwnProjects();
	$temp = "";
	for($i = 0; $i < count($s); $i++){
		$t["link"] = $s[$i]["project_link"];
		$t["img_url"] = $s[$i]["logo_url"];
		$temp .= $this->getReplacedContent($t, "ownproject");
	}
	return $temp;
}


public function getLM(){ return ""; }
public function returnClass(){ return ""; }
public function returnStyels(){ return ""; }
public function returnScripts(){ return ""; }

public function RenderCpanel($title = "", $contents = ""){
	
	$sr["title"] = $title;
	$sr["user"] = $this->getUserName();
	$sr["content"] = $contents;
	
	$this->main_tmpl = $this->getReplacedContent($sr, "admin_index");
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