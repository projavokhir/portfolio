<?php

class Projects extends View{

private $main_title;
private $portfolio_count = 6;
private $p;

public function __construct($p){
 $this->main_title = $this->getTitle();
 $this->p = count($p) != 0 ? substr($p[0], strlen($p[0])-1) : '';
	parent::__construct(); 
}

public function showcontent(){
	$title = $this->getTitle();
	$m_desc = "PY PRODUCTION";
	$m_key = "py";
	$contents = $this->renderContent();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

public function showProject(){
	$title = $this->main_title;
	$m_desc = "PY PRODUCTION";
	$m_key = "py";
	$contents = $this->getPortfolioInner();
	$this->Render($this->main_title, $m_desc, $m_key, $contents, true, true);
}

private function getPortfolioInner(){
	$bl = $this->controller->getProject($this->p);
	$t['header'] = $bl['header'];
	$t['second_header'] = $bl['second_header'];
	$t['images'] = $this->getProjectImages($bl['images']);
	$t['tags'] = $this->getProjectTags($bl['hashtag']);
	return $this->getReplacedContent($t, 'portfolio-inner-page');
}

private function getProjectImages($q){
	$q = explode(",",$q);
	$t = '';
	for($i = 0; $i < count($q); $i++){
		$t .= '<img src="'.$q[$i].'">';
	}
	return $t;
}

private function getProjectTags($q){
	$q = explode(",",$q);
	$t = '';
	for($i = 0; $i < count($q); $i++){
		$t .= ' #'.$q[$i];
	}
	return $t;
}

private function getTags(){
	$f = parse_ini_file(MAIN_DIR."contents/tags.ini", true);
	$headers = explode(",", $f["headers"]["all"]);	
	$tags = explode(",", $f["tags"]["all"]);
	$li = "";
		for($i = 0; $i < count($headers); $i++){
			$q["tag"] = $tags[$i];
			$q["header"] = $headers[$i];
			$li .= $this->getReplacedContent($q, "tag");
		}
	return $li;	
}

public function getPortfolios($count, $ajax = false){
	$s = $this->controller->getPortfolioData($count);
	if(count($s) == 0) return false;
	$temp = "";
		for($i = 0; $i < count($s); $i++){
			$classes = "";
			$hashtags = "";
			$ha = explode(",", $s[$i]["hashtag"]);
			for($r = 0; $r < count($ha); $r++){
				if(count($ha) != 0){	
					$classes .= " ".$ha[$r];
					$hashtags .= count($ha) > 1 ? "#".$ha[$r]." " : "#".$ha[$r];
				}
			}
			$t["is_front"] = $classes." grid-item";
			$t["hashtags"] = $hashtags;
			$t["id"] = $this->toLatin($s[$i]["header"])."-id-".$s[$i]["id"];
			$t["pr_header"] = $s[$i]["header"];
			$t["pr_desc"] = $s[$i]["description"];
			$t["cover"] = $s[$i]["img_cover"];
			$temp .= $this->getReplacedContent($t, "project-block", $ajax);
		}
	return $temp;
}

public function returnScripts(){
	return $this->p == '' ? $this->getContent("projects-scripts") : '';
}

private function renderContent(){
	$h = $this->getHeaders("projects");
	$t["header"] = $this->security($h["header"]);
	$t["desc"] = $this->security($h["desc"]);
	$t["tags"] = $this->getTags();
	$t["portfolio"] = $this->getPortfolios($this->portfolio_count);
	return $this->getReplacedContent($t, "projects");
}

}
?>